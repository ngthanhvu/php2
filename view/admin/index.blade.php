@extends('layouts.admin')
@section('content')
    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">
        <h2>Bảng điều khiển</h2>
    </div>
    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">

        <div class="row mb-4 mt-3">
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Earnings (Monthly)</h5>
                        <p class="card-text">$40,000</p>
                        <a href="#" class="btn btn-light">View Report</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Earnings (Annual)</h5>
                        <p class="card-text">$215,000</p>
                        <a href="#" class="btn btn-light">View Report</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Task Completion</h5>
                        <p class="card-text">24</p>
                        <a href="#" class="btn btn-light">View Tasks</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <p class="card-text">17</p>
                        <a href="#" class="btn btn-light">View Requests</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Earnings Breakdown</h5>
                        <canvas id="earningsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Revenue</h5>
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Earnings Breakdown Chart
        var ctx1 = document.getElementById('earningsChart').getContext('2d');
        var earningsChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
                datasets: [{
                    label: 'Earnings Breakdown',
                    data: [12000, 15000, 18000, 15000, 22000, 24000, 25000, 23000, 27000, 30000, 35000],
                    borderColor: 'blue',
                    fill: false
                }]
            }
        });

        // Monthly Revenue Chart
        var ctx2 = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyRevenueChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [5000, 7000, 6000, 8000, 10000, 15000],
                    backgroundColor: 'blue'
                }]
            }
        });
    </script>
@endsection
