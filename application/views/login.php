<!DOCTYPE html>
<html>
    <head>
        <title><?= $page['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= base_url(BOOTSTRAP); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(BOOTSTRAP); ?>/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?= base_url(JADMIN_STYLE); ?>/login.css">
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="<?= base_url(BOOTSTRAP); ?>/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">

            <form class="form-signin" role="form" action="<?= base_url(); ?>login" method="post">
              <div class="login-logo">
                <img src="<?= base_url(JADMIN_IMAGES) ?>/design/logoLogin.png" />
              </div>
              <? if(isset($error) && !empty($error)){ ?>
                <div class="alert alert-danger"><?= $error; ?></div>
              <? } ?>  
              <input type="email" class="form-control" name="email" placeholder="Email address" value="<?= set_value('email'); ?>" required autofocus>
              <input type="password" name="password" class="form-control" placeholder="Password" value="<?= set_value('password'); ?>" required>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>

        </div>
    </body>
</html>    