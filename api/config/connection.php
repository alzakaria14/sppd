<?php

date_default_timezone_set('Asia/Makassar');

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_sppd';

$connection = mysqli_connect($host, $user, $password, $database);

$salt = 'mrDpEH8z5qY4LtkAuTbegf9xCnJa6PK7jVRyMUvsSWwcZF2Nh3';
$datenow = date('Y-m-d H:i:s');
