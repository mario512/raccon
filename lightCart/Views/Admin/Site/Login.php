<!doctype html>
<html lang="en">

<head>
    <link rel="canonical" href="<?php echo $dataPage['href_canonical']; ?>">
    <title><?php echo $dataPage['text_title_login']; ?></title>
    <link href="<?php echo $dataPage['href_assets']; ?>css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo $dataPage['href_assets']; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
    <link href="<?php echo $dataPage['href_assets']; ?>css/style.css" rel="stylesheet">
    <style>
        .logo {
            border-radius: 50%;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="text-center">
    <main class="form-signin container">
        <form action="<?php echo $dataPage['href_action']; ?>" method="post">
            <img class="mb-4 logo" src="<?php echo $dataPage['href_assets']; ?>image/logo.jpg" alt="" width="100" height="100">
            <h1 class="h3 mb-3 fw-normal"><?php echo $dataPage['text_title_massage']; ?></h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="floatingInput">
                <label for="floatingInput"><?php echo $dataPage['text_label_email']; ?></label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="floatingPassword">
                <label for="floatingPassword"><?php echo $dataPage['text_label_pass']; ?></label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo $dataPage['text_button']; ?></button>
        </form>
        <div class="clearfix"></div>
        <?php if (isset($dataPage['errors'])) { ?>
            <?php foreach ($dataPage['errors'] as $error) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (isset($dataPage['sucsses'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $dataPage['sucsses']; ?>
            </div>
        <?php } ?>
    </main>
</body>

</html>