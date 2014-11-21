	<?php  include '_header.php';  ?>
    <link rel="stylesheet" href="assets/css/datepicker.css">
        
        <form action="page/mostrar_quartos.php" method="get">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Check in: <input type="text" class="span2" name="checkIn" value="" id="dpd1" data-date-format="dd/mm/yyyy" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" title="Three letter country code" required></th>
                        <th>Check out: <input type="text" class="span2" name="checkOut" value="" id="dpd2" data-date-format="dd/mm/yyyy" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" required></th>
                    </tr>
                </thead>
            </table>

            <button type="submit" id="acao" name="acao" value="logar">Entrar</button>
        </form>
        
		
		
		<br><br><br><br><br><br><br><br><br><br><br><br>
		
		Mostrar os <a href='page/mostrar_quartos.php'>quartos</a><br><br><br><br><br><br>
		
		<h1>Links de testes</h1>
		Acessar a sessão <a href='admin/'>admin</a><br>
		Acessar uma página interna de <a href='auth/interno_usuario.php'>usuário</a><br>
		Acessar uma página interna de <a href='auth/interno_admin.php'>admin</a><br>
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
    	jQuery(document).ready(function($) {
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

            var checkin = $('#dpd1').datepicker({
              onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
              }
            }).on('changeDate', function(ev) {
              if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                checkout.setValue(newDate);
              }
              checkin.hide();
              $('#dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('#dpd2').datepicker({
              onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
              }
            }).on('changeDate', function(ev) {
              checkout.hide();
            }).data('datepicker');
    	});
    </script>

	<?php  include '_footer.php';  ?>