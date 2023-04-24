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
                    url: '{{ (Auth::user()->role_id == 1) ? route('review.category.get') : route('category.get') }}',
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
                minimumInputLength: 0,
                minimumResultsForSearch: 0,
            }).on('select2:select', function(e) {
                let data = e.params.data;
                let category_id = data.id;
                let code = data.code;
                modal.find('.code').val(code);
            });
        });
    });
</script>
