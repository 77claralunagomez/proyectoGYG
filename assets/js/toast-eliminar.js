const eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-bs-id');
        const inputId = eliminaModal.querySelector('#id_eliminar');
        inputId.value = id;
    });
