<script type="text/javascript">
    $(document).ready(function() {
        $('.modalView').each(function() {
            let modal = $(this);
            let key = modal.data('key');
            let select = modal.find('.getProjectDetail');
            let id = {{ Auth::user()->id }};
            select.select2({
                placeholder: 'Cari Project yang Relevan',
                allowClear: true,
                dropdownParent: modal,
                width: "100%",
                ajax: {
                    url: '{{ Auth::user()->role_id == 1 ? route('review.project.getProjectDetail') : route('project.getProjectDetail') }}',
                    dataType: 'json',
                    delay: 220,
                    data: function(params) {
                        return {
                            q: params.term,
                            id: id,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumResultsForSearch: 0,
            }).on('select2:select', function(e) {
                let data = e.params.data;
                let projectId = data.id;
                console.log(projectId);
            });
        });
    });
</script>
