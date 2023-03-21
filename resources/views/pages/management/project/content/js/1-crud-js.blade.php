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
</script>
