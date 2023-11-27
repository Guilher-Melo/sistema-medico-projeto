<?php
    include('../conexao.php');

    if(isset($_POST['nomeUsuario']) || isset($_POST['senha'])) {

        if(strlen($_POST['crm'] == 0)) {
            echo "Preencha seu CRM";
        } else if(strlen($_POST['nome']) == 0) {
            echo "Preencha seu nome";
        } else if(strlen($_POST['nomeUsuario']) == 0) {
            echo "Preencha seu nome de usuário";
        } else if(strlen($_POST['email']) == 0) {
            echo "Preencha seu email";
        } else if(strlen($_POST['senha']) == 0) {
            echo "Preencha sua senha";
        } else if(strlen($_POST['espec']) == 0) {
            echo "Preencha sua especialidade";
        } else {
            $crm = $mysqli -> real_escape_string($_POST['crm']);
            $nome = $mysqli -> real_escape_string($_POST['nome']);
            $nomeUsuario = $mysqli -> real_escape_string($_POST['nomeUsuario']);
            $email = $mysqli -> real_escape_string($_POST['email']);
            $senha = $mysqli -> real_escape_string($_POST['senha']);
            $especialidade = $mysqli -> real_escape_string($_POST['espec']);

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $mysqli -> query("INSERT INTO medico (id_medico, nome, nome_usuario, senha, email, especialidade) VALUES ('$crm', '$nome', '$nomeUsuario', '$senha', '$email', '$especialidade') ");

            header("Location: index.php");
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
    <h1>Cadastro médico</h1>
    <form action="" method="POST">
        <p>
            <label for="crm">CRM</label>
            <input type="text" id="crm" name="crm">
        </p>
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
            <label for="espec">Especialidade</label>
            <input type="text" id="espec" name="espec">
        </p>
        <p>
            <button type="submit">Cadastrar</button>
        </p>
    </form>
</body>
</html>