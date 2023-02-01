<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>

	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.4/examples/dashboard/dashboard.css">
	<script src="https://kit.fontawesome.com/2a33fe9a00.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			getEmail();
			getGrupo();
			getPhone();
		});

		function atualizar() {
			const nome = $("#nome").val();
			const nascimento = $("#nascimento").val();
			const cpf = $("#cpf").val();
			$.ajax({
				url: '< ?= base_url() ?>contato/atualizar/<?= $contato['id'] ?>',
				type: "post",
				data: {
					nome: nome,
					nascimento: nascimento,
					cpf: cpf
				},
				success: function(data) {
					window.location.replace('<?= base_url() ?>contato');
				},
				error: function(d) {
					console.log("error" + d);
					return false;
				}
			});
		}

		function mask(src, mascara) {
			var campo = src.value.length;
			var saida = mascara.substring(0, 1);
			var texto = mascara.substring(campo);
			if (texto.substring(0, 1) != saida) {
				src.value += texto.substring(0, 1);
			}
		}

		const handlePhone = (event) => {
			let input = event.target
			input.value = phoneMask(input.value)
		}

		const phoneMask = (value) => {
			if (!value) return ""
			value = value.replace(/\D/g, '')
			value = value.replace(/(\d{2})(\d)/, "($1) $2")
			value = value.replace(/(\d)(\d{4})$/, "$1-$2")
			return value
		}

		function addPhone() {
			var phone = $('#phone').val();
			if (phone != "") {
				$.ajax({
					url: "<?= base_url() ?>contato/addPhone",
					type: "post",
					dataType: "json",
					data: {
						id_contato: <?= $contato['id'] ?>,
						phone: phone
					},
					success: function(data) {
						$("#phone").val('');
						getPhone();
					},
					error: function(d) {

					}
				});
			} else {
				alert("Insira um Email");
			}
		}

		function getPhone() {
			$.ajax({
				url: "<?= base_url() ?>contato/getPhone",
				dataType: 'json',
				type: 'get',
				data: {
					id_contato: <?= $contato['id'] ?>
				},
				success: function(data) {
					var tabela = '';
					$.each(data, function(index, value) {
						console.log(value);
						tabela += '<tr>';
						tabela += '<td><input style="border: none;" type="text" readonly value="' + value.phone + '"></td>';
						tabela += '<td>';
						tabela += '<button class="btn btn-danger" type="button" onclick="removerPhone(' + value.id + ')"><i class="fas fa-trash"></i></button></td>';
						tabela += '</tr>';
					});
					$('#tabelaTelefone tbody').html('');
					$('#tabelaTelefone tbody').append(tabela);
				},
				error: function(d) {
					console.log("error" + d);
					return false;
				}
			});
		}

		function removerPhone(index) {
			$.ajax({
				url: "<?= base_url() ?>contato/deletarPhone",
				dataType: 'json',
				type: 'post',
				data: {
					id_contato: <?= $contato['id'] ?>,
					id_phone: index
				},
				success: function(data) {
					getPhone();
				},
				error: function(d) {
					console.log("error" + d);
					return false;
				}
			});
		}

		function getGrupo() {
			$.ajax({
				url: "<?= base_url() ?>contato/getGrupo",
				dataType: 'json',
				type: 'get',
				data: {
					id_contato: <?= $contato['id'] ?>
				},
				success: function(data) {
					var tabela = '';
					$.each(data, function(index, value) {
						console.log(value);
						tabela += '<tr>';
						tabela += '<td class="linha"><input style="border: none;" type="text" readonly value="' + value.grupo + '"></td>';
						tabela += '<td>';
						tabela += '<button class="btn btn-danger" type="button" onclick="removerGrupo(' + value.id_grupo + ')"><i class="fas fa-trash"></i></button></td>';
						tabela += '</tr>';
					});
					$('#tabelaGrupo tbody').html('');
					$('#tabelaGrupo tbody').append(tabela);
				},
				error: function(d) {
					console.log("error" + d);
				}
			});
		}

		function removerGrupo(index) {
			console.log(index);
			$.ajax({
				url: "<?= base_url() ?>contato/deletarGrupo",
				dataType: 'json',
				type: 'post',
				data: {
					id_contato: <?= $contato['id'] ?>,
					id_grupo: index
				},
				success: function(data) {
					getGrupo();
				},
				error: function(d) {
					console.log("error" + d);
				}
			});
		}

		function addEmail() {
			var email = $('#email').val();
			if (email != "") {
				$.ajax({
					url: "<?= base_url() ?>contato/addEmail",
					type: "post",
					dataType: "json",
					data: {
						id_contato: <?= $contato['id'] ?>,
						email: email
					},
					success: function(data) {
						$("#email").val('');
						getEmail();
					},
					error: function(d) {

					}
				});
				getEmail();
			} else {
				alert("Insira um Email");
			}
		}

		function getEmail() {

			$.ajax({
				url: "<?= base_url() ?>contato/getEmail",
				dataType: 'json',
				type: 'get',
				data: {
					id_contato: <?= $contato['id'] ?>
				},
				success: function(data) {
					var tabela = '';
					$.each(data, function(index, value) {
						tabela += '<tr>';
						tabela += '<td><input style="border: none;" type="text" readonly value="' + value.email + '"></td>';
						tabela += '<td>';
						tabela += '<button class="btn btn-danger" type="button" onclick="removerEmail(' + value.id + ')"><i class="fas fa-trash"></i></button></td>';
						tabela += '</tr>';
					});
					$('#tabelaEmail tbody').html('');
					$('#tabelaEmail tbody').append(tabela);
				},
				error: function(d) {
					console.log("error" + d);
				}
			});
		}

		function removerEmail(index) {
			console.log(index);
			$.ajax({
				url: "<?= base_url() ?>contato/deletarEmail",
				dataType: 'json',
				type: 'post',
				data: {
					id_contato: <?= $contato['id'] ?>,
					id_email: index
				},
				success: function(data) {
					getEmail();
				},
				error: function(d) {
					console.log("error" + d);
				}
			});
		}

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
					atualizar();
				},
				error: function(d) {
					console.log("error: " + d);
					return false;
				}
			});
		}	
	</script>
