<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Sample Read</h2>
        <table class="table">
	    <tr><td>Sas1</td><td><?php echo $sas1; ?></td></tr>
	    <tr><td>Assa2</td><td><?php echo $assa2; ?></td></tr>
	    <tr><td>Sas3</td><td><?php echo $sas3; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('sample') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>