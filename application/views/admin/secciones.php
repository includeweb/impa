<?php echo add_jscript('function');?>  
 <?php echo add_jscript('jquery.confirm');?>
<script type="text/javascript">     
    
    var base_url = "<?php echo base_url()?>";

    $(document).ready(function () {
        result = 20;


        $("body").on('click','.remove',function(){
            var id = $(this).attr('rel');
            $.confirm({
                text: "Desea eliminar este Producto?",
                title: "Confirmation required",
                confirm: function(button) {
                   producto_delete(id)
                },
                cancel: function(button) {
                    
                },
                confirmButton: "Yes",
                cancelButton: "No",
                post: true,
                confirmButtonClass: "btn-danger",
                cancelButtonClass: "btn-default",
                dialogClass: "modal-dialog"                     
            });

        });

    });

</script>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-10"><h3 class="panel-title fix-title">Secciones</h3></div>
            <div class="col-md-2 text-right "><a href="<?=base_url();?>admin/agregar_seccion" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Agregar</a></div>
        </div>   
    </div>

    <div class="panel-body">
        
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead id="table_news">
                      <tr>
                        <th rel="id"><a href="javascript:void(0)" class="asc" >Id</a></th>
                        <th rel="nombre"><a href="javascript:void(0)" class="asc" >Nombre</a></th>
                        <th rel="url"><a href="javascript:void(0)" class="asc" >Url</a></th>
                        <th rel="template_name"><a href="javascript:void(0)" class="asc" >Template</a></th>
                        <th rel="user"><a href="javascript:void(0)" class="asc" >Creado por</a></th>
                        <th rel="fecha"><a href="javascript:void(0)" class="asc" >Fecha</a></th>
                        <th rel="status"><a href="javascript:void(0)" class="asc" >Estado</a></th>
                        
                        <th rel="acction">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?foreach ($secciones as $seccion) {?>
                        <tr>
                            <td><?=$seccion->id?></td>
                            <td><?=$seccion->name?></td>
                            <td><?=$seccion->url?></td>
                            <td><?=$seccion->template_name?></td>
                            <td><?=$seccion->username?></td>
                             <td><?=$seccion->registered?></td>
                            <td>
                            <?if($seccion->status_id == STATUS_DRAFT){?>
                                <span class="label label-warning"><?=$seccion->status?></span></td>
                            <? }else{ ?>
                                <span class="label label-success"><?=$seccion->status?></span></td>
                            <? } ?>
                           
                            <td>
                                <a href="<?=base_url();?>admin/editar_seccion/<?=$seccion->id;?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="<?=base_url();?>admin/editar_seccion/<?=$seccion->id;?>"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="<?=base_url();?><?=$seccion->url?>" title="vista previa" target="_blank"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <td>
                        </tr>
                    <? } ?>

                    </tbody>
                </table>          
            </div>
        </div>
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
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->