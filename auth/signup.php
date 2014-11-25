<?php  
    include '../_header.php';   
    require_once 'cadastro.php';
?> 

<style type="text/css">
    .inner.cover {
        border: 2px solid rgba(25, 25, 25, .6);
        box-shadow: 0px 5px 20px 0px rgba(25, 25, 25, 0.60);
        padding: 5% 10% 5% 10%;
        background-color: rgba(25, 25, 25, 0.60)
    }
    input {
        height: 3em;
    }
    h1 {
        margin-bottom: 8%;
    }
    #btn-signup {
        margin-top: 5%;
    }
    .form-control:focus {
        -webkit-box-shadow: rgba(0, 0, 19, 0.0745098) 0px 17px 25px 0px inset, rgba(102, 175, 233, 0.6) 0px 0px 5px 3px;
    }
    
    
    .btnCheck {
            height: 34px;
            width: 69px;
            border-radius: 4px;
        color: black;
    }
    
</style>


<div class="inner cover">
   
    <h1>Crie uma conta</h1>
    
    
    
    <form id="signupform" class="form-horizontal" role="form" action="functions.php?acao=salvar" method="post">
    

<!--
    <div class="form-group">
         <label for="email" class="col-md-3 control-label">Email</label>
         <div class="col-md-9">
            <input class="form-control" required id="email" name="email" type="email"  placeholder="Digite o email" /><br>

     </div>
      </div>
    <div class="form-group">
        <div class="col-md-6">
           <button   class="btn btn-info" class="icon-hand-right" id="btnCheck" class="btnCheck">Verificar disponibilidade</button>  
        </div>    
        <div class="col-md-6" id="avaibleResult" style="
                    height: 27.33px;
                    background-color: lightgray;">
                        
        </div>
               
    </div>
-->
<!--
        </div>
        <table class="table">
            <tr>
            <td>
                <div class="col-md-9">
                <button   class="btn btn-info"
class="icon-hand-right" id="btnCheck" class="btnCheck">Verificar disponibilidade</button>  
                
                 </div>    
            </td>
            <td>
                <div class="form-group" id="avaibleResult" style="
            width: 300px;
            height: 50px;
            background-color: lightgray;
            padding: 15px 0 10px 30px;
            "></div>
            </td>
            </tr>
        </table>
    </div>
-->
        

    <div class="form-group">
        <label for="firstname" class="col-md-3 control-label">Nome</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="nome" placeholder="Primeiro nome">
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-md-3 control-label">Sobrenome</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="sobrenome" placeholder="Sobrenome">
        </div>
    </div>
    
    
    
      <div class="form-group">
         <label for="email" class="col-md-3 control-label">Email</label>
         <div class="col-md-7">
            <input class="form-control" required id="email" name="email" type="email"  placeholder="Digite o email" />
          </div>
               <div class="col-md-2">
                <button class="btnCheck btn btn-default">check</button>
            </div>
     </div>
    
    
    <div class="form-group">
    <label for="sexo" class="col-md-3 control-label">Sexo</label>
    <div class="col-md-9">
        <select  name="sexo" class="form-control">
            <option value="m">Masculino</option>
            <option value="f">Feminino</option>
                            
        </select> 
    </div>
    </div>
    
    <div class="form-group">
        <label for="lastname" class="col-md-3 control-label">Telefone</label>
        <div class="col-md-9">
        <input type="number" class="form-control" name="telefone" placeholder="Telefone">
        </div>
    </div>



    <div class="form-group">
        <label for="password" class="col-md-3 control-label">Senha</label>
        <div class="col-md-9">
            <input type="password" class="form-control" name="senha" placeholder="Senha">
        </div>
    </div>

   <div class="form-group">
        <label for="rg" class="col-md-3 control-label">RG</label>
        <div class="col-md-9">
            <input type="number" class="form-control" name="rg" placeholder="RG">
        </div>
    </div>
    
       <div class="form-group">
        <label for="cpf" class="col-md-3 control-label">CPF</label>
        <div class="col-md-9">
            <input type="number" class="form-control" name="cpf" placeholder="CPF">
        </div>
    </div>
    
       <div class="form-group">
        <label for="datanasc" class="col-md-3 control-label">Data Nacimento</label>
        <div class="col-md-9">
            <input type="date" class="form-control" name="datanasc" placeholder="Data de Nascimento">
        </div>
    </div>

    <div class="form-group">                               
        <div class="col-md-12">
            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp; Sign Up</button>

        </div>
    </div>

    </form>
    
    
</div>






<!-- ********************************************* -->

        	<script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.btnCheck').click(function(){
    		// e.preventDefault();
                makeAjaxRequest();
                return false;
    		});

                        
//            $('form').submit(function(e){
//               // e.preventDefault();
//                makeAjaxRequest();
//                return false;
//            });
                        
            $('#email').change(function() {
                makeAjaxRequest();
            })

            function makeAjaxRequest() {
                $.ajax({
                    url: '../ajax/checkAvailability.php',
                    type: 'get',
                    data: {email: $('input#email').val()},
                    success: function(response) {
                        if(response == "<p>Disponivel</p>") {
                            $('.btnCheck').removeClass('btn-default btn-danger').addClass('btn-success');
                            
                        } else {
                            $('.btnCheck').removeClass('btn-default btn-success').addClass('btn-danger');
                        }
                    }
                });
            }
    	});
    </script>































<?php  include '../_footer.php';  ?>