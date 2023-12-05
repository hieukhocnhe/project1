<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 text-center m-4">
                <h3>Danh sách nhà cung cấp</h3>
            </div>
            <div class="col mx-4 mb-4">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#addSupplier">Thêm
                    nhà cung cấp</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 text-center">
                        <tbody>
                            <tr>
                                <div class="row gap-3 justify-content-evenly text-center">
                                    <?php
                                    foreach ($suppliers as $supplier):
                                        extract($supplier);
                                        ?>
                                        <div class="col col-sm-3">
                                            <div class="card">
                                                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                                    <a href="javascript:;" class="d-block">
                                                        <img src="../assets/img/suppliers/<?= $logo ?>"
                                                            class="img-fluid border-radius-lg">
                                                    </a>
                                                </div>
                                                <div class="card-body pt-2">
                                                    <span
                                                        class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                        <?= $id ?>
                                                    </span>
                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                        <?= $name ?>
                                                    </a>
                                                    <p class="card-description mb-4">
                                                        <?= $contact_person ?>
                                                    </p>
                                                    <p class="card-description mb-4">
                                                        <?= $contact_number ?>
                                                    </p>
                                                    <button type="button" class="btn btn-warning btn-sm mx-4"
                                                        data-bs-toggle="modal" data-bs-target="#editSupplier"
                                                        data-value='<?= json_encode($supplier) ?>'>
                                                        <i class="ni ni-settings"></i>
                                                    </button>
                                                    <a onclick="return confirm('Bạn có xác nhận xóa ?');"
                                                        class="btn btn-danger btn-sm mx-4"
                                                        href="?act=delSupplier&id=<?= $id ?>"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Thêm nhà cung cấp-->

<?php include_once '../main/modals/addSupplier.php' ?>

<!--Sửa nhà cung cấp-->

<?php include_once '../main/modals/editSupplier.php' ?>