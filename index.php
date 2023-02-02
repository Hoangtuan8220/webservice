<?php
session_start();
require 'connect.php';

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/themify-icons/themify-icons.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <title>Thực đơn</title>
</head>

<body>
<?php
require 'layouts/header.php';
?>
    <div class="row content-products">
        <?php
        $sqls = "SELECT * FROM `food`";
        if (isset($_POST['search_name'])) {
            $name = $_POST['timkiem'];
            $sqls = "SELECT * FROM `food` where `name` like '%" . $name . "%'";
        }        
        
        $data = array();
        $result = mysqli_query($connect, $sqls);
        while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <div class="col-md-4">
            <form action="addtocart.php?id=<?php echo ($row['id']); ?>" method="post">
                <div class="row products">
                    <div class="col-md-6">
                        <img src="<?php echo ($row['img']) ?>" alt="" name="image" style="height: 170px; object-fit: cover;">
                        <input type="hidden" name="image" value="<?php echo ($row['img']) ?>"></input>
                        <input type="hidden" name="food_id" value="<?php echo ($row['id']) ?>"></input>
                    </div>
                    <div class="col-md-6 ml-10px">
                        <input type="hidden" class="name" name="name" value="<?php echo ($row['name']) ?>"><b><?php echo ($row['name']) ?></b></input>
                        <p class="description"><?php echo ($row['description']) ?></p>
                        <input type="hidden" name="description" value="<?php echo ($row['description']) ?>"></input>
                        <input type="hidden" name="price" value="<?php echo ($row['price']) ?>">
                        <p class="price"><?php echo ($row['price']) ?></p></input>
                        <input type="number" name="quantity" value="1" class="quantity float-left"></input>
                        <div class="float-right add-product">
                            <button type="submit" name="addproduct" class="addsubmit">
                                <p class="add">+</p>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php
            $json_arr[] = $row;
        }
        $arr_index = array();
        // foreach ($json_arr as $key => $value) {
        //     if ($value['id'] == "8") {
        //     }
        // }
        // foreach ($arr_index as $i) {
        //     unset($json_arr[$i]);
        // }
        $json_arr = array_values($json_arr);


        file_put_contents('data.json', json_encode($json_arr));
        ?>

    </div>


</body>

</html>