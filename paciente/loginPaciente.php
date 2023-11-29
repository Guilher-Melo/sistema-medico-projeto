<?php 
    include('../conexao.php');
    if(isset($_POST['nome_usuario'])) {
    if(strlen($_POST['nome_usuario'] == 0)) {
        echo "Preencha seu nome de usuario";
    } else if(strlen($_POST['senha_paciente']) == 0) {
        echo "Preencha sua senha";
    } else {
        $nomeUsuario = $mysqli -> real_escape_string($_POST['nome_usuario']);
        $senha = $mysqli -> real_escape_string($_POST['senha_paciente']);

        $sql_code = "SELECT * FROM paciente WHERE nome_usuario = '$nomeUsuario' LIMIT 1";
        $sql_exec = $mysqli -> query($sql_code) or die($mysqli -> error);

        $quantidade = $sql_exec -> num_rows;

        if ($quantidade == 1) {
            $paciente = $sql_exec -> fetch_assoc();
            if(password_verify($senha, $paciente['senha'])) {
                echo "Usuário logado!";
                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['nome_usuario'] = $paciente['nome_usuario'];
                $_SESSION['id_paciente'] = $paciente['id_paciente'];

                header("Location: pagPaciente.php");
            }
        } else {
            echo "Falha ao logar! Senha ou e-mail incorretos";
        }
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e cadastro</title>
</head>

<body>
    <form action="" method="POST">
        <h1>Fazer login</h1>
        <p>
            <label for="nome_usuario">Nome do usuário</label>
            <input type="text" name="nome_usuario" id="nome_usuario">
        </p>
        <p>
            <label for="senha_paciente">Senha</label>
            <input type="password" name="senha_paciente" id="senha_paciente">
        </p>
        <p>
            <button type="submit">Fazer login</button>
            <a href="cadastroPaciente.php">Não tem login? Cadastre-se</a>
        </p>
    </form>
</body>

</html>