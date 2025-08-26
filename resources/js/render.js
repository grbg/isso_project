import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { DRACOLoader } from 'three/examples/jsm/loaders/DRACOLoader.js';

const canvas = document.querySelector("#project_section_model");
const sizes = {
    width: window.innerWidth,
    height: window.innerHeight,
};

const scene = new THREE.Scene();

const loaderTexture = new THREE.TextureLoader();
loaderTexture.load('/images/render_bg2.jpg', (texture) => {
    scene.background = texture;
});

const camera = new THREE.PerspectiveCamera(
    50,
    sizes.width / sizes.height,
    0.01,
    10000
);
camera.position.set(5, 5, 5);
camera.lookAt(0, 0, 0);
scene.add(camera);

const renderer = new THREE.WebGLRenderer({ canvas, antialias: false }); // antialias отключен для производительности
renderer.setSize(sizes.width, sizes.height);
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.5)); // ограничиваем пиксель рэйтио

const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;

const dracoLoader = new DRACOLoader();
dracoLoader.setDecoderPath('/draco/');
const loader = new GLTFLoader();
loader.setDRACOLoader(dracoLoader);

scene.add(new THREE.AmbientLight(0xffffff, 1));
const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
directionalLight.position.set(10, 10, 10);
scene.add(directionalLight);

let model;
loader.load('../storage/models/building_2.glb', (gltf) => {
    model = gltf.scene;

    model.scale.set(1, 1, 1);

    const box = new THREE.Box3().setFromObject(model);
    const center = new THREE.Vector3();
    box.getCenter(center);
    model.position.sub(center);

    scene.add(model);

    const size = new THREE.Vector3();
    box.getSize(size);
    const maxDim = Math.max(size.x, size.y, size.z);
    const dist = maxDim * 1.5; 

    camera.position.set(dist, dist, dist);
    camera.lookAt(0, 0, 0);
    controls.update();
}, undefined, (error) => {
    console.error('Ошибка загрузки GLB:', error);
});

const animate = () => {
    controls.update();
    renderer.render(scene, camera);
    requestAnimationFrame(animate);
};
animate();

const zoomFactor = 0.9;

document.getElementById('zoomModelIn').addEventListener('click', () => {
    camera.position.multiplyScalar(zoomFactor);
    controls.update();
});

document.getElementById('zoomModelOut').addEventListener('click', () => {
    camera.position.multiplyScalar(1 / zoomFactor);
    controls.update();
});

window.addEventListener('resize', () => {
    sizes.width = window.innerWidth;
    sizes.height = window.innerHeight;

    camera.aspect = sizes.width / sizes.height;
    camera.updateProjectionMatrix();

    renderer.setSize(sizes.width, sizes.height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.5));
});
