<?php
return [
    '/' => function () {
        require 'home.php';
    },
    '/index.php' => function () {
        require 'home.php';
    },
    '/bill/detail' => function (array $params = []) {
        require 'data.php';
    }
];
?>