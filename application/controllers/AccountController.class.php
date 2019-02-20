<?php

require $_SERVER['DOCUMENT_ROOT'] . '/application/core/Account.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/validation.php';

/**
 * class AccountController
 * Класс-контроллер для работы с аккаунтами
 */

class AccountController
{

    /**
     * Метод, для вызова соответсвующего метода модели
     */
    static function callModelMethod()
    {
        if ($_POST['hidden_action'] == 'login') {
            Account::enter();
        }
    }
}

validation($_POST);
AccountController::callModelMethod();