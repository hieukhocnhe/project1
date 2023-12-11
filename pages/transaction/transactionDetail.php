<div class="card">
    <div class="col-md-11 mb-lg-0 mb-4 mx-6">
        <div class="mt-4">
            <div class="pb-0">
                <div class="text-center">
                    <div class="row">
                        <div class="d-flex align-items-center flex-row">
                            <?php foreach ($transactionDetail as $item)
                                $transaction_type_name = $item['transaction_type_name'];
                            $transaction_date = $item['transaction_date'];
                            $datetime = new DateTime($transaction_date, new DateTimeZone('Asia/Ho_Chi_Minh'));

                            // Lấy thông tin Giờ, Phút, Giây, Ngày, Tháng, Năm
                            $gio = $datetime->format('H');
                            $phut = $datetime->format('i');
                            $giay = $datetime->format('s');
                            $ngay = $datetime->format('d');
                            $thang = $datetime->format('m');
                            $nam = $datetime->format('Y');
                            echo <<<HTML
                        <div class="col mx-4 mb-5">
                            <h3>Tên giao dịch : $transaction_type_name</h3>
                            <h6 class="fst-italic">$gio giờ $phut phút $giay giây. Ngày $ngay Tháng $thang Năm $nam</h6>
                        </div>
HTML;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-4">
            <div class="card pb-4">
                <?php foreach ($transactionDetail as $key => $value): ?>
                    <div class="card-header pb-0 px-3">
                        <h3 class="mb-3 ms-3">Thông tin giao dịch</h3>
                    </div>
                    <div class="card-body pt-4 p-4 d-flex">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 ms-3">Mã giao dịch :
                                <?= $value['transaction_code'] ?>
                            </h6>
                            <h6 class="mb-3 ms-3">
                                Họ và tên người tạo :
                                <?= $value['fullname'] ?>
                            </h6>
                            <h6 class="mb-3 ms-3">
                                Nơi lưu trữ :
                                <?= $value['area_name'] ?>
                            </h6>
                            <h6 class="mb-3 ms-3">
                                Trạng thái :
                                <?= $value['status'] ?>
                            </h6>
                        </div>
                        <div class="ms-6 d-flex flex-column">
                            <h6 class="mb-3 ms-3">
                                Tên sản phẩm :
                                <?= $value['product_name'] ?>
                            </h6>
                            <h6 class="mb-3 ms-3">
                                Giá sản phẩm :
                                <?= $value['product_price'] ?>
                            </h6>
                            <h6 class="mb-3 ms-3">
                                Đơn vị tính :
                                <?= $value['product_unit'] ?>
                            </h6>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="col-md-6 mt-4 text-end">
            <div class="card">
                <?php foreach ($transactionDetail as $key => $value): ?>
                    <div class="card-header pb-0 px-3">
                        <h3 class="mb-3 me-3">Biến động</h3>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 me-3">Số lượng trước thay đổi :
                                <?= $value['previous_quantity'] ?>
                            </h6>
                            <h6 class="mb-3 me-3">
                                Số lượng thay đổi :
                                <?= $value['quantity_changed'] ?>
                            </h6>
                            <h6 class="mb-3 me-3">Giá sản phẩm :
                                <?= $value['product_price'] ?>
                            </h6>
                            <hr class="bg-secondary border-2 border-top border-secondary" />
                            <h6 class="mb-3 me-3">
                                Tổng tiền :
                                <?= number_format($value['total_amount'], 0, ',', '.') ?>
                            </h6>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <?php foreach ($transactionDetail as $key => $value): ?>
                    <div class="card-body pt-4 p-3">
                        <div class="d-flex text-center">
                            <p>Tổng số tiền (Viết bằng chữ) : </p>
                            <h5 class="mb-3 me-3 fst-italic">
                                <?= numberToWordsVND($value['total_amount']) ?>
                            </h5>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>