<?php
$servername = "localhost";
$usarname = "root";
$password = "";
$dbname = "mercatodo";

$conn = new mysqli($servername, $usarname, $password, $dbname);

if($conn->connect_error){
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT c.Nombre, p.Nombre AS Producto, co.Fecha, co.UPC, co.Cantidad, (p.Precio * co.Cantidad) AS Valor_Productos FROM Cliente c JOIN Compra co ON c.DNI = co.DNI JOIN Producto p ON co.UPC = p.UPC ORDER BY co.UPC ASC;";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Compra</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Reporte de Compra</h2>

    <table>
        <tr>
            <th>Nombre del Cliente</th>
            <th>Producto</th>
            <th>Fecha de Compra</th>
            <th>Número del Pedido</th>
            <th>Cantidad</th>
            <th>Valor de los Productos</th>
        </tr>
        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row["Nombre"] . "</td>";
                echo "<td>" . $row["Producto"] . "</td>";
                echo "<td>" . $row["Fecha"] . "</td>";
                echo "<td>" . $row["UPC"] . "</td>";
                echo "<td>" . $row["Cantidad"] . "</td>";
                echo "<td>" . $row["Valor_Productos"] . "</td>";
                echo "</tr>";
            }
        }else{
            echo "<tr><td colspan='6'>No se Encontraron resultados</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>