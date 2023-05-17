<script type="text/javascript">
    function showLoading() {
        $("#data-review").hide();
        $("#loading").show();
    }

    $('#submit-review').click(function(e) {
        e.preventDefault();
        let search = $('#search').val();

        showLoading();

        let xhr = $.ajax({
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

        let requestTimeout = setTimeout(function() {
            $("#loading").hide();
            swal({
                title: 'Request Timeout!',
                text: 'Mohon periksa jaringan anda',
                type: 'error',
                onClose: function() {
                    $('#data-review').show();
                }
            });
            xhr.abort();
        }, 60000);
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
            document.getElementById("submit-review").click();
        }
    });

    function addData() {
        $(document).on("submit", ".formCreateProjectData", function(e) {
            e.preventDefault();
            $(".formCreateProjectData button[type='submit']").attr("disabled", true);
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            formData.append("code", "A");
            formData.append("category_id", "1");

            const params = new URLSearchParams(window.location.search);
            let slr_code = null;
            if (params !== null) {
                slr_code = params.get("slr_code");
                formData.append("reference_source", slr_code);
            }

            let url =
                "{{ Auth::user()->role_id == 1 ? route('review.master.create') : route('master.create') }}";

            $.ajax({
                url: url,
                dataType: "JSON",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    var html =
                        '<hr>' +
                        '<span class="mb-3 text-center">Scraping Data Lain?</span>' + '<br><br>' + 
                        '<a class="ms-1 me-1 text-white review-go btn btn-sm btn-success btn-outline-primary" href="{{ route('management.project.index') }}" title="Lihat Hasil" id="button1">Lihat List</a>' +
                        '<a id="button-acm" class="ms-1 me-1 text-white review-go btn btn-sm btn-info btn-outline-primary" href="{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}" title="Scraping data ACM" id="button1">ACM</a>' +
                        '<a class="ms-1 me-1 text-white review-go btn btn-sm btn-warning btn-outline-primary" href="{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index') }}" title="Scraping data Springer" id="button1">Springer</a>' +
                        '<br>';
                    swal({
                        title: "Data Tersimpan!",
                        html: html,
                        showCloseButton: !0,
                        showConfirmButton: !1,
                        type: "success",
                    }).then((value) => {
                        $(".formCreateProjectData").trigger("reset");
                        $(".modalCreate").modal("hide");
                    });
                },
                error: function(result) {
                    swal("Error!", "Data sudah ada atau yang lainnya", "error");
                    $(".formCreateProjectData").trigger("reset");
                    $(".modalCreate").modal("hide");
                    return false;
                },
                complete: function() {
                    $(".formCreateProjectData button[type='submit']").attr("disabled", false);
                },
            });
            abort();
        });
    }


    function enableInput() {
        document.querySelectorAll('.create').forEach(function(el) {
            el.disabled = false;
        });
    }

    function showFullAbstract() {
        document.querySelectorAll('.show')[0].style.display = 'inline';
        document.querySelectorAll('.hide')[0].style.display = 'none';
        document.querySelectorAll('.read-more')[0].style.display = 'none';
        document.querySelectorAll('.read-less')[0].style.display = 'inline';
    }

    function hideFullAbstract() {
        document.querySelectorAll('.show')[0].style.display = 'none';
        document.querySelectorAll('.hide')[0].style.display = 'inline';
        document.querySelectorAll('.read-more')[0].style.display = 'inline';
        document.querySelectorAll('.read-less')[0].style.display = 'none';
    }

    function toggleItems() {
        var itemsDiv = document.querySelector('.all-items');
        var readMoreBtn = document.querySelector('#read-more');
        var readLessBtn = document.querySelector('#read-less');
        if (itemsDiv.classList.contains('d-none')) {
            itemsDiv.classList.remove('d-none');
            readMoreBtn.classList.add('d-none');
            readLessBtn.classList.remove('d-none');
        } else {
            itemsDiv.classList.add('d-none');
            readMoreBtn.classList.remove('d-none');
            readLessBtn.classList.add('d-none');
        }
    }
</script>
