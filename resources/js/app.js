import './bootstrap';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import Swal from 'sweetalert2';

window.Swal = Swal;

$.fn.select2.defaults.set("theme", "bootstrap-5");
$.fn.select2.defaults.set("width", "100%");
$.fn.select2.defaults.set("language", {
    noResults: function (params) {
    return "Nenhum resultado encontrado!";
    }
});



window.deleteConfirm = function (e, title, text) {
    var button = e.target.closest('button');
    var form = button.form;
    var titulo = !title ? 'Você tem certeza?' : title;
    var texto = !text ? 'Deseja realmente excluir?' : text;
    e.preventDefault();

    Swal.fire({
        title: titulo,
        text: texto,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
      })
      .then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
      });
}

window.successSavedAlert = function (title) {
    let titulo = !title ? 'Registro salvo com sucesso!' : title;
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: titulo,
        showConfirmButton: false,
        timer: 2000
    })
}

window.successRemovedAlert = function (title) {
    let titulo = !title ? 'Registro removido com sucesso!' : title;
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: titulo,
        showConfirmButton: false,
        timer: 2000
    })
}

window.errorAlert = function (title) {
    let titulo = !title ? 'Ocorreu um erro inesperado!' : title;
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: titulo,
        showConfirmButton: false,
        timer: 3000
    })
}

