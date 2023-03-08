<script type="text/javascript">
    function addData() {
        $("body").on("submit", "#formCreateProjectData", function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let url = '{{ route('scraping.review.create') }}'
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
                            $("#formCreateProjectData").trigger("reset");
                            $(".modalCreate").modal("hide");
                            // location.reload();
                        });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateProjectData").trigger("reset");
                    $(".modalCreate").modal("hide");
                },
            });
        });
    }

    function enableInput() {
        document.getElementById("title").disabled = false;
        document.getElementById("publisher").disabled = false;
        document.getElementById("type").disabled = false;
        document.getElementById("publication_title").disabled = false;
        document.getElementById("publication_year").disabled = false;
        document.getElementById("citing_paper_count").disabled = false;
        document.getElementById("abstracts").disabled = false;
        document.getElementById("authors").disabled = false;
        document.getElementById("keywords").disabled = false;
    }
</script>
