<?php $view->extend('@BbasinskiWarehouseBundle/Resources/views/client/layout.html.php') ?>
<div class="container">
  <div class="notification">
    <form method="post">
      <div class="field">
        <label class="label">Name</label>
        <div class="control">
          <input name="name" class="input" type="text" placeholder="Item name" autofocus required
                 value="<?= $item->name ?>">
        </div>
      </div>
      <div class="field">
        <label class="label">Amount</label>
        <div class="control">
          <input name="amount" class="input" type="number" placeholder="0" required value="<?= $item->amount ?>">
        </div>
      </div>
      <div class="control">
        <button class="button is-info">Edit</button>
      </div>
    </form>
  </div>
