<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: login.php");
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
        <h1>Welcome, <?php echo $_SESSION["firstName"]?>!</h1>
        <h4>Here's where you can organize your products and keep your inventory up to date.</h4>
    </div>
<hr>
    <?php
        $datafile="items.json";
        $data = file_exists($datafile) ? json_decode(file_get_contents($datafile),true):[] ;

        // EDIT Item
        if(isset($_POST['id'])) {
            $id = $_POST['id'];
            foreach ($data as &$item) {
                if($item['id'] === $id){
                    $item['IName'] = trim($_POST['IName'] ?? $item['IName']);
                    $item['Category'] = trim($_POST['Category'] ?? $item['Category']);
                    $item['Qty'] = (int)($_POST['Qty'] ?? $item['Qty']);
                    $item['Price'] = (float)($_POST['Price'] ?? $item['Price']);
                    break;
                }
            }
                file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));

            header("Location: dashboard.php");
            exit();
            }

        //ADD Item
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $itemN = trim($_POST['IName'] ?? '');
            $category = trim($_POST['Category'] ?? '');
            $qty = (int)($_POST['Qty'] ?? 0);
            $price = (float)($_POST['Price'] ?? 0);


            if($itemN !== '' && $qty > 0 && $price >= 0 && $category !== ''){
                $data[] = [
                    "id" => uniqid(),
                    "IName" => $itemN,
                    "Category" => $category,
                    "Qty" => $qty,
                    "Price" => $price
                ];
                file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));
            }
            header("Location: dashboard.php");
            exit();
        }

        //DELETE Item
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = array_values(array_filter($data, fn($item)=> $item['id'] != $id));
            file_put_contents($datafile, json_encode($data, JSON_PRETTY_PRINT));
            header('Location: dashboard.php');
            exit();

        }

    ?>

    <div class="addItem">
        <form method="POST" action="dashboard.php">
                <label for="IName">Item Name:</label>
                <input type="text" name="IName" id="IName" required placeholder="Enter Items">  

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

    <div class="editModal" id="editModal">
        <div class="editItem">
            <span class="close" onclick="closeEditModal()">&times;</span>
                <h2>Edit Item</h2>

                <form action="dashboard.php" method="POST">
                    <input type="hidden" name="id" id="editId">

                    <label for="editIName">Item Name:</label>
                    <input type="text" name="IName" id="editIName" required >  

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
                    <input type="number" name="Qty" id="editQty" required min="1" >

                    <label for="editPrice">Price:</label>
                    <input type="number" name="Price" id="editPrice" required min="0" step="0.01" >

                <button type="submit">Edit Item</button>
                </form>
        </div>
    </div>

<hr>

    <div class="Inventory" >
        <table class="table" border="1">
            <thead >
                <tr>
                    <th colspan="5" class="itemTitle" style>Item List</th>
                </tr>
                <tr>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Quantity (kg)</th>
                    <th>Price per Kilo</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item["IName"]; ?></td>
                    <td><?php echo $item["Category"]; ?></td>
                    <td><?php echo $item["Qty"]; ?></td>
                    <td><?php echo "₱". number_format($item["Price"], 2); ?></td>
                    <td>
                        <button 
                        data-id="<?php echo $item['id']; ?>" 
                        onclick="openEditModal('<?php echo $item['id']; ?>')">Edit</button>
                        <a href="?id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </td>
                </tr>
               
                <?php } ?>
            </tbody>
        </table>
    </div>
    
<script src="script.js"></script>
</body>
</html>
