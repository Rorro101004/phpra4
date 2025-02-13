<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["array_numeros"])) {
    $_SESSION["array_numeros"] = array(10, 15, 20);
}
$array_numeros = $_SESSION["array_numeros"];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $posicion = $_POST["posicion"];
    $valor = $_POST["valor"];
    $_SESSION["posicion"] = $posicion;
    $_SESSION["valor"] = $valor;
    if (isset($_POST["valor"])&&isset($_POST["modify"])) {
        $_SESSION["array_numeros"][$_SESSION["posicion"]] = $valor;
        
        echo "Valor modificado ".$valor." de la posicion ".$posicion;
    }
    if (isset($_POST["average"])) {
        $suma_total = 0;
        for ($i=0; $i < count($array_numeros) ; $i++) { 
            $suma_total += $array_numeros[$i];
        }
        $suma_media = $suma_total/3;
        echo "El valor medio es de ".$suma_media;
    }
    $array_numeros = $_SESSION["array_numeros"];
    
}   
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label for="pos">Posicion a modificar</label>
        <select name="posicion">
            <option value="0">Posicion 0</option>
            <option value="1">Posicion 1</option>
            <option value="2">Posicion 2</option>
        </select>
        <br>
        <br>

        <label>Nuevo valor</label>
        <input type="number" name="valor" min="1">
        <br>
        <input type="submit" name="modify" value="Modify">
        <input type="submit" name="average" value="Average">
        <input type="reset">
        <br>
        <?php echo "<br>";
        echo "Array actual: ";
        for ($i = 0; $i < count($array_numeros); $i++) {
            echo  $array_numeros[$i] . ",";
        } ?>
    </form>
</body>

</html>