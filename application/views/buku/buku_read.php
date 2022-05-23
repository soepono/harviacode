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
        <h2 style="margin-top:0px">Buku Read</h2>
        <table class="table">
	    <tr><td>Kode Buk</td><td><?php echo $kode_buk; ?></td></tr>
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Pengarang</td><td><?php echo $pengarang; ?></td></tr>
	    <tr><td>Peneribit</td><td><?php echo $peneribit; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('buku') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>