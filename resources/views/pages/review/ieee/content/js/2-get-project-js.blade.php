<script type="text/javascript">
    $(document).ready(function() {
        $('.modalCreate').each(function() {
            let modal = $(this);
            let key = modal.data('key');
            let select = modal.find('.getProject');
            let id = {{ Auth::user()->id }};
            select.select2({
                placeholder: 'Hubungkan dengan Project',
                allowClear: true,
                dropdownParent: modal,
                width: "100%",
                ajax: {
                    url: '{{ Auth::user()->role_id == 1 ? route('review.project.getProject') : route('project.getProject') }}',
                    dataType: 'json',
                    delay: 220,
                    data: function(params) {
                        return {
                            q: params.term,
                            id: id,
                            // c: c,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                // minimumInputLength: 2,
                minimumResultsForSearch: 0,
            }).on('select2:select', function(e) {
                let data = e.params.data;
                let projectId = data.id;
                console.log(projectId);
            });
        });
    });
</script>
