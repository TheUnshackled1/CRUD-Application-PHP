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
            <input list="coffee_names" name="coffee_name" class="form-control" placeholder="Select or type a coffee name" required>
            <datalist id="coffee_names">
                <option value="Drip Coffee">
                <option value="Espresso">
                <option value="French Press">
                <option value="Pour Over">
                <option value="Cold Brew">
                <option value="AeroPress">
                <option value="Moka Pot">
            </datalist>
            <small class="text-muted">Select from the list or type your own coffee name.</small>
        </div>
        <div class="mb-3">
            <label>Temperature Category:</label>
            <select name="type" class="form-select" required>
                <option value="">-- Select Temperature --</option>
                <option value="Hot">Hot</option>
                <option value="Iced">Iced</option>
                <option value="Cold Brew">Cold Brew</option>
                <option value="Blended">Blended</option>
                <option value="Other">Other</option>
            </select>
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
        $name = $_POST['coffee_name'];
        $type  = $_POST['type'];
        $price = $_POST['price'];

        if (!empty($name)) {
            $query = "INSERT INTO tbl_coffee (coffee_name, coffee_type, price)
                      VALUES ('$name', '$type', '$price')";

            mysqli_query($conn, $query);
            header("Location: index.php");
        } else {
            echo '<div class="alert alert-danger mt-2">Please select or type a coffee name.</div>';
        }
    }
    ?>
</div>
</body>
</html>