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

    $errores = [];

    $op1 = param('op1');
    $op2 = param('op2');
    $op  = param('op');

    try {
        comprobarParametros($errores);
        comprobarErrores($errores);
        comprobarValores($op1, $op2, $op, OPS);
        calcular($op1, $op2, $op);
    } catch (Exception $e) {
        foreach ($errores as $error) {
            echo $error;
        }
    }
    ?>
    
    <form action="" method="get">
        <label for="op1">Primer operando:</label>
        <input type="text" id="op1" name="op1" value="<?= $op1 ?>">
        <br>
        <label for="op2">Segundo operando:</label>
        <input type="text" id="op2" name="op2" value="<?= $op2 ?>">
        <br>
        <label for="op">Operación:</label>
        <input type="text" id="op" name="op" value="<?= $op ?>">
        <br>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>
