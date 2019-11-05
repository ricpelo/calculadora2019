<?php

function calcular($args)
{
    extract($args);

    switch ($op) {
        case '+':
            $op1 += $op2;
            break;
        
        case '-':
            $op1 -= $op2;
            break;

        case '*':
            $op1 *= $op2;
            break;

        case '/':
            $op1 /= $op2;
            break;
    }

    return compact('op1', 'op2', 'op');
}

function comprobarParametros($par, &$errores)
{
    $res = $par;
    if (!empty($_GET)) {
        if (empty(array_diff_key($par, $_GET)) &&
            empty(array_diff_key($_GET, $par))) {
            $res = array_map('trim', $_GET);
        } else {
            $errores[] = 'Los parámetros recibidos no son los correctos.';
        }
    }
    return $res;
}

function comprobarValores($args, $ops, &$errores)
{
    extract($args);

    if (!is_numeric($op1)) {
        $errores['op1'] = 'El primer operando no es un número';
    }
    if (!is_numeric($op2)) {
        $errores['op2'] = 'El segundo operando no es un número';
    }
    if (!in_array($op, $ops)) {
        $errores['op'] = 'El operador no es correcto';
    }
    if ($op == '/' && $op2 == 0) {
        $errores['op'] = 'No se puede dividir por cero.';
    }
    comprobarErrores($errores);
}

function mensajeError($campo, $errores)
{
    if (isset($errores[$campo])) {
        return <<<EOT
        <div class="invalid-feedback">
            {$errores[$campo]}
        </div>
        EOT;
    } else {
        return '';
    }
}

function comprobarErrores($errores)
{
    if (empty($_GET) || !empty($errores)) {
        throw new Exception();
    }
}

function selected($op, $o)
{
    return $op == $o ? 'selected' : '';
}

function valido($campo, $errores)
{
    if (isset($errores[$campo])) {
        return 'is-invalid';
    } elseif (!empty($_GET)) {
        return 'is-valid';
    } else {
        return '';
    }
}

function dibujarFormulario($args, $ops, $errores)
{
    extract($args);
    ?>
    <form action="" method="get">
        <div class="form-group">
            <label for="op1">Primer operando:</label>
            <input type="text"
                   class="form-control <?= valido('op1', $errores) ?>"
                   id="op1" name="op1" value="<?= $op1 ?>">
            <?= mensajeError('op1', $errores) ?>
        </div>
        <div class="form-group">
            <label for="op2">Segundo operando:</label>
            <input type="text"
                   class="form-control <?= valido('op2', $errores) ?>"
                   id="op2" name="op2" value="<?= $op2 ?>">
            <?= mensajeError('op2', $errores) ?>
        </div>
        <div class="form-group">
            <label for="op">Operación:</label>
            <select class="form-control <?= valido('op', $errores) ?>"
                    name="op">
                <?php foreach ($ops as $o): ?>
                    <option value="<?= $o ?>" <?= selected($op, $o) ?> >
                        <?= $o ?>
                    </option>
                <?php endforeach ?>
            </select>
            <?= mensajeError('op', $errores) ?>
        </div>
        <button type="submit" class="btn btn-primary">Calcular</button>
    </form>
    <?php
}
