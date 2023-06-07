<script>
    function snowBalling(id) {
        $('#modalHeadingViewProject').html("Snowballing");
        $('.info').show();
        $('#modal-content-detail').hide();
        $('#modal-content-snowballing').show();
        let hashedId = CryptoJS.SHA256(id.toString()).toString();
        $.ajax({
            url: '{{ Auth::user()->role_id == 1 ? route('management.project.snowBalling') : route('project.snowBalling') }}',
            type: 'GET',
            data: {
                code: hashedId
            },
            success: function(data) {
                $('#modal-content-snowballing').html(data);
                $('#viewProject').modal('show');
                return true;
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function showDetail(id) {
        $('#modalHeadingViewProject').html("Detail Data Scraping");
        $('.info').hide();
        $('#modal-content-snowballing').hide();
        $('#modal-content-detail').show();
        let hashedId = CryptoJS.SHA256(id.toString()).toString();
        $.ajax({
            url: '{{ Auth::user()->role_id == 1 ? route('management.project.modalDetail') : route('project.modalDetail') }}',
            type: 'GET',
            data: {
                code: hashedId,
            },
            success: function(data) {
                $('#modal-content-detail').html(data);
                $('#viewProject').modal('show');
                return true;
            },
            error: function(xhr, status, error) {
                console.log(error);
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
            confirmButtonText: "Hapus!",
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
                        if (results.e === true) {
                            swal("Done!", results.status, "success");
                        } else {
                            swal("Error!", results.status, "error");
                        }
                        $('#table-project').DataTable().ajax.reload()
                    },
                });
            } else {
                e.dismiss;
            }
        });
    });

    function exportData() {
        swal({
            title: "Export?",
            text: "Dapatkan data berupa file Excel!",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Batalkan!",
            reverseButtons: true
        }).then((result) => {
            if (result.dismiss || result.cancel) {
            } else {
                window.location = "{{ Auth::user()->role_id == 1 ? route('management.project.export') : route('project.export') }}";
            }
        });
    }
</script>
