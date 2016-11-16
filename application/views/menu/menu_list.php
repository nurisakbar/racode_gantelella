<div class="">
    <div class="clearfix"></div>

    <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Menu<small>
		<?php echo anchor(site_url('menu/create'), '<i class="fa fa-files-o"></i> Create', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('menu/excel'), ' <i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-sm btn-primary"'); ?>
		<?php echo anchor(site_url('menu/word'), '<i class="fa fa-file-word-o"></i> Word', 'class="btn btn-sm btn-primary"'); ?></small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
        <table class="table table-bordered table-striped" id="datatable-buttons">
            <thead>
                <tr>
                    <th width="10px">No</th>
		    <th>Link</th>
		    <th>Judul</th>
		    <th>Icon</th>
		    <th>IsParent</th>
		    <th>STATUS</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($menu_data as $menu)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $menu->link ?></td>
		    <td><?php echo $menu->judul ?></td>
		    <td><?php echo $menu->icon ?></td>
		    <td><?php echo $menu->isParent ?></td>
		    <td><?php echo $menu->aktif=='y'?'AKTIF':'TIDAK AKTIF' ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('menu/read/'.$menu->id),'<i class="fa fa-eye"></i>','title="Detail" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('menu/update/'.$menu->id),'<i class="fa fa-edit"></i>','title="Edit Data" class="btn btn-sm btn-danger"'); 
			echo '  '; 
			echo anchor(site_url('menu/delete/'.$menu->id),'<i class="fa fa-trash"></i>','title="Delete Data" class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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