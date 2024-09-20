<?php
require 'config/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'gasto') {
    // Verificar si están presentes los datos del formulario
    if (isset($_POST['cantidad_gasto'], $_POST['fecha_gasto'], $_POST['tipo_gasto'], $_POST['gasto_modificado'])) {
        // Recoger los datos del formulario
        $cantidad_gasto = $_POST['cantidad_gasto'];
        $fecha_gasto = $_POST['fecha_gasto'];
        $tipo_gasto = $_POST['tipo_gasto'];
        $descripcion_gasto = $_POST['gasto_modificado']; // Descripción modificada por JS

        // Llamada a la función para agregar el gasto en la base de datos
        agregarGasto($cantidad_gasto, $fecha_gasto, $descripcion_gasto);
    }
}

