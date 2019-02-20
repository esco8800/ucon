<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/models/MainModel.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/validation.php';

/**
 * class AccountController
 * Класс-контроллер для работы с публичной частью
 */

class MainController
{
    /**
     * Метод, для вызова соответсвующего метода модели
     */
    static function callModelMethod()
    {
        if ($_POST['hidden_action'] == 'add_request') {
            MainModel::addRequest($_POST['sity'], $_POST['birthday'], $_POST['phone'], $_POST['square'], $_POST['svetilnik'], $_POST['calc_fct'], $_POST['lustr'], $_POST['truba'], $_POST['ugol'], $_POST['calc-radio']);
        }

        if ($_POST['hidden_price'] == 'get_price') {
            MainModel::calcPrice($_POST['calc_fct'], $_POST['square'], $_POST['svetilnik'], $_POST['lustr'], $_POST['truba'], $_POST['ugol']);
        }
    }


}

validation($_POST);
MainController::callModelMethod();