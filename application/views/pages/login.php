<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title><?= $title ?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="theme-color" content="#563d7c">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://getbootstrap.com/docs/4.4/examples/sign-in/signin.css" rel="stylesheet">
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
        function validar(){
            var user = $("#inputUser").val();
            var senha = $("#inputSenha").val();
            $.ajax({
                url: '<?= base_url() ?>login/validar',
                type: 'post',
                dataType: 'json',
                data: {
                    user: user,
                    senha: senha
                },
                success: function(data){
                    window.location.replace('<?= base_url() ?>contato');
                },
                error: function(d){
                    console.log('error: ' + d);
                    alert('Usuário e Senha incorretos.');
                }
            });
        }
    </script>
</head>

<body class="text-center">
    <form class="form-signin" method="post" onsubmit="validar()">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <label for="inputUser" class="sr-only">Usuário</label>
        <input type="text" name="user" id="inputUser" class="form-control" placeholder="Usuário" required autofocus>
        <label for="inputSenha" class="sr-only">Senha</label>
        <input type="password" name="senha" id="inputSenha" class="form-control" placeholder="Senha" required>
        <p>
            <a href="<?= base_url() ?>cadastro">Não tem uma conta?</a>
        </p>
        <button class="btn btn-lg btn-primary btn-block" onclick="validar()">Sign in</button>
    </form>
</body>

</html>