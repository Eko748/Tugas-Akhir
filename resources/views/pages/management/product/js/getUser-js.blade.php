<script type="text/javascript">
    $('.product').select2({
        placeholder: 'Search....',
        ajax: {
            url: "{{ route('management.product.selectSearch') }}",
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('.users_select').select2({
        allowClear: true,
        placeholder: 'Search...',
        width: "100%",
    });
</script>
