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
          <p id="modalDetails" style="transform: translateX(-50%); text-align: left; margin-left: 50%;;"></p>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="buttonConfirm"></button>
        <button type="button" class="btn btn-primary" id="buttonSubmit"></button>
      </div>
    </div>
  </div>
</div>
                 
                   
                <script type="text/javascript">

                    /* Mostra o modal para update/delete */
                    function showModal(jThis) {
                            var array_title = [];
                            var array_content = [];
                            $("thead tr").find( "th:not(th:gt(-3))" ).each(function( index ) {
                                array_title[index] = $( this ).text();
                            });
                            jThis.parent().parent().parent().find( "td:not(td:gt(-3))" ).each(function( index ) {
                                array_content[index] = $( this ).text();
                            });
                            var detailsText = "";
                            for(i=0; i<array_title.length; i++) {
                                detailsText += "<strong>" + array_title[i] + "</strong>: " + array_content[i] + "<br>";
                            }
                            $("#modalDetails").html(detailsText);
                            
                            $("#buttonConfirm").attr("data-href", jThis.parent().attr("data-href"));
                            
                            $('#myModal').modal('show'); 
                            $("#buttonSubmit").css('display', 'none');
                            $("#buttonConfirm").css('display', 'inline-block');
                    }

                    $(document).ready(function() {
                        
                        /* Quando o botão de update é clicado em alguma linha */
                        $(".glyphicon-ok").on("click", function(e) {
                            $("#modalTitle").text("Aviso");
                            $("#modalAlert").text("Você está querendo ir para a tela de alteração, para o item a seguir:");
                            $("#buttonConfirm").text("Alterar");
                            
                            var jThis = $(this);
                            showModal(jThis);
                        });
                        
                        /* Quando o botão de remove é clicado em alguma linha */
                        $(".glyphicon-remove").on("click", function(e) {
                            $("#modalTitle").text("Atenção!");
                            $("#modalAlert").text("Você está querendo excluir o item a seguir:");
                            $("#buttonConfirm").text("Excluir");
                            
                            var jThis = $(this);
                            showModal(jThis);
                        });
                        
                        /* Quando o botão de confirm da modal é clicado */
                        $("#buttonConfirm").on("click", function() {
                            var url = $(this).attr("data-href");
                            window.location = url;
                        });
                        
                        /* Quando o submit é executado, testar se o modal recebeu ok */
                        $("form").submit(function() {
                            var ret = $("button[type=submit]").attr("data-ok");
                            
                            if(ret === "true")
                                return true;
                            
                            else {
                                $("#modalTitle").text("Aviso");
                                $("#modalAlert").text("Você está querendo salvar o item");
                                $("#buttonSubmit").text("Salvar");
                                $("#modalDetails").html("");
                                
                                $('#myModal').modal('show');
                                $("#buttonConfirm").css('display', 'none');
                                $("#buttonSubmit").css('display', 'inline-block');
                                
                                return false;
                            }
                        })
                        
                        /* Quando o botão de confirmSubmit é clicado no modal */
                        $("#buttonSubmit").on("click", function() {
                            $("button[type=submit]").attr("data-ok", "true");
                            $("button[type=submit]").click();
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
                      <p>Empresa Tal, na rua x, do bairro y, da cidade z, na República Rio-Grandense. <br>Nenhum direito reservado :)</p>
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