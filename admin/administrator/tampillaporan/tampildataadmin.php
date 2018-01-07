<form action="../../cetaklaporan/cetak-admin.php" method="POST">
<table class="tabel2">
    <h4>Laporan Data Petugas</h4>
    <tr>
        <th>Kode Pengguna</th>
        <th>Nama Lengkap</th>
        <th>Nama Pengguna</th>
        <th>Level</th>
        <th>Aksi</th>
    </tr>

    <?php 
    $sql = mysql_query("SELECT * FROM admin") or die(mysql_error());
    $cek = mysql_num_rows($sql);
    if ($cek == 0) { ?>
        <tr>
            <td></td>
            <td></td>
            <td>Data Tidak DiTemukan</td>
        </tr>
    <?php 
    } else {
        while ($data = mysql_fetch_array($sql)) { ?>
            <tr>
                <td class="tampilan"><?php echo $data['kodeuser']; ?></td>
                <td class="tampilan"><?php echo $data['nama']; ?></td>
                <td class="tampilan"><?php echo $data['username']; ?></td>
                <td class="tampilan"><?php echo $data['level']; ?></td>
                <td class="tampilan">
                    <a target="_BLANK" href="laporan-solo/laporanpetugas.php?kodeuser=<?php echo $data['kodeuser']; ?>"><i class="fa fa-print" title="Cetak" target="_BLANK"></i></a>
                </td>
            </tr>
        <?php
        }
    }
         ?> 
</table>
<table>
    <tr>
        <td><input type="submit" name="submit" value="Cetak Data Keseluruhan"></td>
    </tr>
</table>
</form>
