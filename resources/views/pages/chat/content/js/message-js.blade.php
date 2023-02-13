<script>
    $(document).ready(function() {
        // Kirim pesan baru
        $("body").on("submit", "#createChat", function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('message.post') }}',
                data: $(this).serialize(),
                success: function(data) {
                    location.reload(true);
                    // $('#messages').append(`<p>${message.message}</p>`);
                    // $("#chat-box").html(data);
                }
            });
        });

        // Ambil pesan baru secara periodik
        // setInterval(function() {
        //     $.ajax({
        //         type: 'GET',
        //         url: '{{ route('api.message') }}',
        //         success: function(data) {
        //             // $("#chat-box").html(data);
        //         }
        //     });
        // }, 3000); // Mengambil pesan baru setiap 3 detik
    });

    $(document).ready(function() {
        $("#load-new").click(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('message.ajax') }}',
                success: function(data) {
                    // Load new messages into the messages-container element
                    $("#data-chat").html(data);
                }
            });
        });
    });

</script>
