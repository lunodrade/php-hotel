	<?php include '../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Atualizar Tb Reservas</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=atualizar&id=<?php  echo $_GET['id'];  ?>" method="post">
						<div class="form-group">
<label>Res In</label>
<input type="text" name="res_in" value="<?php  echo $data["tb_reservas"]["res_in"];  ?>" class="form-control" placeholder="Res In" required>
</div>

<div class="form-group">
<label>Res Out</label>
<input type="text" name="res_out" value="<?php  echo $data["tb_reservas"]["res_out"];  ?>" class="form-control" placeholder="Res Out" required>
</div>

<div class="form-group">
<label>Res Val</label>
<input type="text" name="res_val" value="<?php  echo $data["tb_reservas"]["res_val"];  ?>" class="form-control" placeholder="Res Val" required>
</div>

<div class="form-group">
<label>Fk Qua Num</label>
<select class="form-control" name="fk_qua_num" required>
<?php   foreach ($data["fk_qua_num_list"] as $value) {  ?>
<?php   if ($data["tb_reservas"]["fk_qua_num"] == $value["pk_qua_num"]) {  ?>
<option value="<?php  echo $value["pk_qua_num"];  ?>" selected><?php  echo $value["pk_qua_num"];  ?></option>
<?php  } else {  ?>
<option value="<?php  echo $value["pk_qua_num"];  ?>"><?php  echo $value["pk_qua_num"];  ?></option>
<?php  }  ?>
<?php  }  ?>
</select>
</div>
<div class="form-group">
<label>Fk Cli Cod</label>
<select class="form-control" name="fk_cli_cod" required>
<?php   foreach ($data["fk_cli_cod_list"] as $value) {  ?>
<?php   if ($data["tb_reservas"]["fk_cli_cod"] == $value["pk_cli_cod"]) {  ?>
<option value="<?php  echo $value["pk_cli_cod"];  ?>" selected><?php  echo $value["pk_cli_cod"];  ?></option>
<?php  } else {  ?>
<option value="<?php  echo $value["pk_cli_cod"];  ?>"><?php  echo $value["pk_cli_cod"];  ?></option>
<?php  }  ?>
<?php  }  ?>
</select>
</div>

						<button type="submit" style="float:right;" class="btn btn-success">Salvar</button>
					</form>
				</div>
			</div>		
		</div>	
	</div>
	
	<?php include '../footer.php'; ?>
