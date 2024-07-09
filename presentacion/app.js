import * as THREE from 'three';
import { STLLoader } from 'three/addons/loaders/STLLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

if (!modelUrl) {
    console.error("No model URL provided");
} else {
    console.log("Product ID:", productId); // Asegúrate de que el ID del producto es correcto
    console.log("Model URL:", modelUrl); // Asegúrate de que la URL es correcta

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0xffffff, 1);
    document.body.appendChild(renderer.domElement);

    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.maxPolarAngle = Math.PI;

    const light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(5, 5, 5).normalize();
    scene.add(light);

    const loader = new STLLoader();
    loader.load(modelUrl, function (geometry) {
        geometry.computeBoundingBox();
        const sizeX = geometry.boundingBox.max.x - geometry.boundingBox.min.x;
        const sizeY = geometry.boundingBox.max.y - geometry.boundingBox.min.y;
        const sizeZ = geometry.boundingBox.max.z - geometry.boundingBox.min.z;
        const maxSize = Math.max(sizeX, sizeY, sizeZ);
        const scaleFactor = 100 / maxSize; // Escala todos los modelos para que el lado más largo sea 100

        const material = new THREE.MeshPhongMaterial({ color: 0x555555, specular: 0x111111, shininess: 200 });
        const mesh = new THREE.Mesh(geometry, material);
        scene.add(mesh);
        mesh.position.set(0, 0, 0);
        mesh.rotation.set(-Math.PI / 2, 0, 0);
        mesh.scale.set(scaleFactor, scaleFactor, scaleFactor);
    }, function (xhr) {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
    }, function (error) {
        console.error("Error loading STL:", error);
        if (error.target) {
            console.error("Error status:", error.target.status);
            console.error("Error status text:", error.target.statusText);
        }
    });

    camera.position.z = 100; // Ajusta esta posición según sea necesario para que los modelos sean visibles adecuadamente

    function animate() {
        requestAnimationFrame(animate);
        renderer.render(scene, camera);
    }
    animate();
}
