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
        <h2>Buku List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Buk</th>
		<th>Judul</th>
		<th>Pengarang</th>
		<th>Peneribit</th>
		
            </tr><?php
            foreach ($buku_data as $buku)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $buku->kode_buk ?></td>
		      <td><?php echo $buku->judul ?></td>
		      <td><?php echo $buku->pengarang ?></td>
		      <td><?php echo $buku->peneribit ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>