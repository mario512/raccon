<div class="footer_wrap">
    <div class="footer ccenter flex vcenter">
        <div class="footer_left">
            <a href="/">
                <img src="<?php echo $dataPage['logo'];?>">
            </a>
        </div>
        <div class="footer_menu">
            <ul id="menu-nizhnee-menyu-footer-menu" class="hmenu">
                <li id="menu-item-961" class="menu-item menu-item-type-post_type menu-item-object-page  first_menu_li menu-item-961"><a href="<?php echo$dataPage['href_tos'];?>"><span><?php echo $dataPage['text_tos'];?></span></a></li>
                <li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page  last_menu_li menu-item-36"><a href="<?php echo$dataPage['href_notice'];?>"><span><?php echo $dataPage['text_notice'];?></span></a></li>
            </ul>
        </div>
        <div class="footer_work">
            <div class="footer_timetable">
                <p><?php echo $dataPage['text_work_time'];?></p>
            </div>
        </div>
        <div class="footer_right">
            <div class="footer_soc">
                <a href="<?php echo $dataPage['text_telegram'];?>" class="tm" target="_blank" rel="nofollow"><?php echo $dataPage['text_telegram'];?></a>
                <a href="mailto:<?php echo $dataPage['href_email'];?>" class="email" target="_blank" rel="nofollow"><?php echo $dataPage['href_email'];?></a>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<div id="topped" class="js_to_top js_show_top" style="display: none;"><span></span></div>


<div class="loginform_box_html" style="display: none;">
    <div class="form_field_line rb_line type_input field_name_logmail has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-1-logmail"><span class="form_field_label_ins"><?php echo $dataPage['text_login_and_email'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-1-logmail" class="rb_input" autocomplete="off" name="logmail" value="" placeholder="<?php echo $dataPage['placeholder_login_and_email'];?>">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_password field_name_pass has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-1-pass"><span class="form_field_label_ins"><?php echo $dataPage['text_password'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="password" id="form_field_id-1-pass" class="rb_password" autocomplete="off" name="pass" value="" placeholder="<?php echo $dataPage['placeholder_password'];?>">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_input field_name_user_pin hidden_line has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-1-user_pin"><span class="form_field_label_ins"><?php echo $dataPage['text_user_pin'];?></span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-1-user_pin" class="rb_input" autocomplete="off" name="user_pin" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="rb_line"><input type="submit" formtarget="_top" name="submit" class="rb_submit" value="<?php echo $dataPage['text_value_login'];?>"></div>
    <div class="rb_line"><a href="#" class="js_window_join"><?php echo $dataPage['text_register'];?></a> | <a href="#"><?php echo $dataPage['text_lostpass'];?></a></div>
    <div class="resultgo"></div>
</div>
<form method="post" class="ajax_post_form" action="#">
    <input type="hidden" name="return_url" value="">
    <div class="loginform_box not_frame"></div>
</form>
<div class="registerform_box_html" style="display: none;">
    <div class="form_field_line rb_line type_input field_name_login has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-2-login"><span class="form_field_label_ins"><?php echo $dataPage['text_login'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-2-login" class="rb_input" autocomplete="off" name="login" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_input field_name_email has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-2-email"><span class="form_field_label_ins"><?php echo $dataPage['text_email'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-2-email" class="rb_input" autocomplete="off" name="email" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_password field_name_pass has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-2-pass"><span class="form_field_label_ins"><?php echo $dataPage['text_password'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="password" id="form_field_id-2-pass" class="rb_password" autocomplete="off" name="pass" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_password field_name_pass2 has_title">
        <div class="form_field_label rb_label"><label for="form_field_id-2-pass2"><span class="form_field_label_ins"><?php echo $dataPage['text_password_repeat'];?> <span class="req">*</span>:</span></label></div>
        <div class="form_field_ins rb_line_ins">
            <input type="password" id="form_field_id-2-pass2" class="rb_password" autocomplete="off" name="pass2" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="rb_line">
        <div class="checkbox"><label><input type="checkbox" name="check_rule" value="1" class="jcheckbox" style="display: none;"> <?php echo $dataPage['text_tos_label_1'];?>&nbsp;<a href="https://myxa.cc/tos/" target="_blank" rel="noreferrer noopener">&nbsp;<?php echo $dataPage['text_tos_label_2'];?></a>&nbsp;<?php echo $dataPage['text_tos_label_3'];?></label></div>
    </div>
    <div class="rb_line"><input type="submit" formtarget="_top" name="submit" class="rb_submit" value="<?php echo $dataPage['text_register'];?>"></div>
    <div class="resultgo"></div>
</div>
<form method="post" class="ajax_post_form" action="#">
    <input type="hidden" name="return_url" value="">
    <div class="registerform_box"></div>
</form>




<div class="reserv_box_html" style="display: none;">
    <div class="resultgo"></div>
    <div class="form_field_line rb_line type_input field_name_sum">
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-3-sum" placeholder="Необходимая сумма" class="rb_input" autocomplete="off" name="sum" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_input field_name_email">
        <div class="form_field_ins rb_line_ins">
            <input type="text" id="form_field_id-3-email" class="notclea rb_input" placeholder="E-mail" autocomplete="off" name="email" value="">
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="form_field_line rb_line type_text field_name_comment">
        <div class="form_field_ins rb_line_ins">
            <textarea id="form_field_id-3-comment" class="notclea rb_text" placeholder="Комментарий" autocomplete="off" name="comment"></textarea>
            <div class="form_field_errors">
                <div class="form_field_errors_ins"></div>
            </div>
        </div>
        <div class="form_field_clear rb_line_clear"></div>
    </div>
    <div class="rb_line"><input type="submit" formtarget="_top" name="submit" class="rb_submit" value="Отправить запрос"></div>
</div>
<form method="post" class="ajax_post_form" action="">
    <input type="hidden" name="id" id="reserv_box_id" value="0">
    <div class="reserv_box"></div>
</form>

<script type="text/javascript">
    jQuery(function($) {

        var auto_load = 1;

        function globalajax_timer() {

            if (auto_load == 1) {
                auto_load = 0;

                var param = 'link=%2F';

                $('.globalajax_ind').addClass('active');
                $.ajax({
                    type: "POST",
                    url: "",
                    dataType: 'json',
                    data: param,
                    error: function(res, res2, res3) {
                        //console.log('Текст ошибки, text1: ' + res2 + ',text2:' + res3);
                        for (key in res) {
                            //console.log(key + ' = ' + res[key]);
                        }
                    },
                    beforeSend: function(res, res2, res3) {},
                    success: function(res) {

                        if (res['status'] == 'success') {
                            auto_load = 1;
                        }
                        $('.globalajax_ind').removeClass('active');
                    }
                });
            }

        }
        setInterval(globalajax_timer, 60000);
        globalajax_timer();
    });
</script>