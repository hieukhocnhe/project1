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
            <form action="?act=addTransaction" method="POST">
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
                                        <label class="form-label" for="previous_quantity">Số lượng trước đó</label>
                                        <input type="text" name="previous_quantity" id="previous_quantity"
                                            class="form-control form-control-sm"
                                            value="<?= $transactions[0]['quantity_in_stock'] ?>" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="quantity_changed">Số lượng thay đổi</label>
                                        <input type="number" name="quantity_changed" id="quantity_changed"
                                            class="form-control form-control-sm" min=0
                                            oninput="calculateTotalAmount()" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="product_price">Giá sản phẩm</label>
                                        <input type="text" name="product_price" id="product_price"
                                            class="form-control form-control-sm"
                                            value="<?= $transactions[0]['product_price'] ?>" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="total_amount">Tổng giá trị</label>
                                        <input type="text" name="total_amount" id="total_amount"
                                            class="form-control form-control-sm" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="storage_area_id">Khu vực lưu trữ</label>
                                        <input type="text" name="storage_area_id" id="storage_area_id"
                                            class="form-control form-control-sm"
                                            value="<?= $transactions[0]['storage_area_id'] ?>" readonly
                                            style="background-color: #fff;" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control form-control-sm" name="status_id">
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
                        <input type="hidden" name="id" value="<?= $transactions[0]['product_id'] ?>" />
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
    function calculateTotalAmount() {
        var quantityChanged = document.getElementById("quantity_changed").value;
        var productPrice = <?= $transactions[0]['product_price'] ?>; // Đổi giá trị này thành giá trị thực tế từ PHP

        var totalAmount = quantityChanged * productPrice;

        // Định dạng số theo định dạng của Việt Nam Đồng
        var formattedTotalAmount = totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

        document.getElementById("total_amount").value = formattedTotalAmount;
    }
</script>