<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inventario actual</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Inventario actual</h2>

    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Tipo de Tela</th>
          <th>Color</th>
          <th>Metros Disponibles</th>
          <th>Fecha Ingreso</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT r.tipo_tela, r.color, r.fecha_ingreso,
                       r.largo - IFNULL(SUM(v.metros_vendidos), 0) AS disponible
                FROM rollos r
                LEFT JOIN ventas v ON r.id = v.rollo_id
                GROUP BY r.id
                ORDER BY disponible DESC";

        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
              <td>{$row['tipo_tela']}</td>
              <td>{$row['color']}</td>
              <td>{$row['disponible']} m</td>
              <td>{$row['fecha_ingreso']}</td>
            </tr>";
        }
        ?>
      </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Volver</a>
  </div>
</body>
</html>
