<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Webcam y Cropper.js</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Agrega los archivos CSS y JS de Bootstrap -->
		<link rel="stylesheet" href="res/css/bootstrap.min.css">
		<script src="res/js/bootstrap.min.js"></script>
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


		<!-- Agrega los archivos CSS y JS de Cropper.js -->
		<link rel="stylesheet" href="res/plugin/cropper/cropper.css">
		<script src="res/plugin/cropper/cropper.js"></script>

	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="card border">
						<div class="card-body">

						</div>
						<div class="card-footer">
							<!-- boton para abrir modal que muestra la cámara web -->
							<!--<button id="btnOpenCam" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWebcam">-->
							<button id="btnOpenCam" type="button" class="btn btn-primary">
								<i class="fa fa-camera"></i> Abrir cámara web
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal estático que muestra la cámara web -->
		<div class="modal fade" id="modalWebcam" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalWebcamLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalWebcamLabel">Cámara Web</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Aquí integraremos el contenido de la cámara web y Cropper.js -->
						<video id="webcam" width="100%" height="auto" autoplay playsinline></video>
						<canvas id="webcamCanvas" style="display:none;"></canvas>
					</div>
					<div class="modal-footer">
						<button id="btnCloseCam" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button id="btnCapture" type="button" class="btn btn-primary">Capturar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal estático que muestra la foto capturada -->
		<div class="modal fade" id="modalEditor" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalWebcamLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalWebcamLabel">Editar fotografía</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Canvas para Cropper.js -->
						<!--<canvas id="croppedImage"></canvas>-->
						<div class="row">
							<div class="col-12">
								<div class="img-container">
									<img id="imgEditor" class="img-fluid" style="display: block; max-width: 100%;">
								</div>
							</div>
						</div>


					</div>
					<div class="modal-footer">
						<div class="row">
							<div class="col-12">
								<!-- Botones de control de Cropper.js -->
								<button type="button" class="btn btn-secondary" id="btnFlipVertical">Flip Vertical</button>
								<button type="button" class="btn btn-secondary" id="btnFlipHorizontal">Flip Horizontal</button>
								<button type="button" class="btn btn-secondary" id="btnRotateLeft">Rotar Izquierda</button>
								<button type="button" class="btn btn-secondary" id="btnRotateRight">Rotar Derecha</button>
								<button type="button" class="btn btn-primary" id="btnApply">Aplicar cambios</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script>

		</script>

		<script src="res/js/photo-creator.js"></script>
	</body>
</html>
