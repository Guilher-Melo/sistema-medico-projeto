<?php
include('../conexao.php')
?>

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
    <h1>Suas consultas</h1>
<?php
    $id_paciente = $_SESSION['id_paciente'];
    $sql_code = "SELECT medico.nome as nome_medico, id_consulta, id_paciente_consulta, horario_inicio, horario_final, data 
    FROM consulta join medico on medico.id_medico = id_medico_consulta WHERE id_paciente_consulta = $id_paciente ";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
    $quantidade = $sql_exec->num_rows;
    if ($quantidade > 0) {
        while ($linha = mysqli_fetch_assoc($sql_exec)) {
            echo '<strong>Médico:</strong> ' . $linha['nome_medico'] . '<br>';
            echo '<strong>Horário:</strong> ' . $linha['horario_inicio'] . ' - ' . $linha['horario_final'] . '<br>';
            echo '<strong>Data:</strong> ' . $linha['data'] . '<br><br>';
        }
    } else {
        echo "Sem consultas marcadas!";
    }
?>
</body>
</html>

