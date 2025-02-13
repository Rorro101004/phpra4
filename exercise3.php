<!DOCTYPE html>
<html>

<head>
    <title>Shopping list</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        input[type=submit] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['list'])) {
        $_SESSION['list'] = array();
    }
    $total_cost = 0;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = isset($_POST["name"]) ? $_POST["name"] : '';
        $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0;
        $price = isset($_POST["price"]) ? $_POST["price"] : 0;
        $index = -1;

        $_POST["index"] = 1;
        $_POST["index"] = $index;

        if (isset($_POST["add"])) {
            $_SESSION['list'][$name] = array('name' => $name, 'quantity' => $quantity, 'price' => $price, 'index' => $index);
            $index++;
        }
        if (isset($_POST["update"][$index])) {

            $_SESSION['list'][$name]['quantity'] = $quantity;
            $_SESSION['list'][$name]['price'] = $price;
            echo "Ítem actualizado.";
        }

        if (isset($_POST["delete"][$index])) {
            unset($_SESSION["list"][$name]);
        }
    }
    ?>
    <?php
    if (isset($_POST["total"])) {

        foreach ($_SESSION['list'] as $item) {
            $total_cost += $item['quantity'] * $item['price'];
        }
    }

    ?>
    <h1>Shopping list</h1>
    <form method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="name" value="<?php $name = isset($_POST["name"]) ? $_POST["name"] : ''; ?>">
        <br>
        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo isset($_POST["quantity"]) ? $quantity : $quantity = "cantidad"; ?>">
        <br>
        <label for="price">price:</label>
        <input type="number" name="price" id="price" value="<?php echo  isset($_POST["price"]) ?  $price : $precio = "precio"; ?>">
        <br>
        <input type="hidden" name="index" value="<?php //echo  isset($_POST["index"]) ?  $index : "No existe"; 
                                                    ?>">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="reset" value="Reset">
    </form>
    <!--   <p style="color:red;"><?php echo $error; ?></p>
    <p style="color:green;"><?php echo $message; ?></p> -->
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>quantity</th>
                <th>price</th>
                <th>cost</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['list'] as $index => $item) { ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                            <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                            <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" name="edit" value="Edit">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><?php echo isset($total_cost) ?  $total_cost : ""; ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="total" value="Calculate Total">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- <?php // session_destroy();
            ?> -->
</body>