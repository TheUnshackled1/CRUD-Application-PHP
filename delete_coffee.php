<?php
require_once("includes/db.php");
$id = $_GET['id'];
$coffee = '';
$result = mysqli_query($conn, "SELECT coffee_name FROM tbl_coffee WHERE coffee_id = $id");
if ($row = mysqli_fetch_assoc($result)) {
    $coffee = $row['coffee_name'];
}
mysqli_query($conn, "DELETE FROM tbl_coffee WHERE coffee_id = $id");
header("Location: index.php?success=delete&coffee=" . urlencode($coffee));
exit();
?>