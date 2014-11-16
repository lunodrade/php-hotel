	<?php  include '_header.php';  ?>
        
		
		
		<form method="get">   
            <label for="checkEmail">Email</label>
            <input id="checkEmail" name="checkEmail" placeholder="Digite o email" />
            <button class="btnCheck">Verificar disponibilidade</button>   
        </form>
        <div id="avaibleResult" style="
                width: 300px;
                height: 50px;
                background-color: lightgray;
                padding: 15px 0 10px 30px;
        "></div>
		
		<br><br><br><br><br><br><br><br><br><br><br><br>
		
		Mostrar os <a href='mostrar_quartos.php'>quartos</a><br><br><br><br><br><br>
		
		<h1>Links de testes</h1>
		Acessar a sessão <a href='admin/'>admin</a><br>
		Acessar uma página interna de <a href='auth/interno_usuario.php'>usuário</a><br>
		Acessar uma página interna de <a href='auth/interno_admin.php'>admin</a><br>
	
	<script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.btnCheck').click(function(){
    			makeAjaxRequest();
    		});

            $('form').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: 'ajax/checkAvailability.php',
                    type: 'get',
                    data: {email: $('input#checkEmail').val()},
                    success: function(response) {
                        $('#avaibleResult').html(response);
                    }
                });
            }
    	});
    </script>

	<?php  include '_footer.php';  ?>