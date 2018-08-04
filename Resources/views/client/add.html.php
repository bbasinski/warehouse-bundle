<?php /** @var string|null $endpoint */ ?>
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
</head>
<body>
<section class="section">
  <div class="container">
    <h1 class="title">Items API</h1>
    <h2 class="subtitle">
      A simple client.
    </h2>
    <div class="tabs is-centered is-boxed">
      <ul>
        <li><a href="/">Endpoints</a></li>
        <li class="is-active"><a href="/add">Add</a></li>
        <li><a>Edit/Remove</a></li>
      </ul>
    </div>
  </div>
</section>
<div class="container">
  <?php if ($message): ?>
    <div class="notification is-success">
      Item added
    </div>
  <?php endif;?>

  <div class="notification">
    <form method="post">
      <div class="field">
        <label class="label">Name</label>
        <div class="control">
          <input name="name" class="input" type="text" placeholder="Item name" autofocus required>
        </div>
      </div>
      <div class="field">
        <label class="label">Amount</label>
        <div class="control">
          <input name="amount" class="input" type="number" placeholder="0" required>
        </div>
      </div>
      <div class="control">
        <button class="button is-info">Add</button>
      </div>
    </form>


  </div>
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
