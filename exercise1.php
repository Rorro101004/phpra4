<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supermarket Management</title>
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

    // Inicialización de variables de sesión si no existen
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
            if ($product === 'milk' || $product === 'softDrink') {
                $_SESSION[$product] += $quantity;
            } else {
                echo "Producto no encontrado";
            }
        } elseif (isset($_POST["remove"])) {
            if ($product == 'milk' || $product == 'softDrink') {
                $_SESSION[$product] = max(0, $_SESSION[$product] - $quantity);
            } else {
                echo "Producto no encontrado";
            }
        }
    }
    session_destroy();
    ?>

    <h1>Supermarket Management</h1>
    <form method="post">
        <label for="el_nombre">Worker: 
            <?php echo htmlspecialchars($_SESSION["el_nombre"]); ?>
        </label>
        <input type="text" name="el_nombre">
        <h2>Choose product</h2>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="softDrink">Soft Drink</option>
        </select>
        <h2>Select product quantity</h2>
        <input type="number" name="quantity" min="1" required>
        <br>
        <input type="submit" name="add" value="Add">
        <input type="submit" name="remove" value="Remove">
        <input type="reset" value="Reset">
    </form>

    <h2>Inventario</h2>
    <p>Worker: <?php echo htmlspecialchars($_SESSION["el_nombre"]); ?></p>
    <p>Units of Milk: <?php echo htmlspecialchars($_SESSION["milk"]); ?></p>
    <p>Units of Soft Drink: <?php echo htmlspecialchars($_SESSION["softDrink"]); ?></p>
</body>

</html>
