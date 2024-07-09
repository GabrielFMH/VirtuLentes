<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superposición de Lentes en Tiempo Real</title>
    <style>
        .container {
            position: relative;
            display: inline-block;
            
        }
        .glasses {
            position: absolute;
            transform: translate(-50%, -50%);
            width: 100px; /* Ajusta el tamaño de los lentes según sea necesario */
            height: auto;
            display: none; /* Ocultar inicialmente */
        }
        #output_canvas {
            position: absolute;
            top: 0;
            left: 0;
            display: none; /* Ocultar el canvas */
        }
        video {
            width: 100%;
        }
        .button-container {
            text-align: left;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        h1 {
            text-align: left;
            margin-bottom: 10px;
        }
        p.intro {
            text-align: left;
            margin-bottom: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>

</head>
<body>
<h1>Prueba de Lentes en Tiempo Real</h1>
<p class="intro">Aquí puedes probar diferentes estilos de lentes en tiempo real usando tu cámara. Activa la cámara para comenzar.</p>
    <div class="container">
        <video id="webcam" autoplay playsinline></video>
        <canvas id="output_canvas"></canvas>
        <img id="glassesImage" class="glasses" />
    </div>
    <div class="button-container">
    <button onclick="window.location.href='../../glasses.php'">Volver</button>

    </div>
    <script type="module">
        import vision from "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3";
        const { FaceLandmarker, FilesetResolver } = vision;

        let faceLandmarker;
        const videoElement = document.getElementById('webcam');
        const canvasElement = document.getElementById('output_canvas');
        const canvasCtx = canvasElement.getContext('2d');
        const glassesImage = document.getElementById('glassesImage');

        // Función para obtener el valor del parámetro id de la URL
        function getIdFromUrl() {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get('id');
        }

        // Establece la imagen de los lentes según el id
        function setGlassesImageById(id) {
            if (id == 1) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Pic.png";
            } else if (id == 2) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Clipart.png";
            }
            else if (id == 3) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Clipart.png";
            }
            else if (id == 4) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-Transparent-Background.png";
            }
            else if (id == 5) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Clipart.png";
            }
            else if (id == 6) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Clipart.png";
            }
            else if (id == 7) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-Transparent-Background.png";
            }
            else if (id == 8) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Transparent-Image.png";
            }
            else if (id == 9) {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-Clipart.png";
            }
            else {
                glassesImage.src = "https://www.pngmart.com/files/1/Glasses-PNG-File.png";
            }
        }

        async function createFaceLandmarker() {
            const filesetResolver = await FilesetResolver.forVisionTasks(
                "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3/wasm"
            );
            faceLandmarker = await FaceLandmarker.createFromOptions(filesetResolver, {
                baseOptions: {
                    modelAssetPath: `https://storage.googleapis.com/mediapipe-models/face_landmarker/face_landmarker/float16/1/face_landmarker.task`,
                    delegate: "GPU"
                },
                outputFaceBlendshapes: false,
                runningMode: "VIDEO",
                numFaces: 1
            });
            console.log("FaceLandmarker cargado");
        }

        async function enableCam() {
            if (!faceLandmarker) {
                console.log("¡Espera! FaceLandmarker aún no se ha cargado.");
                return;
            }

            const constraints = {
                video: true
            };
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            videoElement.srcObject = stream;
            videoElement.addEventListener('loadeddata', predictWebcam);
        }

        async function predictWebcam() {
            canvasElement.width = videoElement.videoWidth;
            canvasElement.height = videoElement.videoHeight;

            const faceLandmarkerResult = await faceLandmarker.detectForVideo(videoElement, performance.now());

            if (faceLandmarkerResult.faceLandmarks) {
                for (const landmarks of faceLandmarkerResult.faceLandmarks) {
                    // No dibujes los puntos de referencia en el canvas

                    // Posiciona los lentes
                    positionGlasses(landmarks);
                }
            }

            window.requestAnimationFrame(predictWebcam);
        }

        function positionGlasses(landmarks) {
            // Obtén las dimensiones y posición del video
            const videoRect = videoElement.getBoundingClientRect();
            const leftEye = landmarks[33]; // índice aproximado del ojo izquierdo
            const rightEye = landmarks[263]; // índice aproximado del ojo derecho

            // Calcula el ancho entre los ojos
            const eyeWidth = distance(leftEye, rightEye) * videoRect.width;

            // Calcula el centro entre los ojos
            const centerX = ((leftEye.x + rightEye.x) / 2) * videoRect.width;
            const centerY = ((leftEye.y + rightEye.y) / 2) * videoRect.height;

            // Ajusta el tamaño y posición de los lentes
            glassesImage.style.width = eyeWidth * 1.5 + 'px'; // Ajusta según sea necesario
            glassesImage.style.left = centerX + 'px';
            glassesImage.style.top = centerY + 'px';
            glassesImage.style.display = 'block'; // Mostrar los lentes
        }

        function distance(point1, point2) {
            return Math.sqrt(Math.pow(point1.x - point2.x, 2) + Math.pow(point1.y - point2.y, 2));
        }

        // Inicializa FaceLandmarker y habilita la cámara
        createFaceLandmarker().then(() => {
            const id = getIdFromUrl();
            setGlassesImageById(id);
            enableCam();
        });
    </script>
</body>
</html>
