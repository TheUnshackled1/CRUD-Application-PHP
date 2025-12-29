<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coffee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Coffee</h2>
    <?php require_once("includes/db.php");
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM tbl_coffee WHERE coffee_id = $id");
    $row = mysqli_fetch_assoc($result);
    ?>
    <form method="POST" class="mb-3">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="<?= $row['coffee_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Type:</label>
            <input type="text" name="type" class="form-control" value="<?= $row['coffee_type'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= $row['price'] ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
    <?php
    if (isset($_POST['update'])) {
        $name  = $_POST['name'];
        $type  = $_POST['type'];
        $price = $_POST['price'];
        $query = "UPDATE tbl_coffee SET coffee_name='$name', coffee_type='$type', price='$price' WHERE coffee_id=$id";
        mysqli_query($conn, $query);
        header("Location: index.php?success=update&coffee=" . urlencode($name));
        exit();
    }
    ?>
</div>
</body>
</html>