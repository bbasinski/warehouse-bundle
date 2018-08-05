<?php /** @var string|null $endpoint */ ?>
<?php $view->extend('@BbasinskiWarehouseBundle/Resources/views/client/layout.html.php') ?>

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
      <label class="label" style="margin-top: 20px">Results (<?= $endpoint ?>)</label>

      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Amount</th>
        <th class="is-narrow">Edit</th>
        <th class="is-narrow">Delete</th>
        </thead>
        <tbody>
        <?php foreach ($results->items as $item): ?>
          <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->name ?></td>
            <td><?= $item->amount ?></td>
            <td class="has-text-centered">
              <a href="/edit/<?= $item->id ?>">
                <i class="fa fa-edit"></i>
              </a>
            </td>
            <td class="has-text-centered">
              <a href="/delete/<?= $item->id ?>">
                <i class="fa fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

</div>
