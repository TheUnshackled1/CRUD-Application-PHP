<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coffee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Add Coffee</h2>
    <form method="POST" class="mb-3">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Type:</label>
            <input type="text" name="type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <button type="submit" name="save" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
    <?php
    require_once("includes/db.php");

    if (isset($_POST['save'])) {
        $name  = $_POST['name'];
        $type  = $_POST['type'];
        $price = $_POST['price'];

        $query = "INSERT INTO tbl_coffee (coffee_name, coffee_type, price)
                  VALUES ('$name', '$type', '$price')";

        mysqli_query($conn, $query);
        header("Location: index.php");
    }
    ?>
</div>
</body>
</html>