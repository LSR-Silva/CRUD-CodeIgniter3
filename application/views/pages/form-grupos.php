<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"></h1>
	</div>

	<div class="col-md-12">
		<?php if (isset($grupo)) : ?>
			<form action="<?= base_url() ?>grupo/atualizar/<?= $grupo["id"] ?>" method="post">
		<?php else : ?>
			<form action="<?= base_url() ?>grupo/salvar" method="post">
		<?php endif; ?>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nome">Nome do Grupo:</label>
						<input type="text" class="form-control" name="grupo" id="grupo" placeholder="Nome do Grupo" required value="<?= isset($grupo) ? $grupo["grupo"] : "" ?>">
					</div>
				</div>

				<div class="col-md-6">
					<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
					<a href="<?= base_url() ?>grupo" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
				</div>
			</form>
	</div>
</main>
