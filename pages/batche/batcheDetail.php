<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Danh sách sản phẩm của lô hàng
        </h3>
    </div>
    <div class="col mx-4 mb-4">
    </div>
    <div class="table-responsive">
        <table class="table align-items-center mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá sản phẩm</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số lượng ban đầu
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($batch_detail as $key => $value): ?>
                    <tr>
                        <td class="align-middle">
                            <?= $value['id'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['name'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['price'] ?>
                        </td>
                        <td class="align-middle">
                            <?= $value['quantity_in_batch'] ?>
                        </td>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>