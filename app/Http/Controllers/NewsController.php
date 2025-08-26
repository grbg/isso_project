<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function show($id)
    {
        $news = News::with('media')->findOrFail($id); // Загрузка новости и связанного медиа (если есть)
        return view('news', compact('news'));
    }

}
