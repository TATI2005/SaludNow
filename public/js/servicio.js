const motivosPorEspecialidad = {
    'Medicina General': ['Control médico', 'Fiebre y malestar', 'Gripa o tos', 'Dolor de cabeza', 'Chequeo general'],
    'Pediatria':        ['Control de crecimiento', 'Vacunación', 'Fiebre en niños', 'Revisión pediátrica'],
    'Odontologia':      ['Limpieza dental', 'Dolor de muela', 'Extracción', 'Revisión bucal'],
    'Oftamologia':      ['Examen de la vista', 'Prescripción de lentes', 'Irritación ocular', 'Control oftalmológico'],
};

function abrirModalCita(especialidad) {
    document.getElementById('displayEspecialidad').textContent = especialidad;
    document.getElementById('fieldEspecialidad').value = especialidad;

    const select = document.getElementById('motivoSelect');
    select.innerHTML = '<option value="" disabled selected>Selecciona el motivo...</option>';
    const motivos = motivosPorEspecialidad[especialidad] || [];
    motivos.forEach(m => {
        const opt = document.createElement('option');
        opt.value = m;
        opt.textContent = m;
        select.appendChild(opt);
    });

    new bootstrap.Modal(document.getElementById('modalAgendarCita')).show();
}