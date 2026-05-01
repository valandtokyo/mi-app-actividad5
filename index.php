<?php
echo "Prueba cron funcionando<br>";

$conn = new mysqli(
    "lab-db.cmprymvijhpn.us-east-1.rds.amazonaws.com",
    "admin",
    "Admin1234",      // <-- tu password real
    "transporte_lab" // <-- tu base de datos real
);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT 
    e.id_envio,
    c.nombre AS cliente,
    v.tipo AS vehiculo,
    r.origen,
    r.destino,
    e.estado
FROM envios e
JOIN clientes c ON e.id_cliente = c.id_cliente
JOIN vehiculos v ON e.id_vehiculo = v.id_vehiculo
JOIN rutas r ON e.id_ruta = r.id_ruta;";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo $row["cliente"] . " - " . $row["estado"] . "<br>";
}
?>

