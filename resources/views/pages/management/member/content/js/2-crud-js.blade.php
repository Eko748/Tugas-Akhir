<script type="text/javascript">
    function addMember() {
        $('#modalHeadingCreateMember').html("Create Member");
        $('#member').modal('show');

        $('.modal .modal-dialog').attr('class', 'modal-dialog  fadeInLeft  animated');
        $("body").on("submit", "#formCreateMember", function(e) {
            e.preventDefault();
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
                    swal("Done!", "Karyawan berhasil ditambahkan", "success")
                        .then((value) => {
                            $("#formCreateMember").trigger("reset");
                            $("#member").modal("hide");
                            $("#table-member").DataTable().ajax.reload();
                            // location.reload();
                        });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateMember").trigger("reset");
                    $("#member").modal("hide");
                },
            });
        });
    }

    // Read
    function detailMember(id) {
        $('#modalHeading').html("Detail Member");
        $('#member').modal('show');
    }

    // Update
    function editMember(id) {
        let hashedId = CryptoJS.SHA256(id.toString()).toString(); // menggunakan CryptoJS untuk menghitung hash SHA-256
        $.ajax({
            url: "{{ url('/management/member-edit') }}",
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
                success: function(data) {
                    $("#updateMember").modal("hide");
                    swal({
                        type: "success",
                        title: "Done!",
                        text: "Data Berhasil Diubah",
                    }).then(function() {
                        $("#formUpdateMember").trigger("reset");
                        $("#table-member").DataTable().ajax.reload();
                        //location.reload(true);
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formUpdatemember").trigger("reset");
                    $("#updateMember").modal("hide");
                    $("#table-member").DataTable().ajax.reload();
                },
            });
        });
    }

    // Delete
    function deleteMember(id) {
        swal({
            title: "Delete?",
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function(e) {
            if (e.value === true) {
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/management/member-delete') }}/" + id,
                    data: {
                        _token: CSRF_TOKEN
                    },
                    dataType: 'JSON',
                    success: function(results) {
                        if (results.success === true) {
                            swal("Done!", results.s, "success");
                        } else {
                            swal("Error!", results.e, "error");
                        }
                        $("#table-member").DataTable().ajax.reload();
                    }
                });
            } else {
                e.dismiss;
            }

        }, function(dismiss) {
            return false;
        })
    }

    function exportData() {
        swal({
            title: "Export?",
            text: "Dapatkan data berupa file Excel!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, export!",
            cancelButtonText: "Tidak, batalkan!",
            reverseButtons: !0
        }).then((result) => {
            window.location = "{{ route('management.member.export') }}";
        });
    }

    function addInstitute() {
        $('#modalHeadingInstitute').html("Create Institute");
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
                    // location.reload(true);
                },
            });
        });
    }
</script>
