            <div class="mastfoot">
            <div class="inner">
              <p>Empresa Tal, na rua x, do bairro y, da cidade z, na República Rio-Grandense. <br>Nenhum direito reservado :)</p>
            </div>
          </div>

        </div>

      </div>

    </div>
    
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
          <p id="modalDetails" style="text-align: left;"></p>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="buttonCancel" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="buttonConfirm"></button>
        <button type="button" class="btn btn-primary" id="buttonSubmit"></button>
      </div>
    </div>
  </div>
</div>
  
    <script type="text/javascript">

        /* Mostra o modal para update/delete */
        function showModal() {
            $("#modalTitle").text("Aviso");
            $("#modalAlert").text("Você está querendo cadastrar com um email não válido");
            $("#modalDetails").html("<p>Preencha um email ainda n&atilde;o cadastrado, \
                                    e verifique isso observando a caixa ao lado:<br> \
                                    • 'check' com fundo verde: email <strong>válido</strong>. <br> \
                                    • 'check' com fundo verde: email <strong>não válido</strong>. </p>");

            $("#buttonCancel").text("Ok");

            $('#myModal').modal('show'); 
            $("#buttonSubmit").css('display', 'none');
            $("#buttonConfirm").css('display', 'none');
        }
    </script>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo ASSETS ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo ASSETS ?>/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>