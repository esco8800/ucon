$(document).ready(function() {
    $(".input_add").mask("AAAAAAAAAAAAAAAAAA");
    $(".input_setting").mask("999999");

    /*Отправляем аякз запрос на добавление пользователя, добавляем строку в таблицу и выводимм модалку*/

    $('.add_user_button').on('click', function() {
        event.preventDefault();
        var data= $(this).closest("form").serialize();
        var login=$('input.input_add[name=login]').val();
        var password=$('input.input_add[name=password]').val();

        console.log(login);
        console.log(password);

        if ((login.length>=5) && (password.length>=5)){ //Проветка на валидацию полей

            $.ajax({
                url: 'application/controllers/AdminController.class.php',
                type: "POST",
                data: data,
                success: function (result) {
                    if (result != 0) {

                        $('.alert_modal')
                            .css('display', 'block')
                            .animate({opacity: 1, top: '5%'}, 200);
                        setTimeout(function () {
                            $('.alert_modal')
                                .animate({opacity: 0, top: '3%'}, 200,
                                    function () {
                                        $(this).css('display', 'none');
                                    }
                                );
                        }, 1500);

                        $('.input_add').val('');
                        $(".table_user_add").append(result);
                    } else alert("Такой пользователь уже есть");
                }
            });
        }
        else alert("Логин и пароль должны быть более 5 символов");
    });

    /*Отправляем аякз запрос на сохранение настроек и выводимм модалку*/

    $('.add_setting_button').on('click', function() {
        event.preventDefault();
        var data= $(this).closest("form").serialize();
        $.ajax({
            url: 'application/controllers/AdminController.class.php',
            type: "POST",
            data: data,
            success: function (data) {
                $('.alert_modal')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '5%'}, 200);
                setTimeout(function () {
                    $('.alert_modal')
                        .animate({opacity: 0, top: '3%'}, 200,
                            function(){
                                $(this).css('display', 'none');
                            }
                        );
                }, 1500);
            }
        });
    });


    /*Удаление цвета*/

    $('.option_color').on('click', '.color_cross', function() {

        var color_del=$(this).prev().text();
        var data_action=$(this).data("action");
        console.log(color_del);

        $(this).prev().remove();
        $(this).prev().detach();
        $(this).remove();
        $(this).detach();

        $.ajax({
            url: 'application/controllers/AdminController.class.php',
            type: "POST",
            data: {
                color_del: color_del,
                data_action: data_action
            }
        });
    });

    /*Окно добавления цвета*/

    /*Действия при нажатии на плюсик и на строку "добавить цвет"*/

    $('.add_color_span, .add_icon').on('click', function() {
            $('.modal_form')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);

    });
    $('.modal_close, .color_button').on('click', function() {
        event.preventDefault();
        $('.modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                }
            );
    });

    /*Действия при нажатии на кнопку добавить*/

    $('.color_button').on('click', function() {
        var color_add=$('.input_color').val();
        var colors=$(".option_color").text();
        var data_action=$(this).data("action");
        if (colors.indexOf(color_add)==-1){
            $("<br><span>"+color_add+"</span><i data-action='del_color' class=\"color_cross fas fa-times\">").appendTo(".option_color"); // Вставка span после всеми div
        }
        $.ajax({
            url: 'application/controllers/AdminController.class.php',
            type: "POST",
            data: {
                color_add: color_add,
                data_action: data_action
            },
            success: function (data) {
                if (data==1) {
                    alert("Такой цвет есть!");
                }
            }
        });
        $('.input_color').val('');
    });

    /*Удаление строки таблицы пользователи по клику и из базы*/

    $('.table_user').on('click','.table_closs', function() {
        $(this).closest("tr").remove();
        $(this).closest("tr").detach();

        var data_action=$(this).data("action");
        var data_id=$(this).data("id");

        $.ajax({
            url: 'application/controllers/AdminController.class.php',
            type: "POST",
            data: {
                data_action:  data_action,
                data_id: data_id
            }
        });
    });

    /*Удаление строки таблицы заявки по клику и из базы*/

    $('.table_cross').on('click', function() {
        $(this).closest("tr").remove();
        $(this).closest("tr").detach();

        var data_action=$(this).data("action");
        var data_id=$(this).data("id");

        $.ajax({
            url: 'application/controllers/AdminController.class.php',
            type: "POST",
            data: {
                data_action:  data_action,
                data_id: data_id
            }
        });
    });

    /*Изменение данных*/
    $('.table_user_add').on('click','.table_edit', function() {
        var id_user=$(this).closest("tr").children().eq(0).text();
        var login_user=$(this).parent().parent().children().next().text();


        $('.modal_change_form')
            .css('display', 'block')
            .animate({opacity: 1, top: '50%'}, 200);
            $(".modal_info").text("Редактирование пользователя с id " + id_user);
            $('input.input_color[name=login]').val(login_user);
            $('input.input_color[name=id_change_user_hidden]').val(id_user);
    });


    $('.modal_close,.user_change_button').on('click', function() {
        event.preventDefault();
        $('.modal_change_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                }
            );
    });

    $('.user_change_button').on('click', function() {
        var data= $(this).closest("form").serializeArray();
        var data_action=$(this).data("action");
        data.push({name:"data_action",value:data_action});
        var id_user= $('input.input_color[name=id_change_user_hidden]').val();
        var login_change=$('input.input_color[name=login]').val();
        var password_change=$('input.input_color[name=password]').val();

        if ((login_change.length>=5) && ((password_change.length==0) || (password_change.length>=5))) { //Проветка на валидацию полей

            $("tr[data-id=" + id_user + "]").children().eq(1).text(login_change); // Динамически добавляем элемиент


            $.ajax({
                url: 'application/controllers/AdminController.class.php',
                type: "POST",
                data: data,
                success:function (data) {
                    $('.alert_modal')
                        .css('display', 'block')
                        .animate({opacity: 1, top: '5%'}, 200);
                    setTimeout(function () {
                        $('.alert_modal')
                            .animate({opacity: 0, top: '3%'}, 200,
                                function(){
                                    $(this).css('display', 'none');
                                }
                            );
                    }, 1500);
                }
            });
        }
        else {
            alert("Логин и пароль должны быть не менее 5 символов");
        }
    });



    $('.login_button').on('click', function() {
        event.preventDefault();
        var result='<br><span class="error_auth">Пароль или логин не верный!</span>';
        var data= $(this).closest("form").serialize();
        var login=$('input.input_add[name=login_auth]').val();
        var password=$('input.input_add[name=pass_auth]').val();


        if ((login.length>0) && (password.length>0)) {

            $.ajax({
                url: 'application/controllers/AccountController.class.php',
                type: "POST",
                data: data,

                success:function (data) {
                    if (data==1){
                        window.location.href = "/admin.php"
                    }
                    else {
                        $(".login_button").append(result);
                    }
                }
            });

        }
        else {
            alert("Заполните логин и пароль!");
        }

    });
});

