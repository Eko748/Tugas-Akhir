<script>
    $('input[name="date_range"]').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        opens: 'top-left',
        drops: 'up',
        locale: {
            format: 'MM/DD/YYYY HH:mm:ss'
        },
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(24, 'hour')
    }, function(start, end, label) {
        $('input[name="start_date"]').val(start.format('YYYY-MM-DD HH:mm:ss'));
        $('input[name="end_date"]').val(end.format('YYYY-MM-DD HH:mm:ss'));
    });
</script>
