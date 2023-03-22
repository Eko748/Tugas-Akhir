<script type="text/javascript">
    function addCategory() {
        $("body").on("submit", "#formCreateCategory", function(e) {
            e.preventDefault();
            let url = "{{ route('scraping.category.create') }}"
            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    swal("Done!", "Category berhasil ditambahkan", "success");
                    $("#formCreateCategory").trigger("reset");
                    // $("#member").modal("hide");
                    // $("#table-member").DataTable().ajax.reload();
                    // location.reload(true);
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $("#formCreateCategory").trigger("reset");
                    // $("#member").modal("hide");
                },
            });
        });
    }
</script>
