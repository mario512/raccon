<div class="wrapper">
	<div class="breadcrumb_wrap">
		<div class="breadcrumb_div">
			<div class="breadcrumb_ins">
				<h1 class="breadcrumb_title" id="the_title_page">
					<?php echo $dataPage['text_h1_page'];?> </h1>
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
					<form action="<?php echo $dataPage['href_go_order'];?>" class="ajax_post_form" method="post">
						<input type="hidden" name="hash" value="<?php echo $dataPage['hash'];?>" />
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
						<div class="block_xchangedata">
							<div class="block_xchangedata_ins">
								<div class="block_xchdata">
									<div class="block_xchdata_ins">
										<div class="block_xchdata_title otd give">
											<span><?php echo $dataPage['text_label_currency_in'];?></span>
										</div>
										<div class="block_xchdata_info">
											<div class="block_xchdata_info_left">
												<div class="block_xchdata_line"><span><?php echo $dataPage['text_label_summ'];?>:</span>&nbsp;<?php echo $dataPage['summ_in'];?>&nbsp;<?php echo $dataPage['currency_in']['currency_name'];?></div>
											</div>
											<div class="block_xchdata_info_right">
												<div class="block_xchdata_ico currency_logo" style="background-image: url(<?php echo $dataPage['currency_in']['currency_image'];?>);"></div>
												<div class="block_xchdata_text"><?php echo $dataPage['currency_in']['currency_name'];?></div>
												<div class="clear"></div>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
								<div class="block_xchdata">
									<div class="block_xchdata_ins">
										<div class="block_xchdata_title pol get">
											<span><?php echo $dataPage['text_label_currency_out'];?></span>
										</div>
										<div class="block_xchdata_info">
											<div class="block_xchdata_info_left">
												<div class="block_xchdata_line"><span><?php echo $dataPage['text_label_summ'];?>:</span>&nbsp;<?php echo $dataPage['summ_out'];?>&nbsp;<?php echo $dataPage['currency_out']['currency_name'];?></div>
												<div class="block_xchdata_line"><span><?php echo $dataPage['text_label_account'];?>:</span> <?php echo $dataPage['user_card'];?></div>
											</div>
											<div class="block_xchdata_info_right">
												<div class="block_xchdata_ico currency_logo" style="background-image: url(<?php echo $dataPage['currency_out']['currency_image'];?>);"></div>
												<div class="block_xchdata_text"><?php echo $dataPage['currency_out']['currency_name'];?></div>
												<div class="clear"></div>
											</div>
											<div class="clear"></div>
										</div>
									</div>
									
								</div>
								<div class="block_persdata">
									<div class="block_persdata_ins">
										<div class="block_persdata_title">
											<div class="block_persdata_title_ins">
												<span><?php echo $dataPage['text_title_personal_data'];?></span>
											</div>
										</div>
										<div class="block_persdata_info">
											<div class="block_persdata_line"><span><?php echo $dataPage['text_label_email'];?>:&nbsp;</span><?php echo $dataPage['user_mail'];?></div>
										</div>
									</div>
								</div>
								<div class="block_checked_rule">
									<label><input type="checkbox" id="check_rule_step" name="check_rule" value="1" /><?php echo $dataPage['text_label_tos'];?></label>
								</div>
								<div class="block_submitbutton">
									<input type="submit" name="" formtarget="_top" id="check_rule_step_input" disabled="disabled" value="<?php echo $dataPage['text_label_button'];?>" />
								</div>
								<div class="ajax_post_bids_res">
									<div class="resultgo"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="sidebar">
			<div class="not_frame">
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>