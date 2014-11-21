	<?php include '../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Cadastrar Tb Reservas</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=salvar" method="post">
						<div class='form-group'>
<label>Res In</label>
<input type='text' name='res_in' class='form-control' placeholder='Res In' required>
</div>

<div class='form-group'>
<label>Res Out</label>
<input type='text' name='res_out' class='form-control' placeholder='Res Out' required>
</div>

<div class='form-group'>
<label>Res Val</label>
<input type='text' name='res_val' class='form-control' placeholder='Res Val' required>
</div>

<div class="form-group">
<label>Fk Qua Num</label>
<select class="form-control" name="fk_qua_num" required>
<?php   foreach ($data["fk_qua_num_list"] as $value) {  ?>
<option value="<?php  echo $value["pk_qua_num"];  ?>"><?php  echo $value["pk_qua_num"];  ?></option>
<?php  }  ?>
</select>
</div>
<div class="form-group">
<label>Fk Cli Cod</label>
<select class="form-control" name="fk_cli_cod" required>
<?php   foreach ($data["fk_cli_cod_list"] as $value) {  ?>
<option value="<?php  echo $value["pk_cli_cod"];  ?>"><?php  echo $value["pk_cli_cod"];  ?></option>
<?php  }  ?>
</select>
</div>

						<button type="submit" style="float:right;" class="btn btn-default">Salvar</button>
					</form>
				</div>
			</div>		
		</div>	
	</div>
	
	<?php include '../footer.php'; ?>
