<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Grupos</h1>
		<div class="btn-group mr-2">
			<a href="<?= base_url() ?>grupo/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Grupo</a>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-hover" style="text-align:center;">
			<thead>
				<tr>
					<th>Grupo</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($grupos as $grupo) : ?>
					<tr>
						<td><a href="<?= base_url() ?>grupo/editar/<?= $grupo["id"] ?>" style="text-decoration:none; color:black"><?= $grupo["grupo"] ?></a></td>
						<td>
							<a href="<?= base_url() ?>grupo/editar/<?= $grupo["id"] ?>" class="btn btn-sm btn-primary">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a href="javascript:goDeletar(<?= $grupo["id"] ?>)" class="btn btn-sm btn-danger">
								<i class="fas fa-trash-alt"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</main>

<script>
	function goDeletar(id) {
		var url = 'grupo/deletar/' + id;
		if (confirm("Deseja apagar esse registro?")) {
			window.location.href = url;
		} else {
			alert("Registro não alterado.");
			return false;
		}
	}

	$(document).ready(function() {
		listar();
	});
	

	function listar() {
		var search = $("#busca").val();
		console.log(search);
		$.ajax({
			url: '< ?= base_url() ?>contato/listar',
			dataType: "json",
			type: "post",
			data: {
				search: search
			},
			success: function(data) {
				event_data = '';
				$.each(data, function(index, value) {
					event_data += '<tr>'
					event_data += '<td>' + value.nome + '</td>'
					event_data += '<td>' + value.nascimento + '</td>'
					event_data += '<td>' + value.cpf + '</td>'
					event_data += '</tr>'
				});
				$("#datatable tbody").html('');
				$("#datatable tbody").append(event_data);
			},
			error: function(d){

			}
		});
	}
</script>
