<!DOCTYPE html>
<html>
    <head>
        <title><?= $page['title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= base_url(BOOTSTRAP); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(JADMIN_STYLE); ?>/style.css">
        <link rel="stylesheet" href="<?= base_url(JADMIN_JS); ?>/jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css">
        <link rel="stylesheet" href="<?= base_url(JADMIN_JS); ?>/multiselect/css/multi-select.css">
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="<?= base_url(JADMIN_JS); ?>/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="<?= base_url(BOOTSTRAP); ?>/js/bootstrap.min.js"></script>
        <script src="<?= base_url(JADMIN_JS); ?>/tablesorter/jquery.tablesorter.js" ></script>
        <script src="<?= base_url(JADMIN_JS); ?>/ckeditor/ckeditor.js"></script>
        <script src="<?= base_url(JADMIN_JS); ?>/multiselect/js/jquery.multi-select.js"></script>
        <script src="<?= base_url(JADMIN_JS); ?>/datetimepicker.js"></script>
    </head>
    <body>


    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(JADMIN_IMAGES) ?>/design/logo150.png" /></a>
            </div>  
        </div>
        <? 
            $active = $this->uri->segment(1);
            $active2 = $this->uri->segment(2); 
        ?>  
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li <?= ((empty($active) || $active == 'document')?'class="active"':''); ?>><a href="<?= base_url() ?>" class="menu-link">Gālvena</a></li>
            <li <?= (($active == 'tasks' && $active2 == 'all')?'class="active"':''); ?>><a href="<?= base_url() ?>tasks/all" class="menu-link">Mani uzdevumi</a></li>
            <li <?= (($active == 'atskaite')?'class="active"':''); ?>><a href="<?= base_url() ?>atskaite" class="menu-link">Darba laiku uzskaite</a></li>
            <? if($this->ion_auth->is_admin()){ ?>
                <li <?= (($active == 'invoice')?'class="active"':''); ?>><a href="<?= base_url() ?>invoice" class="menu-link">Reķiņi</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url(); ?>tasks"><span class="glyphicon glyphicon-list-alt"> Uzdevumi</span></a></li>
                        <li><a href="<?= base_url(); ?>lieta"><span class="glyphicon glyphicon-pushpin"> Lietas</span></a></li>
                        <li><a href="<?= base_url(); ?>clients"><span class="glyphicon glyphicon-briefcase"> Clienti</span></a></li>
                        <li><a href="<?= base_url(); ?>users"><span class="glyphicon glyphicon-user"> Lietotaji</span></a></li>
                    </ul>
                </li>
                <li <?= (($active == 'settings')?'class="active"':''); ?>><a href="<?= base_url() ?>settings" class="menu-link">Iestatijumi</a></li>
            <? } ?>      
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="<?= base_url(); ?>users/personal">
                    <span class="glyphicon glyphicon-user"> <?= $user->username; ?> </span>
                </a>    
            </li>
            <li><a href="<?= base_url(); ?>login/logout" class="menu-link">Iziet!</a></li>
          </ul>
        </div>
      </div>
    </div>
         
