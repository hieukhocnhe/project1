<div class="card">
  <div class="card-header pb-0 text-center m-4">
    <h3>Danh sách sản phẩm</h3>
  </div>
  <div class="col mx-4 mb-4">
    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProduct">Thêm
      sản phẩm</button>
  </div>
  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0 text-center">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên sản phẩm</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Giá</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã lô hàng</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
              Số lượng tồn kho</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày sản xuất</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hạn sử dụng</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức năng</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product):
            extract($product) ?>
            <tr>
              <td class="align-middle">
                <?= $id ?>
              </td>
              <td class="align-middle">
                <?= $name ?>
              </td>
              <td class="align-middle">
                <?= $price ?>
              </td>
              <td class="align-middle">
                <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
              </td>
              <td class="align-middle">
                <?= $batche_code ?>
              </td>
              <td class="align-middle">
                <div class="d-flex align-items-center justify-content-center">
                  <span class="me-2 text-xs font-weight-bold">
                    <?= $quantity_in_stock ?>
                  </span>
                  <div>
                    <?php
                    $Class = '';

                    if ($quantity_in_stock < 50) {
                      $Class = "progress-bar bg-gradient-danger";
                    } elseif ($quantity_in_stock < 100) {
                      $Class = "progress-bar bg-gradient-warning";
                    } elseif ($quantity_in_stock >= 80) {
                      $Class = "progress-bar bg-gradient-success";
                    } else {
                      $Class = "badge badge-sm bg-gradient-info";
                    }
                    ?>

                    <div class="progress">
                      <div class="<?= $Class ?>" role="progressbar" aria-valuenow="<?= $quantity_in_stock ?>"
                        aria-valuemin="0" aria-valuemax="100" style="width: <?= $quantity_in_stock ?>%;"></div>
                    </div>
                  </div>

                </div>
              </td>
              <td class="align-middle">
                <?= $manufacturing_date ?>
              </td>
              <td class="align-middle">
                <?= $expiry_date ?>
              </td>
              <td class="align-middle pt-4">
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProduct"
                  data-value='<?= json_encode($batche) ?>'>
                  <i class="ni ni-settings"></i>
                </button>
                <a onclick="return confirm('Bạn có xác nhận xóa ?');" class="btn btn-danger btn-sm"
                  href="?act=delProduct&id=<?= $id ?>"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>