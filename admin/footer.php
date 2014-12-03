<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong id="modalTitle"></strong></h4>
      </div>
      <div class="modal-body">
          
          <p id="modalAlert"></p>
          <p id="modalDetails"></p>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="buttonConfirm"></button>
      </div>
    </div>
  </div>
</div>
                 
                   
                <script type="text/javascript">
                    $(document).ready(function() {
                        
                        $(".glyphicon-ok").on("click", function(e) {
                            $("#modalTitle").text("Aviso");
                            $("#modalAlert").text("Você está querendo ir para a tela de alteração, para o item a seguir:");
                            $("#modalDetails").text("testando");    //TODO
                            $("#buttonConfirm").text("Alterar");
                            
                            var href = $(this).parent().attr("data-href");
                            $("#buttonConfirm").attr("data-href", href);
                            
                            $('#myModal').modal('show'); 
                        });
                        
                        $(".glyphicon-remove").on("click", function(e) {
                            $("#modalTitle").text("Atenção!");
                            $("#modalAlert").text("Você está querendo excluir o item a seguir:");
                            $("#modalDetails").text("testando");    //TODO
                            $("#buttonConfirm").text("Excluir");
                            
                            var href = $(this).parent().attr("data-href");
                            $("#buttonConfirm").attr("data-href", href);
                            
                            $('#myModal').modal('show'); 
                        });
                        
                        $("#buttonConfirm").on("click", function() {
                            var url = $(this).attr("data-href");
                            window.location = url;
                        });
                        
                        $('#datatable').DataTable( {
                            "dom": 'T<"clear">lfrtip',
                            "tableTools": {
                                "sSwfPath": "../swf/copy_csv_xls_pdf.swf"
                            },
                            "oLanguage": {
                                "sEmptyTable": "Nenhum registro encontrado",
                                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                                "sInfoPostFix": "",
                                "sInfoThousands": ".",
                                "sLengthMenu": "_MENU_ resultados por página",
                                "sLoadingRecords": "Carregando...",
                                "sProcessing": "Processando...",
                                "sZeroRecords": "Nenhum registro encontrado",
                                "sSearch": "Pesquisar",
                                "oPaginate": {
                                    "sNext": "Próximo",
                                    "sPrevious": "Anterior",
                                    "sFirst": "Primeiro",
                                    "sLast": "Último"
                                },
                                "oAria": {
                                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                                    "sSortDescending": ": Ordenar colunas de forma descendente"
                                }
                            }
                        } );
                    } );
                </script>

                <script type="text/javascript">
                    $(".close").click(function(){$(".alert").show().hide("slow");});
                </script>
                
                
                
            <div class="row">
                    <div class="mastfoot">
                    <div class="inner">
                      <p>Rodap&eacute;</p>
                    </div>
                  </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo ASSETS ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="<?php echo ASSETS ?>/js/ie10-viewport-bug-workaround.js"></script>
    
    <script type="text/javascript" src='<?php echo ASSETS; ?>/js/jquery.dataTables.min.js'></script>
    <script type="text/javascript" src='<?php echo ASSETS; ?>/js/dataTables.bootstrap.js'></script>
    <script type="text/javascript" src='<?php echo ASSETS; ?>/js/dataTables.tableTools.js'></script>
  

</body></html>