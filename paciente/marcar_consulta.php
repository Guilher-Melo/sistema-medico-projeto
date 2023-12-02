<?php 
    include('protectPaciente.php');
?>
<?php 
    include('../conexao.php');
?>

<?php
// Verifique se os parâmetros foram fornecidos na URL
if (isset($_GET['id_medico']) && isset($_GET['horario'])) {
    $id_medico = $_GET['id_medico'];
    $horario = urldecode($_GET['horario']);

    $id_paciente = $_SESSION['id_paciente'];

    date_default_timezone_set('America/Recife');
    $horariosSeparados = explode("-", $horario);
    $horarioInicio = $horariosSeparados[0];
    $horarioFim = $horariosSeparados[1];
    $data_atual = date('d/m/Y');

    $sql_code = "SELECT id_medico_horario, horario_1, horario_2, horario_3 FROM horarios WHERE id_medico_horario = $id_medico";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    
    $sql_code_consulta = "INSERT INTO consulta (id_medico_consulta, id_paciente_consulta, horario_inicio, horario_final, data, duracao) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql_code_consulta);

     if ($stmt) {
        $stmt->bind_param("sissss", $id_medico, $id_paciente, $horarioInicio, $horarioFim, $data_atual, $duracao);
        
            $duracao = "1h";
        
            $stmt->execute();
        
            if ($stmt->affected_rows > 0) {        
                echo "Consulta marcada!";
            } else {
                echo "Erro ao marcar a consulta.";
            }
        

    if ($sql_exec->num_rows > 0) {
        while ($row = $sql_exec->fetch_assoc()) {
            // Verifica em qual coluna o horário está e executa o UPDATE
            if ($row['horario_1'] == $horario) {
                $mysqli->query("UPDATE horarios SET horario_1 = NULL WHERE id_medico_horario = $id_medico");
                
            } elseif ($row['horario_2'] == $horario) {
                $mysqli->query("UPDATE horarios SET horario_2 = NULL WHERE id_medico_horario = $id_medico");
                
            } elseif ($row['horario_3'] == $horario) {
                $mysqli->query("UPDATE horarios SET horario_3 = NULL WHERE id_medico_horario = $id_medico");
                
            }
        }
    }
    
} else {
    $_SESSION['mensagem'] = 'Parâmetros inválidos. Tente novamente.';
    header('Location: pagina_mensagem.php');
    exit();
}
}

echo "<a href='pagPaciente.php'>Voltar para página principal</a>"
?>
