<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestor de fotos</title>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('bootstrap-5.1.3-dist/css/bootstrap.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/star-rating.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	
</head>
<body>
	<div class="container">
	    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      		<a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
	      		<?php if(auth()->guard()->check()): ?>
	      			Las fotos de <?php echo e(Auth::user()->name); ?>

	      		<?php endif; ?>
	    	</a>
	    	<div class="col-md-3 text-end">
	      		<?php if(auth()->guard()->check()): ?>
		        	<a href="<?php echo e(route('logout')); ?>"><button type="button" class="btn btn-outline-primary me-2">Salir</button></a>
	      		<?php else: ?>
		        	<a href="<?php echo e(route('login')); ?>"><button type="button" class="btn btn-outline-primary me-2">Entrar</button></a>
		        	<a href="<?php echo e(route('register')); ?>"><button type="button" class="btn btn-primary">Registrarse</button></a>
		    	<?php endif; ?>
	        </div>
	    </header>
	</div>
	<article class="container">
		<?php if($errors->any() && $errors->getBag('default')->has('exception')): ?>
			<div class="alert alert-danger" role="alert">
				<?php echo e($errors->getBag('default')->first('exception')); ?>

		  	</div>
		<?php endif; ?>
		<?php echo $__env->yieldContent('content'); ?>
	</article>
	<script type="text/javascript" src="<?php echo e(asset('bootstrap-5.1.3-dist/js/bootstrap.min.js')); ?>"></script>
	
	<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\scriptsPHP\gestor\resources\views/layout.blade.php ENDPATH**/ ?>