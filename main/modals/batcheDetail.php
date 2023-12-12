<div class="modal fade" id="batcheDetail" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Chi tiết lô hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0 text-center">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID lô
                                    hàng</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Ngày sản xuất</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Ngày hết hạn</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Số
                                    lượng sản phẩm</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Thời gian tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($batche_detail as $key => $value): ?>
                                <tr>
                                    <td class="align-middle">
                                        <?= $value['id'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $value['manufacturing_date'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $value['expiry_date'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $value['quantity'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $value['created_at'] ?>
                                    </td>
                                <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

    </script>