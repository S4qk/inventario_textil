<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Rollo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h2>Agregar nuevo rollo</h2>
    <form action="" method="POST">
      <div class="mb-3">
        <label>Tipo de tela:</label>
        <input type="text" name="tipo_tela" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Color:</label>
        <input type="text" name="color" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Largo (m):</label>
        <input type="number" step="0.1" name="largo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Fecha de ingreso:</label>
        <input type="date" name="fecha_ingreso" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Agregar</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Volver</a>
  </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO rollos (tipo_tela, color, largo, fecha_ingreso) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $_POST['tipo_tela'], $_POST['color'], $_POST['largo'], $_POST['fecha_ingreso']);
    $stmt->execute();
    echo "<script>alert('Rollo agregado exitosamente'); window.location='agregar.php';</script>";
}
?>
