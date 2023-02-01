<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Contatos</h1>
		<div class="btn-group mr-2">
			<a href="<?= base_url() ?>contato/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Contatos</a>
		</div>
	</div>

	<div class="table-responsive">
		<div id="alert"></div>
		<div class="input-group input-group-sm mb-3">
			<span class="input-group-text" id="basic-addon1">Filtro</span>
			<select name="filtrar" id="filtrar" class="form-select" onchange="listar()">
				<option value="">Todos</option>
				<?php foreach ($grupos as $grupo) : ?>
					<option value="<?= $grupo['id'] ?>"><?= $grupo['grupo'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<table id="datatable" class="table table-bordered table-hover" style="text-align: center;">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Nascimento</th>
					<th>CPF</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>Opções</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</main>

<script>
	function goDeletar(id) {
		if (confirm("Deseja apagar esse registro?")) {
			apagar(id);
		} else {
			alert("Registro não alterado.");
			return false;
		}
	}

	function apagar(index) {
		$.ajax({
			url: "<?= base_url() ?>contato/deletar/" + index + "",
			dataType: "json",
			type: "post",
			data: {
				id_contato: index
			},
			success: function(data) {
				listar();
			},
			error: function(d) {
				console.log("error" + d);
				return false;
			}
		})
		listar();
	};

	function listar() {
		var search = $("#busca").val();
		var filter = $("#filtrar").val();
		console.log(filter);
		$.ajax({
			url: '<?= base_url() ?>contato/listar',
			dataType: "json",
			type: "post",
			data: {
				search: search,
				filter: filter
			},
			success: function(data) {
				event_data = '';
				$.each(data, function(index, value) {
					event_data += '<tr>'
					event_data += '<td>' + value.nome + '</td>'
					event_data += '<td>' + value.nascimento + '</td>'
					event_data += '<td>' + value.cpf + '</td>'
					event_data += '<td>' + value.email + '</td>'
					event_data += '<td>' + value.phone + '</td>'
					event_data += '<td>'
					event_data += '<a href="<?= base_url() ?>contato/editar/' + value.id + '" class="btn btn-primary btn-sm"><i class="fas fa-pencil"></i></a>'
					event_data += '<button type="button" id="apagar-registro" onclick="goDeletar(' + value.id + ')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>'
					event_data += '</tr>'
				});
				$("#datatable tbody").html('');
				$("#datatable tbody").append(event_data);
			},
			error: function(d) {
				console.log('error' + d);
			}
		});
	}
</script>