</head>

<body>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2"></h1>
	</div>

	<div class="col-md-12">
		<div class="resultado"></div>
		<form id="atualizarContato" method="post">
			<div class="col-md-6" style="margin-bottom: 1.5em;">
				<label>Grupos</label>
				<select class="form-control" name="grupo" id="grupo">
					<option value="">Selecione um Grupo</option>
					<?php foreach ($grupos as $grupo): ?>
						<option value="<?= $grupo['grupo'] ?>"><?= $grupo['grupo'] ?></option>
					<?php endforeach; ?>
				</select>
				<div id="selectGrupo" style="display:flex; margin-bottom:1.5em; max-width: 1200; justify-content:space-between;">
				</div>
			</div>
			<div class="col-md-6">
				<label>Nome:</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" class="form-control nome" name="nome" id="nome" placeholder="João da Silva" required value="<?= $contato[
         'nome'
     ] ?>">
				</div>
			</div>

			<div class="col-md-6">
				<label>Nascimento:</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" maxlength="10" class="form-control nascimento" name="nascimento" id="nascimento" placeholder="dd/mm/yyyy" required value="<?= $contato[
         'nascimento'
     ] ?>" onkeypress="mask(this, `##/##/####`)">
				</div>
			</div>

			<div class="col-md-6">
				<label>CPF:</label>
				<div class="form-group" style="max-width: 1200px; display:flex;">
					<input type="text" maxlength="14" style="width: 500px;" class="form-control cpf" name="cpf" id="cpf" placeholder="000.000.000-00" required value="<?= $contato[
         'cpf'
     ] ?>" onkeypress="mask(this, '###.###.###-##')">
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
					<input type="text" maxlength="15" class="form-control" name="phone" id="phone" placeholder="(00) 00000-0000" onkeyup="handlePhone(event)">
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
				<button type="button" onclick="validarCpf()" class="btn btn-success btn-xs" id="submit"><i class="fas fa-check"></i> Salvar</button>
				<a href="<?= base_url() ?>contato" class="btn btn-dark btn-xs"><i class="fas fa-times"></i> Cancelar</a>
			</div>
		</form>
	</div>
</main>

<script>
	$('#grupo').change(function() {
			var grupo = $('#grupo').val();
			$("#grupo").val('');
			if (grupo != "") {
			
				$.ajax({
					url: "<?= base_url() ?>contato/addGrupo",
					type: "post",
					dataType: "json",
					data: {
						id_contato: <?= $contato['id'] ?>,
						grupo: grupo
					},
					success: function(data) {
						getGrupo();
					},
					error: function(d) {
		
					}
				});
			}
			getGrupo();
		});
</script>