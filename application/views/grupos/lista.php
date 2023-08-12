<div class="content-wrapper">
	<section class="content-header">
		<h1><?= $titulo ?></h1>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<form class="ocform form-inline">
					<div class="row">
						
					<div class="col-md-12">
							<a href="<?php echo base_url() ?>grupos/crear" id="realizar_venta" class="btn btn-success pull-right">
								Registrar
							</a>
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<?= form_dropdown('curso', [], '', array('class' => 'form-control', 'id' => 'curso')); ?>
						</div>
					</div>






					<!-- <input class="form-control" type="month" id="mes" name="mes" value="<?php echo date('Y-m'); ?>" > -->

				</form>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<?php echo genDataTable('mitabla', $columns, true, true); ?>
				</div>
			</div>
		</div>
	</section>
</div>