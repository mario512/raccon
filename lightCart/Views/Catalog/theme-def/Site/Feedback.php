<div class="wrapper">
    <div class="breadcrumb_wrap">
        <div class="breadcrumb_div">
            <div class="breadcrumb_ins">
                <h1 class="breadcrumb_title" id="the_title_page">
                    <?php echo $dataPage['text_feedback_h1']; ?> </h1>
                <div class="breadcrumb">

                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <div class="content">
            <div class="page_wrap">
                <div class="text">
                    <p>
                    <div class="cf_div_wrap">
                        <form method="post" class="ajax_post_form" action="<?php echo $dataPage['href_form_feedback'];?>">
                            <div class="cf_div_title">
                                <div class="cf_div_title_ins">
                                    <?php echo $dataPage['text_feedback_form']; ?>
                                </div>
                            </div>
                            <div class="cf_div">
                                <div class="cf_div_ins">
                                    <div class="form_field_line cf_line type_input field_name_name has_title">
                                        <div class="form_field_label cf_label"><label for="form_field_id-1-name"><span class="form_field_label_ins"><?php echo $dataPage['text_feedback_name']; ?> <span class="req">*</span>:</span></label></div>
                                        <div class="form_field_ins cf_line_ins">
                                            <input type="text" id="form_field_id-1-name" class="notclear cf_input" autocomplete="off" name="name" value="" />
                                            <div class="form_field_errors">
                                                <div class="form_field_errors_ins"></div>
                                            </div>
                                        </div>
                                        <div class="form_field_clear cf_line_clear"></div>
                                    </div>
                                    <div class="form_field_line cf_line type_input field_name_email has_title">
                                        <div class="form_field_label cf_label"><label for="form_field_id-1-email"><span class="form_field_label_ins"><?php echo $dataPage['text_feedback_email'] ?> <span class="req">*</span>:</span></label></div>
                                        <div class="form_field_ins cf_line_ins">
                                            <input type="text" id="form_field_id-1-email" class="notclear cf_input" autocomplete="off" name="email" value="" />
                                            <div class="form_field_errors">
                                                <div class="form_field_errors_ins"></div>
                                            </div>
                                        </div>
                                        <div class="form_field_clear cf_line_clear"></div>
                                    </div>
                                    <div class="form_field_line cf_line type_input field_name_exchange_id has_title">
                                        <div class="form_field_label cf_label"><label for="form_field_id-1-exchange_id"><span class="form_field_label_ins"><?php echo $dataPage['text_feedback_id_transaction']; ?></span></label></div>
                                        <div class="form_field_ins cf_line_ins">
                                            <input type="text" id="form_field_id-1-exchange_id" class="cf_input" autocomplete="off" name="exchange_id" value="" />
                                            <div class="form_field_errors">
                                                <div class="form_field_errors_ins"></div>
                                            </div>
                                        </div>
                                        <div class="form_field_clear cf_line_clear"></div>
                                    </div>
                                    <div class="form_field_line cf_line type_text field_name_text has_title">
                                        <div class="form_field_label cf_label"><label for="form_field_id-1-text"><span class="form_field_label_ins"><?php echo $dataPage['text_feedback_message']; ?> <span class="req">*</span>:</span></label></div>
                                        <div class="form_field_ins cf_line_ins">
                                            <textarea id="form_field_id-1-text" class="cf_text" autocomplete="off" name="text"></textarea>
                                            <div class="form_field_errors">
                                                <div class="form_field_errors_ins"></div>
                                            </div>
                                        </div>
                                        <div class="form_field_clear cf_line_clear"></div>
                                    </div>
                                    <div class="cf_line has_submit">
                                        <input type="submit" formtarget="_top" name="submit" class="cf_submit" value="<?php echo $dataPage['text_feedback_button']; ?>" />
                                    </div>
                                    <div class="resultgo"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php echo $dataPage['text_feedback_notice']; ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="not_frame">
                <?php (isset($dataPage['form_register'])) ? $dataPage['form_register']->getFormRegister() : ''; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>