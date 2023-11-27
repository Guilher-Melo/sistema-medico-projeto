<?php 
    include('protectMedico.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem vindo médico, <?php echo $_SESSION['nome_usuario'] ?></h1>
    <p>
        <a href="logoutMedico.php">Sair</a>
    </p>
</body>
</html>