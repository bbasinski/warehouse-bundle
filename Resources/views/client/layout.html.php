<?php
$controller = explode('::', $view['request']->getParameter('_controller'));
$action = end($controller);
?>
<!doctype html>
<html lang="pl">
<head>
  <meta charset="\">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Items API client</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css"
        integrity="sha256-zIG416V1ynj3Wgju/scU80KAEWOsO5rRLfVyRDuOv7Q=" crossorigin="anonymous"/>
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
</head>
<body>
<section class="section">
  <div class="container">
    <h1 class="title">Items API</h1>
    <h2 class="subtitle">
      A simple client.
    </h2>
  </div>
</section>
<div class="container">
  <div class="tabs is-boxed is-fullwidth">
    <ul>
      <li <?= ($action !== 'endpoints') ?: 'class="is-active"' ?>><a href="/">Endpoints</a></li>
      <li <?= ($action !== 'add') ?: 'class="is-active"' ?>><a href="/add">Add</a></li>
    </ul>
  </div>
    <?php if ($message): ?>
      <div class="notification is-success">
          <?= $message ?>
      </div>
    <?php endif; ?>
    <?php $view['slots']->output('_content'); ?>
  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Symfony Warehouse Bundle</strong> by <a href="https://bbasin.ski">Bartosz Basiński</a>.
      </p>
    </div>
  </footer>
</div>
</body>
</html>
