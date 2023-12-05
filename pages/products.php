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
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số lượng</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Đơn vị tính</th>
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
                <?= number_format($price, 0, ',', '.') ?> VNĐ
              </td>

              <td class="align-middle">
                <img src="../assets/img/products/<?= $image ?>" class="avatar avatar-sm rounded-circle me-2">
              </td>
              <td class="align-middle">
                <?= $batche_code ?>
              </td>
              <td class="align-middle">
                <?= $quantity_in_stock ?>
              </td>
              <td class="align-middle">
                <?= $unit ?>
              </td>
              <?php
              $manufacturingDateFromProduct = $product['manufacturing_date'];
              $manufacturingDateFromBatch = $product['manufacturing_date_from_batche'];
              $expiryDateFromProduct = $product['expiry_date'];
              $expiryDateFromBatch = $product['expiry_date_from_batche'];

              if ($product['batch_id'] === null) {
                // Hiển thị ngày sản xuất từ sản phẩm
                $manufacturingDateToShow = $manufacturingDateFromProduct;
              } else {
                // Hiển thị ngày sản xuất từ lô hàng
                $manufacturingDateToShow = $manufacturingDateFromBatch;
              }
              if ($product['batch_id'] === null) {
                // Hiển thị ngày sản xuất từ sản phẩm
                $expiryDateToShow = $expiryDateFromProduct;
              } else {
                // Hiển thị ngày sản xuất từ lô hàng
                $expiryDateToShow = $expiryDateFromBatch;
              }
              ?>
              <td class="align-middle">
                <?= $manufacturingDateToShow ?>
              </td>
              <td class="align-middle">
                <?= $expiryDateToShow ?>
              </td>
              <td class="align-middle pt-4">
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProduct"
                  data-value='<?= json_encode($product) ?>'>
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

<!--------Thêm sản phẩm----------->

<?php include_once 'modals/addProduct.php' ?>

<!--------Sửa sản phẩm----------->

<?php include_once 'modals/editProduct.php' ?>