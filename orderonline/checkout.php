<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Checkout</h3>
                <hr class="divider my-4" />

            </div>

        </div>
    </div>
</header>
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="" id="checkout-frm">
                <h4>Confirm Delivery Information</h4>
                <div class="form-group">
                    <label for="" class="control-label">First Name</label>
                    <input type="text" name="first_name" required="" class="form-control"
                        value="<?php echo $_SESSION['login_first_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Last Name</label>
                    <input type="text" name="last_name" required="" class="form-control"
                        value="<?php echo $_SESSION['login_last_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Contact</label>
                    <input type="text" name="mobile" required="" class="form-control" maxlength="10" minlength="10"
                        value="<?php echo $_SESSION['login_mobile'] ?>" pattern="[0-9]{10}">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Address</label>
                    <textarea cols="30" rows="3" name="address" required=""
                        class="form-control"><?php echo $_SESSION['login_address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Email</label>
                    <input type="email" name="email" required="" class="form-control"
                        value="<?php echo $_SESSION['login_email'] ?>">
                </div>

                <div class="form-group">
                    <label for="payment_method" class="control-label">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control" required="">
                        <option value="GPay">GPay</option>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                        <option value="PhonePe">PhonePe</option>
                        <option value="Paytm">Paytm</option>
                    </select>
                </div>
                <div class="text-center">
                    <button class="btn btn-block btn-outline-primary">Place Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('#checkout-frm').submit(function (e) {
        e.preventDefault();

        start_load();
        var formData = $(this).serialize();
        // Add the selected payment method to the form data
        formData += '&payment_method=' + $('#payment_method').val();

        $.ajax({
            url: "admin/ajax.php?action=save_order",
            method: 'POST',
            data: formData,
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Order and Payment succeesfully.");
                    setTimeout(function () {
                        location.replace('index.php?page=home');
                    }, 1500);
                }
            }
        });
    });
});
</script>