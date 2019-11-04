<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculadora</title>
</head>
<body>
    <?php
    require __DIR__ . '/auxiliar.php';

    const OPS = ['+', '-', '*', '/'];
    const PAR = ['op1' => '', 'op2' => '', 'op' => '+'];

    $errores = [];

    try {
        extract(comprobarParametros(PAR, $errores));
        comprobarErrores($errores);
        comprobarValores($op1, $op2, $op, OPS, $errores);
        comprobarErrores($errores);
        calcular($op1, $op2, $op);
    } catch (Exception $e) {
        // No se hace nada
    }

    dibujarFormulario($op1, $op2, $op);
    mostrarErrores($errores);
    ?>
</body>
</html>
