<script type="text/javascript">
    // Create
    function addEmployee() {
        $('#modalHeading').html("Tambah Karyawan");
        $('#employee').modal('show');
        
        $("body").on("submit", "#formCreateEmployee", function(e) {
            e.preventDefault();
            let url = "{{ route('management.employee.create') }}"
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    swal("Done!", "Karyawan berhasil ditambahkan", "success");
                    $("#formCreateEmployee").trigger("reset");
                    $("#employee").modal("hide");
                    $("#table-employee").DataTable().ajax.reload();
                    // location.reload(true);
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateEmployee").trigger("reset");
                    $("#employee").modal("hide");
                },
            });
        });
    }
    
    // Read
    function readEmployee(id) {
        $('#modalHeading').html("Detail Karyawan");
        $('#employee').modal('show');
    }
    
    // Update
    function editEmployee(id) {
        $.ajax({
            url: "{{ url('/management/employee-edit') }}",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $("#modal-content-edit").html(data);
                return true;
            }
        });
    }
    function editForm() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $("body").on("submit", "#formUpdateEmployee", function(e) {
            e.preventDefault();
            let txt_id = $("#update_id").val();
            let txt_name = $("#update_name").val();
            let txt_email = $("#update_email").val();
            let url = "{{ route('management.employee.update') }}"
            $.ajax({
                url: url,
                type: "PUT",
                data: {
                    id: txt_id,
                    name: txt_name,
                    email: txt_email
                },
                success: function(data) {
                    $("#updateEmployee").modal("hide");
                    swal({
                        type: "success",
                        title: "Done!",
                        text: "Data Berhasil Diubah",
                    }).then(function() {
                        $("#formUpdateEmployee").trigger("reset");
                        $("#table-employee").DataTable().ajax.reload();
                        //location.reload(true);
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formUpdateEmployee").trigger("reset");
                    $("#updateEmployee").modal("hide");
                    $("#table-employee").DataTable().ajax.reload();
                },
            });
        });
    }
    
    // Delete
    function deleteEmployee(id) {
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
                    url: "{{ url('/management/employee-delete') }}/" + id,
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
                        $("#table-employee").DataTable().ajax.reload();
                    }
                });
            } else {
                e.dismiss;
            }
            
        }, function(dismiss) {
            return false;
        })
    }
    
    function addStore() {
        $('#modalHeadingToko').html("Tambah Toko");
        $('#toko').modal('show');
        
        $("body").on("submit", "#formCreateToko", function(e) {
            e.preventDefault();
            let url = "{{ route('management.toko.create') }}"
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    $("#toko").modal("hide");
                    swal({
                        type: "success",
                        title: "Done!",
                        text : "Karyawan Berhasil Disimpan",
                    }).then(function() {
                        $("#formUpdateEmployee").trigger("reset");
                        location.reload(true);
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateToko").trigger("reset");
                    $("#toko").modal("hide");
                },
            });
        });
    }
</script>
