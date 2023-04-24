<script type="text/javascript">
    function showLoading() {
        $("#data-review").hide();
        $("#loading").show();
    }

    const searchInput = document.getElementById("search");

    document.getElementById("submit-review").addEventListener("click", function() {
        const query = searchInput.value;
        const cleanedQuery = query.replace(/[^\w\s]/gi, "");
        searchInput.value = cleanedQuery;
    });


    $('#submit-review').click(function(e) {
        e.preventDefault();
        let search = $('#search').val();

        showLoading();

        let requestTimeout = setTimeout(function() {
            $("#loading").hide();
            alert('Request timed out. Please try again.');
        }, 15000);

        $.ajax({
            type: "GET",
            data: {
                'search': search,
            },
            url: '{{ Auth::user()->role_id == 1 ? route('review.ieee.request') : route('ieee.request') }}',
            success: function(data) {
                clearTimeout(requestTimeout);
                $("#loading").hide();
                $('#data-review').html(data).show();
            }
        });
    });

    function cleanSearchQuery() {
        const searchInput = document.getElementById("search");
        const query = searchInput.value;
        const cleanedQuery = query.replace(/[^\w\s]/gi, "");
        searchInput.value = cleanedQuery;
    }

    document.getElementById("search").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            cleanSearchQuery();
            document.getElementById("submit-review").click();
        }
    });

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
        document.querySelectorAll('.create').forEach(function(el) {
            el.disabled = false;
        });
    }
</script>
