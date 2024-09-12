@extends('front.layout.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container py-3">
            <div class="card">
                <div class="card-header px-3 py-2">
                    <h3>Reports</h3>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <canvas id="giftsChart" width="400" height="150"></canvas>



                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


                    <script>
                        const graphData = @json($graphData);
                        const totalGifts = @json($totalGifts);
                        const totalAmount = @json($totalAmount);

                        const ctx = document.getElementById('giftsChart').getContext('2d');
                        const chart = new Chart(ctx, {
                            type: 'bar', // You can change this to 'bar', 'pie', etc.
                            data: {
                                labels: graphData.day
                                    .labels, // Change to graphData.week.labels, graphData.month.labels, or graphData.year.labels as needed
                                datasets: [{
                                        label: `Number of Gifts: ${totalGifts}`,
                                        data: graphData.day.count, // Change accordingly
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        fill: false,
                                    },
                                    {
                                        label: `Total Amount Received: $${totalAmount}`,
                                        data: graphData.day.amount, // Change accordingly
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        fill: false,
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        labels: {
                                            font: {
                                                size: 18
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        display: true,
                                        title: {
                                            display: true,
                                            text: 'Date'
                                        }
                                    },
                                    y: {
                                        display: true,
                                        title: {
                                            display: true,
                                            text: 'Count / Amount'
                                        }
                                    }
                                }
                            }
                        });

                        // Function to update chart data based on the selected time frame
                        function updateChart(timeFrame) {
                            chart.data.labels = graphData[timeFrame].labels;
                            chart.data.datasets[0].data = graphData[timeFrame].count;
                            chart.data.datasets[1].data = graphData[timeFrame].amount;
                            chart.update();
                        }
                    </script>

                    <!-- Add buttons to switch between Day, Week, Month, Year -->
                    <button class="btn btn-primary" onclick="updateChart('day')">Day</button>
                    <button class="btn btn-primary" onclick="updateChart('week')">Week</button>
                    <button class="btn btn-primary" onclick="updateChart('month')">Month</button>
                    <button class="btn btn-primary" onclick="updateChart('year')">Year</button>
                </div>
            </div>
        </div>
        </div>
    @endsection
