<div class="wrapper page-template page-template-pn-tarifspage page-template-pn-tarifspage-php page page-id-17">
    <div class="breadcrumb_wrap">
        <div class="breadcrumb_div">
            <div class="breadcrumb_ins">
                <h1 class="breadcrumb_title" id="the_title_page">
                    <?php echo $dataPage['text_tarifs_title']; ?> </h1>
                <div class="breadcrumb">

                </div>
            </div>
        </div>
    </div>
    <div class="ccenter tariffs-currency">
        <div class="container">
            <div class="xtt_left_col_icon">
                <div class="xtt_left_col_icon_ins owl-carousel owl-theme">

                    <div class="tbl_icon active js_icon_left js_icon_left_0" data-type="0" data-id="0">
                        <div class="tbl_icon_ins">
                            <div class="tbl_icon_abs"></div>
                            <?php echo $dataPage['text_teb_currency_all']; ?>
                        </div>
                    </div>
                    <?php if ($dataPage['currency_category']) { ?>
                        <?php foreach ($dataPage['currency_category'] as $category) { ?>
                            <div class="tbl_icon js_icon_left js_icon_left_<?php echo $category['currency_cat_code']; ?>" data-type="<?php echo $category['currency_cat_code']; ?>" data-id="<?php echo $category['currency_cat_code']; ?>" id="btn_currency_<?php echo $category['currency_cat_code']; ?>" style="">
                                <div class="tbl_icon_ins">
                                    <div class="tbl_icon_abs"></div>
                                    <?php echo $category['currency_cat_name']; ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function($) {
            $('.tarif_block_ins > .tarif_table_wrap').each(function() {
                $('#btn_currency_' + $(this).data('currency-id')).show();
            });

            $('.xtt_left_col_icon_ins .tbl_icon').click(function() {
                id = $(this).data('id');
                if (id) {
                    $('.tarif_table_wrap').hide();
                    $('#tarif_table_wrap_' + id).show();
                } else {
                    $('.tarif_table_wrap').show();
                }
            });

            $(".xtt_left_col_icon_ins.owl-carousel").owlCarousel({
                autoWidth: true,
                nav: true,
                dots: false
            });
        });
    </script>
    <div class="content_wrap">
        <div class="content">
            <div class="tarif_div">
                <div class="tarif_div_ins">
                    <div class="tarif_table_title">
                        <div class="tarif_table_title_part out">
                            <?php echo $dataPage['text_title_form_left']; ?>
                        </div>
                        <div class="tarif_table_title_arr"></div>
                        <div class="tarif_table_title_part in">
                            <?php echo $dataPage['text_summ_in']; ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="tarif_block">
                        <div class="tarif_block_ins">
                            <div class="tarif_title">
                                <div class="tarif_title_ins">
                                    <div class="tarif_title_abs"></div>
                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>

                            <?php if ($dataPage['currency_list']) { ?>

                                <?php foreach ($dataPage['currency_list'] as $keyIn => $currencyIn) { ?>
                                    <div class="tarif_table_wrap" id="tarif_table_wrap_<?php echo $currencyIn['code_in']; ?>" data-currency-id="<?php echo $currencyIn['code_in']; ?>">
                                        <?php foreach ($dataPage['currency_list'][$keyIn]['data_in'] as $keyOut => $currencyOut) { ?>
                                            <a href="" class="tarif_line">
                                                <div class="tarif_line_ins">
                                                    <div class="tarif_line_top flex">
                                                        <div class="tarif_curs_line out">
                                                            <div class="tarif_curs_line_ins flex vcenter">
                                                                <div class="tarif_curs_title flex left vcenter">
                                                                    <div class="tarif_logo">
                                                                        <div class="tarif_logo_ins currency_logo"><span style="background-image: url(<?php echo $currencyIn['image_in'] ?>);"></span></div>
                                                                    </div>
                                                                    <div class="tarif_curs_title_ins">
                                                                        <span><?php echo $currencyIn['name_in']; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="tarif_curs">
                                                                    <div class="tarif_curs_ins flex right">
                                                                        <span><?php echo $currencyIn['multiplicity']; ?></span>
                                                                        <div class="tarif_curs_ins_code_title">
                                                                            <?php echo $keyIn; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tarif_curs_line in">
                                                            <div class="tarif_curs_line_ins flex vcenter">
                                                                <div class="tarif_curs_title flex left vcenter">
                                                                    <div class="tarif_logo">
                                                                        <div class="tarif_logo_ins currency_logo"><span style="background-image: url(<?php echo $currencyOut['image_out']; ?>);"></span></div>
                                                                    </div>
                                                                    <div class="tarif_curs_title_ins">
                                                                        <span><?php echo $currencyOut['name_out']; ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="tarif_curs">
                                                                    <div class="tarif_curs_ins flex right">
                                                                        <span><?php echo $currencyOut['price']; ?></span>
                                                                        <div class="tarif_curs_ins_code_title">
                                                                            <?php echo $currencyOut['code_out']; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tarif_curs_reserv">
                                                        <div class="tarif_curs_reserv_ins"><span>Резерв</span>: 8 928.5 USDT</div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            <?php } ?>

                        </div>
                    </div>
                </div>
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
    <div class="content_wrap" style="padding-top: 0;margin-bottom: 30px;">

    </div>
    <div id="reviews_bottom">
        <div class="ccenter reviews_bottom">
            <div class="reviews_wrap">
                <div class="home_reviews_ins">
                    <div class="home_reviews_abs"></div>
                    <div class="home_reviews_block">
                        <div class="home_reviews_title"><?php echo $dataPage['text_h1_reviews']; ?></div>
                        <div class="reviews_div_wrap">
                            <div class="home_reviews_div">
                                <div class="group1201 white"></div>
                                <div class="owl-carousel" id="reviews-carousel">
                                    <?php if ($dataPage['reviews']) { ?>
                                        <?php foreach ($dataPage['reviews'] as $reviews) { ?>
                                            <div class="home_reviews_one_ins">
                                                <div class="home_reviews_abs"></div>
                                                <div class="home_reviews_user_name"><?php echo $reviews['reviews_author']; ?></div>
                                                <div class="home_reviews_content"><?php echo $reviews['reviews_text']; ?></div>
                                                <div class="home_reviews_date"><?php echo $reviews['reviews_date']; ?></div>
                                                <div class="clear"></div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="<?php echo $dataPage['url_assets']; ?>css/owl.carousel.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo $dataPage['url_assets']; ?>css/owl.theme.default.css" type="text/css" media="all">
    <script type="text/javascript" src="<?php echo $dataPage['url_assets']; ?>js/jquery/jquery-carousel/owl.carousel.min.js"></script>
    <script>
        $(".tarif_table_wrap > a").click(function() {
            window.location = '/';
        });
        jQuery(function($) {
            $("#reviews-carousel").owlCarousel({
                nav: true,
                items: 3,
                dots: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        nav: false,
                        items: 1
                    },
                    // breakpoint from 480 up
                    600: {
                        nav: true,
                        dots: false,
                        items: 2
                    },
                    // breakpoint from 768 up
                    900: {
                        nav: true,
                        dots: false,
                        items: 3
                    }
                }
            });
        });
    </script>
</div>
