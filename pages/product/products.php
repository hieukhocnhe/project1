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
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số lượng ban đầu</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Đơn vị tính</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
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
                <?= $quantity_in_batch ?>
              </td>
              <td class="align-middle">
                <?= $unit ?>
              </td>
              <td class="align-middle">
              <?php
              $statusValues1 = [2, 5];
              $statusValues2 = [8, 9, 10];
              $statusValues3 = [3, 4];
              $statusValues4 = [1, 7];

              $statusClass = '';

              if (in_array($status_id, $statusValues1)) {
                $statusClass = "badge badge-sm bg-gradient-danger";
              } elseif (in_array($status_id, $statusValues2)) {
                $statusClass = "badge badge-sm bg-gradient-warning";
              } elseif (in_array($status_id, $statusValues3)) {
                $statusClass = "badge badge-sm bg-gradient-secondary";
              } elseif (in_array($status_id, $statusValues4)) {
                $statusClass = "badge badge-sm bg-gradient-success";
              } else {
                $statusClass = "badge badge-sm bg-gradient-info";
              }
              ?>
              <span class="<?= $statusClass ?>">
                <?= $status_name ?>
              </span>
            </td>
              <td class="align-middle">
                <?= $manufacturing_date ?>
              </td>
              <td class="align-middle">
                <?= $expiry_date ?>
              </td>
              <td class="align-middle pt-4">
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProduct"
                  data-value='<?= json_encode($product) ?>'>
                  <i class="ni ni-settings"></i>
                </button>
                <a class="btn btn-success btn-sm" href="?act=productDetail&id=<?= $id ?>"><i
                    class="fa fa-info"></i></a>
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