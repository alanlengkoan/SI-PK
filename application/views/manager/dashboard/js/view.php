<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

<script>
    Highcharts.getJSON('<?= manager_url() ?>dashboard/get_best_produk', function(data) {
        Highcharts.chart('pemesanan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pembelian Produk'
            },
            colors: ['#FFFF5C'],
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Pembelian'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Pembelian: <b>{point.y:.1f}</b>'
            },
            series: [{
                name: 'Pembelian',
                data: data,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });

    Highcharts.getJSON('<?= manager_url() ?>dashboard/get_best_customer', function(data) {
        Highcharts.chart('pelanggan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Pelanggan'
            },
            colors: ['#FFFF5C'],
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Pembelian'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Pembelian: <b>{point.y:.1f}</b>'
            },
            series: [{
                name: 'Pembelian',
                data: data,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    });
</script>