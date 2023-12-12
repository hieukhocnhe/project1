<!-- Modal -->
<div class="modal fade" id="editTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa giao dịch</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=editTransaction" method="POST">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_transaction_code">Mã giao dịch</label>
                                        <input type="text" name="edit_transaction_code" id="edit_transaction_code"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="edit_transaction_type_id">Loại giao dịch</label>
                                    <select class="form-control form-control-sm" name="edit_transaction_type_id">
                                        <?php foreach ($types as $key => $value):
                                            ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_storage_area_id">Khu vực lưu trữ</label>
                                        <input type="text" name="edit_storage_area_id" id="edit_storage_area_id"
                                            class="form-control form-control-sm" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_product_id">Id sản phẩm</label>
                                        <input type="text" name="edit_product_id" id="edit_product_id"
                                            class="form-control form-control-sm" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_previous_quantity">Số lượng trước đó</label>
                                        <input type="number" name="edit_previous_quantity" id="edit_previous_quantity"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_quantity_changed">Số lượng thay đổi</label>
                                        <input type="number" name="edit_quantity_changed" id="edit_quantity_changed"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_transaction_date">Thời gian tạo giao
                                            dịch</label>
                                        <input type="datetime-local" name="edit_transaction_date"
                                            id="edit_transaction_date" class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_total_amount">Tổng giá trị</label>
                                        <input type="text" name="edit_total_amount" id="total_amount"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_account_id">Id người tạo</label>
                                        <input type="text" name="edit_account_id" id="account_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="edit_status">Trạng thái</label>
                                    <select class="form-control form-control-sm" name="edit_status_id">
                                        <?php foreach ($statuses as $key => $value):
                                            ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="editTransaction">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('editTransaction')
    myModal.addEventListener('shown.bs.modal', function () {
        const id = document.querySelector('input[name="edit_id"]');
        const transaction_type_id = document.querySelector('select[name="edit_transaction_type_id"]');
        const transaction_date = document.querySelector('input[name="edit_transaction_date"]');
        const product_id = document.querySelector('input[name="edit_product_id"]');
        const transaction_code = document.querySelector('input[name="edit_transaction_code"]');
        const product_price = document.querySelector('input[name="product_price"]');
        const previous_quantity = document.querySelector('input[name="edit_previous_quantity"]');
        const quantity_changed = document.querySelector('input[name="edit_quantity_changed"]');
        const storage_area_id = document.querySelector('input[name="edit_storage_area_id"]');
        const status_id = document.querySelector('select[name="edit_status_id"]');
        const total_amount = document.querySelector('input[name="edit_total_amount"]');
        const account_id = document.querySelector('input[name="edit_account_id"]');

        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        transaction_type_id.setAttribute('value', val.transaction_type_id);
        transaction_date.setAttribute('value', val.transaction_date);
        product_id.setAttribute('value', val.product_id);
        transaction_code.setAttribute('value', val.transaction_code);
        product_price.setAttribute('value', val.product_price);
        previous_quantity.setAttribute('value', val.previous_quantity);
        quantity_changed.setAttribute('value', val.quantity_changed);
        storage_area_id.setAttribute('value', val.storage_area_id);
        status_id.setAttribute('value', val.status_id);
        total_amount.setAttribute('value', val.total_amount);
        account_id.setAttribute('value', val.account_id);
        id.setAttribute('value', val.id);
    })
</script>