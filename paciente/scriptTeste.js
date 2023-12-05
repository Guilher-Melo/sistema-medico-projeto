function marcarConsulta() {
    var selectedMedico = document.querySelector('input[name="medico"]:checked');

    if (selectedMedico) {
        var idMedico = selectedMedico.value;

        var selectHorario = document.getElementById('horarios_' + idMedico);

        if (selectHorario) {
            var selectedHorario = selectHorario.value;

            if (selectedHorario) {
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