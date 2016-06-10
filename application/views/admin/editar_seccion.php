<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	tinymce.init({
		relative_urls: false,
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});
</script>
<?php echo add_jscript('jquery.multi-select');?>   
<?php echo add_style('multi-select');?>  
<?php echo add_style('edit');?>
<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
		<div class="col-md-10"><h3 class="panel-title">Editar Página</h3></div>
		<div class="col-md-2 text-right"><a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-default">Volver</a></div>
	</div>
	  
	  
	</div>
	<div class="panel-body">
		<!-- aca contenido de la seccion-->
		<form method="post" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12"><h4>Detalles de la sección</h4>
						<hr>
					</div>
					<div class="col-md-6">
						
						  <div class="form-group">
						    <label for="nombre">Nombre</label>
						    <input type="text" class="form-control" id="nombre" name="name" placeholder="Name" required value="<?=$seccion->name?>"> 
						  </div> 
						  <small>Url: <a href="<?=base_url();?><?=$seccion->url;?>" target="_blank"><?=base_url();?><?=$seccion->url;?></a></small>
						  
					</div>
					<div class="col-md-6">
					<label for=""></label>
						<div class="alert alert-warning" role="alert">El título sera usado como Browser title</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4>Contenido</h4>
						<hr>
						<textarea name="text" style="min-height:400px;"><?=$seccion->text?></textarea>
					</div>
				</div>
				
				 
				  
			
			</div>
			<div class="col-md-3">
				<h4>Template</h4>
				<hr>
				<div class="form-group">
				    <label for="template">Seleccione un template</label>
				    <select class="form-control" name="template" required >
					    <? foreach ($templates as $template) {?>
					    	<option value="<?=$template->id?>" <?if($seccion->template_id == $template->id){echo "selected";}?>><?=$template->name?></option>	
					   	<? } ?>
				   	</select>
			  	</div>

			  	<h4>Publicación</h4>
				<hr>
				<div class="form-group">
				    <label for="template">Seleccione</label>
				    <select class="form-control" name="status" required>
					    
					    	<option value="1" <?if($seccion->status_id == 1){echo "selected";}?>>Borrador</option>	
					    	<option value="2" <?if($seccion->status_id == 2){echo "selected";}?>>Publicado</option>	
					   	
				   	</select>
			  	</div>
				
				
			</div>
		</div>
		<div class="row" style="margin-top:30px;">
			<div class="col-md-12">
				<button type="submit" class="btn btn-default">Guardar</button>
			</div>
		</div>
	</form>
		<!-- / fin contenido -->
	</div>
</div>