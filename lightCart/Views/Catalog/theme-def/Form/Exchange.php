<div class="white_block">
    <div class="white_block_title"><?php echo $dataPage['text_title_form'];?></div>
    <div class="hexch_pers">
        <div class="hexch_pers_ins">
            <div class="hexch_pers_title">
                <div class="hexch_pers_title_ins">
                    <span><?php echo $dataPage['text_personal_data'];?></span>
                </div>
            </div>
            <div class="hexch_pers_div">
                <div class="hexch_pers_div_ins">
                    <div class="hexch_pers_line has_help">
                        <div class="hexch_pers_label">
                            <div class="hexch_pers_label_ins">
                                <label for="cf6"><span class="hexch_label"><?php echo $dataPage['text_email'];?><span class="req">*</span>: <span class="help_tooltip_label"></span></span></label>
                            </div>
                        </div>
                        <div class="hexch_pers_input">
                            <div class="js_wrap_error js_wrap_error_br js_window_wrap">
                                <input type="text" name="cf6" cash-id="cf6" id="cf6" class="cache_data check_cache js_cf6 js_help" autocomplete="off" placeholder="" value="">

                                <div class="info_window js_window">
                                    <div class="info_window_ins">
                                        <div class="info_window_abs"></div>
                                        <p><?php echo $dataPage['text_placeholder_email'];?></p>
                                    </div>
                                </div>
                                <div class="js_error js_cf6_error"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="hexch_curs_line">
        <div class="hexch_curs_line_ins">
            <div class="hexch_curs_label">
                <div class="hexch_curs_label_ins">
                    <label for="account1"><span class="hexch_label"><?php echo $dataPage['text_number_wallet'];?><span class="req">*</span>: </span></label>
                </div>
            </div>
        </div>
        <div class="hexch_curs_input js_wrap_error js_wrap_error_br js_window_wrap">
            <input type="text" name="account1" cash-id="account18" id="account1" class="js_account1  cache_data check_cache" autocomplete="off" placeholder="" value="">
            <div class="hexch_title_logo currency_logo account1"></div>
            <div class="js_error js_account1_error"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="hexch_curs_line">
        <div class="hexch_curs_line_ins">
            <div class="hexch_curs_label">
                <div class="hexch_curs_label_ins">
                    <label for="account2"><span class="hexch_label"><?php echo $dataPage['text_number_card'];?><span class="req">*</span>: <span class="help_tooltip_label"></span></span></label>
                </div>
            </div>
        </div>
        <div class="hexch_curs_input js_wrap_error js_wrap_error_br js_window_wrap">
            <input type="text" name="account2" cash-id="account41" id="account2" class="js_account2 js_help cache_data check_cache" autocomplete="off" placeholder="" value="">
            <div class="hexch_title_logo currency_logo account2"></div>
            <div class="js_error js_account2_error"></div>
            <div class="info_window js_window">
                <div class="info_window_ins">
                    <div class="info_window_abs"></div>
                    <p><?php echo $dataPage['text_placeholder_card'];?></p>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="hexch_submit_div">
        <input type="submit" formtarget="_top" class="hexch_submit" name="" value="<?php echo $dataPage['text_button'];?>">
        <div class="clear"></div>
    </div>
    <div class="hexch_checkdata_div" style="display: none;">
        <div class="checkbox"><label><input type="checkbox" id="not_check_data" name="not_check_data" value="1" class="jcheckbox" style="display: none;"><?php echo $dataPage['text_donоt_remember'];?></label></div>
    </div>
    <div class="ajax_post_bids_res"></div>

</div>