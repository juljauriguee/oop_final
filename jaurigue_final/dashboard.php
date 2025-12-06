<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$datafile = "items.json";
$data = file_exists($datafile) ? json_decode(file_get_contents($datafile), true) : [];

// EDIT item
if(isset($_POST['id']) && isset($_POST['IName'])) {
    $id = $_POST['id'];
    foreach($data as &$item) {
        if($item['id'] === $id) {
            $item['IName'] = trim($_POST['IName']);
            $item['Category'] = trim($_POST['Category']);
            $item['Qty'] = (int)$_POST['Qty'];
            $item['Price'] = (float)$_POST['Price'];
            break;
        }
    }
    file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: dashboard.php");
    exit();
}

// ADD item
if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['id'])) {
    $itemName = trim($_POST['IName']);
    $category = trim($_POST['Category']);
    $qty = (int)$_POST['Qty'];
    $price = (float)$_POST['Price'];

    if($itemName !== "" && $category !== "" && $qty > 0 && $price >= 0) {
        $data[] = [
            "id" => uniqid(),
            "IName" => $itemName,
            "Category" => $category,
            "Qty" => $qty,
            "Price" => $price
        ];
    }
    file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: dashboard.php");
    exit();
}

// DELETE item
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = array_values(array_filter($data, fn($item) => $item['id'] != $id));
    file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="unnamed.jpg" alt="">
        <span>INVENTIFY</span>
    </div>
    <button class="logout"><a href="logout.php">Logout</a></button>
</header>

<div class="welcome-dashboard">
    <h1>Welcome, <?= htmlspecialchars($_SESSION["firstName"]) ?>!</h1>
    <h4>Here's where you can organize your products and keep your inventory up to date.</h4>
</div>
<hr>

<!-- ADD ITEM FORM -->
<div class="addItem">
    <form method="POST" action="dashboard.php">
        <label for="IName">Item Name:</label>
        <input type="text" name="IName" id="IName" required placeholder="Enter item name">

        <label for="Category">Category:</label>
        <select name="Category" id="Category" required>
            <option value="">---- Select Category ----</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Fruits">Fruits</option>
            <option value="Grains">Grains</option>
            <option value="Herbs">Herbs</option>
            <option value="Other">Other</option>
        </select>

        <label for="Qty">Quantity:</label>
        <input type="number" name="Qty" id="Qty" required min="1" placeholder="Enter quantity in kg">

        <label for="Price">Price:</label>
        <input type="number" name="Price" id="Price" required min="0" step="0.01" placeholder="Price per unit">

        <button type="submit">Add Item</button>
    </form>
</div>

<!-- EDIT MODAL -->
<div class="editModal" id="editModal">
    <div class="editItem">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Item</h2>
        <form action="dashboard.php" method="POST">
            <input type="hidden" name="id" id="editId">

            <label for="editIName">Item Name:</label>
            <input type="text" name="IName" id="editIName" required>

            <label for="editCategory">Category:</label>
            <select name="Category" id="editCategory" required>
                <option value="">---- Select Category ----</option>
                <option value="Vegetables">Vegetables</option>
                <option value="Fruits">Fruits</option>
                <option value="Grains">Grains</option>
                <option value="Herbs">Herbs</option>
                <option value="Other">Other</option>
            </select>

            <label for="editQty">Quantity:</label>
            <input type="number" name="Qty" id="editQty" required min="1">

            <label for="editPrice">Price:</label>
            <input type="number" name="Price" id="editPrice" required min="0" step="0.01">

            <button type="submit">Edit Item</button>
        </form>
    </div>
</div>

<hr>

<!-- INVENTORY TABLE -->
<div class="Inventory">
    <table border="1">
        <thead>
            <tr>
                <th colspan="5" class="itemTitle">Item List</th>
            </tr>
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Quantity (kg)</th>
                <th>Price per Kilo</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($data as $item) { ?>
            <tr data-id="<?= $item['id'] ?>">
                <td><?= htmlspecialchars($item["IName"]) ?></td>
                <td><?= htmlspecialchars($item["Category"]) ?></td>
                <td><?= $item["Qty"] ?></td>
                <td><?= "₱".number_format($item["Price"], 2) ?></td>
                <td>
                    <button type="button" onclick="openEditModal('<?= $item['id'] ?>')">Edit</button>
                    <a href="?id=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="script.js"></script>
</body>
</html>
