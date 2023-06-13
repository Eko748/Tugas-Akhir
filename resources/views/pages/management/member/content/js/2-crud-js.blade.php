<script type="text/javascript">
    function addMember() {
        $('#modalHeadingCreateMember').html("New Member");
        $('#member').modal('show');

        $('.modal .modal-dialog').attr('class', 'modal-dialog  fadeInLeft  animated');
        $("body").on("submit", "#formCreateMember", function(e) {
            e.preventDefault();
            $('#formCreateMember button[type="submit"]').attr('disabled', true);
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let url = "{{ route('management.member.create') }}"
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    swal("Done!", "Member berhasil ditambahkan", "success")
                        .then((value) => {
                            $("#formCreateMember").trigger("reset");
                            $("#member").modal("hide");
                            $("#table-member").DataTable().ajax.reload();
                        });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateMember").trigger("reset");
                    $("#member").modal("hide");
                },
                complete: function() {
                    $('#formCreateMember button[type="submit"]').attr('disabled', false);
                }
            });
            abort();
        });
    }

    function detailMember(id) {
        $('#modalHeading').html("Detail Member");
        $('#member').modal('show');
    }

    function editMember(id) {
        let hashedId = CryptoJS.SHA256(id.toString()).toString(); // menggunakan CryptoJS untuk menghitung hash SHA-256
        $.ajax({
            url: "{{ route('management.member.edit') }}",
            type: "GET",
            data: {
                id: hashedId
            },
            success: function(data) {
                $("#modal-content-edit").html(data);
                return true;
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function editForm() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("body").on("submit", "#formUpdateMember", function(e) {
            e.preventDefault();
            $('#formUpdateMember button[type="submit"]').attr('disabled', true);
            let txt_id = $("#update_id").val();
            let txt_name = $("#update_name").val();
            let txt_email = $("#update_email").val();
            let url = "{{ route('management.member.update') }}"
            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: txt_id,
                    name: txt_name,
                    email: txt_email
                },
                success: function(result) {
                    $("#updateMember").modal("hide");
                    swal({
                        type: "success",
                        title: "Done!",
                        text: "Data Berhasil Diubah",
                    }).then(function() {
                        $("#formUpdateMember").trigger("reset");
                        $("#table-member").DataTable().ajax.reload();
                    });
                },
                error: function(result) {
                    swal({
                        type: "error",
                        title: "Fail!",
                        text: "Data Gagal Diubah!",
                    }).then(function() {
                        $("#formUpdateMember").trigger("reset");
                    });
                },
                complete: function() {
                    $('#formUpdateMember button[type="submit"]').attr('disabled', false);
                }
            });
            abort();
        });
    }

    $('body').on('click', '.set-pass', function() {
        let id = $(this).data('id');
        swal({
            title: "Atur Ulang Password",
            text: "Password Default: 12345678",
            type: "info",
            showCancelButton: !0,
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batalkan!",
            reverseButtons: !0,
            confirmButtonColor: "#0000ff"
        }).then(function(e) {
            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('management.member.password') }}',
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

    $('body').on('click', '.delete-member', function() {
        let id = $(this).data('id');
        swal({
            title: "Hapus?",
            text: "Mohon Konfirmasi!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Konfirmasi",
            cancelButtonText: "Batalkan!",
            reverseButtons: !0,
            confirmButtonColor: "#ff0000"
        }).then(function(e) {
            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{ route('management.member.delete') }}',
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

    function exportData() {
        swal({
            title: "Export Data Member",
            text: "Dapatkan data berupa file Excel",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Batalkan!",
            reverseButtons: true
        }).then((result) => {
            if (result.dismiss || result.cancel) {
            } else {
                window.location = "{{ route('management.member.export') }}";
            }
        });
    }


    function addInstitute() {
        $('#modalHeadingInstitute').html("Instansi");
        $('#institute').modal('show');

        $("body").on("submit", "#formCreateInstitute", function(e) {
            e.preventDefault();
            let url = "{{ route('management.institute.create') }}"
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    $("#institute").modal("hide");
                    swal({
                        type: "success",
                        title: "Done!",
                        text: "Institute Berhasil Disimpan",
                    }).then(function() {
                        $("#formCreateInstitute").trigger("reset");
                        location.reload(true);
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateInstitute").trigger("reset");
                    $("#institute").modal("hide");
                    location.reload(true);
                },
            });
        });
    }
</script>
