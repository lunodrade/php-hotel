<?php  include '../_header.php';  ?>

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
</style>


<div class="inner cover">
   
   
   
   
   
   
   
   
    <h1>Crie uma conta</h1>
    
    
    
    <form id="signupform" class="form-horizontal" role="form">



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
    <label for="sexo" class="col-md-3 control-label">Sexo</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="sexo" placeholder="sexo">
    </div>
    </div>
    
    <div class="form-group">
        <label for="email" class="col-md-3 control-label">Email</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="email" placeholder="Email">
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
            <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp; Sign Up</button>

        </div>
    </div>





    </form>
    
    
    
    
    
    
















</div>

<?php  include '../_footer.php';  ?>