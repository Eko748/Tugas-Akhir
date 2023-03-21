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
        }, 15000);

        $.ajax({
            type: "GET",
            data: {
                'search': search,
            },
            url: '{{ (Auth::user()->role_id == 1) ? route('review.article_springer.index') : route('review.index') }}',
            success: function(data) {
                clearTimeout(requestTimeout);
                $("#loading").hide();
                $('#data-review').html(data).show();
            }
        });
    });
</script>
