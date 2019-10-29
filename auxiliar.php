<?php

/**
 * Devuelve el valor de un parámetro GET, o cadena vacía
 * si no existe.
 *
 * @param string $p
 * @return string
 */
function param(string $p): string
{
    return isset($_GET[$p]) ? trim($_GET[$p]) : '';
}

function calcular(&$op1, $op2, $op)
{
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
}

function comprobarParametros(&$errores)
{
    $par = ['op1', 'op2', 'op'];

    if (!empty($_GET)) {
        if (!(empty(array_diff($par, array_keys($_GET))) &&
            empty(array_diff(array_keys($_GET), $par)))) {
            $errores[] = 'Los parámetros recibidos no son los correctos.';
        }
    }
}

function comprobarValores($op1, $op2, $op, $ops)
{
    return is_numeric($op1) && is_numeric($op2) && in_array($op, $ops);
}

/**
 * Vuelca por la salida un mensaje de error.
 *
 * @param string $m
 * @return void
 */
function mensajeError(string $m): void
{ ?>
    <div class="error"><?= $m ?></div><?php
}

function comprobarErrores($errores)
{
    if (!empty($errores)) {
        throw new Exception();
    }
}
