<h3 class="mb-3">💳 Thanh toán</h3>

<div class="card shadow" style="max-width: 500px; margin:auto;">
    <div class="card-body">

        <form method="POST" action="?act=place_order">

            <div class="mb-3">
                <label class="form-label">Tên khách hàng</label>
                <input class="form-control mb-2" name="customer_name" placeholder="Tên" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input class="form-control" name="phone" placeholder="Nhập SĐT..."
                    pattern="0[0-9]{9}" title="SĐT phải 10 số" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input class="form-control" name="address" placeholder="Nhập địa chỉ..." required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="?act=cart" class="btn btn-secondary">← Quay lại</a>
                <button class="btn btn-success">Đặt hàng</button>
            </div>

        </form>

    </div>
</div>