<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=editProduct" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_name">Tên sản phẩm</label>
                                        <input type="text" name="edit_name" id="edit_name" class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_price">Giá</label>
                                        <input type="text" name="edit_price" id="edit_price"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_quantity_in_stock">Số lượng</label>
                                        <input type="number" name="edit_quantity_in_stock" id="edit_quantity_in_stock"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_quantity_in_stock">Số lượng tồn kho</label>
                                        <input type="number" name="edit_quantity_in_stock" id="edit_quantity_in_stock"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_unit">Đơn vị tính</label>
                                        <input type="text" name="edit_unit" id="edit_unit" class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="edit_batch_id">Id lô hàng</label>
                                        <input type="text" name="edit_batch_id" id="edit_batch_id" class="form-control form-control-sm" />
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
                                        <label for="edit_expiry_date">Ngày hết hạn</label>
                                        <input type="date" name="edit_expiry_date" id="edit_expiry_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="image">Ảnh</label>
                                        <input class="form-control form-control-sm" id="image" name="edit_image"
                                            type="hidden" />
                                        <input class="form-control form-control-sm" id="image" name="edit_image"
                                            type="file" />
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="" placeholder="" name="edit_id" id="id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-primary" name="addProduct">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('editProduct')
    myModal.addEventListener('shown.bs.modal', function () {
        const id = document.querySelector('input[name="edit_id"]');
        const name = document.querySelector('input[name="edit_name"]');
        const price = document.querySelector('input[name="edit_price"]');
        const quantity_in_stock = document.querySelector('input[name="edit_quantity_in_stock"]');
        const manufacturing_date = document.querySelector('input[name="edit_manufacturing_date"]');
        const expiry_date = document.querySelector('input[name="edit_expiry_date"]');
        const unit = document.querySelector('input[name="edit_unit"]');
        const batch_id = document.querySelector('select[name="edit_batch_id"]');
        const image = document.querySelector('input[name="edit_image"]');


        const button = event.relatedTarget
        const recipient = button.getAttribute('data-value')
        const val = JSON.parse(recipient)

        name.setAttribute('value', val.name);
        price.setAttribute('value', val.price);
        quantity_in_stock.setAttribute('value', val.quantity_in_stock);
        manufacturing_date.setAttribute('value', val.manufacturing_date);
        expiry_date.setAttribute('value', val.expiry_date);
        unit.setAttribute('value', val.unit);
        batch_id.setAttribute('value', val.batch_id);
        image.setAttribute('value', val.image);
        id.setAttribute('value', val.id);

        console.log(myModal);

    })
</script>