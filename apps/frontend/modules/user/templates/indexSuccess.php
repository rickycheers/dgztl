<h1 class="page-header">Users List</h1>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Full name</th>
      <th>Cars</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td>
          <a href="<?php echo url_for('user/show?id='.$user->getId()) ?>">
              <?php echo $user->getFullName() ?>
          </a>
      </td>
      <td>
          <?php echo $user->getCarsCount() ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<p>
    <a href="<?php echo url_for('user/new') ?>" class="btn btn-primary">
        <i class="icon-ok icon-white"></i> New user
    </a>
</p>