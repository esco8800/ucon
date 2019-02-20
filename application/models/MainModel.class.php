<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/core/Db.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/application/debug.php';

/**
 * class MainModel
 * Класс-модель для работы с публичной частью
 */

class MainModel
{
    /**
     * Метод для добавления заявки, отправляющий временной смс
     * @param string $sity
     * @param string $birthday
     * @param string $phone
     * @param integer $square
     * @param integer $svetilnik
     * @param integer $calc_fct
     * @param integer $lustr
     * @param integer $truba
     * @param integer $ugol
     * @param string $calc_radio - цвет
     */

    static function addRequest($sity, $birthday, $phone, $square, $svetilnik,$calc_fct, $lustr, $truba, $ugol, $calc_radio)
    {
        $mysqli = Db::getInstance();

        /*Формируем данные для бд*/

        if ($sity == 'Выберите город') {
            $sity = 'Город не выбран';
        }
        if($calc_fct == 1) {
            $fact_name = "Глянцевая";
        }
        else {
            $fact_name = "Матовая";
        }
        $today = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];

        if ($birthday == '') {
            $birthday = '0000-00-00';
        }

        $new_birthday=date("Y-m-d",strtotime($birthday));

        /*Формируем джсон и текст заявки*/

        $price = MainModel::calcPrice($calc_fct, $square, $svetilnik ,$lustr, $truba, $ugol);
        $text = [
            'Площадь потолка' => $square . " кв.м",
            'Светильников' => $svetilnik . " шт",
            'Люстр' => $lustr . " шт",
            'Труб' => $truba . " шт",
            'Углов' => $ugol . " шт",
            'Фактура' => "1" . $fact_name,
            'Цвет' => "1" . $calc_radio,
            'Итоговая цена' => $price . " руб"
        ];

        foreach ($text as $key => $val) {
            if (0+$val == 0) {
                unset($text["$key"]);
            }
        }

        $text['Цвет']=substr($text['Цвет'], 1);
        $text['Фактура']=substr($text['Фактура'], 1);

        $json_text = json_encode($text,JSON_UNESCAPED_UNICODE);
        $mysqli->query("INSERT INTO `request` (`sity_delivery`,`birthday`,`phone`,`text`,`date_request`,`ip_user`) VALUES ('$sity',' $new_birthday','$phone','$json_text','$today','$ip')");
        MainModel::sendMassage($text, $today, $ip, $sity, $birthday, $phone);
    }

    /**
     * Метод для вычисления итоговой цены
     * @param integer $calc_fct
     * @param integer $square
     * @param integer $svetilnik
     * @param integer $lustr
     * @param integer $truba
     * @param integer $ugol
     */

    static function calcPrice($calc_fct, $square, $svetilnik ,$lustr, $truba, $ugol)
    {
        $mysqli = Db::getInstance();

        $sql_query = "SELECT * FROM `settings`";
        $result_settings = $mysqli->query($sql_query);
        $row_settings = $result_settings->fetch_assoc();

        if($calc_fct == 1) {
            $fact = $row_settings['price_glossy_texture'];
        }
        else {
            $fact = $row_settings['price_matte_texture'];
        }

       $price = ($row_settings['price_m2']*$square*$fact)+($row_settings['priсe_lamp']*$svetilnik)+($row_settings['price_light']*$lustr)+($row_settings['price_pipe']*$truba)+($row_settings['price_corner']*$ugol);

        echo $price;
        return $price;
    }

    /**
     * Метод для формирования email сообщения
     * @param array $text_array
     * @param date $today
     * @param integer $ip
     * @param string $sity
     * @param string $birthday
     * @param string $phone
     */

    static function sendMassage($text_array, $today, $ip, $sity, $birthday, $phone)
    {

        $text="Город: " . $sity . "\n" . "День рождения: " . $birthday . "\n" . "Телефон: " . $phone . "\n" . "Дата заявки: " . $today . "\n" . "ip покупателя: " . $ip . "\n";
        foreach ($text_array as $key => $value) {
            $text = $text . $key . ": " . $value . "\n";
        }
        mail("mr.ilya2015@mail.ru", "Request for buyer", "$text\n");
    }

    static function getColor(){
        $mysqli = Db::getInstance();
        $result_settings = $mysqli-> getAllRecords('settings');
        $row_settings = $result_settings->fetch_assoc();
        $color = json_decode($row_settings['option_color'],true);
        return $color;
    }

}