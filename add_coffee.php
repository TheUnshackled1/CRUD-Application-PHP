<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coffee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
    function updateCoffeeNames() {
        var type = document.querySelector('select[name="type"]').value;
        var datalist = document.getElementById('coffee_names');
        datalist.innerHTML = '';
        if (type === 'Hot Coffee') {
            var hot = [
                'Espresso',
                'Americano',
                'Latte',
                'Cappuccino',
                'Mocha',
                'Macchiato',
                'Flat White',
                'Cortado',
                'Café au Lait',
                'Breve',
                'Turkish Coffee',
                'Irish Coffee'
            ];
            hot.forEach(function(name) {
                var opt = document.createElement('option');
                opt.value = name;
                datalist.appendChild(opt);
            });
        } else if (type === 'Cold Coffee') {
            var cold = [
                'Iced Coffee',
                'Iced Latte',
                'Iced Americano',
                'Cold Brew',
                'Nitro Cold Brew',
                'Frappé',
                'Frappuccino',
                'Iced Mocha',
                'Iced Caramel Macchiato',
                'Dalgona Coffee'
            ];
            cold.forEach(function(name) {
                var opt = document.createElement('option');
                opt.value = name;
                datalist.appendChild(opt);
            });
        }
    }

    function formatPrice() {
        var priceInput = document.getElementById('priceInput');
        if (priceInput.value) {
            priceInput.value = parseFloat(priceInput.value).toFixed(2);
        }
    }
    </script>
</head>
<body>
<div class="container">
    <h2>Add Coffee</h2>
    <?php if (isset($_GET['success']) && $_GET['success'] === '1') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Coffee added successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <form method="POST" class="mb-3">
        <div class="mb-3">
            <label>Temperature Category:</label>
            <select name="type" class="form-select" required onchange="updateCoffeeNames()">
                <option value="">-- Select Temperature --</option>
                <option value="Hot Coffee">Hot Coffee</option>
                <option value="Cold Coffee">Cold Coffee</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Name:</label>
            <input list="coffee_names" name="coffee_name" class="form-control" placeholder="Select or type a coffee name" required>
            <datalist id="coffee_names"></datalist>
            <small class="text-muted">Select from the list or type your own coffee name.</small>
        </div>
        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control" required id="priceInput" onblur="formatPrice()">
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
            header("Location: index.php?success=add&coffee=" . urlencode($name));
            exit();
        } else {
            echo '<div class="alert alert-danger mt-2">Please select or type a coffee name.</div>';
        }
    }
    ?>
</div>
</body>
</html>