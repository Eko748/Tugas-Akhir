<script>
    function snowBalling(id) {
        $('#modalHeadingViewProject').html("Backward Snowballing");
        $('#modal-content-detail').hide();
        $('#modal-content-snowballing').show();
        $.ajax({
            url: '{{ (Auth::user()->role_id == 1) ? route('management.project.snowBalling', $uuid_project) : route('project.snowBalling', $uuid_project) }}',
            type: 'GET',
            data: {
                code: id
            },
            success: function(data) {
                $('#modal-content-snowballing').html(data);
                $('#viewProject').modal('show');
            }
        });
        // Mendapatkan elemen teks yang ingin disalin

    }

    function showDetail(id) {
        $('#modalHeadingViewProject').html("Detail Data");
        $('#modal-content-snowballing').hide();
        $('#modal-content-detail').show();
        $.ajax({
            url: '{{ (Auth::user()->role_id == 1) ? route('management.project.modalDetail', $uuid_project) : route('project.modalDetail', $uuid_project) }}',
            type: 'GET',
            data: {
                code: id,
                user: {{ Auth::user()->id }}
            },
            success: function(data) {
                $('#modal-content-detail').html(data);
                $('#viewProject').modal('show');
            }
        });
    }



    $('body').on('click', '#deleteSLR', function() {
        let id = $(this).data('id');
        swal({
            title: "Hapus?",
            text: "Mohon Konfirmasi!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Hapus Data!",
            cancelButtonText: "Batalkan!",
            reverseButtons: !0,
            confirmButtonColor: "#ff0000"
        }).then(function(e) {
            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ Auth::user()->role_id == 1 ? route('management.projectSLR.delete') : route('projectSLR.delete') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function(results) {
                        if (results.s === true) {
                            swal("Done!", results.e, "success");
                        } else {
                            swal("Error!", results.e, "error");
                        }
                        $('#table-project').DataTable().ajax.reload()
                    },
                });
            } else {
                e.dismiss;
            }
        });
    });
</script>
