// Aquí implementaremos el código JavaScript para controlar la cámara y Cropper.js
// Variable global para el objeto Cropper.js
var cropper;

// Agregar evento click al botón btnOpenCam
$('#btnOpenCam').click(function(){
	//Abrir modal
	$('#modalWebcam').modal('show');
// Obtener acceso a la cámara web
	navigator.mediaDevices.getUserMedia({
		video: {
			facingMode: 'environment' // 'environment' para cámara trasera, 'user' para cámara frontal
		}
	}).then(function(stream) {
		// Mostrar stream en elemento de vídeo
		$('#webcam')[0].srcObject = stream;
		// Reproducir vídeo
		$('#webcam')[0].play();
	})
		.catch(function(err) {
			console.log(err);
		});
});

// Agregar evento click al botón btnCloseCam
$('#btnCloseCam').click(function(){
	// Detener stream de vídeo
	$('#webcam')[0].srcObject.getTracks()[0].stop();
	// Detener reproducción de vídeo
	$('#webcam')[0].pause();
});

// Agregar evento click al botón btnCapture
$('#btnCapture').click(function(){
	// Obtener contexto del canvas y dibujar sobre él
	var context = $('#webcamCanvas')[0].getContext('2d');
	$('#webcamCanvas')[0].width = $('#webcam')[0].videoWidth;
	$('#webcamCanvas')[0].height = $('#webcam')[0].videoHeight;
	context.drawImage($('#webcam')[0], 0, 0, $('#webcam')[0].videoWidth, $('#webcam')[0].videoHeight);

	// Detener stream de vídeo
	$('#webcam')[0].srcObject.getTracks()[0].stop();
	// Detener reproducción de vídeo
	$('#webcam')[0].pause();

	// Obtener imagen del canvas
	var imgData = $('#webcamCanvas')[0].toDataURL();

	//Guardar la imagen en el servidor
	saveImageToServer(imgData, 'original');

});

function saveImageToServer(imgData, imgSize) {
	// Establecer el valor de uploadPath
	var profileDNI = '0801197902424';

	// Realizar una solicitud AJAX para enviar la imagen al servidor
	$.ajax({
		type: 'POST',
		url: 'photo-creator.php',
		data: {
			imageData: imgData,
			profileDNI: profileDNI,
			imgSize: imgSize
		},
		success: function(response) {
			//console.log('Imagen enviada y guardada en el servidor');
			// Acciones adicionales después de guardar la imagen
			const fileToLoad = profileDNI+'.jpg';
			openImageEditor(fileToLoad);
		},
		error: function(error) {
			//console.error('Error al enviar la imagen al servidor', error);
		}
	});
}

function openImageEditor(fileToLoad) {
	// Obtener la fecha y hora actual y mostrarlo como cadena de texto sin separadores
	var date = new Date();
	var dateTime = date.toLocaleString().replace(/[.:]/g, '');
	// Cargar la imagen guardada en el modalEditor
	$('#imgEditor').attr('src', fileToLoad+'?v='+dateTime);  // Reemplaza con la ruta correcta

	// Limpiar Cropper si ya estaba inicializado
	if (cropper) {
		cropper.destroy();
	}

	const cropperWidth = 150;
	const cropperHeight = 150;

	// Inicializar Cropper.js
	cropper = new Cropper($('#imgEditor')[0], {
		aspectRatio: 1, // ratio 1:1
		viewMode: 1,  // vista previa
		responsive: true,
		autoCropArea: 1,
		minCropBoxWidth: cropperWidth,
		minCropBoxHeight: cropperHeight,
		center: true,
		ready: function () {
			// Establecer el tamaño inicial y la posición centrada
			cropper.setCropBoxData({
				width: cropperWidth,
				height: cropperHeight,
				left: (cropper.getContainerData().width - cropperWidth) / 2,
				top: (cropper.getContainerData().height - cropperHeight) / 2,
			});
		}
	});

	// Cerrar modal de la cámara
	$('#modalWebcam').modal('hide');

	// Abrir modal
	$('#modalEditor').modal('show');

}

$('#btnApply').click(function () {
// Obtener los datos de la imagen recortada
	var croppedImageData = cropper.getCroppedCanvas().toDataURL('image/jpeg');

	// Guardar la imagen recortada en el servidor
	saveImageToServer(croppedImageData, 'thumb');
});

// Evento click para el botón "Flip Vertical"
$('#btnFlipVertical').click(function () {
	cropper.scaleY(-cropper.getData().scaleY);
});

// Evento click para el botón "Flip Horizontal"
$('#btnFlipHorizontal').click(function () {
	cropper.scaleX(-cropper.getData().scaleX);
});

// Evento click para el botón "Rotar Izquierda"
$('#btnRotateLeft').click(function () {
	cropper.rotate(-90);
});

// Evento click para el botón "Rotar Derecha"
$('#btnRotateRight').click(function () {
	cropper.rotate(90);
});


