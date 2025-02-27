
<?php $__env->startSection('content'); ?>
    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">
        <h2 class="fw-bold"><i class="fa-solid fa-gauge-high"></i> Bảng điều khiển</h2>
    </div>

    <div class="p-3 mb-4 rounded-3" style="background-color: #fff;">
        <div class="row mb-4 mt-3">
            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0"><?php echo e($users); ?></h4>
                            <p class="mb-0">SỐ NGƯỜI DÙNG</p>
                        </div>
                        <i class="fa-solid fa-people-group fa-2x"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0"><?php echo e($orders); ?></h4>
                            <p class="mb-0">SỐ ĐƠN HÀNG</p>
                        </div>
                        <i class="fa-solid fa-share fa-2x"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-0"><?php echo e(number_format($total_revenue, 0, ',', '.')); ?>đ</h4>
                            <p class="mb-0">TỔNG DOANH THU</p>
                        </div>
                        <i class="fa-solid fa-file-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Biểu đồ doanh thu -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Doanh thu theo tháng</h5>
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Biểu đồ số đơn hàng -->
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Số đơn hàng theo tháng</h5>
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var months = <?php echo json_encode(array_column($monthly_revenue, 'month'), 512) ?>;
        var revenueData = <?php echo json_encode(array_column($monthly_revenue, 'revenue'), 512) ?>;
        var ordersData = <?php echo json_encode(array_column($monthly_orders, 'total_orders'), 512) ?>;

        var monthLabels = months.map(month => {
            return new Date(0, month - 1).toLocaleString('vi', {
                month: 'long'
            });
        });

        var ctxRevenue = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyRevenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: revenueData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ số đơn hàng theo tháng
        var ctxOrders = document.getElementById('monthlyOrdersChart').getContext('2d');
        var monthlyOrdersChart = new Chart(ctxOrders, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Số đơn hàng',
                    data: ordersData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/admin/index.blade.php ENDPATH**/ ?>