<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Chi tiết khu vực lưu trữ
        </h3>
    </div>
    <?php
    foreach ($storageAreaDetail as $item)
        $storageAreaId = $item['storage_area_id'];
    $areaName = $item['area_name'];
    echo <<<HTML
    <div class="col mx-4 mb-4">
        <h5>Id khu vực lưu trữ : $storageAreaId</h5><br>
        <h5>Tên khu vực lưu trữ : $areaName</h5>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($storageAreaDetail as $key => $value): ?>
                    <tr>
                        <td class="align-middle">
                            <?= $value['batch_id'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['batche_code'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['product_id'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['product_name'] ?>
                        </td>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>