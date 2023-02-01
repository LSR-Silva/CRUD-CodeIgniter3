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
			listar();
		});

		function salvar() {
			const nome = $("#nome").val();
			const nascimento = $("#nascimento").val();
			const cpf = $("#cpf").val();
			$.ajax({
				url: '<?= base_url() ?>contato/salvar',
				dataType: "json",
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
				}
			});
		};

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

		const global_email = [];
		const global_telefone = [];
		const global_grupo = [];

		function addPhone() {
			var telefone = $('#phone').val();
			if (telefone != "") {
				global_telefone.push(telefone);
				document.getElementById('phone').value = '';
				tabelaPhone();
			} else {
				alert("Insira um Telefone");
			}
		}

		function tabelaPhone() {
			var tabela = '';
			$.each(global_telefone, function(index, value) {
				tabela += '<tr>';
				tabela += '<td><input style="border: none;" type="text" readonly name="telefones[]" value="' + value + '"></td>';
				tabela += '<td>';
				tabela += '<button type="button" class="btn btn-danger" onclick="removerPhone(' + index + ')"><i class="fas fa-trash"></i></button></td>';
				tabela += '</tr>';
			});
			$('#tabelaTelefone tbody').html('');
			$('#tabelaTelefone tbody').append(tabela);
		}

		function removerPhone(index) {
			global_telefone.splice(index, 1);
			tabelaPhone();
		}

		// function addGrupo() {
		// 	var grupo = $('#grupo').val();
		// 	if (global_grupo.includes(grupo)) {
		// 		$("#grupo").val('');
		// 		return false;
		// 	}
		// 	global_grupo.push(grupo);
		// 	$("#grupo").val('');
		// 	tabelaGrupo();
		// }

		function tabelaGrupo() {
			var grupos = $("#grupo").val();
			$("#grupo").val('');
			$.ajax({
				url: '<?= base_url() ?>grupo/getGrupos',
				type: 'post',
				dataType: 'json',
				data: {
					id_grupo: grupos
				},
				success: function (data){
					global_grupo.push(data);
					var tabela = '';
					$.each(global_grupo, function(index, value) {
						$.each(value, function (key, valor) {
							console.log(global_grupo);
							tabela += '<tr>';
							tabela += '<td><input style="border: none;" type="text" readonly name="grupos[]" value="' + valor.grupo + '"></td>';
							tabela += '<td>';
							tabela += '<button type="button" class="btn btn-danger" onclick="removerGrupo(' + index + ')"><i class="fas fa-trash"></i></button></td>';
							tabela += '</tr>';
						})
					});
					$('#tabelaGrupo tbody').html('');
					$('#tabelaGrupo tbody').append(tabela);
				},
				error: function (d){
					console.log('error: ' + d);
				}
			})
		}

		function removerGrupo(index) {
			global_grupo.splice(index, 1);
			tabelaGrupo();
		}

		function addEmail() {
			var email = $('#email').val();
			if (email != "") {
				global_email.push(email);
				document.getElementById('email').value = '';
				tabelaEmail();
			} else {
				alert("Insira um Email");
			}
		}

		function tabelaEmail() {
			var tabela = '';
			$.each(global_email, function(index, value) {
				tabela += '<tr>';
				tabela += '<td><input style="border: none;" type="text" readonly name="emails[]" value="' + value + '"></td>';
				tabela += '<td>';
				tabela += '<button type="button" class="btn btn-danger" onclick="removerEmail(' + index + ')"><i class="fas fa-trash"></i></button></td>';
				tabela += '</tr>';
			});
			$('#tabelaEmail tbody').html('');
			$('#tabelaEmail tbody').append(tabela);
		}

		function removerEmail(index) {
			global_email.splice(index, 1);
			tabelaEmail();
		}
	</script>
</head>

<body>