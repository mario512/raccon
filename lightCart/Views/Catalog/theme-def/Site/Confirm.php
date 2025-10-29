<div class="wrapper">
    <div class="breadcrumb_wrap">
        <div class="breadcrumb_div">
            <div class="breadcrumb_ins">
                <h1 class="breadcrumb_title" id="the_title_page">
                    <?php echo $dataPage['text_label_num_order'];?>&nbsp;<?php echo $dataPage['order_id'];?></h1>
                <div class="breadcrumb">

                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <div class="content">
            <div class="exchange_status_html">
                <div class="exchange_status_abs"></div>
                <div id="exchange_status_html">
                    <div class="block_statusbids block_status_cancel">
                        <div class="block_statusbids_ins">
                            <div class="block_statusbid_title">
                                <div class="block_statusbid_title_ins">
                                    <span><?php echo $dataPage['text_title_cancel'];?></span>
                                </div>
                            </div>
                            <div class="block_instruction st_cancel">
                                <div class="block_instruction_ins">
                                    <p><?php echo $dataPage['text_title_message'];?></p>
                                </div>
                            </div>
                            <div class="block_payinfo">
                                <div class="block_payinfo_ins">
                                    <div class="block_payinfo_line">
                                        <span><?php echo $dataPage['text_label_currency_in'];?>:</span>&nbsp;<?php echo $dataPage['summ_in'];?>&nbsp; <?php echo $dataPage['currency_in'];?>, &nbsp;<span><?php echo $dataPage['text_label_user_card'];?></span>:&nbsp; <?php echo $dataPage['wallet'];?>
                                    </div>
                                    <div class="block_payinfo_line">
                                        <span><?php echo $dataPage['text_label_currency_out'];?>:</span>&nbsp;<?php echo $dataPage['summ_out'];?>&nbsp; <?php echo $dataPage['currency_out'];?> , &nbsp;<span><?php echo $dataPage['text_label_account'];?></span>:&nbsp; <?php echo $dataPage['user_card'];?>
                                    </div>
                                </div>
                            </div>
                            <div class="block_status">
                                <div class="block_status_ins">
                                    <div class="block_status_time"><span><?php echo $dataPage['text_label_date'];?>:</span>&nbsp;<?php echo $dataPage['date_time_order'];?></div>
                                    <div class="block_status_text"><span class="block_status_text_info"><?php echo $dataPage['text_label_status'];?>:</span> <span class="block_status_bids bstatus_cancel"><?php echo $dataPage['text_order_status'];?></span></div>
                                </div>
                            </div>
                            <div class="block_paybutton_merch">
								<div class="block_paybutton_merch_ins">
									<a href="<?php echo $dataPage['href_home_page'];?>" class="btn btn-dark"><?php echo $dataPage['text_button_home'];?></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sidebar">
           
        </div>
        <div class="clear"></div>
    </div>
</div>