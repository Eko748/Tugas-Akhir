<script>
    var options = {
        series: [{
            name: 'Total',
            data: {!! json_encode($userData) !!}
        }],
        chart: {
            type: 'bar',
            height: 150
        },
        xaxis: {
            categories: {!! json_encode($userLabels) !!}
        }
    };

    var member = new ApexCharts(document.querySelector("#chart-member"), options);
    member.render();
</script>
<script>
    var options = {
        series: {!! json_encode($categoryData) !!},
        chart: {
            type: 'donut',
            height: 150
        },
        labels: {!! json_encode($categoryLabels) !!}
    };

    var chart = new ApexCharts(document.querySelector("#chart-review"), options);
    chart.render();
</script>