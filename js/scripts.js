$(document).ready(function() {
    $('select').niceSelect();
	$.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
	$("#datepicker").datepicker();
    $("#phone").mask("+7(999)999-9999",{placeholder:"+7(___)___-__-__"});
	$("#datepicker").mask("99-99-9999");
	$(".calc_input").mask("99",{placeholder:"0"});

	$(".form_group_check").children().eq(0).children().attr('checked','checked');
// Нижне меню
	if($(window).width() < 768) {
	    $(".menu_bot_head").click(function() {
	      $(this).next().slideToggle();
	    });
	}
	
	$(".menu_bot_head").on("click", function() {
		   $(this).prev().toggleClass("active");
	});

//мобильное меню

	$(".mobile_menu").on('click', function(event) {
			$(this).toggleClass('active');
			$(".mobile_menu_content").slideToggle(300);
	});

// валидация форм ajax и модальное окно

	$('#form').validate({
		ignore:":hidden",
		errorPlacement: function(error, element) {
			error.insertBefore(element);
		},

		rules: {

			birthday: {
				date: true
			},

		   phone: {
		  	 	required: true,
		  	 	minlength: 15
			},
		    pd: {
		    	required: true,
		    },

		  },
		 submitHandler: function(form) {
    		event.preventDefault();
			 $('input[name=hidden_action]').val('add_request');
    		var data= $("#form").serializeArray();

			$.ajax({
			  url: 'application/controllers/MainController.class.php',
			  type: "POST",
			  data: data,
			   success: function(data){
					$('.overlay').fadeIn(400,
					 	function(){
							$('.modal_form')
								.css('display', 'block')
								.animate({opacity: 1, top: '50%'}, 200);
						});
	            }
			});
  		 },

		  messages: {
			  birthday: {
				  required:"Введите дату корректно"
			  },
		    phone:{
				required:"Заполните телефон"
			},
		    pd:{
				required:"согласие обязательно"
			},
		  }
	});
	
	/*Закрываем модалку*/

	$('.modal_close, .overlay').on('click', function() {
		$('.modal_form')
			.animate({opacity: 0, top: '45%'}, 200,  
				function(){ 
					$(this).css('display', 'none'); 
					$('.overlay').fadeOut(400); 
				}
			);
		});

	/*Формирование цены*/

	$('.calc_input,.calc_input_fact').on('change input',function () {

		$('input[name=hidden_action]').val('0');
		var data= $("#form").serialize();


		$.ajax({
			url: 'application/controllers/MainController.class.php',
			type: "POST",
			data: data,
			success: function (result) {
				$('output[name=itog_price]').html(result);
			}
		});
	});

});
