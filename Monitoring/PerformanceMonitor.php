<?php

class PerformanceMonitor {
    private $startMemory;
    private $startTime;
    private $logFile;

    #logfile debería ser monolog o gestor de archivo de log
    public function __construct($logFile = 'performance.log') {
        $this->logFile = $logFile;
        $this->startMonitoring();
    }

    // Inicia el monitoreo capturando el tiempo y uso de memoria iniciales
    public function startMonitoring() {
        $this->startMemory = memory_get_usage();
        $this->startTime = microtime(true);
    }

    // Finaliza el monitoreo y registra los resultados en el archivo de log
    public function endMonitoring() {
        $endTime = microtime(true);
        $endMemory = memory_get_usage();
        $peakMemory = memory_get_peak_usage();

        $executionTime = $endTime - $this->startTime;
        $memoryUsed = $endMemory - $this->startMemory;

        $logMessage = "Tiempo de ejecución: " . round($executionTime, 4) . " segundos\n" .
                      "Memoria utilizada: " . $this->formatMemory($memoryUsed) . "\n" .
                      "Pico de memoria: " . $this->formatMemory($peakMemory) . "\n" .
                      "---------------------------------------------\n";

        $this->log($logMessage);
    }

    // Función para dar formato a la memoria en KB o MB
    private function formatMemory($bytes) {
        if ($bytes < 1024) return $bytes . ' bytes';
        elseif ($bytes < 1048576) return round($bytes / 1024, 2) . ' KB';
        else return round($bytes / 1048576, 2) . ' MB';
    }

    // Función de log para escribir en el archivo especificado
    private function log($message) {
        file_put_contents($this->logFile, $message, FILE_APPEND);
    }
}

?>







?>