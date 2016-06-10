<?php echo add_jscript('function');?> 
 <?php echo add_jscript('jquery.confirm');?> 
<script type="text/javascript">     
    
    var base_url = "<?php echo base_url()?>";

    $(document).ready(function () {
        result = 20;
        $.post( base_url+"admin/get_contactos", function( data ) {
            contenedor = $("#content_contactos");
            table = $("#table_contactos");
            acction = [{
                            "link":'#',
                            "button":'',
                            "rel":'id',
                            "class":'glyphicon glyphicon-remove remove' ,
                            "parameter":''
                        }];


            $('#buscador').val('');
            json = JSON.parse(data);
            json_active = json;
            load_content(json);
            selectedRow(json);
        });

        $("#report").click(function(){
            var d = new Date();
            var strDate = d.getFullYear() + "_" + (d.getMonth()+1) + "_" + d.getDate();
            var filename = 'Reporte_noticias_'+strDate;
            export_csv(json_active, filename, true);
        });

        $("body").on('click','.remove',function(){
            var id = $(this).attr('rel');
            $.confirm({
                text: "Desea eliminar este Contacto?",
                title: "Confirmation required",
                confirm: function(button) {
                   contact_delete(id)
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

        $("body").on('click','.edition', function(){
            var id = $(this).attr('rel');
            $.ajax({
                url: "<?=base_url('admin/get_contact')?>",
                data: {id:id},
                type: "POST",
                datatype: 'json',
                success: function(data){        
                    contact = JSON.parse(data);
                    $('#title').html('Consulta de '+contact.nombre);
                    $('#body').html(contact.consulta);
                    $('#my_modal').modal('show');

                }  
            });

        });

    });

function contact_delete(id){
    $.post( base_url+"admin/contact_delete",{id:id},function(data){
        $("#"+id).remove().fadeOut(); 
    });
}

</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-10"><h3 class="panel-title fix-title">Contactos </h3></div>
            <div class="col-md-2 text-right "></div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <form id="my_form" method="POST" action="<?=base_url('dashboard/obtener_xls')?>" > 
                <div class="col-md-3 pull-left col-sm-12">
                        <div class="form-group">
                            <label for="result">Buscar:</label>
                            <input type="text" name="buscador" id="buscador" class="form-control">
                        </div>
                    </div>          
                    <div class="col-md-5 pull-left col-sm-12">
                        <div class="form-group">
                            <label for="result">Mostrar:</label>
                            <select  id="result" name="result" class="form-control">
                            <option value="">Seleccione</option>
                            </select>
                            <span>De: </span><span id="numRows"></span>
                        </div>
                        
                    </div>              
                    <div class="col-md-4 col-sm-12">
                        <label>Exportar</label><br>
                        <a href="dashboard/obtener_xls" class="btn btn-default pull-left" id="report" ><span class="glyphicon glyphicon-download"></span> Reporte</a>
                    </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead id="table_contactos">
                      <tr>
                        <th rel="id"><a href="javascript:void(0)" class="asc" >Id</a></th>
                        <th rel="nombre"><a href="javascript:void(0)" class="asc" >Nombre</a></th>
                        <th rel="empresa"><a href="javascript:void(0)" class="asc" >Empresa</a></th>
                        <th rel="direccion"><a href="javascript:void(0)" class="asc" >Dirección</a></th>
                        <th rel="ciudad"><a href="javascript:void(0)" class="asc" >Ciudad</a></th>
                        <th rel="pais"><a href="javascript:void(0)" class="asc" >País</a></th>
                        <th rel="telefono"><a href="javascript:void(0)" class="asc" >Telefono</a></th>
                        <th rel="email"><a href="javascript:void(0)" class="asc" >Email</a></th>
                        <th rel="consulta" class="editable"><a href="javascript:void(0)" class="asc" >Consulta</a></th>
                        <th rel="acction">Acciones</th>
                      </tr>
                    </thead>
                    <tbody id="content_contactos">
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
