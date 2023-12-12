<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Lịch sử giao dịch
        </h3>
    </div>
    <?php
    foreach ($inventories as $item)
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã giao dịch</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Loại giao dịch</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng thay đổi
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Khu vực lưu trữ</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thời gian lưu kho
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($inventories) > 0 && $inventories[0]['inventory_id'] !== NULL): ?>
                    <?php foreach ($inventories as $key => $value):
                        list($start_date, $start_time) = explode(" ", $value['stockdate']); ?>
                        <tr>
                            <td class="align-middle">
                                <?= $value['inventory_id'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['transaction_code'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['transaction_type'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['quantity'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['area_name'] ?>
                            </td>
                            <td class="align-middle">
                                <span>
                                    <?= 'Ngày : ' . $start_date ?>
                                </span>
                                <br>
                                <span>
                                    <?= 'Giờ : ' . $start_time ?>
                                </span>
                            </td>
                        <?php endforeach ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Sản phẩm không thuộc lô hàng nào.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>