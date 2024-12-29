<?php
require "koneksi.php";

$user = "DELETE FROM users WHERE id = '$_GET[id]'";
mysqli_query($koneksi, $user) or die;
header("location:./../admin.php");
