jQuery(function ($) {

	$('.ajax_post_form').ajaxForm({
		dataType: 'json',
		beforeSubmit: function (a, f, o) {
			f.addClass('thisactive');
			$('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled', true);
			$('.thisactive').find('.ajax_submit_ind').show();
		},
		error: function (res, res2, res3) {
			console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
			for (key in res) {
				console.log(key + ' = ' + res[key]);
			}
		},
		success: function (res) {
			console.log(res);
			if (res['status'] == 'error') {
				if (res['status_text']) {
					$('.thisactive .resultgo').html('<div class="resultfalse"><div class="resultclose"></div>' + res['status_text'] + '</div>');
				}
			}
			if (res['status'] == 'success') {
				if (res['status_text']) {
					$('.thisactive .resultgo').html('<div class="resulttrue"><div class="resultclose"></div>' + res['status_text'] + '</div>');
				}
			}

			if (res['clear']) {
				$('.thisactive input[type=text]:not(.notclear), .thisactive input[type=password]:not(.notclear), .thisactive textarea:not(.notclear)').val('');
			}

			if (res['show_hidden']) {
				$('.thisactive .hidden_line').show();
			}

			if (res['url']) {
				window.location.href = res['url'];
			}

			if (res['ncapt1']) {
				$('.captcha1').attr('src', res['ncapt1']);
			}


			$('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled', false);
			$('.thisactive').find('.ajax_submit_ind').hide();
			$('.thisactive').removeClass('thisactive');
		}
	});

	if (self != top && window.parent.frames.length > 0) {
		$('.not_frame').remove();
	}

});


jQuery(function ($) {

	var res_timer = 1;
	function start_res_timer() {
		$('.res_timer').html('0');

		if (res_timer == 1) {
			res_timer = 0;
			setInterval(function () {
				if ($('.res_timer').length > 0) {
					var num_t = parseInt($('.res_timer').html());
					num_t = num_t + 1;
					$('.res_timer').html(num_t);
				}
			}, 1000);
		}
	}

	$('#check_rule_step').on('change', function () {
		if ($(this).prop('checked')) {
			$('#check_rule_step_input').prop('disabled', false);
		} else {
			$('#check_rule_step_input').prop('disabled', true);
		}
	});

	$('#check_rule_step_input').on('click', function () {
		$(this).parents('.ajax_post_form').find('.resultgo').html('<div class="resulttrue">Идет обработка. Пожалуйста подождите (<span class="res_timer">0</span>)</div>');
		start_res_timer();
	});

	$('.iam_pay_bids').on('click', function () {
		if (!confirm("Вы уверены, что уже оплатили заявку?")) {
			return false;
		}
	});

});
jQuery(function ($) {

	function qrCodeShow() {
		//$('.js_qr_code>canvas').remove();
			$('.js_qr_code').each(function () {
				var thet = $(this);
				$(thet).qrcode({
					size: parseInt(thet.attr('data-size')),
					text: thet.attr('data-code')
				});
			});
		
	}
	qrCodeShow();
	if ($('.check_payment_hash').length > 0) {
		var nowdata = 0;
		var redir = 0;
		function check_payment_now() {
			var second = parseInt($('.check_payment_hash').attr('data-time'));
			nowdata = parseInt(nowdata) + 1;
			$('.block_check_payment_abs').html(nowdata);
			$('.block_check_payment').show();
			var wid = $('.block_check_payment').width();
			if (wid > 1) {
				var onepr = wid / second;
				var nwid = onepr * nowdata;
				if (nwid > wid) { nwid = wid; }
				$('.block_check_payment_ins').animate({ 'width': nwid }, 500);
			}

			if (nowdata >= second) {
				nowdata = 0;
				
					$('#exchange_status_html').load(document.URL +  ' #exchange_status_html', function (){
						qrCodeShow();
					});
					$('.block_check_payment_abs').html('0');
				if (redir == 0) {
					var durl = $('.check_payment_hash').attr('data-hash');
					redir = 1;
					if (durl.length > 0) {
						
						
						
					}
				}
			}
		}
		setInterval(check_payment_now, 1000);
	}
	
	

	$(document).on('click', '.merch_paybutton', function (e){
		$('.exchange_status_abs').show();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			//url: '',
			data: 'auto_check=' + $('.merch_paybutton').attr("on-off"),
			error: function (res, res2, res3) {
				console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
				for (key in res) {
					console.log(key + ' = ' + res[key]);
				}
			},
			success: function (res) {
								
				if (res['status'] == 'success') {
					if (res['auto_check'] == '0') {
						$('.check_payment_hash, .block_check_payment').remove();
						$('.merch_paybutton').attr("on-off",'0').text(res['text_button']);
						$('.block_warning_merch_ins>p').text(res['text_info']);
						
					} else {
						$('.check_payment_hash, .block_check_payment').remove();
						if (res['html_block_ins']) {
							$('.block_check_payment').after(res['html_block_ins']);
						}
						if (res['html_block_hash']) {
							$('.exchange_status_html').after(res['html_block_hash']);
						}
						$('.merch_paybutton').attr("on-off", '1').text(res['text_button']);
						$('.block_warning_merch_ins>p').text(res['text_info']);
						$('#exchange_status_html').load(document.URL +  ' #exchange_status_html', function () {
							qrCodeShow();
						});
						
					}
					
					
				}
				$('.exchange_status_abs').hide();
			}
		});
		return false;
		
	})
	
})

