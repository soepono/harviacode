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
        <h2 style="margin-top:0px">Buku <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kode Buk <?php echo form_error('kode_buk') ?></label>
            <input type="text" class="form-control" name="kode_buk" id="kode_buk" placeholder="Kode Buk" value="<?php echo $kode_buk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pengarang <?php echo form_error('pengarang') ?></label>
            <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Pengarang" value="<?php echo $pengarang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Peneribit <?php echo form_error('peneribit') ?></label>
            <input type="text" class="form-control" name="peneribit" id="peneribit" placeholder="Peneribit" value="<?php echo $peneribit; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>