<?php 
    require_once "config.php";
    
    $id = $_GET['id'];

    $sql = "DELETE FROM list WHERE id = '{$id}'";

    $result = mysqli_query($conn, $sql);

     header("location: index.php");

?>