jQuery(function ($) {
	$(document).on('click', '.js_window_login', function () {
		$(document).JsWindow('show', {
			window_class: 'update_window',
			title: 'Авторизация',
			content: $('.loginform_box_html').html(),
			insert_div: '.loginform_box',
			shadow: 1
		});

		var new_url = window.location.href;
		$('input[name=return_url]').val(new_url);

		return false;
	});
});

jQuery(function ($) {
	$(document).on('click', '.js_window_join', function () {
		$(document).JsWindow('show', {
			window_class: 'update_window',
			title: 'Регистрация',
			content: $('.registerform_box_html').html(),
			insert_div: '.registerform_box',
			shadow: 1
		});

		var new_url = window.location.href;
		$('input[name=return_url]').val(new_url);

		return false;
	});
});
jQuery(function ($) {
	var clipboard = new ClipboardJS('.pn_copy');
	clipboard.on('success', function (e) {
		
		$('.pn_copy').removeClass('copied');
		$(e.trigger).addClass('copied');
		var wallet = $('.pn_copy');
		$('.wallet').removeClass('resultfalse').addClass('resulttrue');
	});
});
jQuery(function ($) {
	$(document).on('focusin', '.has_tooltip input, .has_tooltip textarea', function () {
		$(this).parents('.has_tooltip').addClass('showed');
	});
	$(document).on('click', '.field_tooltip_label', function () {
		$(this).parents('.has_tooltip').addClass('showed');
	});
	$(document).on('focusout', '.has_tooltip input, .has_tooltip textarea', function () {
		$(this).parents('.has_tooltip').removeClass('showed');
	});
});

jQuery(function ($) {
	$('.oncetoggletitle').on('click', function () {
		$(this).parents('.oncetoggle').toggleClass('active');
		return false;
	});
});

jQuery(function ($) {
	$(".promo_menu li a").on('click', function () {
		if (!$(this).hasClass('act')) {
			$(".pbcontainer, .promo_menu li").removeClass('act');
			$(".pbcontainer").filter(this.hash).addClass('act');
			$(this).parents('li').addClass('act');
		}
		return false;
	});

	$(".bannerboxlink a").on('click', function () {
		var text = $(this).text();
		var st = $(this).attr('show-title');
		var ht = $(this).attr('hide-title');
		if (text == st) {
			$(this).html(ht);
		} else {
			$(this).html(st);
		}
		$(this).parents(".bannerboxone").find(".bannerboxtextarea").toggle();
		$(this).toggleClass('act');

		return false;
	});
});



