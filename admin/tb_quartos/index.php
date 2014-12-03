		<?php include '../header.php'; ?>
		<?php include 'controller.php'; ?>
		
		<div class="row">
			<div class="col-md-12">
				<h1 style="padding:0px 0px 20px 0px;">Tb Quartos</h1>
			</div>
		</div>	

		<div class="row">
			<div class="col-md-12">	
				<div class="table-responsive">	

				<div class="bs-docs-example" >
			        <div class=" demo content3">

					<table id="datatable" class="table table-striped table-bordered table-hover bootstrap-datatable datatable">
						<thead>
							<tr>
								<th>Pk Qua Num</th>
                                <th>Qua Status</th>
                                <th>Fk Tip Cod</th>


								<th class="bt-padrao">Editar</th>
								<th class="bt-padrao">Deletar</th>
							</tr>
						</thead>
						<tbody>

							<?php $result = $class->listar(); ?>

							<?php if(!empty($result)) { ?>

								<?php foreach ($result as $key => $value) {  ?>
									<tr>
										<td><?php  echo $value['pk_qua_num'];  ?></td>
                                        <td><?php  echo $value['qua_status'];  ?></td>
                                        <td><?php  echo $value['fk_tip_cod'];  ?></td>

										<td><a data-href='<?php  echo URL;  ?>/admin/tb_quartos/functions.php?acao=atualizar&id=<?php echo $value['pk_qua_num']; ?>'><span class='glyphicon glyphicon-ok'></span></a></td>
										<td><a data-href='<?php  echo URL;  ?>/admin/tb_quartos/functions.php?acao=deletar&id=<?php echo $value['pk_qua_num']; ?>'><span class='glyphicon glyphicon-remove'></span></a></td>
									</tr>
								<?php } ?>

							<?php } ?>
						</tbody>
					</table>	

			        </div>
			    </div>

				</div>
			</div>		
		</div>	
		<div class="row">
			<div class="col-md-12">
				<div class="form-group text-center">
					<a href="<?php  echo URL;  ?>/admin/tb_quartos/functions.php?acao=adicionar" style="float:right;" class="btn btn-success">Cadastrar</a>
				</div>
			</div>
		</div>

	<?php include '../footer.php'; ?>