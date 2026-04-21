<h3 class="mb-3">💳 Thanh toán</h3>

<div class="card shadow" style="max-width: 500px; margin:auto;">
    <div class="card-body">

        <form method="POST" action="?act=place_order">

            <!-- 👤 TÊN -->
            <div class="mb-3">
                <label class="form-label">Tên khách hàng</label>
                <input 
                    class="form-control"
                    name="customer_name"
                    value="<?= $_SESSION['user']['full_name'] ?? '' ?>"
                    placeholder="Tên"
                    required
                    readonly
                >
            </div>

            <!-- 📞 SĐT -->
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input 
                    class="form-control"
                    name="phone"
                    value="<?= $_SESSION['user']['phone'] ?? '' ?>"
                    placeholder="Nhập SĐT..."
                    pattern="0[0-9]{9}" 
                    title="SĐT phải 10 số"
                    required
                >
            </div>

            <!-- 📍 ĐỊA CHỈ -->
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input 
                    class="form-control"
                    name="address"
                    value="<?= $_SESSION['user']['address'] ?? '' ?>"
                    placeholder="Nhập địa chỉ..."
                    required
                >
            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-between">
                <a href="?act=cart" class="btn btn-secondary">← Quay lại</a>
                <button class="btn btn-success">Đặt hàng</button>
            </div>

        </form>

    </div>
</div>