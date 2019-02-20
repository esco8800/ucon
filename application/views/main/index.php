<div class="content">
		<div class="container">
			<form action="" method="POST" id="form">
				<div class="row d-flex flex-wrap">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 order-2 order-md-1">
						<div class="itog">
							<div class="itog_price">
								<span class="itog_header">Итоговая цена:</span>
								<br>
								<div class="price">
                                    <output name="itog_price">
									    0
                                    </output>
                                    рублей
								</div>
							</div>
							<label for="sity" class="itog_label">Город доставки:</label>
							<select name="sity" id="sity">
							  <option data-display="Выберите город">Выберите город</option>
							  <option value="Ростов-на-Дону">Ростов-на-Дону</option>
							  <option value="Москва">Москва</option>
							  <option value="Липецк">Липецк</option>
							  <option value="Шахты">Шахты</option>
							  <option value="Омск">Омск</option>
							</select>
								<label for="datepicker" class="itog_label">Дата рождения:</label>
								<label class="icon_date" for="datepicker"><i class="fas fa-calendar-alt"></i></label>
								<input  id="datepicker" class="input_itog" type="text" name="birthday" placeholder="Выберите дату">
							<label for="phone" class="itog_label">Телефон:</label>
							<input id="phone" class="input_itog" type="tel" name="phone">
							<button id="button" class="button" type="submit">Оставить заявку</button>
							<br>
							
								<input id="check" class="checkbox" type="checkbox" name="pd" value="1"/>
								<label for="check" class="itog_label">
									Я согласен на <a href="#">обработку персональных данных</a>
								</label>
							
						</div>
					</div>
                    <div class="rov">
                        <div class="col">
                            <div class="modal_form"><!-- Сaмo oкнo -->
                                <span class="modal_close"><i class="cross fas fa-times"></i></span> <!-- Кнoпкa зaкрыть -->
                                <span class="modal_head">Спасибо за заявку!</span>
                                <p>Спасибо за Вашу заявку. Наш менеджер свяжется с Вами в ближайшее время!</p>
                            </div>
                        </div>
                    </div>
                    <div class="overlay"></div><!-- Пoдлoжкa -->
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 order-1 order-md-2">
						<div class="calc">
							<h1><i class="fas fa-calculator"></i>Калькулятор расчета стоимости</h1>
							<div class="container">
								<div class="row flex-wrap calc_text_div">
									<div class="col-xl-6 col-ld-6 col-md-6 col-sm-6 col-xs-12 order-1" >
										<span class="calc_header">Характеристики:</span>
										<label class="square" for="square">Площадь потолка:</label>
										<div class="float-right">
										<input id="square" class="calc_input" type="text" name="square" size="5">
											м<sup>2</sup>
										</div>
										<br><br>
										Количество
										<div class="calc_kol">
											<label class="calc_text" for="svet">светильников:</label>
											<div class="float-right">
												<input id="svet" class="calc_input" type="text" name="svetilnik" size="5">
												 шт
											</div>
											<br><br>
											<label class="calc_text" for="lus">люстр:</label>
											<div class="float-right">
												<input id="lus" class="calc_input" type="text" name="lustr" size="5">
												 шт
											</div>
											<br><br>
											<label class="calc_text" for="trub">труб:</label>
											<div class="float-right">
												<input id="trub" class="calc_input" type="text" name="truba" size="5">
												 шт
											</div>
											<br><br>
											<label class="calc_text" for="ugol">углов:</label>
											<div class="float-right">
												<input id="ugol" class="calc_input" type="text" name="ugol" size="5">
												 шт
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-ld-4 col-md-4 col-sm-4 col-xs-12 order-2 calc_factura_color">
										<span class="calc_header">Фактура:</span>
										<div class="form_group">
											<label class="chb-fix-param">
												<input type="radio" checked="checked" name="calc-fct" class="calc_input_fact" value="1"/>
												<div class="radio__text">
													глянцевая
												</div>
											</label>
											<br/>

											<label class="chb-fix-param">
												<input type="radio" name="calc-fct" class="calc_input_fact" value="2"/>
												<div class="radio__text">
													матовая
												</div>
											</label>
										</div>
										
										<span class="calc_header">Цвет:</span>
										<div class="form_group form_group_check">
                                            <? foreach ($color as $value): ?>
                                                <label class="chb-fix-param">
												<input type="radio" name="calc-radio" value="<?=$value ?>"/>
												<div class="radio__text">
													<?=$value ?>
												</div>
                                                </label>
                                                <br/>
                                            <? endforeach; ?>
                                            <input type="hidden" name="hidden_action" value="add_request">
                                            <input type="hidden" name="hidden_price" value="get_price">
										</div>

										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>