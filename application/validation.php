<?php

/**
 * Метод, для валидации данных
 */
function validation($info) {

    foreach ($info as $value) {
        $value = htmlspecialchars(trim($value));
    }
    return $info;
}