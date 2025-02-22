<?php 

require '../auth/access.php';

$id_slider = $_POST['id_slider'];

mysqli_query(
    $connection,
    "DELETE FROM tb_slider WHERE id_slider = '$id_slider'"
);
echo 1;
?>