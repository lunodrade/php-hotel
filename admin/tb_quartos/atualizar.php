	<?php include '../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Atualizar Tb Quartos</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=atualizar&id=<?php  echo $_GET['id'];  ?>" method="post">
						<div class="form-group">
<label>Qua Status</label>
<input type="text" name="qua_status" value="<?php  echo $data["tb_quartos"]["qua_status"];  ?>" class="form-control" placeholder="Qua Status" required>
</div>

<div class="form-group">
<label>Fk Tip Cod</label>
<select class="form-control" name="fk_tip_cod" required>
<?php   foreach ($data["fk_tip_cod_list"] as $value) {  ?>
<?php   if ($data["tb_quartos"]["fk_tip_cod"] == $value["pk_tip_cod"]) {  ?>
<option value="<?php  echo $value["pk_tip_cod"];  ?>" selected><?php  echo $value["pk_tip_cod"];  ?></option>
<?php  } else {  ?>
<option value="<?php  echo $value["pk_tip_cod"];  ?>"><?php  echo $value["pk_tip_cod"];  ?></option>
<?php  }  ?>
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
