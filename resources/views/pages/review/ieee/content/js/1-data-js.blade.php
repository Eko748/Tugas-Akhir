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

    // Menambahkan event listener untuk memanggil fungsi cleanSearchQuery() setiap kali pengguna menekan tombol di input kolom pencarian
    document.getElementById("search").addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            cleanSearchQuery();
            document.getElementById("submit-review").click();
        }
    });
</script>
