<?php
session_start();
require 'connect.php';
$totalproducts = 0;
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<?php
$city_name = 'Vinh';
$api_key = 'ffd4e94680c8d23cb25fae35039c36f9';
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city_name . '&appid=' . $api_key;

$weather_data = json_decode(file_get_contents($api_url), true);

$weather = $weather_data['weather'][0]['main'];
$weather_tempdefault = $weather_data['main']['temp'];
$weather_des = '';
switch ($weather) {
    case 'Clouds':
        $weather = 'Mây';
        break;
    case 'Rain':
        $weather = 'Mưa';
        $weather_des = '(Thời tiết xấu)';
        break;
}
$weather_temp = round($weather_tempdefault - 273.15);
// echo ($weather_temp);
// print_r($weather_data);

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/themify-icons/themify-icons.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <title>Giỏ hàng</title>
</head>

<body>
    <?php
    require 'layouts/header.php';
    ?>

    <form action="" method="POST">
        <div class="row content-products">
            <div class="col-md-12">
                <table>
                    <tr>
                        <td class="col-md-2 text-center">Tên món</td>
                        <td class="col-md-1 text-center">Giá</td>
                        <td class="col-md-1 text-center">Số lượng</td>
                        <td class="col-md-1 text-center">Thành tiền</td>
                        <td class="col-md-1 text-center">Xóa</td>
                    </tr>

                    <?php for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                        $id = $i; 
                        $name = $_SESSION['cart'][0][0];
                        $price = $_SESSION['cart'][0][1];
                        $amount = $_SESSION['cart'][0][2];
                        $image = $_SESSION['cart'][0][4];
                        $description = $_SESSION['cart'][0][5];
                    ?>
                        
                    <tr>
                        <td class="text-center"><?php echo ($_SESSION['cart'][$i][0]) ?></td>
                        <td class="text-center"><?php echo ($_SESSION['cart'][$i][1]); ?></td>
                        <td class="text-center"><?php echo ($_SESSION['cart'][$i][2]); ?></td>
                        <td class="text-center"><?php echo ($_SESSION['cart'][$i][3]); ?></td>
                        <td class="xoa text-center"><label for="delete" class="pointer"><a
                                    href="deletecart.php?id=<?php echo ($id); ?>"><i class="ti-eraser"></i></a></label>
                            <input type="submit" id="delete" class="display_none" name="delproduct"></input>
                            <input type="number" class="display_none" name="cartid"
                                value="<?php echo ($id); ?>"></input>
                        </td>
                    </tr>
                    <?php
                        $totalproducts += $_SESSION['cart'][$i][3];
                    } ?>
                    <tr>
                        <th colspan="3">Thời tiết hiện tại</th>
                        <th colspan="2"><?php echo ($weather_temp); ?>°C, <?php echo ($weather); ?></th>
                    </tr>
                    <?php                        
                        $phivanchuyen= 15000;
                        if ($weather_des == '(Thời tiết xấu)') {
                            $phivanchuyen += 3000;
                        }
                        if ($weather_temp >= 37) {
                            $phivanchuyen += 3000;
                        }
                        $totalproducts += $phivanchuyen;
                    ?>
                    <tr>
                        <th colspan="3">Phí vận chuyển<?php echo ($weather_des); ?></th>
                        <th colspan="2"><?php echo ($phivanchuyen); ?></th>
                    </tr>
                    <tr>
                        <th colspan="3">Tổng thanh toán</th>
                        <th colspan="2"><?php echo ($totalproducts); ?></th>
                    </tr>
                </table>
                <div class="col-md-10">
                    <input type="submit" name="thanhtoan" value="Xác nhận đơn hàng" class="thanhtoan float-right">
                </div>

            </div>
    </form>

    <?php
    $test = file_get_contents('dataDatHang.json');
    $test1 = json_decode($test);
    $test2 = array_pop($test1);
    $money = $test2->user_money;
    $payment = $test2->payment;
    if ($payment == 1) {
        $_SESSION['payment'] = "Thanh toán thành công";
    }
    $id = $test2->id;
    $weather_impact = $phivanchuyen - 15000;
    if (isset($_POST['thanhtoan'])) {
        unlink('data.json');
        $sql = "INSERT INTO `bill`(`name`, `image`, `description`, `amount`, `weather_impact`, `price`, `transport`, `user_money`, `payment`) 
        VALUES ('$name','$image','$description','$amount','$weather_impact','$price','$phivanchuyen','$money','$payment')";
        $result = mysqli_query($connect, $sql);

        $sql_update = "UPDATE `bill` SET `payment` = '$payment' WHERE `id` = '$id'";
        unset($_SESSION['cart']);
        unset($_SESSION['sumquantity']);
        
        $data = "SELECT * FROM `bill`";
        $json_data = array();
        $result_data = mysqli_query($connect, $data);
        while($row_data = mysqli_fetch_assoc($result_data)) {
            $json_data[] = $row_data;
        }
        $json_data = array_values($json_data);
        file_put_contents('dataDatHang.json', json_encode($json_data));
        header("Location: index.php");
    }
    ?>

    </div>


</body>

</html>