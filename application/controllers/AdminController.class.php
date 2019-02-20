<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/models/AdminModel.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/validation.php';

/**
 * class AdminController
 * Класс-контроллер для админской части
 */

class AdminController
{
    /**
     * Метод, для вызова соответсвующего метода модели
     */
    static function callModelMethod()
    {
        switch ($_POST['data_action']) {
            case 'del_color':
                AdminModel::delColor($_POST['color_del']);
                break;
            case 'del_user':
                AdminModel::delUser($_POST['data_id']);
                break;
            case 'del_request':
                AdminModel::delRequest($_POST['data_id']);
                break;
            case 'update_settings':
                AdminModel::updateSettings($_POST['price_m2'], $_POST['priсe_lamp'], $_POST['price_corner'], $_POST['price_glossy_texture'], $_POST['price_light'], $_POST['price_matte_texture'], $_POST['price_pipe']);
                break;
            case 'add_user':
                AdminModel::addUser($_POST['login'],$_POST['password']);
                break;
            case 'add_color':
                AdminModel::addColor($_POST['color_add']);
                break;
            case 'change_user':
                AdminModel::changeUser($_POST['login'],$_POST['password'],$_POST['id_change_user_hidden']);
                break;
        }
    }
}
validation($_POST);
AdminController::callModelMethod();

