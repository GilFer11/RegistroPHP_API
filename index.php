<?php
// Nota: La lógica PHP para conectarse a la base de datos (config.php) y el manejo de POST 
// se mantienen sin cambios, asumiendo que el archivo 'config.php' existe.
require "config.php";

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
  $fecha = $_POST["fecha"];
  $actividad = $_POST["actividad"];
  $descripcion = $_POST["descripcion"];
  $horas = $_POST["horas"];
  $responsable = $_POST["responsable"];
  $observaciones = $_POST["observaciones"];

  // Asume que $pdo está inicializado en config.php
  $stmt = $pdo->prepare("INSERT INTO registro (fecha, actividad, descripcion, horas, responsable, observaciones)
                         VALUES (?,?,?,?,?,?)");
  $stmt->execute([$fecha, $actividad, $descripcion, $horas, $responsable, $observaciones]);

  $mensaje = "Registro guardado correctamente.";
}

// Asume que $pdo está inicializado en config.php
$registros = $pdo->query("SELECT * FROM registro ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registros Diarios - Neumorfismo</title>
  <!-- Enlace al nuevo archivo de estilos -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="main-container">
    <h1 class="title">Control de Registros Diarios</h1>

    <?php if($mensaje): ?>
      <p class="msg success-msg"><?= $mensaje ?></p>
    <?php endif; ?>

    <div class="form-card">
      <h2 class="subtitle">Nuevo Registro</h2>
      <form method="POST">
        <!-- Los campos se mantienen iguales para la compatibilidad con el PHP -->
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" class="neumo-input" required>

        <label for="actividad">Actividad:</label>
        <input type="text" name="actividad" id="actividad" class="neumo-input" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="neumo-input"></textarea>

        <label for="horas">Horas:</label>
        <input type="number" name="horas" id="horas" step="0.25" class="neumo-input" required>

        <label for="responsable">Responsable:</label>
        <input type="text" name="responsable" id="responsable" class="neumo-input" required>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" class="neumo-input"></textarea>

        <button type="submit" class="neumo-button primary-button">Guardar registro</button>
      </form>
    </div>

    <h2 class="subtitle records-title">Registros Guardados</h2>
    
    <div class="table-card">
        <table class="neumo-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Actividad</th>
              <th>Horas</th>
              <th>Responsable</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($registros as $r): ?>
              <tr>
                <td><?= $r["id"] ?></td>
                <td><?= $r["fecha"] ?></td>
                <td><?= $r["actividad"] ?></td>
                <td><?= $r["horas"] ?></td>
                <td><?= $r["responsable"] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
  </div>
</body>
</html>