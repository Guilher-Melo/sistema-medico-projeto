function marcarConsulta() {
    var selectedMedico = document.querySelector('input[name="medico"]:checked');
    var selectedHorario = document.getElementById('horarios').value;

    if (selectedMedico && selectedHorario) {
        var idMedico = selectedMedico.value;
        window.location.href = 'marcar_consulta.php?id_medico=' + idMedico + '&horario=' + encodeURIComponent(selectedHorario);
    } else {
        alert('Por favor, selecione um médico e um horário antes de marcar a consulta.');
    }
}