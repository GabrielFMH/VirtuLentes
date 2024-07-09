import vision from "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3";
const { FaceLandmarker, FilesetResolver, DrawingUtils } = vision;
const demosSection = document.getElementById("demos");
let faceLandmarker;
let runningMode = "IMAGE";
let enableWebcamButton;
let webcamRunning = false;
const videoWidth = 480;

async function createFaceLandmarker() {
    const filesetResolver = await FilesetResolver.forVisionTasks("https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.3/wasm");
    faceLandmarker = await FaceLandmarker.createFromOptions(filesetResolver, {
        baseOptions: {
            modelAssetPath: `https://storage.googleapis.com/mediapipe-models/face_landmarker/face_landmarker/float16/1/face_landmarker.task`,
            delegate: "GPU"
        },
        outputFaceBlendshapes: false,
        runningMode,
        numFaces: 1
    });
    demosSection.classList.remove("invisible");
    console.log("FaceLandmarker cargado");
}
createFaceLandmarker();

const imageContainers = document.getElementsByClassName("detectOnClick");
for (let imageContainer of imageContainers) {
    imageContainer.children[0].addEventListener("click", handleClick);
}

async function handleClick(event) {
    if (!faceLandmarker) {
        console.log("¡Espera a que FaceLandmarker se cargue antes de hacer clic!");
        return;
    }
    if (runningMode === "VIDEO") {
        runningMode = "IMAGE";
        await faceLandmarker.setOptions({ runningMode });
    }
    const allCanvas = event.target.parentNode.getElementsByClassName("canvas");
    for (var i = allCanvas.length - 1; i >= 0; i--) {
        const n = allCanvas[i];
        n.parentNode.removeChild(n);
    }

    const faceLandmarkerResult = faceLandmarker.detect(event.target);
    const canvas = document.createElement("canvas");
    canvas.setAttribute("class", "canvas");
    canvas.setAttribute("width", event.target.naturalWidth + "px");
    canvas.setAttribute("height", event.target.naturalHeight + "px");
    canvas.style.left = "0px";
    canvas.style.top = "0px";
    canvas.style.width = `${event.target.width}px`;
    canvas.style.height = `${event.target.height}px`;
    event.target.parentNode.appendChild(canvas);
    const ctx = canvas.getContext("2d");
    const drawingUtils = new DrawingUtils(ctx);
    for (const landmarks of faceLandmarkerResult.faceLandmarks) {
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_TESSELATION, { color: "#C0C0C070", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_EYE, { color: "#FF3030", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_EYEBROW, { color: "#FF3030", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_EYE, { color: "#30FF30", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_EYEBROW, { color: "#30FF30", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_FACE_OVAL, { color: "#E0E0E0", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LIPS, { color: "#E0E0E0", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_IRIS, { color: "#FF3030", lineWidth: 0.5 });
        drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_IRIS, { color: "#30FF30", lineWidth: 0.5 });
    }
    detectFaceShape(faceLandmarkerResult.faceLandmarks[0], "image-face-shape-message");
}

const video = document.getElementById("webcam");
const canvasElement = document.getElementById("output_canvas");
const canvasCtx = canvasElement.getContext("2d");
function hasGetUserMedia() {
    return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}

if (hasGetUserMedia()) {
    enableWebcamButton = document.getElementById("webcamButton");
    enableWebcamButton.addEventListener("click", enableCam);
} else {
    console.warn("getUserMedia() no es compatible con tu navegador");
}

function enableCam(event) {
    if (!faceLandmarker) {
        console.log("¡Espera! FaceLandmarker aún no se ha cargado.");
        return;
    }
    if (webcamRunning === true) {
        webcamRunning = false;
        enableWebcamButton.innerText = "ACTIVAR DETECCION";
    } else {
        webcamRunning = true;
        enableWebcamButton.innerText = "DESACTIVAR PREDICCIONES";
    }
    const constraints = {
        video: true
    };
    navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
        video.srcObject = stream;
        video.addEventListener("loadeddata", predictWebcam);
    });
}

let lastVideoTime = -1;
let results = undefined;
const drawingUtils = new DrawingUtils(canvasCtx);

async function predictWebcam() {
    const ratio = video.videoHeight / video.videoWidth;
    video.style.width = videoWidth + "px";
    video.style.height = videoWidth * ratio + "px";
    canvasElement.style.width = videoWidth + "px";
    canvasElement.style.height = videoWidth * ratio + "px";
    canvasElement.width = video.videoWidth;
    canvasElement.height = video.videoHeight;
    if (runningMode === "IMAGE") {
        runningMode = "VIDEO";
        await faceLandmarker.setOptions({ runningMode: runningMode });
    }
    let startTimeMs = performance.now();
    if (lastVideoTime !== video.currentTime) {
        lastVideoTime = video.currentTime;
        results = faceLandmarker.detectForVideo(video, startTimeMs);
    }
    if (results.faceLandmarks) {
        for (const landmarks of results.faceLandmarks) {
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_TESSELATION, { color: "#C0C0C070", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_EYE, { color: "#FF3030", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_EYEBROW, { color: "#FF3030", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_EYE, { color: "#30FF30", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_EYEBROW, { color: "#30FF30", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_FACE_OVAL, { color: "#E0E0E0", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LIPS, { color: "#E0E0E0", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_RIGHT_IRIS, { color: "#FF3030", lineWidth: 0.5 });
            drawingUtils.drawConnectors(landmarks, FaceLandmarker.FACE_LANDMARKS_LEFT_IRIS, { color: "#30FF30", lineWidth: 0.5 });
        }
    }
    if (results.faceLandmarks.length > 0) {
        detectFaceShape(results.faceLandmarks[0], "video-face-shape-message");
    }
    if (webcamRunning === true) {
        window.requestAnimationFrame(predictWebcam);
    }
}
function detectFaceShape(landmarks, messageElementId) {
    const faceWidth = Math.sqrt(Math.pow(landmarks[127].x - landmarks[356].x, 2) + Math.pow(landmarks[127].y - landmarks[356].y, 2));
    const faceHeight = Math.sqrt(Math.pow(landmarks[10].x - landmarks[152].x, 2) + Math.pow(landmarks[10].y - landmarks[152].y, 2));
    const foreheadToChinHeight = Math.sqrt(Math.pow(landmarks[10].x - landmarks[152].x, 2) + Math.pow(landmarks[10].y - landmarks[152].y, 2));
    const cheekboneWidth = Math.sqrt(Math.pow(landmarks[205].x - landmarks[425].x, 2) + Math.pow(landmarks[205].y - landmarks[425].y, 2));
    const jawlineWidth = Math.sqrt(Math.pow(landmarks[31].x - landmarks[351].x, 2) + Math.pow(landmarks[31].y - landmarks[351].y, 2));
    const foreheadWidth = Math.sqrt(Math.pow(landmarks[54].x - landmarks[284].x, 2) + Math.pow(landmarks[54].y - landmarks[284].y, 2));
    const chinToJawHeight = Math.sqrt(Math.pow(landmarks[8].x - landmarks[152].x, 2) + Math.pow(landmarks[8].y - landmarks[152].y, 2));

    const faceProportion = faceWidth / faceHeight;
    const jawToFaceProportion = jawlineWidth / faceWidth;
    const cheekboneToFaceProportion = cheekboneWidth / faceWidth;
    const foreheadToFaceProportion = foreheadWidth / faceWidth;
    const chinToJawProportion = chinToJawHeight / faceHeight;

    let faceShape;

    if (faceProportion > 0.9 && faceProportion < 1.1) {
        faceShape = "circular";
    } else if (faceProportion < 0.9 && foreheadToChinHeight > cheekboneWidth && foreheadToChinHeight > jawlineWidth) {
        faceShape = "ovalada";
    } else if (faceProportion > 1.3) {
        faceShape = "rectangular";
    } else if (faceProportion > 1.1 && faceProportion < 1.3 && cheekboneToFaceProportion < 0.75) {
        faceShape = "cuadrada";
    } else if (foreheadToFaceProportion > 0.7 && jawToFaceProportion < 0.75) {
        faceShape = "triangular";
    } else if (cheekboneToFaceProportion > 0.75 && chinToJawProportion > 0.6) {
        faceShape = "diamante";
    } else {
        faceShape = "indefinida";
    }

    const faceShapeElement = document.getElementById(messageElementId);
    faceShapeElement.innerText = `Forma del Rostro: ${faceShape}`;

    showButton(faceShape);
}


function showButton(faceShape) {
    let buttonContainer = document.getElementById('button-container');
    if (!buttonContainer) {
        buttonContainer = document.createElement('div');
        buttonContainer.id = 'button-container';
        buttonContainer.style.textAlign = 'center';
        buttonContainer.style.marginTop = '10px';
        document.body.appendChild(buttonContainer);
    }

    buttonContainer.innerHTML = ''; // Clear previous button if exists

    const button = document.createElement('button');
    button.innerText = '¿Quieres ver modelos de lentes acordes a tu tipo de rostro?';
    button.onclick = () => window.location.href = `lentes.php?tipo=${faceShape}`;
    button.className = 'mdc-button mdc-button--raised';

    buttonContainer.appendChild(button);
}
