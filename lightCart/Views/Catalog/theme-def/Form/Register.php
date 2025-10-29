<div class="login_widget">
    <div class="login_widget_ins">
        <form method="post" class="ajax_post_form" action="тут будет action">
            <div class="login_widget_title">
                <div class="login_widget_title_ins">
                    <?php echo $dataPage['text_label_login_form'];?>
                </div>
            </div>
            <div class="resultgo"></div>
            <div class="login_widget_body">
                <div class="login_widget_body_ins">
                    <div class="form_field_line widget_log_line type_input field_name_logmail has_title">
                        <div class="form_field_label widget_log_label"><label for="form_field_id-1-logmail"><span class="form_field_label_ins"><?php echo $dataPage['text_label_imput_login'];?> <span class="req">*</span>:</span></label></div>
                        <div class="form_field_ins widget_log_line_ins">
                            <input type="text" id="form_field_id-1-logmail" class="widget_log_input" autocomplete="off" name="logmail" value="" placeholder="<?php echo $dataPage['text_placeholder_login']?>"/>
                            <div class="form_field_errors">
                                <div class="form_field_errors_ins"></div>
                            </div>
                        </div>
                        <div class="form_field_clear widget_log_line_clear"></div>
                    </div>
                    <div class="form_field_line widget_log_line type_password field_name_pass has_title">
                        <div class="form_field_label widget_log_label"><label for="form_field_id-1-pass"><span class="form_field_label_ins"><?php echo $dataPage['text_label_imput_password'];?><span class="req">*</span>:</span></label></div>
                        <div class="form_field_ins widget_log_line_ins">
                            <input type="password" id="form_field_id-1-pass" class="widget_log_password" autocomplete="off" name="pass" value="" placeholder="<?php echo $dataPage['text_placeholder_password']?>"/>
                            <div class="form_field_errors">
                                <div class="form_field_errors_ins"></div>
                            </div>
                        </div>
                        <div class="form_field_clear widget_log_line_clear"></div>
                    </div>
                    <div class="form_field_line widget_log_line type_input field_name_user_pin hidden_line has_title">
                        <div class="form_field_label widget_log_label"><label for="form_field_id-1-user_pin"><span class="form_field_label_ins"><?php echo $dataPage['text_user_pin'];?></span></label></div>
                        <div class="form_field_ins widget_log_line_ins">
                            <input type="text" id="form_field_id-1-user_pin" class="widget_log_input" autocomplete="off" name="user_pin" value="" />
                            <div class="form_field_errors">
                                <div class="form_field_errors_ins"></div>
                            </div>
                        </div>
                        <div class="form_field_clear widget_log_line_clear"></div>
                    </div>
                    <div class="widget_log_line_text">
                        <div class="login_widget_subm_left">
                            <a href="<?php echo $dataPage['href_register'];?>"><?php echo $dataPage['text_register'];?></a>
                        </div>
                        <div class="login_widget_subm_right">
                            <a href="<?php echo $dataPage['href_lostpass'];?>"><?php echo $dataPage['text_lostpass'];?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="widget_log_line_subm">
                        <input type="submit" formtarget="_top" name="submit" class="widget_log_submit" value="<?php echo $dataPage['text_button_login'];?>" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>