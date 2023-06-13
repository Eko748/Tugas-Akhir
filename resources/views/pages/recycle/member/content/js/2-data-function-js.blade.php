<script type="text/javascript">
    $('body').on('click', '.restore', function() {
        let id = $(this).data('id');
        swal({
            title: "Restore?",
            text: "Data Member akan dipulihkan!",
            type: "question",
            showCancelButton: !0,
            confirmButtonText: "Restore!",
            cancelButtonText: "Batalkan!",
            reverseButtons: !0,
            confirmButtonColor: "#3B71CA"
        }).then(function(e) {
            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('recycle.member.restore') }}',
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
                        $('#table-member').DataTable().ajax.reload()
                    },
                });
            } else {
                e.dismiss;
            }
        });
    });

    $('body').on('click', '.delete', function() {
        let id = $(this).data('id');
        swal({
            title: "Hapus?",
            text: "Data Member akan terhapus permanen!",
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
                    url: '{{ route('recycle.member.delete') }}',
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
                        $('#table-member').DataTable().ajax.reload()
                    },
                });
            } else {
                e.dismiss;
            }
        });
    });
</script>
