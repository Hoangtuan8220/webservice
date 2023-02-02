<?php

$test = file_get_contents('dataDatHang.json');
$test1 = json_decode($test);
$id = $_GET['id'];
$length_data = count($test1);
for ($x = 0; $x < $length_data; $x++) {
    if ($test1[$x]->id == $id) {
        echo "",json_encode($test1[$x]);
    }
  }
?>