<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Project;
use App\Models\News;
use App\Models\ProjectMedia;
use App\Models\Apartment;
use Carbon\Carbon;

class ProjectController extends Controller
{

    public function home()
    {
        $projects = Project::all();

        $news = News::with('media')->get()->map(function ($item) {
            $item->formatted_date = Carbon::parse($item->created_at)->translatedFormat('d F Y');

            // Выделение первого предложения
            if (preg_match('/.*?[.!?](\s|$)/u', $item->text, $matches)) {
                $item->first_sentence = $matches[0];
            } else {
                $item->first_sentence = $item->text;
            }

            return $item;
        });

        return view('home', compact('projects', 'news'));
    }

    public function show($id) 
    {
        $project = Project::with([
            'media',
            'location',
            'transports',
            'infrastructures',
            'places',
            'architectures',
            'apartments.media'
        ])->findOrFail($id);

        // Можно выбрать нужные изображения по типу:
        $titleImage = $project->media->firstWhere('type', 'title');
        $descriptionImage = $project->media->firstWhere('type', 'description');
        $galleryImages = $project->media->where('type', 'gallery');

        return view('project', compact('project', 'titleImage', 'descriptionImage', 'galleryImages'));
    }


    public function index()
    {
        $projects = Project::with(['media', 'location'])->get();
        
        foreach ($projects as $project) {
            $project->titleImage = $project->media()->where('type', 'title');
        }

        return view('home', compact('projects'));
    }

    public function filterApartments(Request $request, $id)
    {
        //dd(request()->fullUrl(), $request->all(), $request->query());
        $type = $request->query('type');

        $query = Apartment::with('media', 'project')->where('id_project', $id);

        if (!empty($type)) {
            $query->where('type', $type);
        }

        $apartments = $query->get();

        $lastApartment = $apartments->last();
        
        return response()->json(['apartments' => $apartments->values(),
                                'lastApartment' => $lastApartment]);
    }

    public function allProjects()
    {
        $projects = Project::with(['media', 'location', 'apartments'])->get();

        foreach ($projects as $project) {
            $project->titleImage = $project->media->firstWhere('type', 'title');

            $grouped = $project->apartments->groupBy('type');

            $project->apartmentStats = $grouped->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'avg_area' => round($group->avg('area'), 2), // средняя площадь с 2 знаками
                ];
            });

            $project->totalApartments = $project->apartments->count();
        }

        $cities = DB::table('locations')
            ->select('city')
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        return view('all_projects', compact('projects', 'cities'));
    }


   public function filter(Request $request)
    {
        $city = $request->query('city');
        $type = $request->query('type');
    
        $projects = Project::with(['media', 'location', 'apartments'])
            ->when($city, function ($query, $city) {
                $query->whereHas('location', function ($q) use ($city) {
                    $q->where('city', $city);
                });
            })
            ->get();
        
        foreach ($projects as $project) {
            $project->titleImage = $project->media->firstWhere('type', 'title');
        
            $grouped = $project->apartments->groupBy('type');
        
            $project->apartmentStats = $grouped->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'avg_area' => round($group->avg('area'), 2),
                ];
            });
        
            $project->totalApartments = $project->apartments->count();
        }
    
        if ($type) {
            $projects = $projects->filter(function ($project) use ($type) {
                return isset($project->apartmentStats[$type]) && $project->apartmentStats[$type]['count'] > 0;
            });
        }
    
        $html = view('partials.project_cards', ['projects' => $projects])->render();
    
        return response()->json(['html' => $html]);
    }
}