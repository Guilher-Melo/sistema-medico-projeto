<?php 
    include ('../conexao.php');
?>
<?php 
    include ('protectMedico.php');
?>

<?php
    echo "Teste prontuário";

        $id_consulta = $_GET['id_consulta'];

        $sql_code_prontuario = "SELECT paciente.nome as nome, prontuario.id_consulta, id_prontuario, altura, peso, pressao_arterial, descricao_problema 
        FROM prontuario 
        join consulta on consulta.id_consulta = prontuario.id_consulta
        join paciente on id_paciente = id_paciente_consulta
        WHERE prontuario.id_consulta = $id_consulta";
        $sql_exec = $mysqli->query($sql_code_prontuario) or die($mysqli->error);
        $quantidade = $sql_exec->num_rows;

        if ($quantidade > 0) {
            $linha = mysqli_fetch_assoc($sql_exec) ;
            $nome_paciente = $linha['nome'];
            $altura = $linha['altura'];
            $peso = $linha['peso'];
            $pressao_arterial = $linha['pressao_arterial'];
            $descricao_problema = $linha['descricao_problema'];
            $id_prontuario = $linha['id_prontuario'];
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Editar Prontuário Médico</h1>

<form action="processar_edicao.php" method="POST">
    <label for="nome">Nome do Paciente:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $nome_paciente; ?>" readonly>

    <label for="altura">Altura:</label>
    <input type="text" id="altura" name="altura" value="<?php echo $altura; ?>">

    <label for="peso">Peso:</label>
    <input type="text" id="peso" name="peso" value="<?php echo $peso; ?>">

    <label for="pressao_arterial">Pressão Arterial:</label>
    <input type="text" id="pressao_arterial" name="pressao_arterial" value="<?php echo $pressao_arterial; ?>">

    <label for="descricao_problema">Descrição do problema</label>
    <textarea id="descricao_problema" name="descricao_problema"><?php echo $descricao_problema; ?></textarea>

    <input type="hidden" name="id_prontuario" value="<?php echo $id_prontuario; ?>">
    
    <input type="submit" value="Salvar Alterações">
        <br>
    <a href="pagMedico.php">Voltar para a sua página</a>
</form>
</body>
</html>

