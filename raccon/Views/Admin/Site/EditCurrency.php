<div class="container-fluid">
    <!-- Title -->
    <h1 class="h2">
        <a href="<?php echo $dataPage['href_return']; ?>" class="text-muted">
            <img src="<?php echo $dataPage['href_img']; ?>" alt="..." class="avatar-img" width="30" height="30">
        </a>&nbsp;
        <?php echo $dataPage['text_title_edit'] ?>&nbsp;<?php echo $dataPage['currency_name']; ?>
    </h1>
    <style>
        .form-edit {
            padding: 15px;
        }
    </style>
    <div class="row">
        <div class="col">
            <div class="card border-0 flex-fill w-100">
                <form enctype="multipart/form-data" class="form-edit" action="<?php echo $dataPage['href_form']; ?>" method="POST" currency-id="<?php echo $dataPage['currency_id']; ?>">
                    <div class="row">
                        <div class="col-6">

                            <label for="inputName" class="form-label"><?php echo $dataPage['text_label_currency_name']; ?></label>
                            <input type="text" id="inputName" name="inputName" class="form-control" aria-describedby="inputName" value="<?php echo $dataPage['currency_name']; ?>">
                            <div id="inputName" class="form-text">
                                <?php echo $dataPage['text_help_currency_name']; ?>
                            </div>
                            <label for="inputNameToken" class="form-label"><?php echo $dataPage['text_label_token_name']; ?></label>
                            <input type="text" id="inputNameToken" name="inputNameToken" class="form-control" aria-describedby="inputNameToken" value="<?php echo $dataPage['currency_code']; ?>">
                            <div id="inputNameToken" class="form-text">
                                <?php echo $dataPage['text_help_token_name']; ?>
                            </div>
                            <label for="inputCurrencyCat" class="form-label"><?php echo $dataPage['text_label_currency_category']; ?></label>
                            <select class="form-select" name="inputCurrencyCat" aria-label="inputCurrencyCat">
                                <option><?php echo $dataPage['text_option_select_category']; ?></option>
                                <?php if ($dataPage['currency_category']) { ?>
                                    <?php foreach ($dataPage['currency_category'] as $category) { ?>
                                        <option <?php echo $category['currency_cat_by_currency'] ?>><?php echo $category['currency_cat_name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div id="inputCurrencyCat" class="form-text">
                                <?php echo $dataPage['text_help_currency_category']; ?>
                            </div>
                            <label for="inputInOut" class="form-label"><?php echo $dataPage['text_label_exchange_direction']; ?></label>
                            <select class="form-select" name="inputInOut" aria-label="inputInOut">
                                <option><?php echo $dataPage['text_option_select_direction']; ?></option>
                                <?php if ($dataPage['currency_in_out']) { ?>
                                    <?php foreach ($dataPage['currency_in_out'] as $inOut) { ?>
                                        <option <?php echo $inOut['currency_in_out_active']; ?>><?php echo $inOut['currency_in_out_name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <div id="inputInOut" class="form-text">
                                <?php echo $dataPage['text_help_exchange_direction']; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="formImg" class="form-label"><?php echo $dataPage['text_label_currency_logo']; ?></label>
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?php echo $dataPage['currency_image']; ?>" alt="..." class="avatar-img this-currency" width="40" height="40">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="inputLogo" name="inputLogo" class="form-control " aria-describedby="inputLogo" value="<?php echo $dataPage['currency_image_name']; ?>">
                                    </div>
                                    <input class="form-control visually-hidden" type="file" id="formImg" accept=".jpg, .jpeg, .png" name="formImg" url="<?php echo $dataPage['url_image_edit']; ?>" value="">
                                    <div class="col-3">
                                        <button type="button" class="btn btn-primary " id="logo-select">...</button>
                                    </div>
                                </div>
                            </div>
                            <div id="formImg" class="form-text">
                                <?php echo $dataPage['text_help_currency_logo']; ?>
                            </div>


                            <label for="inputRandom" class="form-label"><?php echo $dataPage['text_label_random_range']; ?></label>
                            <input type="text" id="inputRandom" name="inputRandom" class="form-control" aria-describedby="inputRandom" value="<?php echo $dataPage['currency_rand_min_max']; ?>">
                            <div id="inputRandom" class="form-text">
                                <?php echo $dataPage['text_help_random_range']; ?>
                            </div>
                            <label for="inputWallet" class="form-label"><?php echo $dataPage['text_label_wallet']; ?></label>
                            <input type="text" id="inputWallet" name="inputWallet" class="form-control" aria-describedby="inputWallet" value="<?php echo $dataPage['currency_wallet']; ?>">
                            <div id="inputWallet" class="form-text">
                                <?php echo $dataPage['text_help_wallet']; ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-3 clearfix"></div>
                    <button type="submit" class="btn btn-primary"><?php echo $dataPage['text_button_save']; ?></button>
                    <button type="button" class="btn btn-primary " id="button-delete"><?php echo $dataPage['text_button_delete']; ?></button>
            </div>
            </form>
        </div>
    </div>
</div>
</div> <!-- / .row -->
<script>
    $(document).ready(function() {
        $('#logo-select').on('click', function(e) {
            var inputFile = $('input[name="formImg"]');
            inputFile.trigger('click');
            inputFile.change(function() {
                var formData = new FormData();
                formData.append('file', inputFile[0].files[0]);
                $.ajax({
                    type: 'POST',
                    url: inputFile.attr('url'),
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formData,
                    success: function(res) {
                        if (res['status'] == 'success') {
                            $('.this-currency').attr('src', res['html']);
                        }
                    }
                });
                $('#inputLogo').val(inputFile.val().replace(/.+[\\\/]/, ""));
            });

        });
        $('#button-delete').on('click', function(e) {
            var isDelete = confirm("<?php echo $dataPage['text_confirm_delete']; ?>");
            if (isDelete) {
                var currencyId = $('form').attr('currency-id');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: 'mode=delete&currency_id=' + currencyId,
                    success: function(res) {
                        if (res['url']) {
                            window.location.href = res['url'];
                        }
                    }
                })
            }

        });
    })
</script>
