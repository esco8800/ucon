<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/core/Db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/debug.php';

/**
 * AdminModel
 * Класс-модель для работы с админской частью
 */

class AdminModel
{
    /**
     * Метод, для обновления настроек калькулятора
     * @param integer $price_m2
     * @param integer $price_lamp
     * @param integer $price_corner
     * @param integer $price_glossy_texture
     * @param integer $price_light
     * @param integer $price_matte_texture
     * @param integer $price_pipe
     */
    static function updateSettings($price_m2,$priсe_lamp,$price_corner,$price_glossy_texture,$price_light,$price_matte_texture,$price_pipe)
    {
        $mysqli = Db::getInstance();
        $mysqli->query("UPDATE `settings` SET `price_m2`=$price_m2, `priсe_lamp`=$priсe_lamp, `price_corner`=$price_corner, `price_glossy_texture`=$price_glossy_texture, `price_light`=$price_light, `price_matte_texture`=$price_matte_texture, `price_pipe`=$price_pipe");
    }

    /**
     * Метод, для добавления цвета в бд (работаем с джсон строкой)
     * @param string $color
     */
    static function addColor($color)
    {
        $mysqli = Db::getInstance();
        $result = $mysqli->query("SELECT `option_color` FROM `settings` WHERE `id`=1");
        $row = $result->fetch_array();
        $row = json_decode($row['option_color'],true);
        if (in_array($color,$row)) {
            echo "1";
            return;
        }
        array_push($row,$color);
        $res = json_encode($row,JSON_UNESCAPED_UNICODE);
        $mysqli->query("UPDATE `settings` SET `option_color`='$res'");
    }

    /**
     * Метод, для удаления цвета из бд  (работаем с джсон строкой)
     * @param string $color_del
     */

    static function delColor($color_del)
    {
        $mysqli = Db::getInstance();
        $result = $mysqli->query("SELECT `option_color` FROM `settings` WHERE `id`=1");
        $row = $result->fetch_array();
        $row = json_decode($row['option_color'],true);
        unset($row[array_search($color_del, $row)]);
        $res = json_encode($row,JSON_UNESCAPED_UNICODE);
        $mysqli->query("UPDATE settings SET option_color='$res'");
    }

    /**
     * Метод, для добавления юзера в бд
     * @param string $login
     * @param string $password
     */

    static function addUser($login,$password)
    {
        $mysqli= Db::getInstance();
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $result_query = $mysqli->query("INSERT INTO `users` (`login`,`password`) VALUES ('$login','$pass')");
        $result_id=$mysqli->query("SELECT * FROM `users` ORDER BY `id` DESC LIMIT 1");
        $last_id = $result_id->fetch_array();

        if ($result_query == false) {
            echo "0";
            return;
        }


        $temp="
                     <tr data-id=\"$last_id[0]\">
                      <td class=\"column_one\">$last_id[0]</td>
                      <td class=\"column_two\">$_POST[login]</td>
                      <td class='column_three'><i class='table_edit fas fa-edit'></i><i data-action='del_user' data-id=\"$last_id[0]\" class='table_closs fas fa-times'></i></td>
                    </tr>
        ";
        echo $temp;
    }

    /**
     * Метод, для удаления юзера
     * @param integer $id_user
     */


    static function delUser($id_user)
    {
        $mysqli = Db::getInstance();
        $mysqli->query("DELETE FROM `users` WHERE `id`=$id_user");
    }

    /**
     * Метод, для удаления заявки
     * @param integer $data_id
     */

    static function delRequest($data_id)
    {
        $mysqli = Db::getInstance();
        $mysqli->query("DELETE FROM `request` WHERE `id`=$data_id");
    }

    /**
     * Метод, для обновления юзера
     * @param string $login
     * @param string $password
     * @param integer $id_user
     */

    static function changeUser($login,$password,$id_user)
    {
        $mysqli= Db::getInstance();
        $pass = password_hash($password,PASSWORD_DEFAULT);
        if ($password == "") {
            $mysqli->query("UPDATE `users` SET `login`='$login' WHERE `id`='$id_user'");
        }
        else {
            $mysqli->query("UPDATE `users` SET `login`='$login',`password`='$pass' WHERE `id`='$id_user'");
        }
    }

    static function getUsers(){
        $mysqli= Db::getInstance();
        $result_users = $mysqli-> getAllRecords('users');
        $user_array=[];
        while($user = $result_users->fetch_assoc()) {
            $user_array[]=$user;
        }
        return $user_array;
    }

    static function getSettings()
    {
        $mysqli= Db::getInstance();
        $result_settings = $mysqli-> getAllRecords('settings');
        $row_settings=$result_settings->fetch_assoc();
        return $row_settings;
    }

    static function  getRequest()
    {
        $mysqli = Db::getInstance();
        $result_request = $mysqli->getAllRecords('request');
        $request_array = [];

        while ($request = $result_request->fetch_assoc()) {
            $text = '';
            $text_array = json_decode($request['text'], true);
            $new_birh = date("d.m.Y", strtotime($request['birthday']));
            $request['date_request'] = date("d.m.Y H:i:s", strtotime($request['date_request']));
            foreach ($text_array as $key => $value) {
                $text = $text . $key . ": " . $value . "<br>";
            }
            if ($new_birh == '01.01.1970') {
                $new_birh = 'Дата не выбрана';
            }
            $request['text']=$text;
            $request['birthday']=$new_birh;
            $request_array[]=$request;
        }
        return $request_array;
    }

}


