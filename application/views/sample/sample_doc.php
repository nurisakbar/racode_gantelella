<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Sample List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Sas1</th>
		<th>Assa2</th>
		<th>Sas3</th>
		
            </tr><?php
            foreach ($sample_data as $sample)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $sample->sas1 ?></td>
		      <td><?php echo $sample->assa2 ?></td>
		      <td><?php echo $sample->sas3 ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>