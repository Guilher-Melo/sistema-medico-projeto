<?php
    include('../conexao.php');

    if(isset($_POST['nomeUsuario']) || isset($_POST['senha'])) {

        if(strlen($_POST['nome']) == 0) {
            echo "Preencha seu nome";
        } else if(strlen($_POST['nomeUsuario']) == 0) {
            echo "Preencha seu nome de usuário";
        } else if(strlen($_POST['email']) == 0) {
            echo "Preencha seu email";
        } else if(strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else {
            $nome = $mysqli -> real_escape_string($_POST['nome']);
            $nomeUsuario = $mysqli -> real_escape_string($_POST['nomeUsuario']);
            $email = $mysqli -> real_escape_string($_POST['email']);
            $senha = $mysqli -> real_escape_string($_POST['senha']);

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $mysqli -> query("INSERT INTO paciente (nome, nome_usuario, senha, email) VALUES ('$nome', '$nomeUsuario', '$senha', '$email') ");

            header("Location: loginPaciente.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro Paciente</h1>
    <form action="" method="POST">
        <p>
            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome">
        </p>
        <p>
            <label for="nomeUsuario">Nome de usuário</label>
            <input type="text" id="nomeUsuario" name="nomeUsuario">
        </p>
        <p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email">
        </p>
        <p>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>