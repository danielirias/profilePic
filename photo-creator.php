<?php
// Obtener los datos de la imagen desde la solicitud POST
$imageData  = $_POST['imageData'];

// DNI del perfil
$profileDNI = $_POST['profileDNI'];

// Rutas de almacenamiento
$uploadPath = '';
$thumbPath  = 'thumb/';

if($_POST["imgSize"] == 'original') {
	// Decodificar la imagen base64
	$decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

	// Crear un nombre de archivo
	$fileName = $profileDNI . '.jpg';

	// Guardar la imagen en el servidor
	file_put_contents($uploadPath . $fileName, $decodedImageData);

	// Acciones adicionales después de guardar la imagen

	// Devolver una respuesta al cliente (opcional)
	//echo 'Imagen guardada exitosamente en el servidor';
}

if($_POST["imgSize"] == 'thumb') {
// Decodificar la imagen base64
	$decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

	// Crear un nombre de archivo para la imagen recortada
	$thumbFileName = $profileDNI . '.jpg';

	// Guardar la imagen recortada en el directorio "thumb"
	file_put_contents($thumbPath . $thumbFileName, $decodedImageData);

	// Acciones adicionales después de guardar la imagen recortada en el directorio "thumb"
	//echo 'Imagen recortada guardada exitosamente en el directorio thumb';
}