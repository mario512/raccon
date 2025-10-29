   <div class="wrapper">
       <div class="breadcrumb_wrap">
           <div class="breadcrumb_div">
               <div class="breadcrumb_ins">
                   <h1 class="breadcrumb_title" id="the_title_page">
                       <?php echo $dataPage['text_h1_reviews']; ?> </h1>
                   <div class="breadcrumb">

                   </div>
               </div>
           </div>
       </div>
       <div class="content_wrap">
           <div class="content">
               <div class="many_reviews">
                   <div class="many_reviews_ins">
                       <?php if ($dataPage['reviews']) { ?>
                           <?php foreach ($dataPage['reviews'] as $review) { ?>
                               <div class="one_reviews" id="review-<?php echo $review['id']; ?>" itemprop="review" itemscope itemtype="https://schema.org/Review">
                                   <meta itemprop="name" content="<?php echo $review['meta_text']; ?>.&hellip;">
                                   <meta itemprop="datePublished" content="<?php echo $review['meta_date']; ?>">
                                   <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                       <meta itemprop="worstRating" content="1">
                                       <meta itemprop="ratingValue" content="5">
                                       <meta itemprop="bestRating" content="5">
                                   </div>
                                   <div class="one_reviews_ins">
                                       <div class="one_reviews_abs"></div>
                                       <div class="one_reviews_name">
                                           <span itemprop="author"><?php echo $review['author']; ?></span>
                                       </div>
                                       <div class="one_reviews_date"><?php echo $review['date']; ?></div>
                                       <div class="clear"></div>
                                       <div class="one_reviews_text" itemprop="description">
                                           <p><?php echo $review['text']; ?></p>
                                           <div class="clear"></div>
                                       </div>
                                   </div>
                               </div>
                           <?php } ?>
                       <?php } ?>
                   </div>
               </div>
               <div class="pagenavi">
                   <?php echo !isset($dataPage['pagination_nav']) ? '' : $dataPage['pagination_nav']; ?>
               </div>
               <div class="rf_div_wrap">
                   <form method="post" class="ajax_post_form" action="<?php echo $dataPage['href_form_reviews']; ?>" name="review">
                       <div class="rf_div_title">
                           <div class="rf_div_title_ins">

                               <?php echo $dataPage['text_form_reviews']; ?>

                           </div>
                       </div>
                       <div class="rf_div">
                           <div class="rf_div_ins">
                               <div class="form_field_line rf_line type_input field_name_name has_title">
                                   <div class="form_field_label rf_label"><label for="form_field_id-1-name"><span class="form_field_label_ins"><?php echo $dataPage['text_form_your_name']; ?> <span class="req">*</span>:</span></label></div>
                                   <div class="form_field_ins rf_line_ins">
                                       <input type="text" id="form_field_id-1-name" class="notclear rf_input" autocomplete="off" name="name" value="" />
                                       <div class="form_field_errors">
                                           <div class="form_field_errors_ins"></div>
                                       </div>
                                   </div>
                                   <div class="form_field_clear rf_line_clear"></div>
                               </div>
                               <div class="form_field_line rf_line type_input field_name_email has_title">
                                   <div class="form_field_label rf_label"><label for="form_field_id-1-email"><span class="form_field_label_ins"><?php echo $dataPage['text_form_your_mail']; ?> <span class="req">*</span>:</span></label></div>
                                   <div class="form_field_ins rf_line_ins">
                                       <input type="text" id="form_field_id-1-email" class="notclear rf_input" autocomplete="off" name="email" value="" />
                                       <div class="form_field_errors">
                                           <div class="form_field_errors_ins"></div>
                                       </div>
                                   </div>
                                   <div class="form_field_clear rf_line_clear"></div>
                               </div>
                               <div class="form_field_line rf_line type_text field_name_text has_title">
                                   <div class="form_field_label rf_label"><label for="form_field_id-1-text"><span class="form_field_label_ins"><?php echo $dataPage['text_form_reviews']; ?> <span class="req">*</span>:</span></label></div>
                                   <div class="form_field_ins rf_line_ins">
                                       <textarea id="form_field_id-1-text" class="rf_text" autocomplete="off" name="text"></textarea>
                                       <div class="form_field_errors">
                                           <div class="form_field_errors_ins"></div>
                                       </div>
                                   </div>
                                   <div class="form_field_clear rf_line_clear"></div>
                               </div>
                               <div class="captcha_div">
                                   <div class="captcha_title">
                                       <?php echo $dataPage['text_captcha_title']; ?>
                                   </div>
                                   <div class="captcha_body">
                                       <div class="captcha_divimg">
                                           <img src="<?php echo $dataPage['captcha'] ?>" class="captcha1" alt="" />
                                       </div>
                                       <div class="captcha_divznak">
                                           <span class="captcha_sym">&nbsp;</span>
                                       </div>
                                       <input type="text" class="captcha_divpole" name="number" maxlength="4" autocomplete="off" value="" />
                                       <a href="#" class="captcha_reload" title="заменить задачу"></a>
                                       <div class="clear"></div>
                                   </div>
                               </div>
                               <div class="rf_line has_submit">
                                   <input type="submit" formtarget="_top" name="submit" class="rf_submit" value="<?php echo $dataPage['text_form_button_reviews']; ?>" />
                               </div>
                               <div class="resultgo"></div>
                           </div>
                       </div>
                   </form>
               </div>
               <div class="clear"></div>
           </div>
           <div class="sidebar">
               <div class="not_frame">
                   <?php (!empty($dataPage['form_register'])) ? $dataPage['form_register']->getFormRegister() : ''; ?>
               </div>
           </div>
           <div class="clear"></div>
       </div>
   </div>