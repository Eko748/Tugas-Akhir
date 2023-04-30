<script type="text/javascript">
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        let slr_code = null;
        if (params !== null) {
            slr_code = params.get('slr_code');
            console.log(slr_code);
            $('.slr-code').val(slr_code);
            const inputHidden = document.querySelector('.slr-code');
            if (inputHidden !== null) {
                inputHidden.style.display = 'block';
                inputHidden.value = slr_code;
                console.log('Oke');
            } else {
                console.log("It's Oke");
            }
        } else {
            const inputHidden = document.querySelector('.slr-code');
            if (inputHidden !== null) {
                inputHidden.style.display = 'none';
            }
        }
    });

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
            })
        });
    });
</script>
