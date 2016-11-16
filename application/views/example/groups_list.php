<div class="">
    <div class="clearfix"></div>

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Groups<small>
		<?php echo anchor(site_url('example/create'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="datatable-buttons">
            <thead>
                <tr>
                    <th width="10px">No</th>
		    <th>Name</th>
		    <th>Description</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($example_data as $example)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $example->name ?></td>
		    <td><?php echo $example->description ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('example/read/'.$example->id),'<i class="fa fa-eye"></i>','title="Detail" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('example/update/'.$example->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('example/delete/'.$example->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                 </div>
            </div>
        </div>

       
            </div>
        </div>
    </div>
</div>