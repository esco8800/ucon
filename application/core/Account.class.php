<?php

ini_set ("session.use_trans_sid", true);
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/application/core/Db.class.php';

/**
 * class Account
 * Класс для работы с аккаунтами
 */

class Account
{
    /**
     * Метод, для проверки пользователя (гость или залогиненный юзер) и старта сессии
     * @return bool
     */
    static function guestCheck ()
    {
        if (isset($_SESSION['id'])) { //если сесcия есть
            return true;
        }

        else {  //Иначе редиректим
            header('Location: /login.php');
            exit();
            }
        }

    /**
     * Метод, для авторизации пользователя
     * @return bool
     */
    static function enter()
    {
        $mysqli = Db::getInstance();


        if ($_POST['login_auth'] != "" && $_POST['pass_auth'] != "") {
            $login = $_POST['login_auth'];
            $password = $_POST['pass_auth'];

            $result_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='$login'"); //запрашиваем строку из БД с логином, введённым пользователем

            if ($result_user->num_rows == 1) {
                $row = $result_user->fetch_assoc();
                if (password_verify($password,$row['password'])) {  //Проверка правильного пароля
                    $_SESSION['id'] = $row['id'];	//записываем в сессию id пользователя
                    echo "1";
                    return true;
                }
                else { // если не совпали
                    echo "0";
                    return false;
                }

            }
            else {
                echo "0";
                return false;
            }
        }
        echo "0";
        return false;
    }

}