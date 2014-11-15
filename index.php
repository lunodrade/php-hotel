	<?php  include 'header.php';  ?>
        
	<div class="container">

		<h2>Olá, <strong>
		<?php 
            if($usuario != null) {
                if($usuario->getCliente() > 0) {
                    $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
                    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                    $sql = "select cli_nome 
                           from tb_clientes
                           where pk_cli_cod = {$usuario->getCliente()};";

                    $stm = $conn->query($sql);

                    if ($stm->rowCount() > 0) {
                        $dados = $stm->fetch(PDO::FETCH_ASSOC);
                        echo($dados['cli_nome']);
                    }
                } else {
                    echo('Administrador');
                }
            } else {
                echo('Convidado');
            }
        ?>
		</strong>		
		</h2>
		
		<?php if($usuario == null) { ?>	
		        <a href='auth/login.php'>logar</a>
		<?php } else { ?>
		        <a href='auth/logout.php'>Sair</a>
        <?php } ?>	
		<br><br><br><br><br><br><br>
		
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
		
		<h1>Links de testes</h1>
		Acessar a sessão <a href='admin/'>admin</a><br>
		Acessar uma página interna de <a href='auth/interno_usuario.php'>usuário</a><br>
		Acessar uma página interna de <a href='auth/interno_admin.php'>admin</a><br>
	</div>
	
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
                    url: 'ajax/checkAvaible.php',
                    type: 'get',
                    data: {email: $('input#checkEmail').val()},
                    success: function(response) {
                        $('#avaibleResult').html(response);
                    }
                });
            }
    	});
    </script>

	<?php  include 'footer.php';  ?>