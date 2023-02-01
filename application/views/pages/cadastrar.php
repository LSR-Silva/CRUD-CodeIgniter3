<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title><?= $title ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">
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
    <script>
        function cadastrar() {
            var user = $("#inputUser").val();
            var email = $("#inputEmail").val();
            var senha = $("#inputSenha").val();
            var confirma = $("#inputConfirmaSenha").val();
            console.log(senha);
            console.log(confirma);
            if (senha == confirma) {
                $.ajax({
                    url: '<?= base_url() ?>cadastro/salvar',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        user: user,
                        email: email,
                        senha: senha
                    },
                    success: function(data) {
                        window.location.replace('<?= base_url() ?>login');
                    },
                    error: function(d) {
                        console.log('error: ' + d);
                        alert('Esse usuário já existe. Utilize um usuário não existente');
                    }
                })
            } else {
                alert('As senhas precisam ser iguais.');
                $("#inputSenha").val('');
                $("#inputConfirmaSenha").val('');
            }
        }
    </script>
    <link href="https://getbootstrap.com/docs/4.4/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="post" onsubmit="cadastrar()">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Cadastrar</h1>

        <label for="inputUser" class="sr-only">User</label>
        <input type="text" name="user" id="inputUser" class="form-control" placeholder="Nome de Usuário" required autofocus>

        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>

        <label for="inputSenha" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputSenha" class="form-control" placeholder="Senha" required>

        <label for="inputConfirmaSenha" class="sr-only">Confirmar Senha</label>
        <input type="password" name="confirmarSenha" id="inputConfirmaSenha" class="form-control" placeholder="Confirmar Senha" required>

        <p>
            <a href="<?= base_url() ?>login">Já possui um conta?</a>
        </p>
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="cadastrar()">Sign in</button>
    </form>
</body>

</html>