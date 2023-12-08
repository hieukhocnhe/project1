<div class="card">
    <div class="card-header pb-0 text-center m-4">
        <h3>Danh sách tài khoản</h3>
    </div>
    <div class="col mx-4 mb-4">
        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addAccount">Thêm
            tài khoản</button>
    </div>
    <div class="table-responsive">
        <table class="table align-items-center mb-0 text-center">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên đăng nhập
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Họ và tên
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh đại diện
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Địa chỉ</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số điện thoại
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng thái</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vai trò</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($accounts as $account):
                    extract($account);
                    ?>
                    <tr>
                        <td class="align-middle">
                            <?= $id ?>
                        </td>
                        <td class="align-middle">
                            <?= $username ?>
                        </td>
                        <td class="align-middle">
                            <?= $fullname ?>
                        </td>
                        <td class="align-middle">
                            <img src="../assets/img/accounts/<?= $avatar ?>" class="avatar avatar-sm rounded-circle me-2">
                        </td>
                        <td class="align-middle">
                            <?= $email ?>
                        </td>
                        <td class="align-middle">
                            <?= $address ?>
                        </td>
                        <td class="align-middle">
                            <?= $bio ?>
                        </td>
                        <td class="align-middle">
                            <?= $tel ?>
                        </td>
                        <td class="align-middle">
                            <span class="<?php if ($status === "Đang làm việc") {
                                echo "badge badge-sm bg-success";
                            } else {
                                echo "badge badge-sm bg-secondary";
                            }
                            ?>">
                                <?= $status ?>
                            </span>
                        </td>
                        <td class="align-middle">
                            <span class="<?php if ($position_id == 0) {
                                echo "badge badge-sm bg-primary";
                            } else {
                                echo "badge badge-sm bg-warning";
                            }
                            ?>">
                                <?= $position_name ?>
                            </span>
                        </td>
                        <td class="align-middle pt-4">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editAccount" data-value='<?= json_encode($account) ?>'>
                                <i class="ni ni-settings"></i>
                            </button>
                            <a onclick="return confirm('Bạn có xác nhận xóa ?');" class="btn btn-danger btn-sm"
                                href="?act=delAccount&id=<?= $id ?>"><i class="fa fa-trash"></i></a>
                        </td>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!--------Thêm tài khoản----------->

<?php include_once 'modals/addAccount.php' ?>

<!--------Sửa tài khoản----------->

<?php include_once 'modals/editAccount.php' ?>