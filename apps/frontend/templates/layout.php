<!DOCTYPE html>
<html lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php include_stylesheets() ?>
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a href="<?php echo url_for('homepage') ?>" class="brand active">Car Management System</a>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="offset1 span9">
                <?php echo $sf_content ?>
            </div>
        </div>
    </div>
    <?php include_javascripts() ?>
</body>
</html>