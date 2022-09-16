

<?php $__env->startSection('content'); ?>
	
	

	<div class="ordenacion mb-3">
    <div>
        <h5>Buscar por nombre</h5>
        <div id='cajabusqueda'>
            <img src="https://img.icons8.com/ios-filled/25/000000/search--v1.png" />
            <input type='text' name='busqueda' id='busqueda' placeholder='Nombre'>
        </div>
    </div>
    <div>
        <h5>Ordenar por</h5>
        <select id="order" name="order">
            <option value="fechaReciente" selected>Subida más recientemente</option>
            <option value="fechaViejo">Subida menos reciente</option>
            <option value="fechaCreacionMayor">Creada más recientemente</option>
            <option value="fechaCreacionMenor">Creada menos recientemente</option>
            <option value="calificacionMayor">Mayor calificación</option>
            <option value="calificacionMenor">Menor calificación</option>
            <option value="alfabetico">Orden alfabético</option>
        </select>
    </div>
    <div id='filtroFecha'>
        <h5 id='tituloFiltro'>Filtrar por fecha</h5>
        <label for="desde">Desde</label>
        <input type='date' id='desde' name='desde'><br>
        <label for="hasta">hasta</label>
        <input type='date' id='hasta' name='hasta'>
    </div>
    <button id="newPicture" class="btn btn-success col-2" onclick="openModal('create')">Añadir</button>
</div>
	<section id="pictures" class="row g-3">
		<?php if(!count($pictures)): ?>
			<h2>¡Añade tus primeras fotos!</h2>
		<?php else: ?>
			<?php $__currentLoopData = $pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="card col-md-4 col-sm-6 col-12" id="img-<?php echo e($picture->id); ?>">
					<img src="<?php echo e(route('get-picture',['picture'=>$picture->picture_url])); ?>" class="card-img-top">
					<div class="card-body">
						<h5 id="cardTitle<?php echo e($picture->id); ?>"><?php echo e($picture->picture_name); ?></h5>
						<div id="starsContainer<?php echo e($picture->id); ?>">
							<select class="star-rating" id="cardRating<?php echo e($picture->id); ?>" disabled="">
								<option></option>
								<option value="1" <?php if("1" == $picture->rating): echo 'selected'; endif; ?>></option>
								<option value="2" <?php if("2" == $picture->rating): echo 'selected'; endif; ?>></option>
								<option value="3" <?php if("3" == $picture->rating): echo 'selected'; endif; ?>></option>
								<option value="4" <?php if("4" == $picture->rating): echo 'selected'; endif; ?>></option>
								<option value="5" <?php if("5" == $picture->rating): echo 'selected'; endif; ?>></option>
							</select>
						</div>
						<div class="row mt-3">
							<button class="btn btn-primary col-md-5 col-sm-6 col-12" onclick="openModal('edit',<?php echo e($picture->id); ?>)">Editar</button>
							<button class="btn btn-danger col-md-5 col-sm-6 col-12 offset-md-2" onclick="confirmDeletion(<?php echo e($picture->id); ?>)">Borrar</button>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>		
	</section>

	<div id="modalForm" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	  <div class="modal-dialog modal-xl">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTitle">Modal title</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	      	<div class="row mb-4">
	      		<img id="imgPreview" class="col-10 offset-1">
	      	</div>
        	<div class="row mb-3" id="imageInputContainer">
			    <label for="picture" class="col-sm-2 col-form-label">Imagen</label>
			    <div class="col-sm-10">
			     	<input type="file" accept="image/*" class="form-control" id="picture" onchange="previewPicture()">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="title" class="col-sm-2 col-form-label">Título</label>
			    <div class="col-sm-10">
			     	<input type="text" maxlength="80" class="form-control" id="title">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="rating" class="col-sm-2 col-form-label">Calificación</label>
			    <div class="col-sm-10">
			     	<select id="rating">
					    <option value="0"></option>
					    <option value="1"></option>
					    <option value="2"></option>
					    <option value="3"></option>
					    <option value="4"></option>
					    <option value="5"></option>
					</select>
			    </div>
			</div>
			<div class="alert alert-danger" id="errors" style="display:none"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="save()">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalDeleteLabel">¿Borrar la foto?</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <p>Si la borras, no podrás recuperarla</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-warning" onclick="removePicture()">Borrar</button>
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script type="text/javascript" src="<?php echo e(asset('js/star-rating.js')); ?>"></script>

	
	<script type="text/javascript">
		const postUrl = "<?php echo e(route('save-picture')); ?>";
		const deleteUrl = "<?php echo e(route('remove-picture')); ?>";
		const csrf = "<?php echo e(csrf_token()); ?>";
		var pictures = {
			<?php $__currentLoopData = $pictures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $picture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			"<?php echo e($picture->id); ?>":{
				"title":"<?php echo e($picture->picture_name); ?>",
				"image":"<?php echo e(route('get-picture',['picture'=>$picture->picture_url])); ?>",
				"rating":"<?php echo e($picture->rating); ?>"
			},
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		};
	</script>

	<script type="text/javascript" src="<?php echo e(asset('js/pictures.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scriptsPHP\gestor\resources\views/pictures/list.blade.php ENDPATH**/ ?>