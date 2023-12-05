<?php 
    include('protectPaciente.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo Paciente, <?php echo $_SESSION['nome_usuario'] ?></h1>
    <p>
        <a href="listarMedicos.php">Marcar consulta com um médico</a>
        <a href="consultasMarcadas.php">Conferir suas consultas</a>
        <a href="logoutPaciente.php">Sair</a>
    </p>
</body>
</html>