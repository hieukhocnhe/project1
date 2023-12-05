<!-- Modal -->

<div class="modal fade" id="addBatche" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm lô hàng</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?act=addAccount" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center h-100 my-5 p-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="supplier_id">Nhà cung cấp</label>
                                        <input type="text" name="supplier_id" id="supplier_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="storage_area_id">Khu vực lưu trữ</label>
                                        <input type="text" name="storage_area_id" id="storage_area_id"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="quantity">Số lượng</label>
                                        <input type="number" name="quantity" id="quantity"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="production_date">Ngày sản xuất</label>
                                        <input type="date" name="production_date" id="production_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="manufacturing_date">Ngày hết hạn</label>
                                        <input type="date" name="manufacturing_date" id="manufacturing_date"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div class="form-group">
                                        <label for="created_at">Ngày tạo</label>
                                        <input type="date" name="created_at" id="created_at"
                                            class="form-control form-control-sm" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <label for="status_id">Trạng thái</label>
                                    <select class="form-control form-control-sm" name="status_id">
                                        <?php
                                        foreach ($statuses as $status):
                                            extract($status) ?>
                                            <option value="<?= $id ?>">
                                                <?= $name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-outline">
                                    <a href="../assets/public/products_partten.xlsx"
                                        class="btn btn-sm btn-sm btn-success mb-3">
                                        <i class="fa-regular"></i>
                                        File mẫu
                                    </a>
                                </div>
                                <div class="md-6 mb-4 pb-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="products">Tải lên file</label>
                                        <input type="file" id="products" name="products"
                                            class="form-control form-control-sm" />
                                    </div>
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