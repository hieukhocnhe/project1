<div class="card">
  <div class="card-header pb-0 text-center m-4">
    <h3>Danh sách lô hàng</h3>
  </div>
  <div class="col mx-4 mb-4">
    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addBatche">Thêm
      lô hàng</button>
  </div>
  <div class="table-responsive">
    <table class="table align-items-center mb-0 text-center">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã lô hàng</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nhà cung cấp</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Khu vực lưu trữ</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày sản xuất</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày hết hạn</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Thời gian tạo</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức năng</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($batches as $batche):
          extract($batche);
          list($start_date, $start_time) = explode(" ", $created_at);
          ?>
          <tr>
            <td class="align-middle">
              <?= $id ?>
            </td>
            <td class="align-middle">
              <?= $batche_code ?>
            </td>
            <td class="align-middle">
              <?= $supplier_name ?>
            </td>
            <td class="align-middle">
              <?= $storage_name ?>
            </td>
            <td class="align-middle">
              <?php
              $statusValues1 = [4, 5, 2];
              $statusValues2 = [7, 8];
              $statusValues3 = [5, 10];
              $statusValues4 = [3, 9];

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
            <td class="align-middle">
              <span>
                <?= 'Ngày : ' . $start_date ?>
              </span>
              <br>
              <span>
                <?= 'Giờ : ' . $start_time ?>
              </span>
            </td>
            <td class="align-middle pt-4">
              <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBatche"
                data-value='<?= json_encode($batche) ?>'>
                <i class="ni ni-settings"></i>
              </button>
              <a class="btn btn-success btn-sm" href="?act=batcheDetail&id=<?= $id ?>"><i class="fa fa-info"></i></a>
            </td>
          <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
<!--------Thêm lô hàng----------->

<?php include_once 'modals/addBatche.php' ?>

<!--------Sửa lô hàng----------->

<?php include_once 'modals/editBatche.php' ?>