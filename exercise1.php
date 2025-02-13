<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION["softDrink"])) {
    $_SESSION["softDrink"] = 0;
}
if (!isset($_SESSION["el_nombre"])) {
    $_SESSION["el_nombre"] = "un empleado";
}
if (!isset($_SESSION["milk"])) {
    $_SESSION["milk"] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $worker = $_POST["el_nombre"];
    $product = $_POST["product"];
    $quantity = $_POST["quantity"];
    $_SESSION["el_nombre"] = $worker;

    if (isset($_POST["add"])) {
        switch ($product) {
            case 'milk':
                $_SESSION["milk"] += $quantity;
                break;
            case 'softDrink':
                $_SESSION["softDrink"] += $quantity;
                break;
            default:
                echo "Producto no encontrado";
                break;
        }
    } elseif (isset($_POST["remove"])) {
        switch ($product) {
            case 'milk':
                $_SESSION["milk"] -= $quantity;
                if ($quantity<$_SESSION["milk"]) {
                    $_SESSION["milk"] -= $quantity;
                } 
                break;
            case "softDrink":
                if ($quantity<$_SESSION["softDrink"]) {
                    $_SESSION["softDrink"] -= $quantity;
                } 
                break;
            default:
                echo "Producto no encontrado";
                break;
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Management</title>
</head>

<body>
    <h1>Supermarket Management</h1>
    <form method="post">
        <label for="el_nombre">Worker: 
            <?php if (isset($_SESSION["el_nombre"])) {
                echo $_SESSION["el_nombre"];
            } ?>
        </label>
        <input type="text" name="el_nombre">
        <h2>Choose product</h2>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="softDrink">Soft Drink</option>
        </select>
        <h2>Select product quantity</h2>
        <input type="number" name="quantity" min="1">
        <br>
        <input type="submit" name="add" value="add">
        <input type="submit" name="remove" value="remove">
        <input type="reset" value="reset">
    </form>
    <h2>Inventario</h2>
    <p>worker: <?php if (isset($_SESSION["el_nombre"])) {
            echo $_SESSION["el_nombre"];
        } ?>
    </p>
    <p>units milk: <?php if (isset($_SESSION["milk"])) {
            echo $_SESSION["milk"];
        } ?>
    </p>
    <p>units softDrink: <?php if (isset($_SESSION["softDrink"])) {
            echo $_SESSION["softDrink"];
        } ?>
    </p>
</body>

</html>
