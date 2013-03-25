<?php use_javascript('confirmation.js') ?>
<form action="<?php echo url_for('car/' . ($form->getObject()->isNew() ? 'create' : 'update') . '?user-id=' . $form->getDefault('user_id') . (!$form->getObject()->isNew() ? '&id=' . $form->getObject()->getId() : '')) ?>" method="post">

    <?php if (!$form->getObject()->isNew()) : ?>
        <input type="hidden" name="sf_method" value="put" id="sf_method" />
    <?php endif ?>

    <table class="table table-striped table-hover">
        <thead>
          <tr>
            <td colspan="2">
              <a href="<?php echo url_for('user/show?id=' . $form->getDefault('user_id')) ?>" class="btn">
                  <i class="icon-chevron-left"></i> Back to user
              </a>
            </td>
          </tr>
        </thead>
        <tbody>
          <?php echo $form ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                  <?php if (!$form->getObject()->isNew()) : ?>

                    <a href="<?php echo url_for('car/delete?user-id=' . $form->getDefault('user_id') . '&id=' . $form->getObject()->getId()) ?>" class="btn btn-danger">
                       <i class="icon-remove icon-white"></i> Delete
                    </a>

                    <?php $form = new BaseForm(); echo "<script type='text/javascript'>var csrfId = '{$form->getCSRFFieldName()}'; var csrfToken = '{$form->getCSRFToken()}';</script>"?>

                    <div id="confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modal-label">Delete user</h3>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this car?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            <button class="btn btn-primary" id="delete">Ok</button>
                        </div>
                    </div>

                  <?php endif ?>

                  <button type="submit" class="btn btn-primary">
                      <i class="icon-ok icon-white"></i> Save
                  </button>
                </td>
            </tr>
        </tfoot>
    </table>
</form>