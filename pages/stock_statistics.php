<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Doanh thu hôm nay</p>
                            <h5 class="font-weight-bolder">
                                <?= number_format($totalAmountToday, 0, ',', '.') ?> VNĐ
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng sản phẩm</p>
                            <h5 class="font-weight-bolder">
                                <?= $allProduct ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Số lượng nhân viên</p>
                            <h5 class="font-weight-bolder">
                                <?= $numberSellerActive['active_users'] ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng lô hàng đang vận chuyển</p>
                            <h5 class="font-weight-bolder">
                                <?= $numberBatchesInTransit['total_shipments_in_transit'] ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-12 mb-sm-0">
                    <div class="card bg-white shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl">
                            <div class="card-body position-relative z-index-1 p-3">
                                <h5 class="text-dark mt-4 mb-5 pb-2">Biểu đồ So Sánh Các Loại Giao Dịch</h5>
                                <canvas id="myChart" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Tổng doanh thu</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <h6 class="mb-0">Lợi tức :
                                            <?= number_format($totalRevenue, 0, ',', '.') ?> VNĐ
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                        <h6 class="mb-0">Thất thoát :
                                            <?= number_format($totalLoss, 0, ',', '.') ?> VNĐ
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-7 d-flex align-items-center">
                            <h5 class="mb-0">Top 5 sản phẩm bán chạy nhất</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3 pb-0">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bold">Tên sản phẩm</p>
                        <p class="pe-3 font-weight-bold">Tổng doanh thu</p>
                    </div>
                    <ul class="list-group">
                        <?php foreach ($bestSellingProducts as $product):
                            extract($product); ?>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                                        <?= $name ?>
                                    </h6>
                                    <span class="text-xs">
                                        Giá :
                                        <?= number_format($price, 0, ',', '.') ?> VNĐ
                                    </span>
                                </div>
                                <div class="d-flex align-items-center text-sm">
                                    <?= number_format($total_sales, 0, ',', '.') ?> VNĐ
                                </div>
                            </li>

                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">So sánh sản phẩm</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <canvas id="chartProductsByMonth" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5 mt-4">
            <div class="card h-100 mb-4">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Top 5 Người Có Tổng Lợi Tức Cao Nhất</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2 p-3">
                    <canvas id="userSalesChart" width="400" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$quantityTransactions = getQuantityTransaction();
// Lấy dữ liệu từ mảng PHP
$data = [
    'successful_transactions' => $quantityTransactions['successful_transactions'],
    'failed_or_cancelled_transactions' => $quantityTransactions['failed_or_cancelled_transactions'],
    'total_transactions' => $quantityTransactions['total_transactions']
];
?>
<script>
    // Lấy đối tượng canvas
    var ctx = document.getElementById('myChart').getContext('2d');

    // Tạo biểu đồ cột
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Giao dịch thành công', 'Giao dịch đang chờ/hủy bỏ', 'Tổng giao dịch'],
            datasets: [
                {
                    label: 'Số lượng',
                    data: [<?= $data['successful_transactions'] ?>, <?= $data['failed_or_cancelled_transactions'] ?>, <?= $data['total_transactions'] ?>],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    // Dữ liệu từ PHP
    var phpData = <?php echo json_encode($compareProductsByMonth); ?>;

    // Xử lý dữ liệu từ PHP để chuẩn bị cho biểu đồ
    var labels = phpData.map(item => item.product_name);
    var transactionsData = phpData.map(item => item.total_transactions);
    var quantitySoldData = phpData.map(item => item.total_quantity_sold);

    var chartData = {
        labels: labels,
        datasets: [{
            label: 'Số lượng giao dịch',
            data: transactionsData,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }, {
            label: 'Số lượng bán',
            data: quantitySoldData,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Vẽ biểu đồ bar
    var ctx = document.getElementById('chartProductsByMonth').getContext('2d');
    var chartProductsByMonth = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    // Dữ liệu từ PHP
    var userSalesData = <?php echo json_encode($userActivityStatistic); ?>;
    var userLabels = userSalesData.map(item => item.fullname);
    var userSales = userSalesData.map(item => item.total_revenue);

    // Vẽ biểu đồ tròn
    var ctx = document.getElementById('userSalesChart').getContext('2d');
    var userSalesChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: userLabels,
            datasets: [{
                data: userSales,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 205, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>