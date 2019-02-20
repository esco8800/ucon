<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/application/debug.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/application/models/MainModel.class.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/application/models/AdminModel.class.php';

    $color=MainModel::getColor();
    $mysqli = Db::getInstance();
    $user=AdminModel::getUsers();
    $row_settings=AdminModel::getSettings();
    $requests=AdminModel::getRequest();
?>

<div class="container"> 
    <div class="row">
      <div class="col">
        <div class="info_user">
          <span class="header_block">Пользователи</span>
          <table class="table_user table_user_add">
            <tr>
               <th class="column_one">ID</th>
               <th class="column_two">Логин пользователя</th>
               <th class="column_three">Действие</th>
            </tr>
              <? foreach ($user as $value): ?>
                    <tr data-id="<?=$value['id']?>">
                      <td class="column_one"><?=$value['id']?></td>
                      <td class="column_two"><?=$value['login']?></td>
                      <td class="column_three"><i data-action="change_user" data-id="<?=$value['id']?>" class="table_edit fas fa-edit"></i><i data-action="del_user" data-id="<?=$value['id']?>" class="table_closs fas fa-times"></i></td>
                    </tr>
              <? endforeach; ?>
          </table>
        </div>        
      </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="alert_modal"><!-- Сaмo oкнo -->
                <span class="modal_close"><i class="cross fas fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
                <span class="alert_head">Все получилось!</span>
            </div>

            <div class="modal_form"><!-- Сaмo oкнo -->
                <span class="modal_close"><i class="cross fas fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
                <span class="modal_head">Введите цвет</span>
                <form action="" method="POST">
                    <input class="input_color" type="text" size="15">
                    <button type="submit" data-action="add_color" class="color_button">Добавить</button>
                </form>
            </div>
            <div class="modal_change_form"><!-- Сaмo oкнo -->
                <span class="modal_close"><i class="cross fas fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
                <form action="" method="POST">
                    <span class="modal_info">Редактирование пользователя с id </span>
                    <br><br>
                    <span class="modal_head">Логин</span>
                    <br>
                    <input class="input_color" name="login" type="text" size="15">
                    <br>
                    <span class="modal_head"">Пароль</span>
                    <br>
                    <input class="input_color" name="password" type="text" size="15">
                    <br>
                    <input class="input_color" name="id_change_user_hidden" type="hidden">
                    <button type="submit" data-action="change_user" class="user_change_button">Отправить</button>
                </form>
            </div>
            <div class="overlay"></div><!-- Пoдлoжкa -->
        </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="add_user">
            <form method="POST" id="add_user" action="" name="add_user">
              <span class="header_add">Добавление нового пользователя</span>
              <br>
              <span class="top_input">Логин:</span>
              <br>
              <input class="input_add" type="text" name="login" size="25" placeholder="Логин пользователя">
              <br>
              <span class="top_input">Пароль:</span>
              <br>
              <input class="input_add" type="password" name="password" size="25" placeholder="Пароль пользователя">
              <br>
                <input type="hidden" name="data_action" value="add_user">
              <button data-action="add_user" class="add_button add_user_button type="submit">Добавить пользователя</button>
            </form>
        </div>
      </div>
    </div>

    <div class="setting_calc">
      <div class="row">
        <div class="col">
          <span class="header_block">Настройки калькулятора</span>
        </div>      
      </div>
      <div class="row d-flex flex-wrap">
        <div class="col-xl-4 col-lg-4 col-md-12 order-3 order-lg-1">
            <form class="form-calc" method="POST" action="" name="settings">
                <span class="top_input">Цена за кв.м. потолка:</span>
                <br>
                <input class="input_setting" type="text" name="price_m2" value="<?php echo $row_settings['price_m2']; ?>">
                <br>
                <span class="top_input">Цена за светильник:</span>
                <br>
                <input class="input_setting" type="text" name="priсe_lamp" value="<?php echo $row_settings['priсe_lamp']; ?>">
                <br>
                <span class="top_input">Цена за угол:</span>
                <br>
                <input class="input_setting" type="text" name="price_corner" value="<?php echo $row_settings['price_corner']; ?>">
                <br>
                <span class="top_input">Варианты цветов:</span>
                <br>
                <div class="option_color">
                    <? foreach ($color as $value): ?>
                        <br><span><span><?=$value?></span><i data-action='del_color' class="color_cross fas fa-times"></i></span>
                    <? endforeach; ?>
                </div>

                <div class="add_color">
                    <span class="add_color_span">Добавить новый цвет</span><i class="add_icon fas fa-plus"></i>
                </div>
                <button class="add_button add_setting_button" type="submit">Сохранить изменения</button>
        </div>

                <div class="col-xl-4 col-lg-4 col-md-12 order-1 order-lg-2">
                  <span class="top_input">Цена за глянцевую фактуру:</span>
                  <br>
                  <input class="input_setting" type="text" name="price_glossy_texture" value="<?php echo $row_settings['price_glossy_texture']; ?>">
                  <br>
                  <span class="top_input">Цена за люстру:<span>
                  <br>
                  <input class="input_setting" type="text" name="price_light" value="<?php echo $row_settings['price_light']; ?>">
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 order-2 order-lg-3">
                  <span class="top_input">Цена за матовую фактуру:</span>
                  <br>
                  <input class="input_setting" type="text" name="price_matte_texture" value="<?php echo $row_settings['price_matte_texture']; ?>">
                  <br>
                  <span class="top_input">Цена за трубу:</span>
                  <br>
                  <input class="input_setting" type="text" name="price_pipe" value="<?php echo $row_settings['price_pipe']; ?>">
                  <input type="hidden" name="data_action" value="update_settings">
                </div>
          </form>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="requests">
          <span class="header_block">Заявки</span>
          <table class="table_user table_request">
              <tr>
                 <th>ID</th>
                 <th>Телефон</th>
                 <th>Дата рождения</th>
                 <th>Город доставки</th>
                 <th>Текст заявки</th>
                 <th>Дата заявки</th>
                 <th>IP</th>
                 <th>Действие</th>

              </tr>
              <? foreach ($requests as $value): ?>
                    <tr>
                        <td><?=$value['id']?></td>
                        <td><?=$value['phone']?></td>
                        <td><?=$value['birthday']?></td>
                        <td><?=$value['sity_delivery']?></td>
                        <td><?=$value['text']?></td>
                        <td><?=$value['date_request']?></td>
                        <td><?=$value['ip_user']?></td>
                        <td><i data-action="del_request" data-id="<?=$value['id']?>" class="table_cross fas fa-times"></i></td>
                  </tr>
              <? endforeach; ?>


            </table>
          </div>
      </div>     
    </div>

  </div>