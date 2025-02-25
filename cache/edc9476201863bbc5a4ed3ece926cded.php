
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">
        <h2>Bảng điều khiển</h2>
    </div>
    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">

        <div class="row mb-4 mt-3">
            <!-- Số người ghé thăm -->
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0">914,001</h4>
                            <p class="mb-0">VISITS</p>
                        </div>
                        <i class="fa-solid fa-people-group fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Tỷ lệ thoát trang -->
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0">46.41%</h4>
                            <p class="mb-0">BOUNCE RATE</p>
                        </div>
                        <i class="fa-solid fa-share fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Số lượt xem trang -->
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0">4,054,876</h4>
                            <p class="mb-0">PAGEVIEWS</p>
                        </div>
                        <i class="fa-solid fa-file-alt fa-2x"></i>
                    </div>
                </div>
            </div>

            <!-- Tỷ lệ tăng trưởng -->
            <div class="col-12 col-md-3 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0">46.43%</h4>
                            <p class="mb-0">GROWTH RATE</p>
                        </div>
                        <i class="fa-solid fa-chart-bar fa-2x"></i>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/index.blade.php ENDPATH**/ ?>