jQuery(function ($) {

	$(document).on('click', '.js_reserv', function () {
		$(document).JsWindow('show', {
			window_class: 'update_window',
			title: 'Запрос резерва "<span id="reserv_box_title"></span>"',
			content: $('.reserv_box_html').html(),
			insert_div: '.reserv_box',
			shadow: 1
		});

		var title = $(this).attr('data-title');
		var id = $(this).attr('data-id');
		$('#reserv_box_title').html(title);
		$('#reserv_box_id').attr('value', id);

		return false;
	});

});

jQuery(function ($) {

	function create_icons() {

		$('.js_icon_left').hide();
		$('.js_icon_left:first').show();

		$('.js_icon_left').each(function () {
			var vtype = $(this).attr('data-type');
			if ($('.js_item_left_' + vtype).length > 0) {
				$('.js_icon_left_' + vtype).show();
			}
		});

		$('.js_icon_right').hide();
		$('.js_icon_right:first').show();

		$('.js_icon_right').each(function () {
			var vtype = $(this).attr('data-type');
			if ($('.js_item_right_' + vtype + ':visible').length > 0) {
				$('.js_icon_right_' + vtype).show();
			}
		});

		if ($('.js_icon_right.active:visible').length == 0) {
			$('.js_item_right').show();
			$('.js_icon_right').removeClass('active');
			$('.js_icon_right:first').addClass('active');
		}
	}

	function go_active_left_col() {

		if ($('.xtt_html_abs').length > 0) {
			if ($('.js_item_left:visible.active').length == 0 || $('.js_item_left:visible.active').length > 1) {
				if ($(window).width() > 559) {
					$('.js_item_left').removeClass('active');
				}
				$('.js_item_left:visible:first').addClass('active');
			} 

			active = $('.js_item_left.active');
			$('#com_give_block_btn_currency .currency_code').text(active.data('currency-code'));
			$('#xtt_left_col_container .mobile_title').text(active.data('currency'));
			$('#com_give_block_btn_currency .currency_logo').html(active.find('.currency_logo span').clone());
			$('#com_give_block_btn_currency').addClass('loaded');

			var valid = active.attr('data-id');
			var cur_to = $('#js_cur_to').val();
			$('.xtt_html_abs').show();
			var param = 'id=' + valid + '&cur_to=' + cur_to;



			create_icons();


			$.ajax({
				type: "POST",
				url: "currency/price-" + active.data('currency-code'),
				dataType: 'json',
				data: param,

				success: function (res) {
					$('.xtt_html_abs').hide();
					if (res['status'] == 'success') {
						$('#xtt_right_col_html').html(res['html']);

						$('#hexch_html .hexch_left .currency_logo').html(active.find('.currency_logo span').clone());
						$('#hexch_html .hexch_left .hexch_psys').text(active.data('currency'));
						$('#hexch_html .hexch_left .currency').text(active.data('currency-code'));




					}
					create_icons();
				}
			});
		}

	}
	go_active_left_col();

	$(document).on('click', ".js_item_left", function () {
		if (!$(this).hasClass('active')) {
			$('.xtt_left_col_table_ins .btn_close').trigger('click');
			$(".js_item_left").removeClass('active');
			$(this).addClass('active');
			go_active_left_col();
		}
		return false;
	});

	$(document).on('click', ".js_icon_left", function () {
		if (!$(this).hasClass('active')) {
			var vtype = $(this).attr('data-type');
			$(".js_icon_left").removeClass('active');
			$(this).addClass('active');
			if (vtype == 0) {
				$('.js_item_left').show();
			} else {
				$('.js_item_left').hide();
				$('.js_item_left_' + vtype).show();
			}
			go_active_left_col();
		}
		return false;
	});

	$(document).on('click', ".js_icon_right", function () {
		console.log($(this).hasClass('active'));
		if (!$(this).hasClass('active')) {
			var vtype = $(this).attr('data-type');
			$(".js_icon_right").removeClass('active');
			$(this).addClass('active');
			if (vtype == 0) {
				$('.js_item_right').show();
			} else {
				$('.js_item_right').hide();
				$('.js_item_right_' + vtype).show();
			}
		}
		return false;
	});

	$(document).on('click', ".xtt_title_link", function () {
		$('.xtt_title_link').removeClass('active');
		$(this).addClass('active');

		var id = $(this).attr('data-id');

		Cookies.set("table5_select", id, { expires: 7, path: '/' });

		$('.js_check_reserve').each(function () {
			var data_now = $(this).attr('data-reserve');
			if (id == 'rate') {
				data_now = $(this).attr('data-rate');
			}
			$(this).html(data_now);
		});

		return false;
	});

	$('#com_give_block_btn_currency').on('click', function () {
		$('.xtt_right_col_icon_ins').attr({
			style: 'display: none'
		}).removeClass('opened');
		$('.xtt_left_col_table_ins').attr({
			style: 'display: block;'
		}).addClass('opened');


	});
	$('#com_get_block_btn_currency').on('click', function () {
		$('.xtt_left_col_table_ins').attr({
			style: 'display: none;'
		}).removeClass('opened');
		$('.xtt_right_col_table_ins').attr({
			style: 'display: block'
		}).addClass('opened');
	});
	$('.btn_close').on('click', function () {
		$('.opened').attr({
			style: 'display: none'
		}).removeClass('opened');
	});
});
/* /wp-content/plugins/premiumbox/plugin/directions/widget.php */

