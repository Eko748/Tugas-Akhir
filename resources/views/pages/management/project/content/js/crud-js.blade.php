<script type="text/javascript">
    function addProject() {
        $('#modalHeadingCreateProject').html("Create Project");
        $('#project').modal('show');

        $("body").on("submit", "#formCreateProject", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let url = '{{ route('management.project.create') }}'
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    swal("Done!", "Project berhasil ditambahkan", "success")
                    .then((value) => {
                        $("#formCreateProject").trigger("reset");
                        $("#project").modal("hide");
                        // $("#table-member").DataTable().ajax.reload();
                        location.reload();
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateProject").trigger("reset");
                    $("#project").modal("hide");
                },
            });
        });
    }

    // Read
    function readMember(id) {
        $('#modalHeading').html("Detail Member");
        $('#member').modal('show');
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
                            swal("Done!", results.message, "success");
                        } else {
                            swal("Error!", results.message, "error");
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
