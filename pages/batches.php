<div class="card">
  <div class="card-header pb-0 text-center m-4">
    <h3>Danh sách nhà lô hàng</h3>
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
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức năng</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="align-middle">
            1
          </td>
          <td class="align-middle">
            1
          </td>
          <td class="align-middle">
            1
          </td>
          <td class="align-middle">
            1
          </td>
          <td class="align-middle">
            1
          </td>
          <td class="align-middle">
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBatche"
              data-value='<?= json_encode($batche) ?>'>
              <i class="ni ni-settings"></i>
            </button>
            <button type="button" class="btn bg-gradient-success btn-sm" data-bs-toggle="modal"
              data-bs-target="#batcheDetail">
              <i class="fa fa-info"></i>
            </button>
            <a onclick="return confirm('Bạn có xác nhận xóa ?');" class="btn btn-danger btn-sm"
              href="?act=batches&delBatche&id=<?= $id ?>"><i class="fa fa-trash"></i></a>
          </td>
      </tbody>
    </table>
  </div>
</div>
<!--------Chi tiết lô hàng----------->

<?php include_once 'modals/batcheDetail.php' ?>

<!--------Thêm lô hàng----------->

<?php include_once 'modals/addBatche.php' ?>

<!--------Sửa lô hàng----------->

<?php include_once 'modals/editBatche.php' ?>