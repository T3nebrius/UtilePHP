<?php

// Incluye la clase
include 'PerformanceMonitor.php';

// Crea una instancia y comienza el monitoreo
$monitor = new PerformanceMonitor();

// C�digo a monitorear
for ($i = 0; $i < 100000; $i++) {
    // Ejemplo de c�digo intensivo
    $array[] = md5($i);
}

// Termina el monitoreo y registra los resultados
$monitor->endMonitoring();
?>
