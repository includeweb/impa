<?php echo add_jscript('jquery.multi-select');?>   
<?php echo add_style('multi-select');?>  
<?php echo add_style('edit');?>
<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
		<div class="col-md-10"><h3 class="panel-title">Agregar Item</h3></div>
		<div class="col-md-2 text-right"><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-default">Volver</a></div>
	</div>
	  
	  
	</div>
	<div class="panel-body">
		<!-- aca contenido de la seccion-->
		<form method="post" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12"><h4>Detalles del item</h4>
						<hr>
					</div>
					<div class="col-md-12">
							<div class="alert alert-danger" role="alert" style="display:none;">Por favor complete los campos obligatorios.</div>

						  <div class="form-group">
						    <label for="titulo">Titulo</label>
						    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" required > 
						  </div> 
						  <div class="form-group">
						    <label for="subtitulo">Subtitulo</label>
						    <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtitulo" required > 
						  </div>
						  <div class="form-group">
						    <label for="comentario">Comentario</label>
						    <textarea class="form-control" name="comentario" id="comentario"></textarea>
						  </div> 
						  <div class="form-group">
						    <label for="ubicacion">Ubicación</label>
						    <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" required > 
						  </div>
						  <div class="form-group">
						    <label for="ano">Año</label>
						    <input type="text" class="form-control" id="ano" name="ano" required > 
						  </div>  
						  <div class="form-group">
						    <label for="superficie">Superficie</label>
						    <input type="text" class="form-control" id="superficie" name="superficie" required placeholder="Superficie"> 
						  </div>
						  <div class="form-group">
						    <label for="actividad">Actividad</label>
						     <textarea class="form-control" name="actividad" id="actividad"></textarea>
						  </div>
						  <div class="form-group">
						    <label for="tiempo">Tiempo de obra</label>
						    <input type="text" class="form-control" id="tiempo" name="tiempo" placeholder="Tiempo de obra" required > 
						  </div>
						  <div class="form-group">
						    <label for="modalidad">Modalidad de trabajo</label>
						    <input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Modalidad de trabajo" required > 
						  </div> 
						  <div class="form-group">
						    <label for="proyecto">Proyecto</label>
						    <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Proyecto" required > 
						  </div>

						  
					</div>
					
				</div>
				
				 
				  
			
			</div>
			<div class="col-md-3">
				<h4>Categoría</h4>
				<div class="form-group">
					<select class="form-control" name="categoria" class="required" id="categoria">
						<option>Seleccione</option>
						<option value="oficinas">Oficina</option>
						<option value="viviendas">Vivienda</option>
					</select>
				</div>
				<h4>Imagen Portfolio <a href="javascript:void(0);" class="btn btn-default imagen-principal" style="float:right">+</a></h4>
				<hr>
				<div class="">
				   
				   <img src="" id="imagen-principal-selected" class="thumbnail" width="250" style="display:none;" />
				   <input type="hidden" id="imagen-principal" value="" class="required" name="imagenp"/>
			  	
			  	</div>

			  	<h4>Carrusel  <a href="javascript:void(0);" class="btn btn-default imagen-carousel" style="float:right">+</a></h4>
				<hr>
				<div class="">
				  
				   <div id="imagenes-carousel-contenedor"></div>
				   <input type="hidden" id="imagen-carousel" value="" class="required" name="imagenc"/>
			  	</div>
				
				
			</div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-md-12">
				<a href="javascript:void(0);" class="btn btn-default guardar-item">Guardar</a>
			</div>
		</div>
	</form>
		<!-- / fin contenido -->
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="my_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="title"></h4>
      </div>
      <div class="modal-body" id="body">
      	
			  	<?php foreach ($imagenes as $imagen) {?>
			  		<div class="imagen-contenedor">
		    		
					    <a href="javascript:void(0);" class="thumbnail imagenes" data-id="<?=$imagen->id;?>" data-src="<?=base_url().'uploads/'.$imagen->file;?>">
					      <img src="<?=base_url().'uploads/'.$imagen->file;?>" />
					    </a>
					    <div class="imagen-name"><?=$imagen->name;?></div>
					  	
					  </div>
		    	<?php } ?>
	
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="my_modal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" ></h4>
      </div>
      <div class="modal-body" >
      
			  	<?foreach ($imagenes as $imagen) {?>
		    		<div class="imagen-contenedor">
					    <a href="javascript:void(0);" class="thumbnail imagenes-carousel" data-id="<?=$imagen->id;?>" data-src="<?=base_url().'uploads/'.$imagen->file;?>">
					      <img src="<?=base_url().'uploads/'.$imagen->file;?>" />
					    </a>
					   <div class="imagen-name"><?=$imagen->name;?></div>
					  </div>
		    	<? } ?>
		
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <a href="javascript:void(0);" class="btn btn-default guardar">Guardar</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function(){
		

		var imagenes = [];

		
		$('.guardar-item').click(function(){
			var titulo = $('#titulo').val();
			var subtitulo = $('#subtitulo').val();
			var comentario = $('#comentario').val();
			var ubicacion = $('#ubicacion').val();
			var tiempo = $('#tiempo').val();
			var ano = $('#ano').val();
			var actividad = $('#actividad').val();
			var modalidad = $('#modalidad').val();
			var imagenp = $('#imagen-principal').val();
			var imagenc = $('#imagen-carousel').val();
			var categoria = $('#categoria').val();
			var superficie = $('#superficie').val();
			var proyecto = $('#proyecto').val();

			if(titulo != '' && subtitulo != '' && ubicacion != '' && tiempo != '' && ano != '' && actividad != '' && modalidad != '' && imagenp != '' && imagenc != '' && categoria != '' && superficie != ''){
				$('.alert-danger').hide();
				$.ajax({
				  type: "POST",
				  url: '<?=base_url();?>admin/saveItem',
				  data: {proyecto: proyecto,titulo: titulo, subtitulo: subtitulo, comentario: comentario, ubicacion:ubicacion, tiempo: tiempo, ano: ano, actividad: actividad, modalidad: modalidad, imagenp: imagenp, imagenc: imagenc, categoria: categoria, superficie:superficie},
				  dataType: 'json'
				});
				window.location.href = "<?=base_url();?>admin/portfolio";
			}else{
				$('.alert-danger').show();
				
			}

		
		});


		$('.imagen-principal').click(function(){
			$('#my_modal').modal();
		});
		$('.imagen-carousel').click(function(){
			$('#my_modal2').modal();
		});

		$('.imagenes').click(function(){
			var id = $(this).data('id');
			var src = $(this).data('src');
			
			$('#imagen-principal').val(src);
			$('#imagen-principal-selected').attr('src', src);
			$('#imagen-principal-selected').show();
			$('#my_modal').modal('hide');
		});

		$('.imagenes-carousel').click(function(){
			var id = $(this).data('id');
			var src = $(this).data('src');

			if($(this).hasClass('imagen-active')){
				$(this).removeClass('imagen-active');
				  if(imagenes.indexOf(src) != -1){
				    imagenes.splice(src, 1);
				  }else{
				  	imagenes.push(src);
				  }

			}else{
				$(this).addClass('imagen-active');
				 if(imagenes.indexOf(src) != -1){
				    imagenes.splice(src, 1);
				  }else{
				  	imagenes.push(src);
				  }
			}
			
			
			
			$('#imagen-carousel').val(id);
			
		});

		$('.guardar').click(function(){
			$('#my_modal2').modal('hide');
			 $('#imagenes-carousel-contenedor').html('');
			imagenes.forEach(function(name){
			   $('#imagenes-carousel-contenedor').append('<img src="'+name+'" class="thumbnail" width="250"/>');
			  });

			$('#imagen-carousel').val(imagenes);
		});
	});
</script>