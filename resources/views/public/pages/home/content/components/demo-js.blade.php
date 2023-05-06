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
            url: '{{ route('home.demo') }}',
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
        const cleanedQuery = query;
        searchInput.value = cleanedQuery;
    }

    document.getElementById("search").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            cleanSearchQuery();
            document.getElementById("submit-review").click();
        }
    });

    function enableInput() {
        document.querySelectorAll('.create').forEach(function(el) {
            el.disabled = false;
        });
    }

    function showFullAbstract() {
        document.querySelectorAll('.show')[1].style.display = 'inline';
        document.querySelectorAll('.hide')[1].style.display = 'none';
        document.querySelectorAll('.read-more')[1].style.display = 'none';
        document.querySelectorAll('.read-less')[1].style.display = 'inline';
    }

    function hideFullAbstract() {
        document.querySelectorAll('.show')[1].style.display = 'none';
        document.querySelectorAll('.hide')[1].style.display = 'inline';
        document.querySelectorAll('.read-more')[1].style.display = 'inline';
        document.querySelectorAll('.read-less')[1].style.display = 'none';
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