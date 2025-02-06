<h2>Dashboard</h2>
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

<!-- Best Selling and Slow Selling Products Carousel -->
<div class="row mt-4">
    <!-- Best Selling Products -->
    <div class="col-12 col-md-6 mb-3">
        <h4>Best Selling Products</h4>
        <div id="bestSellingCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1: Product A and Product B -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+A" class="card-img-top" alt="Product A">
                                <div class="card-body">
                                    <h5 class="card-title">Product A</h5>
                                    <p class="card-text">200 Units Sold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+B" class="card-img-top" alt="Product B">
                                <div class="card-body">
                                    <h5 class="card-title">Product B</h5>
                                    <p class="card-text">180 Units Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2: Product C and Product D -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+C" class="card-img-top" alt="Product C">
                                <div class="card-body">
                                    <h5 class="card-title">Product C</h5>
                                    <p class="card-text">150 Units Sold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+D" class="card-img-top" alt="Product D">
                                <div class="card-body">
                                    <h5 class="card-title">Product D</h5>
                                    <p class="card-text">130 Units Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bestSellingCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bestSellingCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Slow Selling Products -->
    <div class="col-12 col-md-6 mb-3">
        <h4>Slow Selling Products</h4>
        <div id="slowSellingCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1: Product E and Product F -->
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+E" class="card-img-top" alt="Product E">
                                <div class="card-body">
                                    <h5 class="card-title">Product E</h5>
                                    <p class="card-text">10 Units Sold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+F" class="card-img-top" alt="Product F">
                                <div class="card-body">
                                    <h5 class="card-title">Product F</h5>
                                    <p class="card-text">15 Units Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide 2: Product G and Product H -->
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+G" class="card-img-top" alt="Product G">
                                <div class="card-body">
                                    <h5 class="card-title">Product G</h5>
                                    <p class="card-text">12 Units Sold</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <div class="card">
                                <img src="https://placehold.co/150x150.png?text=Product+H" class="card-img-top" alt="Product H">
                                <div class="card-body">
                                    <h5 class="card-title">Product H</h5>
                                    <p class="card-text">8 Units Sold</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slowSellingCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slowSellingCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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