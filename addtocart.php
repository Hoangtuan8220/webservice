<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['sumquantity'])) {
    $_SESSION['sumquantity'] = 0;
}

if (isset($_POST['delcart'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['sumquantity']);
}
if (isset($_POST['addproduct'])) {
    $name = $_POST['name'];
    $price = (int) $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $check = 0;
   

    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $name) {
            $check = 1;
            $quantitynew = $quantity + $_SESSION['cart'][$i][2];
            $_SESSION['sumquantity'] += $quantity;
            $total = $price * $quantitynew;
            $sp = [$name, $price, $quantitynew, $total, $image, $description];
            $_SESSION['cart'][$i] = $sp;           
            break;
        }
    }
    if ($check==0) {
        $_SESSION['sumquantity'] += $quantity;
        $total = $price * $quantity;
        $sp = [$name, $price, $quantity, $total, $image, $description];
        $_SESSION['cart'][] = $sp;       
    }
    header("Location: index.php");
}
?>