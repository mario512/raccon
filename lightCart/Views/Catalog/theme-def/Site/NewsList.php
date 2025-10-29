<div class="wrapper">
    <div class="breadcrumb_wrap">
        <div class="breadcrumb_div">
            <div class="breadcrumb_ins">
                <h1 class="breadcrumb_title" id="the_title_page">
                    <?php echo $dataPage['text_news_h1']; ?> </h1>
                <div class="breadcrumb">

                </div>
            </div>
        </div>
    </div>
    <div class="content_wrap">
        <div class="content">
            <div class="many_news_wrap">
                <div class="many_news">
                    <?php if ($dataPage['news']) { ?>
                        <?php foreach ($dataPage['news'] as $news) { ?>
                            <div class="one_news" itemscope itemtype="https://schema.org/NewsArticle">
                                <meta itemprop="name" content="<?php echo $news['title'];?>">
                                <meta itemprop="headline" content="<?php echo $news['title'];?>">
                                <meta itemprop="image" content="<?php echo $news['meta_logo'];?>">
                                <meta itemprop="datePublished" content="<?php echo $news['meta_date'];?>">
                                <meta itemprop="dateModified" content="<?php echo $news['meta_date'];?>">
                                <meta itemprop="author" content="<?php echo $news['text_meta_author'];?>">
                                <div style="display: none;" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                                        <meta itemprop="image" content="<?php echo $news['meta_logo'];?>">
                                        <a href="<?php echo $news['meta_logo'];?>" style="display: none;" itemprop="url"></a>
                                        <span itemprop="width">100</span>
                                        <span itemprop="height">60</span>
                                    </div>
                                    <meta itemprop="name" content="<?php echo $news['text_meta_author'];?>">
                                    <meta itemprop="address" content="">
                                    <meta itemprop="telephone" content="">
                                </div>
                                <h2 class="one_news_title">
                                    <a href="<?php echo $news['href'];?>" rel="bookmark" title="<?php echo $news['title'];?>"><span><?php echo $news['title'];?></span></a>
                                </h2>
                                <div class="one_news_date">
                                <?php echo $news['date'];?> </div>
                                <div class="clear"></div>
                                <div class="one_news_excerpt ">
                                    <div class="text" itemprop="articleBody">
                                        <a href="<?php echo $news['href'];?>" title="<?php echo $news['title'];?>">
                                            <p><?php echo $news['text'];?></p>
                                        </a>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="metabox_div">
                                    <div class="metabox_left">
                                        <div class="metabox_cats">
                                            <span><?php echo $news['text_category_name'];?></span> <span itemprop="articleSection"><a href="<?php echo $news['href']?>" rel="tag"><?php echo $news['category'];?></a></span>
                                        </div>
                                    </div>
                                    <a href="<?php echo $news['href'];?>" itemprop="url" class="one_news_more" title="<?php echo $news['title'];?>"><?php echo $news['button_name'];?></a>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="pagenavi">
                    <?php echo !isset($dataPage['pagination_nav']) ? '' : $dataPage['pagination_nav']; ?>
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