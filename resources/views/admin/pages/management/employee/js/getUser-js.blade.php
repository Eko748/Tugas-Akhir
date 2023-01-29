<script type="text/javascript">
    $(document).ready(function(){
        $('.user').select2({
        placeholder: 'Search....',
        ajax: {
            url: "{{ route('management.employee.getUsers') }}",
            dataType: 'json',
            delay: 220,
            processResults: function (data) {
                return {
                    results: $.map(data, function (data) {
                        return {
                            text: data.name,
                            id: data.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});
</script>