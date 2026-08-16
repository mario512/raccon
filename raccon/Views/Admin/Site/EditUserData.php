<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">
        <a href="<?php echo $dataPage['href_return']; ?>" class="text-muted">
            <img src="<?php echo $dataPage['href_img']; ?>" alt="..." class="avatar-img" width="30" height="30">
        </a>&nbsp;
        <?php echo $dataPage['text_title_edit'] ?>
    </h1>
    <style>
        .form-edit {
            padding: 15px;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 flex-fill w-100">
                <form class="form-edit" action="<?php echo $dataPage['href_form']; ?>" method="POST">
                    <div class="row">
                        <div class="col-6">

                            <label for="inputName" class="form-label"><?php echo $dataPage['text_label_name']; ?></label>
                            <input type="text" id="inputName" name="inputName" class="form-control" aria-describedby="inputName" value="<?php echo $dataPage['user_name']; ?>">
                            <div id="inputName" class="form-text">
                                <?php echo $dataPage['text_help_name']; ?>
                            </div>
                            <label for="inputLogin" class="form-label"><?php echo $dataPage['text_label_email']; ?></label>
                            <input type="text" id="inputLogin" name="inputLogin" class="form-control" aria-describedby="inputLogin" value="<?php echo $dataPage['user_login']; ?>">
                            <div id="inputLogin" class="form-text">
                                <?php echo $dataPage['text_help_email']; ?>
                            </div>
                            <label for="inputPass" class="form-label"><?php echo $dataPage['text_label_password']; ?></label>
                            <input type="text" id="inputPass" name="inputPass" class="form-control" aria-describedby="inputPass" value="<?php echo $dataPage['user_pass']; ?>">
                            <div id="inputPass" class="form-text">
                                <?php echo $dataPage['text_help_password']; ?>
                            </div>

                        </div>

                        <div id="inputPass" class="form-text">
                            <?php echo $dataPage['text_after_save']; ?>
                        </div>
                        <div class="col-12 clearfix"></div>
                    </div>
                    <div class="col-3 clearfix"></div>
                    <button type="submit" class="btn btn-primary"><?php echo $dataPage['text_button_save']; ?></button>

            </div>
            </form>
        </div>
    </div>
</div>
</div> <!-- / .row -->
