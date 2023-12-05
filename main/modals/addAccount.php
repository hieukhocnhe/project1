<!-- Modal -->
<div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm tài khoản</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=addAccount" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="username">Tên đăng nhập</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="fullname">Họ và tên</label>
                                        <input type="text" name="fullname" id="fullname"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="tel">Số điện thoại</label>
                                        <input type="text" name="tel" id="tel" class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <textarea class="form-control form-control-sm" name="address" id="address" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="bio">Mô tả</label>
                                        <textarea class="form-control form-control-sm" name="bio" id="bio" value=""
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <label for="position">Vai trò</label>
                                    <select class="form-control form-control-sm" name="position_id">
                                        <?php foreach ($positions as $key => $value):
                                             ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['position_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="addAccount">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>