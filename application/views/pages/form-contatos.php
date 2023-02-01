<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"></h1>
	</div>

	<div class="col-md-12">
		<div class="resultado"></div>
		<form action="<?= base_url() ?>contato/salvar" id="novoContato" method="post">
			<div class="col-md-6" style="margin-bottom: 1.5em;">
				<label>Grupos</label>
				<select class="form-control" name="grupo" id="grupo">
					<option value="">Selecione um Grupo</option>
					<?php foreach ($grupos as $grupo) : ?>
						<option value="<?= $grupo['id'] ?>"><?= $grupo['grupo'] ?></option>
					<?php endforeach; ?>
				</select>
				<div id="selectGrupo" style="display:flex; margin-bottom:1.5em; max-width: 1200; justify-content:space-between;">
				</div>
			</div>
			<div class="col-md-6">
				<label>Nome:</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" class="form-control nome" name="nome" id="nome" placeholder="João da Silva" required>
				</div>
			</div>

			<div class="col-md-6">
				<label>Nascimento:</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" maxlength="10" class="form-control nascimento" name="nascimento" id="nascimento" placeholder="01/01/2000" required onkeypress="mask(this, `##/##/####`)">
				</div>
			</div>

			<div class="col-md-6">
				<label>CPF</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" style="width: 500px;" maxlength="14" class="form-control cpf" name="cpf" id="cpf" placeholder="000.000.000-00" required onkeypress="mask(this, '###.###.###-##')">
				</div>
			</div>

			<div class="col-md-6" id="div-email">
				<label>Email:</label>
				<div class="form-group div-email" style="max-width: 1200px; display:flex;">
					<input type="email" class="form-control email" id="email" placeholder="joao@gmail.com" name="email" size="30" type="text">
					<button type="button" style="position:static;" class="btn btn-primary btn-xs" onclick="addEmail()"><i class="fas fa-plus"></i></button>
				</div>
			</div>

			<div class="col-md-6" id="div-phone">
				<label>Telefone:</label>
				<div class="form-group div-phone" style="max-width: 1200px; display:flex;">
					<input type="text" class="form-control" maxlength="15" name="phone" id="phone" placeholder="(00) 00000-0000" onkeyup="handlePhone(event)">
					<button type="button" style="position:static;" class="btn btn-primary btn-xs" onclick="addPhone()"><i class="fas fa-plus"></i></button>
				</div>
			</div>

			<div class="row" style="display: flex; justify-content:space-around;">
				<div>
					<table id="tabelaTelefone" class="table">
						<thead>
							<th scope="Nome">Telefone</th>
							<th rowspan="1" scope="Nome">Opções</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div>
					<table id="tabelaEmail" class="table">
						<thead>
							<th scope="Nome">Email</th>
							<th rowspan="1" scope="Nome">Opções</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div>
					<table id="tabelaGrupo" class="table">
						<thead>
							<th scope="Nome">Grupo</th>
							<th rowspan="1" scope="Nome">Opções</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-md-6">
				<button type="submit" onclick="validarCpf()" class="btn btn-success btn-xs" id="submit"><i class="fas fa-check"></i> Salvar</button>
				<a href="<?= base_url() ?>contato" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancelar</a>
			</div>
		</form>
	</div>
</main>

<script>
	$('#grupo').change(function() {
		tabelaGrupo();
	});

	function validarCpf() {
		cpf = $("#cpf").val();
		console.log(cpf);
		$.ajax({
			url: "<?= base_url() ?>contato/validaCPF",
			type: "post",
			dataType: "json",
			data: {
				cpf: cpf
			},
			success: function(data) {
				salvar();
			},
			error: function(d) {
				console.log("error: " + d);
			}
		});
	}
</script>