<?php
session_start();

if (isset($_GET["id"])) {
    $_SESSION['sumquantity'] -= $_SESSION['cart'][$_GET["id"]][2];
    array_splice($_SESSION['cart'], $_GET["id"], 1);
    header("Location: cart.php");
}
?>