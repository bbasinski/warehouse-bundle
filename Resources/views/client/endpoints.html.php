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
        <li class="is-active"><a href="/">Endpoints</a></li>
        <li><a>Add</a></li>
        <li><a>Edit/Remove</a></li>
      </ul>
    </div>
  </div>
</section>
<div class="container">
  <div class="notification">
    <form method="get">
      <label class="label">Endpoint</label>
      <div class="field has-addons">
        <div class="control">
          <a class="button is-static">
            GET
          </a>
        </div>
        <div class="control is-expanded">
          <div class="select is-fullwidth">
            <select title="Wybierz endpoint" name="endpoint">
              <option selected disabled>---</option>
              <option value="available">/items/available</option>
              <option value="unavailable">/items/unavailable</option>
              <option value="amount-over-5">/items/amount/over/5</option>
            </select>
          </div>
        </div>
        <div class="control">
          <button class="button is-info">
            Try
          </button>
        </div>
      </div>
    </form>

      <?php if (!is_null($endpoint)): ?>
        <label class="label" style="margin-top: 20px">Results (<?=$endpoint?>)</label>

        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
          <thead>
          <th>Id</th>
          <th>Name</th>
          <th>Amount</th>
          </thead>
          <tbody>
          <?php foreach ($results->items as $item): ?>
            <tr>
              <td><?=$item->id?></td>
              <td><?=$item->name?></td>
              <td><?=$item->amount?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

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
