<?php
include 'db.php';

// Si es petición POST para registrar venta, responder JSON
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');

    $rollo_id = isset($_POST['rollo_id']) ? intval($_POST['rollo_id']) : 0;
    $metros = isset($_POST['metros']) ? floatval($_POST['metros']) : 0;

    // Validaciones básicas
    if ($rollo_id <= 0) {
        echo json_encode(["success" => false, "message" => "Rollo no válido."]);
        exit;
    }
    if ($metros <= 0) {
        echo json_encode(["success" => false, "message" => "Los metros a vender deben ser mayores que cero."]);
        exit;
    }

    // Verificar disponibilidad actual
    $check = $conn->query("
        SELECT r.largo - IFNULL(SUM(v.metros_vendidos), 0) AS disponible
        FROM rollos r
        LEFT JOIN ventas v ON r.id = v.rollo_id
        WHERE r.id = $rollo_id
        GROUP BY r.id
    ");
    $row = $check->fetch_assoc();
    $disponible = $row ? floatval($row['disponible']) : 0;

    if ($metros > $disponible) {
        echo json_encode(["success" => false, "message" => "No hay suficientes metros disponibles."]);
        exit;
    }

    // Registrar la venta
    $stmt = $conn->prepare("INSERT INTO ventas (rollo_id, metros_vendidos) VALUES (?, ?)");
    $stmt->bind_param("id", $rollo_id, $metros);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Venta registrada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar la venta."]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrar Venta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="p-4">
  <div class="container">
    <h2>Registrar venta parcial</h2>

    <form id="ventaForm" method="POST" action="">
      <div class="mb-3">
        <label for="rollo" class="form-label">Seleccionar tela:</label>
        <select id="rollo" name="rollo_id" class="form-select" required>
          <option value="">-- Selecciona un rollo --</option>
          <?php
          // Mostrar solo rollos con metros disponibles
          $sql = "SELECT r.id, r.tipo_tela, r.color, (r.largo - IFNULL(SUM(v.metros_vendidos), 0)) AS disponible
                  FROM rollos r
                  LEFT JOIN ventas v ON r.id = v.rollo_id
                  GROUP BY r.id
                  HAVING disponible > 0";
          $res = $conn->query($sql);
          while ($row = $res->fetch_assoc()) {
              $disp = number_format($row['disponible'], 2);
              echo "<option value='{$row['id']}'>
                      {$row['tipo_tela']} - {$row['color']} ({$disp} m disponibles)
                    </option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="metros" class="form-label">Metros a vender:</label>
        <input type="number" step="0.1" id="metros" name="metros" class="form-control" required min="0.1" />
      </div>

      <button type="submit" class="btn btn-warning">Registrar Venta</button>
    </form>

    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("ventaForm");

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      // Validación cliente extra
      const metros = parseFloat(form.metros.value);
      if (isNaN(metros) || metros <= 0) {
        alert("Los metros a vender deben ser un número positivo.");
        return;
      }

      const formData = new FormData(form);

      fetch("vender.php", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        alert(data.message);
        if (data.success) {
          form.reset();
          // Opcional: actualizar lista de rollos (recargar select) para reflejar stock actual
          location.reload(); 
        }
      })
      .catch(() => alert("Error al registrar la venta."));
    });
  });
  </script>
</body>
</html>

