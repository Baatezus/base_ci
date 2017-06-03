<!DOCTYPE html>
<html>
<head>
<title></title>
<!-- Materialize CSS CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

<!-- Google icons CDN-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- More CSS CDN -->
<link href="<?= base_url() ?>css/main.css" rel="stylesheet">

<!-- Nice google font CDN -->
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">

<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Materialize Js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<!-- Materialize js handlers  CDN -->
<script src="<?= base_url() ?>js/materialize/materialize_handlers.js"></script>

<!-- VueJs CDN -->
<script src="https://unpkg.com/vue"></script>
<style>

</style>
</head> 
<body>
  <nav id="main-nav">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">ONESITE.COM</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?= base_url() ?>">Home</a></li>
        <?php if($user) { ?>
        <?php if($user->admin === '1') { ?>
        <li><a href="<?= base_url() ?>index.php/user">Users list</a></li>
        <?php } ?>
        <li><a href="<?= base_url() ?>index.php/user/my_page/<?= $user->token ?>" >My page</a></li>
        <li><a href="<?= base_url() ?>index.php/user/logout">Logout</a></li>
        <?php } else { ?>
        <li><a href="<?= base_url() ?>index.php/user/signin">Sign in</a></li>
        <li><a href="<?= base_url() ?>index.php/user/signup">Sign up</a></li>
        <?php } ?>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="<?= base_url() ?>">Home</a></li>
        <?php if($user) { ?>
        <?php if($user->admin === '1') { ?>
        <li><a href="<?= base_url() ?>index.php/user">Users list</a></li>
        <?php } ?>
        <li><a href="<?= base_url() ?>index.php/user/my_page/<?= $user->token ?>" >My page</a></li>
        <li><a href="<?= base_url() ?>index.php/user/logout">Logout</a></li>
        <?php } else { ?>
        <li><a href="<?= base_url() ?>index.php/user/signin">Sign in</a></li>
        <li><a href="<?= base_url() ?>index.php/user/signup">Sign up</a></li>
        <?php } ?>
      </ul>
    </div>
  </nav>
<?php if(count($this->session->flashdata())> 0) { ?>
    <div class="card-panel text-align flash-message green white-text"><?= $this->session->flashdata('message') ?></div>
<?php } ?>
<div class="container">