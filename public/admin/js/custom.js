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