	<?php include '../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Atualizar Tb Tipos</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=atualizar&id=<?php  echo $_GET['id'];  ?>" method="post">
						<div class="form-group">
<label>Tip Nome</label>
<input type="text" name="tip_nome" value="<?php  echo $data["tb_tipos"]["tip_nome"];  ?>" class="form-control" placeholder="Tip Nome" required>
</div>

<div class="form-group">
<label>Tip Val</label>
<input type="text" name="tip_val" value="<?php  echo $data["tb_tipos"]["tip_val"];  ?>" class="form-control" placeholder="Tip Val" required>
</div>

<div class="form-group">
<label>Tip Desc</label>
<input type="text" name="tip_desc" value="<?php  echo $data["tb_tipos"]["tip_desc"];  ?>" class="form-control" placeholder="Tip Desc" required>
</div>


						<button type="submit" style="float:right;" class="btn btn-success">Salvar</button>
					</form>
				</div>
			</div>		
		</div>	
	</div>
	
	<?php include '../footer.php'; ?>
