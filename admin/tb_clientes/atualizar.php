	<?php include '../../header.php'; ?>

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Atualizar Tb Clientes</h1>
			</div>
		</div>	
	                    	
		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	
					<form action="functions.php?acao=atualizar&id=<?php  echo $_GET['id'];  ?>" method="post">
						<div class="form-group">
<label>Cli Nome</label>
<input type="text" name="cli_nome" value="<?php  echo $data["tb_clientes"]["cli_nome"];  ?>" class="form-control" placeholder="Cli Nome" required>
</div>

<div class="form-group">
<label>Cli Nasc</label>
<input type="text" name="cli_nasc" value="<?php  echo $data["tb_clientes"]["cli_nasc"];  ?>" class="form-control" placeholder="Cli Nasc" required>
</div>

<div class="form-group">
<label>Cli Rg</label>
<input type="text" name="cli_rg" value="<?php  echo $data["tb_clientes"]["cli_rg"];  ?>" class="form-control" placeholder="Cli Rg" required>
</div>

<div class="form-group">
<label>Cli Cpf</label>
<input type="text" name="cli_cpf" value="<?php  echo $data["tb_clientes"]["cli_cpf"];  ?>" class="form-control" placeholder="Cli Cpf" required>
</div>


						<button type="submit" style="float:right;" class="btn btn-default">Salvar</button>
					</form>
				</div>
			</div>		
		</div>	
	</div>
	
	<?php include '../../footer.php'; ?>
