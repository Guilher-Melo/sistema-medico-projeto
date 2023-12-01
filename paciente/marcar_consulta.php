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

    $sql_code = "SELECT id_medico_horario, horario_1, horario_2, horario_3 FROM horarios WHERE id_medico_horario = $id_medico";
    $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);

    if ($sql_exec->num_rows > 0) {
        while ($row = $sql_exec->fetch_assoc()) {
            // Verifica em qual coluna o horário está e executa o UPDATE
            if ($row['horario_1'] == $horario) {
                $conn->query("UPDATE horarios SET horario_1 = NULL WHERE id_medico_horario = $id_medico");
                break;
            } elseif ($row['horario_2'] == $horario) {
                $conn->query("UPDATE horarios SET horario_2 = NULL WHERE id_medico_horario = $id_medico");
                break;
            } elseif ($row['horario_3'] == $horario) {
                $conn->query("UPDATE horarios SET horario_3 = NULL WHERE id_medico_horario = $id_medico");
                break;
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
?>
