<script type="text/javascript">
    function addData() {
        $("body").on("submit", ".formCreateProjectData", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let url =
                '{{ Auth::user()->role_id == 1 ? route('review.master.create') : route('master.create') }}'
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    swal("Done!", "Data berhasil ditambahkan", "success")
                        .then((value) => {
                            $(".formCreateProjectData").trigger("reset");
                            $(".modalCreate").modal("hide");
                            // location.reload();
                        });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $(".formCreateProjectData").trigger("reset");
                    $(".modalCreate").modal("hide");
                },
            });
        });
    }

    function enableInput() {
        document.querySelectorAll('.ieee').forEach(function(el) {
            el.disabled = false;
        });
    }
</script>