jQuery(function ($) {

	if ($('#hexch_html').length > 0) {
		$(document).on('click', '.js_exchange_link', function () {
			$('.xtt_right_col_table_ins .btn_close').trigger('click');
			
			if (!$(this).hasClass('active')) {

				$('.js_exchange_link').removeClass('active');
				$(this).addClass('active');
				active = $(this);

				var direction_id = $(this).attr('data-direction-id');

				$('.js_exchange_widget_abs').show();
				$('.hexch_div_ins').show();

				var tscroll = $('#hexch_html').offset().top - 100;
				$('body,html').animate({ scrollTop: tscroll }, 500);


				$.ajax({
					type: "POST",
					url: "currency/board",
					dataType: 'json',
					error: function (res, res2, res3) {
						console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
						for (key in res) {
							console.log(key + ' = ' + res[key]);
						}
					},
					success: function (res) {
						if (res['html']) {

						
						$(document).find('#hexch_curs_line_sum1, #hexch_curs_line_sum12').appendTo('#xtt_left_col_container');
						$(document).find('#hexch_curs_line_sum2, #hexch_curs_line_sum22').appendTo('#xtt_right_col_container');

						if ($('#hexch_curs_line_sum12').css('display') != $('#hexch_curs_line_sum22').css('display')) {
							$('#xtt_left_col_container, #xtt_right_col_container').addClass('fixed');
						} else {
							$('#xtt_left_col_container, #xtt_right_col_container').removeClass('fixed');
						}

						active_give = $('.js_item_left.active');

						$('#com_give_block_btn_currency .currency_code').text(active_give.data('currency-code'));
						$('#xtt_left_col_container .mobile_title').text(active_give.data('currency'));
						$('#com_give_block_btn_currency .currency_logo').html(active_give.find('.currency_logo span').clone());
						$('#com_give_block_btn_currency').addClass('loaded');

						$('#com_get_block_btn_currency .currency_code').text(active.data('currency-code'));
						$('#xtt_right_col_container .mobile_title').text(active.data('currency'));
						$('#com_get_block_btn_currency .currency_logo').html(active.find('.currency_logo span').clone());
						$('#com_get_block_btn_currency').addClass('loaded');

						$('#hexch_html .hexch_right .currency_logo').html(active.find('.currency_logo span').clone());
						$('#hexch_html .hexch_right .hexch_psys').text(active.data('currency'));
						$('#hexch_html .hexch_right .currency').text(active.data('currency-code'));

						$('.hexch_curs_input .account1').html($('#hexch_html .hexch_left .hexch_title_logo span').clone());
						$('.hexch_curs_input .account2').html($('#hexch_html .hexch_right .hexch_title_logo span').clone());
						$('#input_give').removeAttr('js-change-input-uniq').trigger('change');

					}
						setTimeout(function () {
							$('#summa1').empty().html($('#input_give').val());
							$('#summa2').empty().html($('#input_get_com').val());
							}, 100);
						if (res['status'] == 'error') {
							$('#hexch_html').html('<div class="resultfalse"><div class="resultclose"></div>' + res['status_text'] + '</div>');
						}
						$(document).JTimer();

						jQuery(function ($) {
							$('.js_qr_code').each(function () {
								var thet = $(this);
								$(thet).qrcode({
									size: parseInt(thet.attr('data-size')),
									text: thet.attr('data-code')
								});
							});
						});
						$(document).Jselect();
						$(document).JcheckboxInit();
						$('.js_exchange_widget_abs').hide();
					}
				});

			}

			return false;
		});
	}
});

