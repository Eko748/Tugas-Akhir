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
        $("body").on("submit", ".formCreateProjectData", function(e) {
            e.preventDefault();
            $('.formCreateProjectData button[type="submit"]').attr('disabled', true);
            let formData = new FormData(this);
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            formData.append('code', 'A');
            formData.append('category_id', '1');
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
                    return false;
                },
                complete: function() {
                    $('.formCreateProjectData button[type="submit"]').attr('disabled', false);
                }
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
