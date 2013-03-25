/**
 * Confirmation dialog shown before deleting an entry
 * 
 * @author Luis Montealegre <montealegreluis@gmail.com>
 */
$(document).ready(function() {
    $('#delete').on('click', function() {
        var $form = $('<form></form>');
        var $method = $('#sf_method');
        
        $form.attr('method', 'post');
        $form.attr('action', $('.btn-danger').attr('href'));
        $method.val('delete');
        $method.appendTo($form);
        $csrfToken = $('<input type="hidden" />');
        $csrfToken.attr('name', csrfId);
        $csrfToken.val(csrfToken);
        $csrfToken.appendTo($form);
        $form.appendTo('body');
        $form.submit();
        
        return false;  //Stop bubbling, prevent the submit of the edit form 
    });
    $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        $('#confirm').modal('show');
    });
});