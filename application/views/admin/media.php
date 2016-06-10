<?php echo add_jscript('function');?>  
<?php echo add_jscript('jquery.confirm');?>
<?php echo add_jscript('sweetalert.min');?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/sweetalert.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.2/isotope.pkgd.min.js"></script>
<script type="text/javascript">     
    
    

    $(document).ready(function () {
        $('.files-container').isotope({
          // options
          itemSelector: '.file',
          layoutMode: 'fitRows'
        });
        $('.delete').click(function(){
            var id = $(this).data('id');
            $.confirm({
                text: "¿Desea eliminar este archivo?",
                title: "Archivos",
                confirm: function(button) {
                   deleteFile(id)
                },
                cancel: function(button) {
                    
                },
                confirmButton: "Si",
                cancelButton: "No",
                post: true,
                confirmButtonClass: "btn-default",
                cancelButtonClass: "btn-danger",
                dialogClass: "modal-dialog"                     
            });
               
            });
           
           $('.share').click(function(){
            var img = $(this).data('img');
            var url = '<?=base_url();?>uploads/'+img;
            swal("Use este link:", url);
               
        });
                 
           $('.filter-button-group').on( 'click', 'button', function() {
              var filterValue = $(this).attr('data-filter');
              $('.files-container').isotope({ filter: filterValue });
            });
        }); 

     
                 

     

        function deleteFile(id){

                $.ajax({
                  type: "POST",
                  url: '<?=base_url();?>admin/delete_media',
                  data: {id: id},
                  success: function(){
                        $('#media-'+id).fadeOut('slow').remove();
                    }
                }); 
        }
    

</script>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-10"><h3 class="panel-title fix-title">Archivos</h3></div>
            <div class="col-md-2 text-right "><a href="<?=base_url();?>admin/agregar_media" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Agregar</a></div>
        </div>   
    </div>

    <div class="panel-body">
       
        <div class="row button-group filter-button-group">
            <div class="col-md-12" style="padding:15px">
              <button data-filter="*" class="btn-primary">Todos</button>
              <button data-filter=".jpg" class="btn-default">Jpg</button>
              <button data-filter=".png" class="btn-default">Png</button>
              <button data-filter=".gif" class="btn-default">Gif</button>
              <button data-filter=".doc, .docx" class="btn-default">Doc</button>
              <button data-filter=".xls, .xlsx" class="btn-default">Xls</button>
              <button data-filter=".ppt, .pptx" class="btn-default">Ppt</button>
              <button data-filter=".pdf" class="btn-default">Pdf</button>
            </div> 
        </div>
       
        <div class="row files-container">
            <?foreach ($files as $file) {?>
                <div class="col-md-2 file <?=$file->type;?>" id="media-<?=$file->id;?>">
                <div class="thumbnail">
                    <?if($file->type != 'jpg' && $file->type != 'gif' && $file->type != 'png' ){ ?>
                      <div style="text-align:center;min-height:100px;padding:20px"> <span class="glyphicon glyphicon-file" style="font-size:62px;"></span> </div>
                    <? }else{ ?>
                        <img src="<?=base_url();?>uploads/<?=$file->file;?>" alt="..." class="img-responsive">
                      
                    <? } ?>
                  <div class="caption">
                 
                    <h4><?=$file->name;?></h4>
                    <p>Subido por: <?=$file->username;?> </p>
                    <p>Fecha: <?=$file->registered;?> </p>
                    <p>Tipo:  <?=$file->type;?></p>
                    <p>
                        <a href="javascript:void(0);" class="btn btn-primary delete" role="button" data-id="<?=$file->id;?>" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a> 
                        <a href="javascript:void(0);" class="btn btn-default share" role="button" data-img="<?=$file->file;?>" title="Obtener link"><span class="glyphicon glyphicon-share"></span></a>
                    </p>
                  </div>
                </div>
              
                </div>
            <? } ?>
           
        </div>
    </div>
</div>    
