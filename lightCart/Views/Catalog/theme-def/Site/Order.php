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
					<div class="check_payment_hash" data-time="30" data-hash="<?php echo $dataPage['hash'];?>"></div>
					<div class="notice_message">
						<div class="notice_message_ins">
							<div class="notice_message_abs"></div>
							<div class="notice_message_close"></div>
							<div class="notice_message_title">
								<div class="notice_message_title_ins">
									<span><?php echo $dataPage['text_title'];?></span>
								</div>
							</div>
							<div class="notice_message_text">
								<div class="notice_message_text_ins">
									<p><?php echo $dataPage['text_notice'];?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="block_statusbids block_status_new">
						<div class="block_statusbids_ins">
							<div class="block_statusbid_title">
								<div class="block_statusbid_title_ins">
									<span><?php echo $dataPage['text_title_indication'];?></span>
								</div>
							</div>
							<div class="block_instruction st_new">
								<div class="block_instruction_ins">
									<?php echo $dataPage['text_indication'];?>
								</div>
							</div>
							<div class="block_payinfo">
								<div class="block_payinfo_ins">
									<div class="block_payinfo_sum block_payinfo_line">
										<p><strong><?php echo $dataPage['text_label_summ_in'];?>:&nbsp;</strong><?php echo $dataPage['summ_in'];?><span class="ps">&nbsp;<?php echo $dataPage['currency_in'];?></span></p>
									</div>
									<div class="block_payinfo_sum block_payinfo_line">
										<p><strong><?php echo $dataPage['text_label_summ_out'];?>:&nbsp;</strong><?php echo $dataPage['summ_out'];?><span class="ps">&nbsp;<?php echo $dataPage['currency_out'];?></span></p>
									</div>
									<div class="block_payinfo_warning">
										<?php echo $dataPage['text_warning'];?>
									</div>
								</div>
							</div>
							<div class="block_payinfo">
								<div class="block_status_ins">
									<div class="pn_copy" data-clipboard-target=".wallet"><div class="wallet resultfalse"><?php echo $dataPage['wallet'];?></div></div>
									<div class="block_status_text flex center"><span class="block_status_text_info js_qr_code" data-code="<?php echo $dataPage['wallet'];?>" data-size="200-200"></div>
								</div>
							</div>
							<div class="block_status">
								<div class="block_status_ins">
									<div class="block_status_time"><span><?php echo $dataPage['text_label_date'];?>:</span> <?php echo $dataPage['order_data'];?></div>
									<div class="block_status_text"><span class="block_status_text_info"><?php echo $dataPage['text_label_status'];?>:</span> <span class="block_status_bids bstatus_new"><?php echo $dataPage['text_status'];?></span></div>
								</div>
							</div>
							<div class="block_paybutton">
								<div class="block_paybutton_ins"><a href="<?php echo $dataPage['href_order_cancel'];?>" class="cancel_paybutton"><?php echo $dataPage['text_button_cancel'];?></a><a href="<?php echo $dataPage['href_order_succsess'];?>" class="success_paybutton iam_pay_bids"><?php echo $dataPage['text_button_confirm'];?></a>
									<div class="clear"></div>
								</div>
							</div>
							<div class="block_check_payment">
								<div class="block_check_payment_ins">
									<div class="block_check_payment_abs"></div>
									<div class="block_check_payment_ins"></div>
								</div>
							</div>
							<div class="block_warning_merch">
								<div class="block_warning_merch_ins">
									<p><?php echo $dataPage['text_info_update'];?></p>
								</div>
							</div>
							<div class="block_paybutton_merch">
								<div class="block_paybutton_merch_ins">
									<a href="" on-off="1" class="merch_paybutton"><?php echo $dataPage['text_button_auto_update'];?></a>
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