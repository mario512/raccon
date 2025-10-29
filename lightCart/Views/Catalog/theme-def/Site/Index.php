<div class="wrapper">
    <div class="content_wrap">
        <div class="homepage_wrap">
            <div class="ccenter home_exchange">
                <form method="post" class="ajax_post_bids" action="#">
                    <input type="hidden" name="" id="js_cur_from" value="">
                    <input type="hidden" name="" id="js_cur_to" value="">
                    <div class="xchange_type_table tbl5">
                        <div class="xchange_type_table_ins">
                            <div class="xchange_type_table_ins_title"><?php echo $dataPage['text_title_page_index']; ?></div>
                            <div class="xtt_table_wrap">
                                <div class="xtt_table_body_wrap">
                                    <div class="xtt_html_abs" style="display: none;"></div>
                                    <div class="xtt_left_col_table js_col_one">
                                        <div class="xtt_left_col_icon">
                                            <div class="title"><?php echo $dataPage['text_title_form_left']; ?></div>
                                            <div id="xtt_left_col_container" class="fixed">
                                                <div class="hexch_curs_line" id="hexch_curs_line_sum1">
                                                    <div class="hexch_curs_input js_wrap_error js_wrap_error_br ">
                                                        <div class="mobile_title"></div><input type="text" id="input_give" name="sum1" autocomplete="off" cash-id="sum" data-decimal="5" class="js_sum_val js_decimal js_sum1 cache_data" value="1">
                                                        <div id="com_give_block_select_currency">
                                                            <div id="com_give_block_btn_currency" class="flex vcenter right loaded">
                                                                <div class="currency_code"></div>
                                                                <div class="currency_logo"><span style=""></span></div>
                                                            </div>
                                                            <div id="com_give_select_currency"></div>
                                                        </div>
                                                        <div class="js_error js_sum1_error"></div>
                                                    </div>
                                                </div>
                                                <div class="hexch_curs_line js_viv_com1" style="display: none;" id="hexch_curs_line_sum12" style="display: none;">
                                                    <div class="hexch_curs_label">
                                                        <div class="hexch_curs_label_ins">
                                                            <?php echo $dataPage['text_fine']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="hexch_curs_input hexch_sum_input js_wrap_error js_wrap_error_br "><input type="text" id="input_give_com" name="" autocomplete="off" class="js_sum_val js_decimal js_sum1c" data-decimal="5" value="1">
                                                        <div class="js_error js_sum1c_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="currency_input_title"><?php echo $dataPage['text_currency_out']; ?></div>
                                            <div class="xtt_left_col_icon_ins">
                                                <div class="tbl_icon js_icon_left js_icon_left_0 active" data-type="0" style="">
                                                    <div class="tbl_icon_ins">
                                                        <div class="tbl_icon_abs"></div><?php echo $dataPage['text_teb_currency_all']; ?>
                                                    </div>
                                                </div>
                                                <!-- start category -->
                                                <?php if ($dataPage['category_currency_out']) { ?>
                                                    <?php foreach ($dataPage['category_currency_out'] as $categoryOut) { ?>
                                                        <div class="tbl_icon js_icon_left js_icon_left_<?php echo $categoryOut['currency_cat_code'] ?>" data-type="<?php echo $categoryOut['currency_cat_code'] ?>" style="">
                                                            <div class="tbl_icon_ins">
                                                                <div class="tbl_icon_abs"></div><?php echo $categoryOut['currency_cat_code'] ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <!-- end category -->
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="xtt_left_col_table_ins">
                                            <div class="btn_close"></div>
                                            <div class="xtt_left_incol_title">
                                                <div class="xtt_table_title1">
                                                    <span><?php echo $dataPage['text_select_system']; ?></span>
                                                </div>
                                            </div>
                                            <?php if ($dataPage['currency_in']) { ?>
                                                <?php foreach ($dataPage['currency_in'] as $currency) { ?>
                                                    <div class="js_item_left js_item_left_<?php echo $currency['currency_code']; ?>" data-id="<?php echo $currency['currency_id']; ?>" data-currency-code="<?php echo $currency['currency_code']; ?>" data-currency="<?php echo $currency['currency_name']; ?>" style="">
                                                        <div class="xtt_one_line_left flex vcenter">
                                                            <div class="xtt_one_line_ico">
                                                                <div class="currency_logo"><span style="background-image: url(<?php echo $currency['currency_image']; ?>);"></span></div>
                                                            </div>
                                                            <div class="xtt_one_line_name_left">
                                                                <div class="xtt_one_line_name">
                                                                    <?php echo $currency['currency_name']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="xtt_right_col_table js_col_one">
                                        <div class="xtt_right_col_icon">
                                            <div class="title"><?php echo $dataPage['text_summ_in']; ?></div>
                                            <div id="xtt_right_col_container" class="fixed">
                                                <div class="hexch_curs_line" id="hexch_curs_line_sum2">
                                                    <div class="hexch_curs_input js_wrap_error js_wrap_error_br ">
                                                        <div class="mobile_title"></div><input type="text" id="input_get" name="" autocomplete="off" class="js_sum_val js_decimal js_sum2" data-decimal="2" value="">
                                                        <div id="com_get_block_select_currency">
                                                            <div id="com_get_block_btn_currency" class="flex vcenter right loaded">
                                                                <div class="currency_code"></div>
                                                                <div class="currency_logo"><span style=""></span></div>
                                                            </div>
                                                            <div id="com_get_select_currency"></div>
                                                        </div>
                                                        <div class="js_error js_sum2_error"></div>
                                                    </div>
                                                </div>
                                                <div class="hexch_curs_line js_viv_com2" id="hexch_curs_line_sum22">
                                                    <div class="hexch_curs_label">
                                                        <div class="hexch_curs_label_ins">
                                                            <?php echo $dataPage['text_summ_fine']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="hexch_curs_input hexch_sum_input js_wrap_error js_wrap_error_br "><input type="text" id="input_get_com" name="" autocomplete="off" class="js_sum_val js_decimal js_sum2c" data-decimal="2" value="" >
                                                        <div class="js_error js_sum2c_error"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="currency_input_title"><?php echo $dataPage['text_currency_in']; ?></div>
                                            <div class="xtt_right_col_icon_ins">
                                                <div class="tbl_icon active js_icon_right js_icon_right_0" data-type="0" style="">
                                                    <div class="tbl_icon_ins">
                                                        <div class="tbl_icon_abs"></div><?php echo $dataPage['text_teb_currency_all']; ?>
                                                    </div>
                                                </div>
                                                <!-- start category -->
                                                <?php if ($dataPage['category_currency_in']) { ?>
                                                    <?php foreach ($dataPage['category_currency_in'] as $categoryIn) { ?>
                                                        <div class="tbl_icon js_icon_right js_icon_right_<?php echo $categoryIn['currency_cat_code']; ?>" data-type="<?php echo $categoryIn['currency_cat_code']; ?>" style="">
                                                            <div class="tbl_icon_ins">
                                                                <div class="tbl_icon_abs"></div><?php echo $categoryIn['currency_cat_code']; ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <!-- end category -->
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="xtt_right_col_table_ins">
                                            <div class="btn_close"></div>
                                            <div class="xtt_right_incol_title">
                                                <div class="xtt_table_title2">
                                                    <span><?php echo $dataPage['text_select_system']; ?></span>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div id="xtt_right_col_html">
                                                <!-- one item -->
                                                <?php if ($dataPage['currency_out']) { ?>
                                                    <?php foreach ($dataPage['currency_out'] as $currencyOut) { ?>
                                                        <a href="" class="js_exchange_link js_item_right js_item_right_<?php echo $currencyOut['currency_category_code']; ?>" data-direction-id="<?php echo $currencyOut['currency_id']; ?>" data-currency-code="<?php echo $currencyOut['currency_category_code']; ?>" data-currency="<?php echo $currencyOut['currency_code']; ?>">
                                                            <div class="xtt_one_line_right flex vcenter">
                                                                <div class="flex left vcenter">
                                                                    <div class="xtt_one_line_ico">
                                                                        <div class="currency_logo"><span style="background-image: url(<?php echo $currencyOut['currency_image'] ?>);"></span></div>
                                                                    </div>
                                                                    <div class="xtt_one_line_name_right">
                                                                        <div class="xtt_one_line_name">
                                                                            <?php echo $currencyOut['currency_name'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="xtt_one_line_reserv_right">
                                                                    <div class="xtt_one_line_reserv">
                                                                        <span class="js_check_reserve" data-reserve="" data-rate=""></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="xtt_data_col_clear"></div>
                                    <div class="xtt_data_col_table js_col_one">
                                        <div class="xtt_data_col_table_ins">
                                            <div class="title"><?php echo $dataPage['text_calc']; ?></div>
                                            <div class="htable_ajax_wrap">
                                                <div class="group1157"></div>
                                                <div class="group1162"></div>
                                                <div class="htable_ajax_wrap_abs js_exchange_widget_abs" style="display: none;"></div>
                                                <div id="hexch_html"><input type="hidden" name="direction_id" class="js_direction_id" value="">
                                                    <div class="hexch_widget">
                                                        <div class="notice_message">
                                                            <div class="notice_message_ins">
                                                                <div class="notice_message_abs"></div>
                                                                <div class="notice_message_close"></div>
                                                                <div class="notice_message_title">
                                                                    <div class="notice_message_title_ins">
                                                                        <span><?php echo $dataPage['text_title_аttention']; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="notice_message_text">
                                                                    <div class="notice_message_text_ins">
                                                                        <p><?php echo $dataPage['text_attention']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="hexch_div">
                                                            <div class="hexch_div_ins" style="display: none;">
                                                                <div class="yellow_block">
                                                                    <div class="hexch_information">
                                                                        <div class="hexch_information_line"><span class="hexh_line_label"><?php echo $dataPage['text_info_summ_price']; ?></span>:</div>
                                                                        <div class="hexch_information_line"><span class="hexh_line_label"><span class="js_curs_html"> </span></span></div>
                                                                    </div>
                                                                    <div class="hexch_left">
                                                                        <div class="hexch_title">
                                                                            <div class="hexch_title_ins">
                                                                                <div class="hexch_title_logo currency_logo"><span style=""></span></div>
                                                                                <span class="hexch_psys"></span>
                                                                                <div class="summa"><span id="summa1"></span> <span class="currency"></span></div>
                                                                                <div class="clear"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="hexch_txt_line">
                                                                            <p class="span_give_max"><span class="js_amount" data-id="sum1" data-val="min">min</span>, <span class="js_amount" data-id="sum1" data-val="max">max</span></p>
                                                                        </div>
                                                                        <div class="hexch_comis_line js_viv_com1" style="display: none;">
                                                                            <span class="js_comis_text1"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="arrow_bottom"></div>
                                                                    <div class="hexch_right">
                                                                        <div class="hexch_title">
                                                                            <div class="hexch_title_ins">
                                                                                <div class="hexch_title_logo currency_logo"><span style=""></span></div>
                                                                                <span class="hexch_psys"></span>
                                                                                <div class="summa"><span id="summa2"></span> <span class="currency"></span></div>
                                                                                <div class="clear"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="hexch_txt_line">
                                                                            <p class="span_get_max"><span class="js_amount" data-id="sum2" data-val="77.67">min.: 77.6 UAH</span>, <span class="js_amount" data-id="sum2" data-val="14465.96">max.: 14 465.9 UAH</span></p>
                                                                        </div>
                                                                        <div class="hexch_comis_line js_viv_com2" style="display: none;">
                                                                            <span class="js_comis_text2"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clear" id="form-exchange"></div>
                                                                <!-- form change -->
                                                                <?php $dataPage['form_exchange']->getFormExchange();?>
                                                                <!-- end form change -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="home_text_wrap">
                <div class="ccenter">
                    <div class="home_text_abs"></div>
                    <div class="home_text_block">
                        <div class="home_text_title">Приветствуем на сайте обменного пункта!</div>
                        <div class="home_text_div">
                            <div class="text">
                                <p>Наш online сервис Myxa.cc ценит время своих клиентов и обеспечивает безопасность проведения обмена, так как создан с учётом самых новых технологий в сфере защиты информации.<br>
                                    Это предельно простой в пользовании сервис, где каждый гость можете стать участником партнерской программы и совершать обмен на более выгодных условиях, просто пройдя регистрацию на сайте.</p>
                                <p>На нашем сайте 24/7 можно быстро пополнить электронные кошельки и вывести средства на банковский счёт либо карту:<br>
                                    — провести автообмен Qiwi, Payeer, Юmoney, Global24, Visa / MasterСard с Privat24 и Монобанк на Сбербанк, ВТБ, Тинькофф и другие;<br>
                                    — вывести средства с балансов мобильных операторов Киевстар и Vodafone;<br>
                                    — пополнить счёт телефона и баланс PariMatch, PokerMatch, SlotoKing.</p>
                                <p>Myxa.cc — надежный партнёр при работе с электронными деньгами и, учитывая пожелания клиентов, по-прежнему продолжает совершенствоваться.<br>
                                    Приятных обменов!</p>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_reserv_wrap">
                <div class="group1202"></div>
                <div class="group1189"></div>
                <div class="group1188"></div>
                <div class="home_reserv_ins">
                    <div class="home_reserv_abs"></div>
                    <div class="home_reserv_block">
                        <div class="ccenter">
                            <div class="home_reserv_title"><?php echo $dataPage['text_reserve_currency']; ?></div>
                            <div class="home_reserv_many">
                                <!-- reserve currency -->
                                <div class="home_reserv_many_ins flex wrap">
                                    <?php if ($dataPage['reserve']) { ?>
                                        <?php foreach ($dataPage['reserve'] as $reserve) { ?>
                                            <div class="one_home_reserv ">
                                                <div class="one_home_reserv_ins flex vcenter">
                                                    <div class="currency_logo">
                                                        <span style="background-image: url(<?php echo $reserve['currency_image']; ?>);"></span>
                                                    </div>
                                                    <div class="one_home_reserv_block flex">
                                                        <div class="one_home_reserv_title">
                                                            <?php echo $reserve['currency_name']; ?> </div>
                                                        <div class="one_home_reserv_sum">
                                                            <span class="summa"><?php echo $reserve['currency_reserv']; ?></span>
                                                            <span class="currency"><?php echo $reserve['currency_code']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <!-- end reserve curency -->
                            </div>
                            <div class="home_reserv_more_wrap">
                                <a href="#" class="home_reserv_more" data-no="<?php echo $dataPage['text_button_get_all']; ?>" data-yes="<?php echo $dataPage['text_button_hide']; ?>"><?php echo $dataPage['text_button_get_all']; ?></a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_news_wrap">
                <div class="ccenter">
                    <div class="home_news_block">
                        <div class="home_news_title"><?php echo $dataPage['text_title_news']; ?></div>
                        <div class="home_news_div_wrap">
                            <!-- start news -->
                            <div class="home_news_div flex wrap">
                                <?php if ($dataPage['news']) { ?>
                                    <?php foreach ($dataPage['news'] as $news) { ?>

                                        <div class="home_news_one ">
                                            <div class="home_news_one_abs"></div>
                                            <div class="home_news_one_ins">
                                                <div class="home_news_one_title"><a href="<?php echo $news['news_href']; ?>" title="<?php echo $news['news_title']; ?>"><?php echo $news['news_title']; ?></a></div>
                                                <div class="home_news_one_date"><?php echo $news['news_date']; ?></div>
                                                <div class="clear"></div>
                                                <div class="home_news_one_content"><a href="<?php echo $news['news_href']; ?>" title="<?php echo $news['news_title']; ?>"><?php echo $news['news_text']; ?></a></div>
                                                <div class="home_news_one_next"><a href="<?php echo $news['news_href']; ?>" title="<?php echo $dataPage['text_href_news']; ?>"><?php echo $dataPage['text_href_news']; ?></a></div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <!-- end news -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_reviews_wrap">
                <div class="ccenter">
                    <div class="home_reviews_abs"></div>
                    <div class="home_reviews_block">
                        <div class="home_reviews_title">
                            <?php echo $dataPage['text_label_reviews']; ?>
                        </div>
                        <div class="home_reviews_div_wrap">
                            <div class="home_reviews_div">
                                <div class="group1201"></div>
                                <div class="flex wrap">
                                    <!-- start reviews -->
                                    <?php if ($dataPage['reviews']) { ?>
                                        <?php foreach ($dataPage['reviews'] as $reviews) { ?>
                                            <div class="home_reviews_one ">
                                                <div class="home_reviews_one_ins">
                                                    <div class="home_reviews_abs"></div>
                                                    <div class="home_reviews_user_name"><?php echo $reviews['reviews_author']; ?></div>
                                                    <div class="home_reviews_content"><?php echo $reviews['reviews_text']; ?></div>
                                                    <div class="home_reviews_date"><?php echo $reviews['reviews_date']; ?></div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- end reviews -->
                                </div>
                            </div>
                        </div>
                        <div class="home_reviews_more_wrap">
                            <a href="<?php echo $dataPage['href_reviews']; ?>" class="home_reviews_more"><?php echo $dataPage['text_label_href_all_reviews']; ?></a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_lchange_wrap">
                <div class="group1205"></div>
                <div class="group1204"></div>
                <div class="group1203"></div>
                <div class="ccenter">
                    <div class="home_lchange_block">
                        <div class="home_lchange_title"><?php echo $dataPage['text_change_last_change']; ?></div>
                        <div class="home_lchange_div_wrap">
                            <div class="home_lchange_div flex wrap">
                                <?php if ($dataPage['last_data_change']) { ?>
                                    <?php foreach ($dataPage['last_data_change'] as $lastChange) { ?>
                                        <div class="home_lchange_one">
                                            <div class="home_lchange_one_ins">
                                                <div class="home_lchange_date"><?php echo $lastChange['date_change']; ?></div>
                                                <div class="home_lchange_body flex">
                                                    <div class="home_lchange_why">
                                                        <div class="home_lchange_ico currency_logo">
                                                            <span style="background-image: url(<?php echo $lastChange['image_in']; ?>);"></span>
                                                        </div>
                                                        <div class="home_lchange_txt">
                                                            <div class="home_lchange_sum"><?php echo $lastChange['total_out']; ?></div>
                                                            <div class="home_lchange_name"><?php echo $lastChange['code_in']; ?></div>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="home_lchange_why">
                                                        <div class="home_lchange_ico currency_logo">
                                                            <span style="background-image: url(<?php echo $lastChange['image_out']; ?>);"></span>
                                                        </div>
                                                        <div class="home_lchange_txt">
                                                            <div class="home_lchange_sum"><?php echo $lastChange['total_in']; ?></div>
                                                            <div class="home_lchange_name"><?php echo $lastChange['code_cat_out']; ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>