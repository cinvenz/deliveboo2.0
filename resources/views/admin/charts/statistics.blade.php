@extends('layouts.app')

@section('content')
<div style="width: 800px; margin: 0 auto;">
    <canvas id="myChart"></canvas>
</div>
@endsection

@section('scripts')

<!-- Include chart.js library -->
<script src="{{ asset('node_modules/chart.js/dist/chart.min.js') }}"></script>

<!-- Chart script -->
<script>
    // Get the context of the canvas element we want to select
    var ctx = document.getElementById('myChart').getContext('2d');
    fetch('{{ route("admin.chart.getData") }}')
        .then(response => response.json())
        .then(data => {
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Sales',
                        data: data.values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    // Chart title and subtitle
                    title: {
                        display: true,
                        text: 'Monthly Sales Chart',
                        fontSize: 18,
                        fontFamily: 'Arial, sans-serif',
                        fontStyle: 'bold'
                    },
                    subtitle: {
                        display: true,
                        text: 'Data from January to December',
                        fontSize: 14,
                        fontFamily: 'Arial, sans-serif'
                    },
                    // Configure the y and x axes
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontSize: 14,
                                fontFamily: 'Arial, sans-serif'
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Total Sales (in USD)',
                                fontSize: 16,
                                fontFamily: 'Arial, sans-serif'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 14,
                                fontFamily: 'Arial, sans-serif'
                            }
                        }]
                    },
                    // Chart legend and tooltips
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            fontSize: 14,
                            fontFamily: 'Arial, sans-serif'
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }

                                label += tooltipItem.yLabel.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                                label = '$' + label;

                                return label;
                            }
                        }
                    }
                }
            });
        });
</script>

<!-- Add some custom CSS -->
<style>
    #myChart {
        margin-top: 50px;
        margin-bottom: 50px;
    }
</style>

@endsection
