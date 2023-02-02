<?php
if (!isset($_SESSION['sumquantity'])) {
    $_SESSION['sumquantity'] = 0;
}
?>
<form action="" method="POST">
    <div class="headerMa row">
        <div class="col-md-1"></div>
        <div class="col-md-2 logo">
            <a href="index.php"><img src="assets/img/logo-full-slogan.png" alt="" style="height: 69px; margin: 7px;"></a>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 timkiem">
            <input type="text" name="timkiem" placeholder="Tìm món ăn" class="search">
            <input type="submit" class="display_none" id="search" name="search_name">
            <label for="search"><i class="ti-search absolute button_search"></i></label>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-1 giohang">
            <a href="cart.php">
                <p name="giohang">Giỏ hàng</p>
                <div class="cart">
                    <?php echo ($_SESSION['sumquantity']) ?>
                </div>
            </a>
        </div>
        <?php if (isset($_SESSION['payment'])) { ?>
            <div class="col-md-1 giohang" style="margin-left: 10px;">
                <p class="payment" style="color: 00B14F; height: 38px;"><?php echo ($_SESSION['payment']) ?></p> 
            </div>
        <?php } ?>
    </div>
</form>