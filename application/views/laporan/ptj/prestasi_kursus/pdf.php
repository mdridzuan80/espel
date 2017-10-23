<style type="text/css">
table
{
    width:  100%;
}
td
{
    /*text-align: center;*/
}

table.biasa, table.listing {
    border-collapse: collapse;
    border-color: #000;
    border-width: 1px;
    color: #000;
}
table.biasa th, table.listing th {
    background: #333;
    border-color: #262628;
    border-style: solid;
    border-width: 1px;
    color: #FDFDFF;
    font-weight: bold;
    padding: 3px 8px;
    text-transform: uppercase;
}
table.biasa tr, table.listing tr {
    background-color: #FFFFFF;
}
table.biasa tr.even, table.listing tr.even {
    background-color: #F5F5F7;
}
table.biasa td, table.listing td {
    border-color: #000;
    border-style: solid;
    border-width: 1px;
    padding: 3px 8px;
}
</style>

<page>
    <page_footer style="font-size: 9px">
       <table style="width: 100%;">
             <tr>
                     <td style="text-align: left;    width: 50%">Tarikh Cetakkan : <?php echo date('d-m-Y H:m:s') ?></td>
                     <td style="text-align: right;    width: 50%"></td>
             </tr>
       <tr>
           <td style="text-align: left;    width: 50%">Sistem Pengurusan Latihan (eSPeL)</td>
           <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
       </tr>
       </table>
    </page_footer>

    <table>
        <tr>
            <td style="width: 100%; text-align:center;"><h3>LAPORAN KESELURUHAN PRESTASI <?= $tahun ?></h3></td>
        </tr>
    </table>
    <br/>
    <table class="biasa">
      <thead>
        <tr>
          <th style="width:5%;" rowspan="2">Bil</th>
          <th style="width:10%;" rowspan="2">Gred / Kumpulan</th>
          <th style="width:10%;" rowspan="2">Bilangan Perjawatan</th>
          <th style="width:10%;" colspan="8" style="text-align:center;">Bilangan Hari</th>
          <th style="width:10%;" rowspan="2">Lebih 7 hari</th>
          <th style="width:9%;" rowspan="2">Jumlah (7 dan Lebih 7 hari)</th>
        </tr>
        <tr>
            <th style="width:5%;">0</th>
            <th style="width:5%;">1</th>
            <th style="width:5%;">2</th>
            <th style="width:5%;">3</th>
            <th style="width:5%;">4</th>
            <th style="width:5%;">5</th>
            <th style="width:5%;">6</th>
            <th style="width:5%;">7</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 1 ?>
        <?php foreach($sen_kelas as $kelas) : ?>
        <tr>
            <td><?= $x++ ?></td>
            <td><?= $kelas->keterangan ?></td>
            <td><?= $kelas->bil ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 0, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 1, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 2, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 3, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 4, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 5, $kelas->kod) ?></td>
            <td><?= $objKursus->kursus->bil_prestasi_kelas($tahun, 6, $kelas->kod) ?></td>
            <?php $tujuh =  $objKursus->kursus->bil_prestasi_kelas($tahun, 7, $kelas->kod) ?>
            <td><?= $tujuh ?></td>
            <?php $over_tujuh =  $objKursus->kursus->bil_prestasi_kelas($tahun, 8, $kelas->kod) ?>
            <td><?= $over_tujuh ?></td>
            <td><?= $tujuh + $over_tujuh ?></td>
        </tr>
        <?php endforeach ?>
       </tbody>
   </table>
</page>
