<!-- Modal -->

<div class="modal fade" id="editBatche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa lô hàng</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=editBatche" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_batche_code">Mã lô hàng</label>
                                        <input type="text" name="edit_batche_code" id="edit_batche_code"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_supplier_id">Nhà cung cấp</label>
                                        <input type="text" name="edit_supplier_id" id="edit_supplier_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_storage_area_id">Khu vực lưu trữ</label>
                                        <input type="text" name="edit_storage_area_id" id="edit_storage_area_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_manufacturing_date">Ngày sản xuất</label>
                                        <input type="date" name="edit_manufacturing_date" id="edit_manufacturing_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="edit_expiry_date">Ngày hết hạn</label>
                                        <input type="date" name="edit_expiry_date" id="edit_expiry_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="edit_created_at">Thời gian tạo</label>
                                        <input type="datetime-local" name="edit_created_at" id="edit_created_at"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="edit_status_id">Trạng thái</label>
                                    <select class="form-control form-control-sm" name="edit_status_id">
                                        <?php
                                        foreach ($statuses as $status):
                                            extract($status) ?>
                                            <option value="<?= $id ?>">
                                                <?= $name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="" placeholder="" name="edit_id" id="id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="editBatche">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('editBatche')
    myModal.addEventListener('shown.bs.modal', function () {
        const id = document.querySelector('input[name="edit_id"]');
        const batche_code = document.querySelector('input[name="edit_batche_code"]');
        const storage_area_id = document.querySelector('input[name="edit_storage_area_id"]');
        const manufacturing_date = document.querySelector('input[name="edit_manufacturing_date"]');
        const expiry_date = document.querySelector('input[name="edit_expiry_date"]');
        const created_at = document.querySelector('input[name="edit_created_at"]');
        const status = document.querySelector('select[name="edit_status_id"]');

        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        batche_code.setAttribute('value', val.batche_code);
        storage_area_id.setAttribute('value', val.storage_area_id);
        manufacturing_date.setAttribute('value', val.manufacturing_date);
        expiry_date.setAttribute('value', val.expiry_date);
        created_at.setAttribute('value', val.created_at);
        status.setAttribute('value', val.status);
        id.setAttribute('value', val.id);

        console.log(myModal);

    })
</script>