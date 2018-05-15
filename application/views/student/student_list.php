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
		
        <h2 style="margin-top:0px">Student List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('student/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('student/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('student'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Fakultas Id</th>
		<th>Jurusan Id</th>
		<th>Nim</th>
		<th>Name</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Birthday</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th>Action</th>
            </tr><?php
            foreach ($student_data as $student)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $student->fakultas_id ?></td>
			<td><?php echo $student->jurusan_id ?></td>
			<td><?php echo $student->nim ?></td>
			<td><?php echo $student->name ?></td>
			<td><?php echo $student->address ?></td>
			<td><?php echo $student->phone ?></td>
			<td><?php echo $student->birthday ?></td>
			<td><?php echo $student->created_at ?></td>
			<td><?php echo $student->updated_at ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('student/read/'.$student->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('student/update/'.$student->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('student/delete/'.$student->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
		
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
				<a href="/qwerty/fakultas/" class="btn btn-primary">Fakultas</a>
				<a href="/qwerty/jurusan/" class="btn btn-primary">Jurusan</a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>