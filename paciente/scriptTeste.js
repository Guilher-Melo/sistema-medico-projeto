function marcarConsulta() {
    var selectedMedico = document.querySelector('input[name="medico"]:checked');
    console.log(selectedMedico)

    if (selectedMedico) {
        var idMedico = selectedMedico.value;

        // Depure os valores para verificar se são os esperados
        console.log('idMedico:', idMedico);

        // Tente obter o elemento
        var selectHorario = document.getElementById('horarios_' + idMedico);

        if (selectHorario) {
            var selectedHorario = selectHorario.value;

            if (selectedHorario) {
                // Redirecione para a página com os parâmetros na URL
                window.location.href = 'marcar_consulta.php?id_medico=' + idMedico + '&horario=' + encodeURIComponent(selectedHorario);
            } else {
                alert('Por favor, selecione um horário antes de marcar a consulta.');
            }
        } else {
            console.log('Elemento select não encontrado.');
        }
    } else {
        alert('Por favor, selecione um médico antes de marcar a consulta.');
    }
}