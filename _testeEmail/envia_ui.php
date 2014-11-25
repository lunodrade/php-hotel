<?php  include '_header.php';  ?>

    <link rel="stylesheet" href="assets/css/datepicker.css">
    <style type="text/css">
        .inner.cover {
            border: 2px solid rgba(25, 25, 25, .6);
            box-shadow: 0px 5px 20px 0px rgba(25, 25, 25, 0.60);
            padding: 12% 0 12% 0;
            background-color: rgba(100, 100, 100, 0.6);
        }
        .cover {
            padding: 0;
        }
        input, button, textarea {
            color: black;
        }
        
        input {
            padding-left: 5%;
        }
        .cover-heading {
            margin-bottom: 10%;
        }
    </style>


<div class="inner cover">


<h1 class="cover-heading">Faça a sua reserva</h1>
    
    
    
    
    
    
    
    
    
    
    
    
    <p>Mande uma mensagem com seu nome e entraremos em contato.</p>
    <form id="form1" name="form1" method="post" action="envia2.php">
      <p>
        <label for="nome2">Assunto:</label>
        <input type="text" name="assunto" id="assunto" />
      </p>
      <p>
        
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" />
      </p>
      <p>
        <label for="e-mail">E-mail:</label>
        <input type="text" name="e-mail" id="e-mail" />
      </p>
      <p>
        <label for="mensagem">Mensagem:</label>
        <textarea name="mensagem" id="mensagem" wrap="physical"></textarea>
      </p>
      <p> </p>
      <p>
        <input type="submit" name="enviar" id="enviar" value="Enviar" />
      </p>
    </form>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
</div>
          
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
        jQuery(document).ready(function($) {
        });
    </script>
          
          
	<?php  include '_footer.php';  ?>