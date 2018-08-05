<?php $view->extend('@BbasinskiWarehouseBundle/Resources/views/client/layout.html.php') ?>

<div class="container">
    <?php if ($message): ?>
      <div class="notification is-success">
        Item added
      </div>
    <?php endif; ?>

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
