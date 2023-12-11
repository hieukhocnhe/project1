<!-- Modal -->
<div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm giao dịch</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=addTransaction" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="transaction_type">Loại giao dịch</label>
                                    <select class="form-control form-control-sm" name="transaction_type_id">
                                        <?php foreach ($types as $key => $value):
                                            ?>
                                            <option value="<?= $value['id'] ?>">
                                                <?= $value['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="transaction_date">Thời gian tạo giao dịch</label>
                                        <input type="datetime-local" name="transaction_date" id="transaction_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="quantity_in_stock">Số lượng trước đó</label>
                                        <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                                            class="form-control form-control-sm"
                                            value="<?= $transactions[0]['quantity_in_stock'] ?>" />
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="quantity_changed">Số lượng thay đổi</label>
                                        <input type="number" name="quantity_changed" id="quantity_changed"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="storage_area_id">Khu vực lưu trữ</label>
                                        <input type="text" name="storage_area_id" id="storage_area_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="status">Trạng thái</label>
                                    <select id="status" name="edit_status" class="select form-control form-control-sm">
                                        <?php
                                        $statusOptions = [
                                            ['value' => 0, 'label' => 'Hoàn thành'],
                                            ['value' => 1, 'label' => 'Đang xử lý'],
                                            ['value' => 2, 'label' => 'Hủy bỏ']
                                        ];

                                        foreach ($statusOptions as $option):
                                            ?>
                                            <option value="<?= $option['value']; ?>" <?= ($option['value'] == $status) ? 'selected' : ''; ?>>
                                                <?= $option['label']; ?>
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
                    <button type="submit" class="btn bg-gradient-primary" name="addTransaction">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('addTransaction')
    myModal.addEventListener('shown.bs.modal', function () {
        const quantity_in_stock = document.querySelector('input[name="quantity_in_stock"]');


        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        quantity_in_stock.setAttribute('value', val.quantity_in_stock);

    })
</script>