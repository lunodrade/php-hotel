<?php 
	include ('../cabecalho.php') ;
    
?>
   
    <h1>Criando usuário</h1>
   <br>
   <br>
   <br>
   <br>
     
	
               
        <form  action="add-cli.php">
            <table class="table">
             
             <tr>
              
                <td><label for="checkEmail">Email</label></td>
                <td><input class="form-control" required id="checkEmail" name="checkEmail"  placeholder="Digite o email" /></td>
                
               </tr>
               <tr> 
                   <td><button class="btnCheck">Verificar disponibilidade</button>   </td>
                  <td>
                <div id="avaibleResult" style="
                width: 300px;
                height: 50px;
                background-color: lightgray;
                padding: 15px 0 10px 30px;
                "></div>
                </td>
                 
                 
             </tr>    

               <tr>
                   <td>Nome:</td>
                   <td><input class="form-control" type="text" name="nome"><br></td>
               </tr>
               
               <tr>
                   <td>RG:</td>
                   <td><input class="form-control" type="text" name="rg"><br></td>
               </tr>
               <tr>
                   <td>CPF</td>
                   <td><input class="form-control" type="text" name="cpf"><br></td>
               </tr>
               <tr>
                   <td>Data nascimento</td>
                   <td><input class="form-control" type="text" name="dataNasc"><br></td>
               </tr>
               
                </tr>
                 <tr>
                   <td>Senha</td>
                   <td><input class="form-control" type="text" name="senha"><br></td>
               </tr>
               
                </tr>
                
                <tr>
                    <td>    <button class="btn btn-primary"   type="submit"> Cadastrar </button></td>
                    
</tr>
       </table>
       </form>
       
        
<!-- ********************************************* -->
        	<script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.btnCheck').click(function(){
    		
                makeAjaxRequest();
                return false;
    		});

            $('form').submit(function(e){
               // e.preventDefault();
               // makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: '../ajax/checkAvailability.php',
                    type: 'get',
                    data: {email: $('input#checkEmail').val()},
                    success: function(response) {
                        $('#avaibleResult').html(response);
                    }
                });
            }
    	});
    </script>
        
        


<?php  include ('../rodape.php') ?>


