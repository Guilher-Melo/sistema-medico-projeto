<?php 
    include('protectMedico.php');
?>

<?php 
    include('../conexao.php');
?>

<?php 
    $id_prontuario = $_POST['id_prontuario'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $pressao_arterial = $_POST['pressao_arterial'];
    $descricao_problema = $_POST['descricao_problema'];

    $sql = "UPDATE prontuario
            SET altura = '$altura', peso = '$peso', pressao_arterial = '$pressao_arterial', descricao_problema= '$descricao_problema'
            WHERE id_prontuario = $id_prontuario";
    
    $sql_exec = $mysqli->query($sql) or die($mysqli->error);

    echo "Prontuário Atualizado!!";
    echo "<a href='pagMedico.php'> Voltar para página principal </a>";
?>