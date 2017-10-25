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
            <td style="width: 100%; text-align:center;"><h3>LAPORAN SENARAI KURSUS YANG DIHADIRI PADA <?= $tahun ?></h3></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Nama</td>
            <td>: <?=$profil->nama ?></td>
        </tr>
    </table>
    <br/>
    <table class="biasa">
      <thead>
        <tr>
          <th style="width:5%;">BIL</th>
          <th style="width:35%;">TAJUK KURSUS</th>
          <th style="width:10%;">ANJURAN</th>
          <th style="width:10%;">MULA</th>
          <th style="width:10%;">TAMAT</th>
          <th style="width:5%;">BIL. HARI</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 1 ?>
        <?php foreach($sen_hadir as $hadir) : ?>
        <tr>
            <td><?= $x++ ?></td>
            <td><?=$hadir->tajuk?></td>
            <td><?= ($hadir->anjuran == 'D') ? $hadir->anjuran_dalam : $hadir->anjuran_luar ?></td>
            <td><?=date("d M Y h:i A",strtotime($hadir->tkh_mula))?></td>
            <td><?=date("d M Y h:i A",strtotime($hadir->tkh_tamat))?></td>
            <td><?=$hadir->hari?></td>
        </tr>
        <?php endforeach ?>
       </tbody>
   </table>
</page>
