<!-- Modal -->
<div class="modal fade" id="editAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa tài khoản</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=editAccount" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="username">Tên đăng nhập</label>
                                        <input type="text" name="edit_username" id="username" value=""
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="fullname">Họ và tên</label>
                                        <input type="text" name="edit_fullname" id="fullname" value=""
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="edit_email" id="email" value=""
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="tel">Số điện thoại</label>
                                        <input type="text" name="edit_tel" id="tel" class="form-control form-control-sm"
                                            value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <textarea class="form-control form-control-sm" name="edit_address" id="address"
                                            value="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="bio">Mô tả</label>
                                        <textarea class="form-control form-control-sm" name="edit_bio" id="bio" value=""
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="status">Trạng thái</label>
                                    <select id="status" name="edit_status" class="select form-control form-control-sm">
                                        <?php
                                        $statusOptions = [
                                            ['value' => 0, 'label' => 'Đã nghỉ việc'],
                                            ['value' => 1, 'label' => 'Đang làm việc']
                                        ];

                                        foreach ($statusOptions as $option):
                                            ?>
                                            <option value="<?= $option['value']; ?>" <?= ($option['value'] == $status) ? 'selected' : ''; ?>>
                                                <?= $option['label']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-4 pb-2">
                                    <label class="form-label select-label" for="position">Vai trò</label>
                                    <select name="position_id" class="select form-control form-control-sm">
                                        <?php foreach ($positions as $key => $value): ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['position_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="avatar">Ảnh đại diện</label>
                                            <input class="form-control form-control-sm" id="avatar" name="edit_avatar"
                                                type="hidden" />
                                            <input class="form-control form-control-sm" id="avatar" name="edit_avatar"
                                                type="file" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" placeholder="" name="edit_id" id="id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="editAccount">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('editAccount')
    myModal.addEventListener('shown.bs.modal', function () {
        const id = document.querySelector('input[name="edit_id"]');
        const username = document.querySelector('input[name="edit_username"]');
        const fullname = document.querySelector('input[name="edit_fullname"]');
        const email = document.querySelector('input[name="edit_email"]');
        const tel = document.querySelector('input[name="edit_tel"]');
        const address = document.querySelector('textarea[name="edit_address"]');
        const bio = document.querySelector('textarea[name="edit_bio"]');
        const status = document.querySelector('select[name="edit_status"]');
        const avatar = document.querySelector('input[name="edit_avatar"]');


        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        username.setAttribute('value', val.username);
        fullname.setAttribute('value', val.fullname);
        email.setAttribute('value', val.email);
        tel.setAttribute('value', val.tel);
        avatar.setAttribute('value', val.avatar);
        address.value = val.address;
        bio.value = val.bio;

        // Duyệt qua từng option để đặt thuộc tính selected
        status.querySelectorAll('option').forEach(option => {
            if (option.value == val.status) {
                option.setAttribute('selected', 'selected');
            } else {
                option.removeAttribute('selected');
            }
        });
        id.setAttribute('value', val.id);

        console.log(myModal);

    })
</script>