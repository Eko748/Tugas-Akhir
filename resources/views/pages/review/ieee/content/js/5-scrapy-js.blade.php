<script type="text/javascript">
    function loadScrapy() {
        $("#data-scrapy").hide();
        $("#loading").show();
    }

    $('#submit-scrapy').click(function(e) {
        e.preventDefault();
        let link = $('#link').val();

        loadScrapy();

        let requestTimeout = setTimeout(function() {
            $("#loading").hide();
            alert('Request timed out. Please try again.');
        }, 15000);

        $.ajax({
            type: "GET",
            data: {
                'link': link,
            },
            url: '{{ (Auth::user()->role_id == 1) ? route('scraping.review.index') : route('ieee.references') }}',
            success: function(data) {
                clearTimeout(requestTimeout);
                $("#loading").hide();
                $('#data-scrapy').html(data).show();
            }
        });
    });
</script>
