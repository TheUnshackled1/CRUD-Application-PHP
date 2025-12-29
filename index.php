<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php require_once("includes/db.php"); ?>

<h2>Coffee List</h2>
<a href="add_coffee.php" class="btn btn-primary mb-3">➕ Add Coffee</a>

<table class="table table-bordered table-striped">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>

<?php
$predefined = [
    'Drip Coffee',
    'Espresso',
    'French Press',
    'Pour Over',
    'Cold Brew',
    'AeroPress',
    'Moka Pot'
];
$result = mysqli_query($conn, "SELECT * FROM tbl_coffee");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['coffee_id'] ?></td>
    <td>
        <?php if (in_array($row['coffee_name'], $predefined)) { ?>
            <?= $row['coffee_name'] ?>
        <?php } else { ?>
            <form method="POST" action="update_coffee.php?id=<?= $row['coffee_id'] ?>" style="display:inline;">
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['coffee_name']) ?>">
                <input type="hidden" name="type" value="<?= htmlspecialchars($row['coffee_type']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']) ?>">
            </form>
        <?php } ?>
    </td>
    <td><?= $row['coffee_type'] ?></td>
    <td><?= $row['price'] ?></td>
    <td>
        <a href="update_coffee.php?id=<?= $row['coffee_id'] ?>" class="btn btn-sm btn-warning">Edit</a> |
        <a href="delete_coffee.php?id=<?= $row['coffee_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this coffee?');">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
