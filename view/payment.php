<div class="row">
    <!-- Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Nạp tiền qua MoMo, VNPay, Ngân hàng</h5>
            </div>
            <div class="card-body">
                <form method="post" action="/payment/create">
                    <div class="mb-3">
                        <label for="phuongThuc" class="form-label">Phương thức thanh toán</label>
                        <select class="form-select" id="phuongThuc">
                            <option selected>-- Chọn phương thức --</option>
                            <option value="momo">MoMo</option>
                            <option value="vnpay">VNPay</option>
                            <option value="bank">Ngân hàng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="soTien" class="form-label">Số tiền cần nạp (VNĐ)</label>
                        <input type="number" name="amount" class="form-control" id="soTien" placeholder="Nhập số tiền cần nạp">
                    </div>
                    <div class="mb-3">
                        <p class="text-success">Số tiền thực nhận: <span id="soTienThucNhan">0</span> VNĐ</p>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Nạp Ngay</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Notes -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Lưu ý</h5>
            </div>
            <div class="card-body">
                <ul class="text-danger">
                    <li>Nạp qua MoMo, VNPay, hoặc ngân hàng đều được xử lý tự động.</li>
                    <li>Nhập đúng số tiền bạn muốn nạp.</li>
                    <li>Phí giao dịch sẽ được trừ tùy theo phương thức thanh toán.</li>
                    <li>Liên hệ CSKH nếu gặp vấn đề trong quá trình nạp tiền.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- table -->
    <div class="col-lg-12 mt-3">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Lịch sử nạp thẻ</h5>
            </div>
        </div>
        <table class="table table-bordered table-hover table-striped text-center">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Phương thức</th>
                    <th>Số tiền</th>
                    <th>Phí giao dịch</th>
                    <th>Tính tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>MoMo</td>
                    <td>10000</td>
                    <td>0</td>
                    <td>10000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>MoMo</td>
                    <td>10000</td>
                    <td>0</td>
                    <td>10000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MoMo</td>
                    <td>10000</td>
                    <td>0</td>
                    <td>10000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function docSoThanhChu(so) {
        const chuSo = [
            '', 'một', 'hai', 'ba', 'bốn', 'năm', 'sáu', 'bảy', 'tám', 'chín'
        ];
        const hangDonVi = ['', 'nghìn', 'triệu', 'tỷ'];

        function docHang(so) {
            let kq = '';
            const donVi = so % 10;
            const chuc = Math.floor(so / 10) % 10;
            const tram = Math.floor(so / 100);

            // Xử lý hàng trăm
            if (tram > 0) {
                kq += `${chuSo[tram]} trăm `;
            }

            // Xử lý hàng chục
            if (chuc > 0) {
                if (chuc === 1) {
                    kq += `mười `;
                } else {
                    kq += `${chuSo[chuc]} mươi `;
                }
            } else if (tram > 0 && donVi > 0) {
                kq += `lẻ `;
            }

            // Xử lý hàng đơn vị
            if (donVi > 0) {
                if (donVi === 1 && chuc > 1) {
                    kq += `mốt`;
                } else if (donVi === 5 && chuc > 0) {
                    kq += `lăm`;
                } else {
                    kq += `${chuSo[donVi]}`;
                }
            }

            return kq.trim();
        }

        if (so === 0) return 'không';

        let ketQua = '';
        let i = 0;

        while (so > 0) {
            const hang = so % 1000;
            if (hang > 0) {
                const chuHang = docHang(hang);
                ketQua = `${chuHang} ${hangDonVi[i]} ${ketQua}`.trim();
            }
            so = Math.floor(so / 1000);
            i++;
        }

        return ketQua.trim();
    }

    // Lắng nghe sự kiện input
    document.getElementById('soTien').addEventListener('input', function() {
        const soTien = parseInt(this.value);
        if (!isNaN(soTien)) {
            const chuSo = docSoThanhChu(soTien);
            document.getElementById('soTienThucNhan').textContent = chuSo;
        } else {
            document.getElementById('soTienThucNhan').textContent = 'Vui lòng nhập số hợp lệ.';
        }
    });
</script>