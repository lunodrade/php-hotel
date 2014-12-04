	<?php  include '_header.php';  ?>

    <link rel="stylesheet" href="assets/css/datepicker.css">
    <style type="text/css">
        .table > thead > tr > th {
            border-bottom: none;
        }
        .inner.cover {
            border: 2px solid rgba(25, 25, 25, .6);
            box-shadow: 0px 5px 20px 0px rgba(25, 25, 25, 0.60);
            padding: 12% 0 12% 0;
            background-color: rgba(100, 100, 100, 0.6);
        }
        .cover {
            padding: 0;
        }
        input, button {
            color: black;
        }
        
        input {
            padding-left: 5%;
        }
        
        button#acao {
            margin-top: 5%;
            width: 25%;
            height: 3em;
        }
        input.span2 {
            height: 3em;
        }
        .cover-heading {
            margin-bottom: 10%;
        }
        .outerDias {
            margin: 10% 0 3% 0;
            padding: 10px;
            background-color: rgba(20,20,20,0.7);;
            font-weight: bolder;
        }
    </style>


<div class="inner cover">


<h1 class="cover-heading">Faça a sua reserva</h1>
<span class="outerDias" id="diasDaReserva">1 dia</span>

<form action="page/mostrar_quartos.php" method="get">
<div class="row">
<div class="col-xs-6"><span>Check in:</span></div>
<div class="col-xs-6"><span>Check out:</span></div>
</div>
<div class="row">
<div class="col-xs-6"><input type="text" class="span2" name="checkIn" value="" id="dpd1" data-date-format="dd/mm/yyyy" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" title="Three letter country code" required></div>
<div class="col-xs-6"><input type="text" class="span2" name="checkOut" value="" id="dpd2" data-date-format="dd/mm/yyyy" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" required></div>
</div>

<button type="submit" id="acao" name="" value="">Entrar</button>
</form>
</div>
          
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
                if (ev.date.valueOf() >= checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                    setDaysReserved();
                }
                checkin.hide();
                $('#dpd2')[0].focus();
            }).data('datepicker');
            
            var checkout = $('#dpd2').datepicker({
                onRender: function(date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function(ev) {
                if (ev.date.valueOf() <= checkin.date.valueOf()) {
                    var newDate = new Date(checkin.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.setValue(newDate);
                }
                checkout.hide();
                setDaysReserved();
            }).data('datepicker');
            
            function setDaysReserved() {
                var start = checkin.date.valueOf();
                var end   = checkout.date.valueOf();
                var days   = (end - start)/1000/60/60/24;
                if(days > 1)
                    $("#diasDaReserva").text(days + " dias");
                else
                    $("#diasDaReserva").text(days + " dia");
            }

            checkin.setValue(now);
            var newDate = new Date(now)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        });
    </script>
          
          
	<?php  include '_footer.php';  ?>