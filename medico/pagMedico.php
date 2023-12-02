<?php 
    include('protectMedico.php');
?>
<?php 
    include('../conexao.php');
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
    <h2>Confira seus pacientes</h2>
    <?php
        $id_medico = $_SESSION['id_medico'];
        $sql_code_consulta = "SELECT paciente.nome, id_medico_consulta, id_paciente_consulta, id_consulta, horario_inicio, horario_final, data, duracao FROM consulta join paciente on paciente.id_paciente = id_paciente_consulta join medico on id_medico_consulta = medico.id_medico WHERE id_medico_consulta = $id_medico";
        $sql_exec = $mysqli->query($sql_code_consulta) or die($mysqli->error);
        $quantidade = $sql_exec->num_rows;

        if ($quantidade > 0) {
            while ($linha = mysqli_fetch_assoc($sql_exec)) {
                $id_consulta = $linha['id_consulta'];

                echo "<div class='consulta'>";
                    echo "<p><strong>Nome:</strong> " . htmlspecialchars($linha['nome']) . "</p>";
                    echo "<p><strong>ID do Paciente:</strong> " . htmlspecialchars($linha['id_paciente_consulta']) . "</p>";
                    echo "<p><strong>Horário de Início:</strong> " . htmlspecialchars($linha['horario_inicio']) . "</p>";
                    echo "<p><strong>Horário Final:</strong> " . htmlspecialchars($linha['horario_final']) . "</p>";
                    echo "<p><strong>Data:</strong> " . htmlspecialchars($linha['data']) . "</p>";
                    echo "<p><strong>Duração:</strong> " . htmlspecialchars($linha['duracao']) . "</p>";

                    // Verificar se o prontuário já existe para a consulta
                    $sql_check_prontuario = "SELECT * FROM prontuario WHERE id_consulta = $id_consulta";
                    $result_check_prontuario = $mysqli->query($sql_check_prontuario);

                    if ($result_check_prontuario->num_rows == 0) {
                        // Inserir o prontuário se ainda não existir
                        $sql_code_prontuario_insert = "INSERT INTO prontuario (id_consulta) VALUES (?)";
                        $stmt = $mysqli->prepare($sql_code_prontuario_insert);
                        
                        if ($stmt) {
                            $stmt->bind_param("i", $id_consulta);
                            $stmt->execute();
                        } else {
                            echo "Não foi possível inserir";
                        }
                    }

                    echo "<a href='prontuario.php?id_consulta=$id_consulta'>Ver prontuário</a>";
                    echo "<br>";
                echo "</div>";
            }
        }
    ?>
    <p>
        <a href="logoutMedico.php">Sair</a>
    </p>
</body>
</html>
