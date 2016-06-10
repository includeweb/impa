<?php echo add_jscript('tiny.editor.packed');?>
<?php echo add_jscript('jquery.multi-select');?>   
<?php echo add_style('multi-select');?>  
<?php echo add_style('edit');?>

<div class="panel panel-default">
	<div class="panel-heading">
	<div class="row">
		<div class="col-md-10"><h3 class="panel-title">Agregar Texto</h3></div>
		<div class="col-md-2 text-right"><a href="<?=base_url('admin/productos')?>" class="btn btn-default">Volver</a></div>
	</div>
	  
	  
	</div>
	<div class="panel-body">

		<!-- aca contenido de la seccion-->
		<form method="post" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				
				 
				  <div class="form-group">
				    <label for="descripcion">Descripción</label>
				    <textarea id="tinyeditor" style="width: 800px; height: 200px" name="descripcion"></textarea>				  </div>
				 
				
			  	
	  			
			
			</div>
			<div class="col-md-12">

				<div class="form-group">
				    <label for="fileimage">Marca</label>
				    <select class="form-control" name="marca_id">
				    	<option value =" ">seleccione</option>
				    	<?php foreach ($secciones->result() as $seccion) {?>
				    		<option value ="<?=$seccion->id?>" <?=($seccion->id == $seccion->marca_id)? "selected":""?>><?=$seccion->nombre?></option>
				    	<? } ?>   	
				    </select>
			  	</div>
				<div class="text-right"><button type="submit" class="btn btn-default" onClick="editor.post();" >Guardar</button></div>
			</div>
		</div>
	</form>
		<!-- / fin contenido -->
	</div>
</div>
<script>
var editor = new TINY.editor.edit('editor', {
	id: 'tinyeditor',
	width: 584,
	height: 175,
	cssclass: 'tinyeditor',
	controlclass: 'tinyeditor-control',
	rowclass: 'tinyeditor-header',
	dividerclass: 'tinyeditor-divider',
	controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
		'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
		'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
		'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
	footer: true,
	fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
	xhtml: true,
	cssfile: 'custom.css',
	bodyid: 'editor',
	footerclass: 'tinyeditor-footer',
	toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
	resize: {cssclass: 'resize'}
});
</script>