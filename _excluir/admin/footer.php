                <script type="text/javascript">
                    $(document).ready(function() {
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
    <script src="<?php echo ASSETS ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo ASSETS ?>/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>