jQuery(function ($) {
	$(document).on('click', '.js_hnotice_close', function () {
		var id = $(this).parents('.js_hnotice').attr('id').replace('hnotice_', '');
		var exp_day = parseInt($(this).attr('data-exp'));
		Cookies.set("hm" + id, 1, { expires: exp_day, path: '/' });

		$('#hnotice_' + id).hide();
	});

	$(document).on('click', '.wn_div_submit', function () {
		var id = $(this).attr('data-id');
		var exp_day = parseInt($(this).attr('data-exp'));
		Cookies.set("hm" + id, 1, { expires: exp_day, path: '/' });
		$(this).parents('.wn_wrap').hide();
	});
});

jQuery(function ($) {
	/* help exchange */
	$(document).on('focusin', '.js_window_wrap', function () {
		$(this).addClass('showed');
	});
	$(document).on('focusout', '.js_window_wrap', function () {
		$(this).removeClass('showed');
	});
	/* end help exchange */
});

jQuery(function ($) {

	function checknumbr(mixed_var) {
		return (mixed_var == '') ? false : !isNaN(mixed_var);
	}

	$(document).on('change', 'select, input:not(.js_sum_val)', function () {
		$(this).parents('.js_wrap_error').removeClass('error');
	});
	$(document).on('click', 'input, select', function () {
		$(this).parents('.js_wrap_error').removeClass('error');
	});

	$(document).on('click', '.js_amount', function () {
		var amount = $(this).attr('data-val');
		var id = $(this).attr('data-id');
		$('input.js_' + id + ':not(:disabled)').val(amount).trigger('change');
		$('.js_' + id + '_html').html(amount);
	});

	$(document).on('click', '.ajax_post_bids input[type=submit]', function () {
		var count_window = $('.window_message').length;
		if (count_window > 0) {

			$(document).JsWindow('show', {
				window_class: 'update_window',
				close_class: 'js_direction_window_close',
				title: 'Внимание!',
				content: $('.window_message').html(),
				shadow: 1,
				enable_button: 1,
				button_title: 'OK',
				button_class: 'js_window_close js_direction_window_close'
			});

			return false;
		}
	});

	$(document).on('click', '.js_direction_window_close', function () {
		$('.ajax_post_bids').submit();
	});

	function add_error_field(id, text) {
		$('.js_' + id).parents('.js_wrap_error').addClass('error');
		if (text.length > 0) {
			$('.js_' + id + '_error').html(text).show();
		}
	}
	function remove_error_field(id) {
		$('.js_' + id).parents('.js_wrap_error').removeClass('error');
	}

	var res_timer = '';
	function start_res_timer() {

		$('.res_timer').html('0');
		clearInterval(res_timer);

		res_timer = setInterval(function () {
			if ($('.res_timer').length > 0) {
				var num_t = parseInt($('.res_timer').html());
				num_t = num_t + 1;
				$('.res_timer').html(num_t);
			}
		}, 1000);
	}

	$('.ajax_post_bids').ajaxForm({
		url:'exchange/go-check',
		dataType: 'json',
		beforeSubmit: function (a, f, o) {
			f.addClass('thisactive');
			$('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled', true);
			$('.ajax_post_bids_res').html('<div class="resulttrue">Идет обработка. Пожалуйста подождите (<span class="res_timer">0</span>)</div>');

			start_res_timer();

			$('.ajax_post_bids_res').find('.js_wrap_error').removeClass('error');

		},
		error: function (res, res2, res3) {
			$('.ajax_post_bids_res').html('<div class="resultfalse">Ошибка базы данных</div>');
			console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
			for (key in res) {
				console.log(key + ' = ' + res[key]);
			}
		},
		success: function (res) {
			console.log(res);
			if (res['error_fields']) {
				$.each(res['error_fields'], function (index, value) {
					add_error_field(index, value);
				});
			}
			if (res['status'] && res['status'] == 'error') {
				$('.ajax_post_bids_res').html('<div class="resultfalse"><div class="resultclose"></div>' + res['status_text'] + '</div>');
				if (res['status_code'] == '2') {
					if ($('.js_wrap_error.error').length > 0) {
						var ftop = $('.js_wrap_error.error:first').offset().top - 100;
						$('body,html').animate({ scrollTop: ftop }, 500);
					}
				}

			}
			if (res['status'] && res['status'] == 'success') {
				$('.ajax_post_bids_res').html('<div class="resulttrue"><div class="resultclose"></div>' + res['status_text'] + ' (<span class="res_timer">0</span>)</div>');
				start_res_timer();
			}

			if (res['url']) {
				setTimeout(function () {
					window.location.href = res['url'];
				}, 1000);
			}

			if (res['ncapt1']) {
				$('.captcha1').attr('src', res['ncapt1']);
			}
			if (res['ncapt2']) {
				$('.captcha2').attr('src', res['ncapt2']);
			}
			if (res['nsymb']) {
				$('.captcha_sym').html(res['nsymb']);
			}

			$('.thisactive input[type=submit], .thisactive input[type=button]').attr('disabled', false);
			$('.thisactive').removeClass('thisactive');
		}
	});

	function calc_set_value(the_obj, the_num) {
		$(the_obj).val(the_num);
	}

	function calc_set_html(the_obj, the_num) {
		$(the_obj).html(the_num);
	}

	function go_exchange_calc(sum, dej) {

		var id = $('.js_direction_id:first').val();
		var currency_in = $('#com_give_block_btn_currency .currency_code').text();
		var currency_out = $('#com_get_block_select_currency .currency_code').text();
		var active_out_id = $('.js_item_right.active ').attr('data-direction-id');
		var param = '&sum=' + sum + '&dej=' + dej + '&cur_in=' + currency_in + '&cur_out=' + currency_out + '&cur_out_id=' + active_out_id;
		
		$('.exch_ajax_wrap_abs, .js_exchange_widget_abs, .js_loader').show();

		$.ajax({
			type: "POST",
			url: "/currency/check",
			data: param,
			dataType: 'json',
			error: function (res, res2, res3) {
				console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
				for (key in res) {
					console.log(key + ' = ' + res[key]);
				}
			},
			success: function (res) {
				
				
				console.log(res);
				if (dej !== 1) {
					calc_set_value('input.js_sum1', res['sum1']);
					calc_set_html('.js_sum1_html', res['sum1']);


				}
				if (dej !== 2) {
					calc_set_value('input.js_sum2', res['sum2']);
					calc_set_html('.js_sum2_html', res['sum2']);
				}
				if (dej !== 3) {
					calc_set_value('input.js_sum1c', res['sum1c']);
					calc_set_html('.js_sum1c_html', res['sum1c']);
				}
				if (dej !== 4) {
					calc_set_value('input.js_sum2c', res['sum2c']);
					calc_set_html('.js_sum2c_html', res['sum2c']);
				}

				$('.js_comis_text1').html(res['comis_text1']);
				$('.js_comis_text2').html(res['comis_text2']);

				remove_error_field('sum1');
				remove_error_field('sum2');
				remove_error_field('sum1c');
				remove_error_field('sum2c');

				
				if (res['error_fields']) {
					$.each(res['error_fields'], function (index, value) {
						add_error_field(index, value);
					});
				}

				
				if (res['curs_html'] && res['curs_html'].length > 0) {
					$('.js_curs_html').html(res['curs_html']);
					$('input.js_curs_html').val(res['curs_html']);
				}
				if (res['reserv_html'] && res['reserv_html'].length > 0) {
					$('.js_reserv_html').html(res['reserv_html']);
					$('input.js_reserv_html').val(res['reserv_html']);
				}
				if (res['user_discount'] && res['user_discount'].length > 0) {
					$('.js_direction_user_discount').html(res['user_discount']);
					$('input.js_direction_user_discount').html(res['user_discount']);
				}
				if (res['viv_com1'] && res['viv_com1'] == 1) {
					$('.js_viv_com1').show();
				} else {
					$('.js_viv_com1').hide();
				}
				if (res['viv_com2'] && res['viv_com2'] == 1) {
					$('.js_viv_com2').show();
				} else {
					$('.js_viv_com2').hide();
				}

				if ($('.verifybysum').length > 0) {
					if (res['sum1']) {
						var verifybysum = $('.verifybysum').val().replace(/,/g, '.');
						verifybysum = verifybysum * 1;
						var res_sum1 = res['sum1'] * 1;
						if (checknumbr(verifybysum)) {
							if (res_sum1 >= verifybysum) {
								$('.verifybysum_wrap').show();
								add_error_field('sum1', 'пройдите верификацию личности');
								add_error_field('sum2', 'пройдите верификацию личности');
								add_error_field('sum1c', 'пройдите верификацию личности');
								add_error_field('sum2c', 'пройдите верификацию личности');
							} else {
								$('.verifybysum_wrap').hide();
							}
						}
					}
				}
				$('#summa1').empty().html($('#input_give').val());
				$('#summa2').empty().html($('#input_get_com').val());
				
				$('.exch_ajax_wrap_abs, .js_exchange_widget_abs, .js_loader').hide();
			},
			
		});
		
	}

	function go_calc(obj, f_id) {
		var vale = obj.val().replace(/,/g, '.');
		if (checknumbr(vale)) {

			if (f_id == 1) {
				$('input.js_sum1:not(:focus)').val(vale);
				$('.js_sum1_html').html(vale);
			} else if (f_id == 2) {
				$('input.js_sum2:not(:focus)').val(vale);
				$('.js_sum2_html').html(vale);
			} else if (f_id == 3) {
				$('input.js_sum1c:not(:focus)').val(vale);
				$('.js_sum1c_html').html(vale);
			} else if (f_id == 4) {
				$('input.js_sum2c:not(:focus)').val(vale);
				$('.js_sum2c_html').html(vale);
			}
			
			go_exchange_calc(vale, f_id);
		} else {
			obj.parents('.js_wrap_error').addClass('error').find('.js_error').hide();
		}
	}

	$(document).ChangeInput({
		trigger: '.js_sum1',
		success: function (obj) {
			go_calc(obj, 1);

		}
	});

	$(document).ChangeInput({
		trigger: '.js_sum2',
		success: function (obj) {
			go_calc(obj, 2);
		}
	});

	
	function set_input_decimal(obj) {
		var dec = obj.attr('data-decimal');
		var sum = obj.val().replace(new RegExp(",", 'g'), '.');
		var len_arr = sum.split('.');
		var len_data = len_arr[1];
		if (len_data !== undefined) {
			var len = len_data.length;
			if (len > dec) {
				var new_data = len_data.substr(0, dec);
				obj.val(len_arr[0] + '.' + new_data);
			}
		}
	}

	$(document).ChangeInput({
		trigger: '.js_decimal',
		success: function (obj) {
			set_input_decimal(obj);
		}
	});

});
jQuery(function ($) {
	$('.widget_reserv_filter').on('click', function () {
		$('.widget_reserv_filter').removeClass('current');
		$(this).addClass('current');
		var id = $(this).attr('data-id');
		$('.widget_reserv_vt').hide();
		$('.widget_reserv_vt_' + id).show();

		return false;
	});
});
jQuery(function ($) {
	$(document).ready(function () {
		$('#com_get_block_btn_currency span').remove();
	});
})