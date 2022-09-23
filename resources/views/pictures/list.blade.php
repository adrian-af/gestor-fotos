@extends('layout')

@section('content')

	<div class="ordenacion mb-3">
		<div id="info"></div>
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
		@if(!count($pictures))
			<h2>¡Añade tus primeras fotos!</h2>
		@else

			<script>
				$("#busqueda").keyup(function()
				{
					filtro();
				});
				
				$("#order").change(function()
				{
					filtro();
				})

				$("#desde, #hasta").change(function()
				{
					filtro();
				});
				function filtro()
				{
					$values = { 'busqueda' : $("#busqueda").val(),
									'order' : $("#order").val(),
									'desde' : $("#desde").val(),
									'hasta' : $("#hasta").val(),
								};

					$value = $("#busqueda").val();

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: 'get',
						url: "{{URL::to('api/search')}}",
						data: {search: $value},
						success: function(data)
						{
							$info = $("#photos");
							$texto = "";
							for(var i=0; i<data.length; i++)
							{
								$texto += "<div class='card col-md-4 col-sm-6 col-12' id='img-" + data[i].id + "'><img src='/picture/" + data[i].picture_url + "' class='card-img-top'><div class='card-body'><h5 id='cardTitle" + data[i].id + "'> " + data[i].picture_name + "</h5><div id='starsContainer" + data[i].id +"'><select class= 'star-rating' id='cardRating" + data[i].id + "' disabled=''><option></option><option value='1' @selected('1' == " + data[i].rating + ")></option><option value='2' @selected('2' == " + data[i].rating + ")></option><option value='3' @selected('3' == " + data[i].rating + ")></option><option value='4' @selected('4' == " + data[i].rating + ")></option><option value='5' @selected('5' == " + data[i].rating + ")></option> </select>";
								$texto += "</div><div class='row mt-3'><button class='btn btn-primary col-md-5 col-sm-6 col-12' onclick='openModal('edit'," + data[i].id +")'>Editar</button><button class='btn btn-danger col-md-5 col-sm-6 col-12 offset-md-2' onclick='confirmDeletion(" + data[i].id + ")'>Borrar</button> </div></div></div>";
							
							}
							console.log(data[0].picture_url);
							console.log($texto);
							$info.html($texto);


						}
					});
				}
			</script>
			@foreach($pictures as $picture)
			
			@endforeach
		@endif		
	</section>
	<div id="photos"></div>
	<!-- modal añadir -->
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


@endsection

@section('scripts')

	<script type="text/javascript" src="{{asset('js/star-rating.js')}}"></script>

	{{-- Variables para el javascript --}}
	<script type="text/javascript">
		const postUrl = "{{route('save-picture')}}";
		const deleteUrl = "{{route('remove-picture')}}";
		const csrf = "{{csrf_token()}}";
		var pictures = {
			@foreach($pictures as $picture)
			"{{$picture->id}}":{
				"title":"{{$picture->picture_name}}",
				"image":"{{route('get-picture',['picture'=>$picture->picture_url])}}",
				"rating":"{{$picture->rating}}"
			},
			@endforeach
		};
	</script>

	<script type="text/javascript" src="{{asset('js/pictures.js')}}"></script>

@endsection