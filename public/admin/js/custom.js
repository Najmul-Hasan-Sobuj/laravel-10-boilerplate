// $(document).ready(function () {
//     $('.js-example-basic-multiple, .js-example-basic-single').select2();
// });


// Delete action with reload page
$(document).on('click', '.delete', function (e) {
    e.preventDefault();

    var deleteUrl = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-success'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then(function () {
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error Occurred!',
                        error,
                        'error'
                    );
                }
            });
        }
        else if (result.dismiss === swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
            );
        }
    });
});


// --------------------------------
// Delete Account with reload page
$(document).on('click', '.delete-account', async function (e) {
    e.preventDefault();

    var deleteAccountUrl = $(this).attr('href');
    var checkPasswordUrl = $(this).data('check-password-url');
    const { value: password } = await Swal.fire({
        title: "Confirm Password",
        input: "password",
        // inputLabel: "Password",
        inputPlaceholder: "Enter your password",
        inputAttributes: {
            maxlength: "30",
            autocapitalize: "off",
            autocorrect: "off"
        },
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-success'
        }
    });

    if (password) {
        // Check if the entered password matches the user's password in the database
        $.ajax({
            url: checkPasswordUrl,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                password: password,
            },
            success: function (response) {
                if (response.success) {
                    // Password matches, proceed with deletion
                    $.ajax({
                        url: deleteAccountUrl,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your Account has been deleted.',
                                'success'
                            ).then(function () {
                                // location.reload();
                                window.location.href = '/';
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error Occurred!',
                                error,
                                'error'
                            );
                        }
                    });
                } else {
                    // Password does not match, show error message
                    Swal.fire(
                        'Error Occurred!',
                        response.message,
                        'error'
                    );
                }
            },
            error: function (xhr, status, error) {
                Swal.fire(
                    'Error Occurred!',
                    'An error occurred while checking the password. Please try again.',
                    'error'
                );
            }
        });
    } else {
        Swal.fire(
            'Cancelled',
            'Your Account is safe :)',
            'error'
        );
    }
});
// --------------------------------


// --------------------------------
// Modal Code
// "use strict";

// var metronicModal = function () {
//     var t = $(".metronic_modal"),
//         n = new bootstrap.Modal(t);

//     return {
//         init: function () {
//             $(document).ready(function () {
//                 // Debugging statement
//                 console.log('Modal element:', t);

//                 // Check if the modal element is found
//                 if (t.length === 0) {
//                     console.error('Modal element not found.');
//                     return;
//                 }



//                 t.find('[data-kt-permissions-modal-action="close"]').on("click", function (event) {
//                     event.preventDefault();
//                     Swal.fire({
//                         text: "Are you sure you would like to close?",
//                         icon: "warning",
//                         showCancelButton: true,
//                         buttonsStyling: false,
//                         confirmButtonText: "Yes, close it!",
//                         cancelButtonText: "No, return",
//                         customClass: {
//                             confirmButton: "btn btn-primary",
//                             cancelButton: "btn btn-active-light"
//                         }
//                     }).then(function (result) {
//                         if (result.isConfirmed) {
//                             n.hide();
//                         } else if (result.dismiss === Swal.DismissReason.cancel) {
//                             Swal.fire({
//                                 text: "Your form has not been cancelled!",
//                                 icon: "error",
//                                 buttonsStyling: false,
//                                 confirmButtonText: "Ok, got it!",
//                                 customClass: {
//                                     confirmButton: "btn btn-primary"
//                                 }
//                             });
//                         }
//                     });
//                 });
//             });
//         }
//     }
// }();

// // Initialize the metronicModal
// metronicModal.init();
// "use strict";

// // Class definition
// var metronicModal = function () {
//     // Shared variables
//     const element = document.querySelector(".metronic_modal");
//     // const form = element.querySelector('#kt_modal_add_permission_form');
//     const modal = new bootstrap.Modal(element);

//     // Init add schedule modal
//     var initModal = () => {


//         // Close button handler
//         const closeButton = element.querySelector('[data-kt-permissions-modal-action="close"]');
//         closeButton.addEventListener('click', e => {
//             e.preventDefault();

//             Swal.fire({
//                 text: "Are you sure you would like to close?",
//                 icon: "warning",
//                 showCancelButton: true,
//                 buttonsStyling: false,
//                 confirmButtonText: "Yes, close it!",
//                 cancelButtonText: "No, return",
//                 customClass: {
//                     confirmButton: "btn btn-primary",
//                     cancelButton: "btn btn-active-light"
//                 }
//             }).then(function (result) {
//                 if (result.value) {
//                     modal.hide(); // Hide modal
//                 }
//             });
//         });

//         // Cancel button handler
//         const cancelButton = element.querySelector('[data-kt-permissions-modal-action="cancel"]');
//         cancelButton.addEventListener('click', e => {
//             e.preventDefault();

//             Swal.fire({
//                 text: "Are you sure you would like to cancel?",
//                 icon: "warning",
//                 showCancelButton: true,
//                 buttonsStyling: false,
//                 confirmButtonText: "Yes, cancel it!",
//                 cancelButtonText: "No, return",
//                 customClass: {
//                     confirmButton: "btn btn-primary",
//                     cancelButton: "btn btn-active-light"
//                 }
//             }).then(function (result) {
//                 if (result.value) {
//                     modal.hide(); // Hide modal
//                 } else if (result.dismiss === 'cancel') {
//                     Swal.fire({
//                         text: "Your form has not been cancelled!.",
//                         icon: "error",
//                         buttonsStyling: false,
//                         confirmButtonText: "Ok, got it!",
//                         customClass: {
//                             confirmButton: "btn btn-primary",
//                         }
//                     });
//                 }
//             });
//         });


//     }

//     return {
//         // Public functions
//         init: function () {
//             initModal();
//         }
//     };
// }();

// // On document ready
// KTUtil.onDOMContentLoaded(function () {
//     metronicModal.init();
// });
"use strict";

// Class definition
var metronicModal = function () {
    // Shared variables
    const modals = document.querySelectorAll('.metronic_modal');

    // Init modals
    var initModals = () => {
        modals.forEach(modalElement => {
            const modal = new bootstrap.Modal(modalElement);

            const swalConfirmClose = () => {
                Swal.fire({
                    text: "Are you sure you would like to close?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, close it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        modal.hide(); // Hide modal
                    }
                });
            };

            const swalConfirmCancel = (form) => {
                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        modal.hide(); // Hide modal
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            };

            // Close button handler
            const closeButton = modalElement.querySelector('[data-kt-permissions-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();
                swalConfirmClose();
            });

            // Cancel button handler
            const cancelButton = modalElement.querySelector('[data-kt-permissions-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();
                const form = modalElement.querySelector('form');
                swalConfirmCancel(form);
            });
        });
    };

    return {
        // Public functions
        init: function () {
            initModals();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    metronicModal.init();
});
