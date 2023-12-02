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
    echo $id_paciente;



    $horariosSeparados = explode("-", $horario);
    $horarioInicio = $horariosSeparados[0];
    $horarioFim = $horariosSeparados[1];
    $data_atual = date('d/m/Y');

    $sql_code = "SELECT id_medico_horario, horario_1, horario_2, horario_3 FROM horarios WHERE id_medico_horario = $id_medico";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);



    // $sql_code_consulta = "INSERT INTO consulta (id_medico_consulta, id_paciente_consulta, horario_inicio, horario_final, data, duracao ) VALUES ($id_medico, $id_paciente, $horarioInicio, $horarioFim, $data_atual, 1h)";

    // $sql_exec_2 = $mysqli->query($sql_code_consulta) or die($mysqli->error);

        // Use prepared statements para evitar problemas de segurança
        $sql_code_consulta = "INSERT INTO consulta (id_medico_consulta, id_paciente_consulta, horario_inicio, horario_final, data, duracao) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql_code_consulta);

        if ($stmt) {
            $stmt->bind_param("iissss", $id_medico, $id_paciente, $horarioInicio, $horarioFim, $data_atual, $duracao);
        
            // Defina o valor da duracao como uma string entre aspas
            $duracao = "1h";
        
            $stmt->execute();
        
            // Verifique se a inserção foi bem-sucedida
            if ($stmt->affected_rows > 0) {
                // Agora, você pode executar as atualizações na tabela horarios
                // ... (código para atualizar a tabela horarios)
        
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

    // Lógica para excluir a relação médico-horário (substitua isso pela sua lógica real)
    // Exemplo: $resultado = excluirRelacaoMedicoHorario($id_medico, $horario);
    echo $id_medico;
    echo $horario;
    echo "Consulta maarcada!";
    // Se a lógica de exclusão for bem-sucedida, redirecione para uma página com a mensagem
    
} else {
    // Se os parâmetros não foram fornecidos, redirecione para uma página de erro
    $_SESSION['mensagem'] = 'Parâmetros inválidos. Tente novamente.';
    header('Location: pagina_mensagem.php');
    exit();
}
}
?>
