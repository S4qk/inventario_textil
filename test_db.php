<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test de Conexión a Base de Datos</h2>";

try {
    include 'db.php';
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Conexión exitosa a MySQL</p>";
        
        // Verificar si la base de datos existe
        $result = $conn->query("SHOW DATABASES LIKE 'inventario_textil'");
        if ($result->num_rows > 0) {
            echo "<p style='color: green;'>✅ Base de datos 'inventario_textil' existe</p>";
            
            // Verificar si las tablas existen
            $tables = ['rollos', 'ventas'];
            foreach ($tables as $table) {
                $result = $conn->query("SHOW TABLES LIKE '$table'");
                if ($result->num_rows > 0) {
                    echo "<p style='color: green;'>✅ Tabla '$table' existe</p>";
                    
                    // Contar registros en cada tabla
                    $count = $conn->query("SELECT COUNT(*) as total FROM $table")->fetch_assoc();
                    echo "<p style='color: blue;'>📊 Tabla '$table' tiene {$count['total']} registros</p>";
                } else {
                    echo "<p style='color: red;'>❌ Tabla '$table' NO existe</p>";
                }
            }
            
            echo "<hr>";
            echo "<h3>🎉 ¡Sistema listo para usar!</h3>";
            echo "<p><a href='index.php' style='color: blue;'>Ir al sistema de inventario</a></p>";
        } else {
            echo "<p style='color: red;'>❌ Base de datos 'inventario_textil' NO existe</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Error en la conexión</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
