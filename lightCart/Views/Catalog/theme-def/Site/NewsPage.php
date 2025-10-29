<div class="wrapper">
    <div class="breadcrumb_wrap">
        <div class="breadcrumb_div">
            <div class="breadcrumb_ins">
                <h1 class="breadcrumb_title" id="the_title_page">
                    <?php echo $dataPage['news']['title']?> </h1>
                <div class="breadcrumb">

                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <div class="content">
            <div class="single_news_wrap">
                <div class="single_news" itemscope itemtype="https://schema.org/NewsArticle">
                    <a href="<?php echo $dataPage['news']['href']?>" style="display: none;" itemprop="url"></a>
                    <meta itemprop="name" content="<?php echo $dataPage['news']['title']?>">
                    <meta itemprop="headline" content="<?php echo $dataPage['news']['title']?>">
                    <meta itemprop="image" content="<?php echo $dataPage['news']['meta_logo']?>">
                    <meta itemprop="datePublished" content="<?php echo $dataPage['news']['meta_date']?>">
                    <meta itemprop="dateModified" content="<?php echo $dataPage['news']['meta_date']?>">
                    <meta itemprop="author" content="<?php echo $dataPage['news']['text_meta_author']?>">
                    <div style="display: none;" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="image" content="<?php echo $dataPage['news']['meta_logo']?>">
                            <a href="<?php echo $dataPage['news']['meta_logo']?>" style="display: none;" itemprop="url"></a>
                            <span itemprop="width">100</span>
                            <span itemprop="height">60</span>
                        </div>
                        <meta itemprop="name" content="<?php echo $dataPage['news']['text_meta_author']?>">
                        <meta itemprop="address" content="">
                        <meta itemprop="telephone" content="">
                    </div>
                    <div class="one_news_date">
                    <?php echo $dataPage['news']['date']?> </div>
                    <div class="clear"></div>
                    <div class="one_news_content">
                        <div class="text" itemprop="articleBody">
                            <p><?php echo $dataPage['news']['text']?></p>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="metabox_div">
                        <div class="metabox_left">
                            <div class="metabox_cats">
                                <span><?php echo $dataPage['news']['text_category_name']?></span> <span itemprop="articleSection"><a href="<?php echo $dataPage['news']['href']?>" rel="tag"><?php echo $dataPage['news']['category']?></a></span>
                            </div>
                        </div>
                        <a href="<?php echo $dataPage['news']['href']?>" class="one_news_more"><?php echo $dataPage['news']['button_name_return']?></a>
                        <div class="clear"></div>
                    </div>
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