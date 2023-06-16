/*
 * Default designs for SweetAlerts
 */
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

const SuccessMsg = Swal.mixin({
    icon: "success",
    confirmButtonColor: '#6e7d88',
    confirmButtonText: "OK",
    allowOutsideClick: true,
    allowEscapeKey: false,
    allowEnterKey: true
});

const ErrorMsg = Swal.mixin({
    icon: "error",
    confirmButtonColor: '#6e7d88',
    confirmButtonText: "OK",
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
});

const ConfirmPrimary = Swal.mixin({
    icon: 'question',
    confirmButtonColor: '#1266f1',
    confirmButtonText: 'Potvrdit',
    showCancelButton: true,
    cancelButtonText: 'Storno',
    reverseButtons: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
});

const ConfirmSuccess = Swal.mixin({
    icon: 'question',
    confirmButtonColor: '#00b74a',
    confirmButtonText: 'Potvrdit',
    showCancelButton: true,
    cancelButtonText: 'Storno',
    reverseButtons: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
});

const ConfirmWarning = Swal.mixin({
    icon: 'question',
    confirmButtonColor: '#ffa900',
    confirmButtonText: 'Potvrdit',
    showCancelButton: true,
    cancelButtonText: 'Storno',
    reverseButtons: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
});

const ConfirmDanger = Swal.mixin({
    icon: 'question',
    confirmButtonColor: '#f93154',
    confirmButtonText: 'Potvrdit',
    showCancelButton: true,
    cancelButtonText: 'Storno',
    reverseButtons: true,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
});