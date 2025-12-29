<?php
require_once("includes/db.php");
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tbl_coffee WHERE coffee_id = $id");
header("Location: index.php");
?>