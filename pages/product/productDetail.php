<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Chi tiết sản phẩm
        </h3>
    </div>
    <?php
    foreach ($productDetail as $item)
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID lô hàng
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã lô hàng</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày sản xuất lô
                        hàng</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày hết hạn lô hàng
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($productDetail) > 0 && $productDetail[0]['batch_id'] !== NULL): ?>
                    <?php foreach ($productDetail as $key => $value): ?>
                        <tr>
                            <td class="align-middle">
                                <?= $value['batch_id'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['batche_code'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['batch_manufacturing_date'] ?>
                            </td>
                            <td class="align-middle">
                                <?= $value['batch_expiry_date'] ?>
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