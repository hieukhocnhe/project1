<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Danh sách khu vực lưu trữ</h3>
    </div>
    <div class="col mx-4 mb-4">
        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
            data-bs-target="#addStorageArea">Thêm
            khu vực lưu trữ</button>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên khu vực lưu
                        trữ</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($storageAreas as $storageArea):
                    extract($storageArea);
                    ?>
                    <tr>
                        <td class="align-middle">
                            <?= $id ?>
                        </td>
                        <td class="align-middle">
                            <?= $area_name ?>
                        </td>
                        <td class="align-middle pt-4">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editStorageArea" data-value='<?= json_encode($storageArea) ?>'>
                                <i class="ni ni-settings"></i>
                            </button>
                            <a class="btn btn-success btn-sm" href="?act=storageAreaDetail&id=<?= $id ?>"><i
                                    class="fa fa-info"></i></a>
                            <a onclick="return confirm('Bạn có xác nhận xóa ?');" class="btn btn-danger btn-sm"
                                href="?act=delstorageArea&id=<?= $id ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!--------Thêm lô hàng----------->

<?php include_once 'modals/addStorageArea.php' ?>

<!--------Sửa lô hàng----------->

<?php include_once 'modals/editStorageArea.php' ?>