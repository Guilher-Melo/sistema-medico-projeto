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
    <form action="" method="POST">
        <p>Selecione seu médico</p>
        <?php
        $sql_code = "SELECT nome, especialidade, horario_1, horario_2, horario_3, id_medico FROM medico join horarios on medico.id_medico = horarios.id_medico_horario";
        $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
        $quantidade = $sql_exec->num_rows;
        if ($quantidade > 0) {
            // Saída de dados para cada linha
            while ($linha = mysqli_fetch_assoc($sql_exec)) {
                $id_medico = $linha['id_medico'];
                if (!empty($linha['horario_1']) || !empty($linha['horario_2']) || !empty($linha['horario_3'])) {
                echo '<pre>';
                echo '<label for="' . $linha['id_medico'] . '">' . $linha["nome"] . ', ' . $linha["especialidade"] . '</label> <br>';
                echo '<input type="radio" name="medico" id="medico_' . $linha['id_medico'] . '" value="' . $linha['id_medico'] . '"> <br>';
                echo '<label for="horarios" style="font-family: Arial, sans-serif; font-size: 14px; font-weight: normal;">Selecione um horário:</label> <br>';
                echo '<select name="horarios_' . $linha['id_medico'] . '" id="horarios_' . $linha['id_medico'] . '">';
        
                // Verifica se cada horário existe antes de exibi-lo
                if (!empty($linha['horario_1'])) {
                    echo '<option value="' . $linha['horario_1'] . '" style="font-family: Arial, sans-serif; font-size: 14px;">' . $linha['horario_1'] . '</option> <br>';
                }
        
                if (!empty($linha['horario_2'])) {
                    echo '<option value="' . $linha['horario_2'] . '" style="font-family: Arial, sans-serif; font-size: 14px;">' . $linha['horario_2'] . '</option> <br>';
                }
        
                if (!empty($linha['horario_3'])) {
                    echo '<option value="' . $linha['horario_3'] . '" style="font-family: Arial, sans-serif; font-size: 14px;">' . $linha['horario_3'] . '</option> <br>';
                }
        
                echo '</select>';
                echo '</pre>';
            } else {
                $sql = "UPDATE medico
                SET disponivel = 0
                WHERE id_medico = $id_medico";
                
    
                $sql_exec_2 = $mysqli->query($sql) or die($mysqli->error);

            }
        }
        } else {
            echo "0 resultados";
        }

        echo '<button type="button" onclick="marcarConsulta()">Marcar Consulta</button>';
        
        ?>
    </form>
    <script src="scriptTeste.js">
        
    </script>
</body>
</html>