<script type="text/javascript">
    $(document).ready(function() {
        $('.modalCreate').each(function() {
            let modal = $(this);
            let key = modal.data('key');
            let select = modal.find('.getCategory');
            select.select2({
                placeholder: 'Find Category',
                allowClear: true,
                dropdownParent: modal,
                width: "100%",
                ajax: {
                    url: '{{ route('scraping.category.getCategory') }}',
                    dataType: 'json',
                    delay: 220,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                minimumResultsForSearch: 0,
            }).on('select2:select', function(e) {
                let data = e.params.data;
                let category_id = data.id;
                let code = data.code;
                console.log(category_id);
                console.log(code);
                modal.find('.code').val(code);
            });
        });
    });
</script>
