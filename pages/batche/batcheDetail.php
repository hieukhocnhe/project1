<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Danh sách sản phẩm của lô hàng
        </h3>
    </div>
    <?php
    foreach ($batchDetail as $item)
        $batchId = $item['batch_id'];
    $batcheCode = $item['batche_code'];
    echo <<<HTML
    <div class="col mx-4 mb-4">
        <h5>Id lô hàng : $batchId</h5><br>
        <h5>Mã lô hàng : $batcheCode</h5>
    </div>
HTML;
    ?>
    <div class="table-responsive">
        <table class="table align-items-center mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng ban đầu
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày sản xuất
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày hết hạn
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($batchDetail as $key => $value): ?>
                    <tr>
                        <td class="align-middle">
                            <?= $value['product_id'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['product_name'] ?>
                        </td>
                        <td class="align-middle">
                            <img src="../assets/img/products/<?= $value['product_image'] ?>"
                                class="avatar avatar-sm rounded-circle me-2">
                        </td>
                        <td class="align-middle">
                            <?= number_format($value['product_price'], 0, ',', '.') ?> VNĐ
                        </td>
                        <td class="align-middle">
                            <?= $value['product_quantity_in_batch'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['product_manufacturing_date'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['product_expiry_date'] ?>
                        </td>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>