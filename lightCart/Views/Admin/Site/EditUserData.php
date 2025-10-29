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

                            <label for="inputName" class="form-label">Имя пользователя</label>
                            <input type="text" id="inputName" name="inputName" class="form-control" aria-describedby="inputName" value="<?php echo $dataPage['user_name']; ?>">
                            <div id="inputName" class="form-text">
                                Имя пользователя. Например - Рачко
                            </div>
                            <label for="inputLogin" class="form-label">Email пользователя (Логин)</label>
                            <input type="text" id="inputLogin" name="inputLogin" class="form-control" aria-describedby="inputLogin" value="<?php echo $dataPage['user_login']; ?>">
                            <div id="inputLogin" class="form-text">
                                Именем пользователя может бфть только Email
                            </div>
                            <label for="inputPass" class="form-label">Пароль</label>
                            <input type="text" id="inputPass" name="inputPass" class="form-control" aria-describedby="inputPass" value="<?php echo $dataPage['user_pass']; ?>">
                            <div id="inputPass" class="form-text">
                                Пароль длинной не менее 8 символов
                            </div>

                        </div>

                        <div id="inputPass" class="form-text">
                            После сохранение данных, вы будете переадресованы на страницу авторизации
                        </div>
                        <div class="col-12 clearfix"></div>
                    </div>
                    <div class="col-3 clearfix"></div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>

            </div>
            </form>
        </div>
    </div>
</div>
</div> <!-- / .row -->