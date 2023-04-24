<script type="text/javascript">
    function showLoading() {
        $("#data-review").hide();
        $("#loading").show();
    }

    $('#submit-review').click(function(e) {
        e.preventDefault();
        let search = $('#search').val();

        showLoading();

        let requestTimeout = setTimeout(function() {
            $("#loading").hide();
            alert('Request timed out. Please try again.');
        }, 30000);

        $.ajax({
            type: "GET",
            data: {
                'search': search,
            },
            url: '{{ Auth::user()->role_id == 1 ? route('review.springer.request') : route('springer.request') }}',
            success: function(data) {
                clearTimeout(requestTimeout);
                $("#loading").hide();
                $('#data-review').html(data).show();
            }
        });
    });

    function addData() {
        console.log("ada");
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
        document.querySelectorAll('.create').forEach(function(el) {
            el.disabled = false;
        });
    }

    function showFullTitle(identifier) {
        document.getElementById('product-title-full-' + identifier).style.display = 'inline';
        document.getElementById('product-title-short-' + identifier).style.display = 'none';
        document.getElementById('read-more-link-' + identifier).style.display = 'none';
        document.getElementById('read-less-link-' + identifier).style.display = 'inline';
    }

    function hideFullTitle(identifier) {
        document.getElementById('product-title-full-' + identifier).style.display = 'none';
        document.getElementById('product-title-short-' + identifier).style.display = 'inline';
        document.getElementById('read-more-link-' + identifier).style.display = 'inline';
        document.getElementById('read-less-link-' + identifier).style.display = 'none';
    }

    function addData() {
        console.log("ada");
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
</script>
