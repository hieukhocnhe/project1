<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=addProduct" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="name">Tên sản phẩm</label>
                                        <input type="text" name="name" id="name" class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="price">Giá</label>
                                        <input type="text" name="price" id="price"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="quantity_in_stock">Số lượng</label>
                                        <input type="number" name="quantity_in_stock" id="quantity_in_stock"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="unit">Đơn vị tính</label>
                                        <input type="text" name="unit" id="unit" class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="manufacturing_date">Ngày sản xuất</label>
                                        <input type="date" name="manufacturing_date" id="manufacturing_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="expiry_date">Ngày hết hạn</label>
                                        <input type="date" name="expiry_date" id="expiry_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="image">Ảnh</label>
                                        <input class="form-control form-control-sm" id="image" name="image"
                                            type="file" />
                                    </div>
                                </div>
                                <div class="col-6 mb-4 pb-2">
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