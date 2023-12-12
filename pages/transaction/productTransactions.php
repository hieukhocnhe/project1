<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Tất cả giao dịch của sản phẩm
        </h3>
    </div>
    <div class="col mx-4 mb-4">
        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
            data-bs-target="#addTransaction">Thêm
            giao dịch</button>
    </div>
    <?php
    foreach ($transactions as $item)
        $productId = $item['product_id'];
    $productName = $item['product_name'];
    echo <<<HTML
    <div class="col mx-4 mb-4">
        <h5>Id sản phẩm : $productId</h5><br>
        <h5>Tên sản phẩm : $productName</h5>
    </div>
HTML;
    ?>
    <div class="table-responsive">
        <table class="table align-items-center mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã giao dịch</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thời gian tạo giao
                        dịch</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loại giao dịch</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Người tạo giao dịch
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transactions) > 0 && $transactions[0]['id'] !== NULL): ?>
                    <?php foreach ($transactions as $transaction):
                        extract($transaction) ?>
                        <tr>
                            <td class="align-middle">
                                <?= $id ?>
                            </td>
                            <td class="align-middle">
                                <?= $transaction_code ?>
                            </td>
                            <td class="align-middle">
                                <?= $transaction_date ?>
                            </td>
                            <td class="align-middle">
                                <?= $transaction_type_name ?>
                            </td>
                            <td class="align-middle">
                                <?= $fullname ?>
                            </td>
                            <td class="align-middle">
                                <span class="<?php if ($status_id == 1) {
                                    echo "badge badge-sm bg-success";
                                } elseif ($status_id == 2) {
                                    echo "badge badge-sm bg-warning";
                                } else {
                                    echo "badge badge-sm bg-secondary";
                                }
                                ?>">
                                    <?= $status_name ?>
                                </span>
                            </td>
                            <td class="align-middle pt-4">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editTransaction" data-value='<?= json_encode($transaction) ?>'>
                                    <i class="ni ni-settings"></i>
                                </button>
                                <a class="btn btn-success btn-sm" href="?act=transactionDetail&id=<?= $id ?>"><i
                                        class="fa fa-info"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Sản phẩm không có giao dịch nào.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<!--------Thêm giao dịch----------->

<?php include_once 'modals/addTransaction.php' ?>

<!--------Sửa giao dịch----------->

<?php include_once 'modals/editTransaction.php' ?>