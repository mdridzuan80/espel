<style type="text/css">

table.biasa, table.listing {
    width: 100%;
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

    <table style="width: 100%;">
        <tr>
            <td style="width:15%;"><img src="./assets/images/coa-malaysia-govt.png" ></td>
            <td style="width:70%;">
                <table>
                    <tr>
                        <td><b>LAPORAN SENARAI PENGANJURAN PADA <?= $tahun ?></b></td>
                    </tr>
                    <tr>
                        <td><b>JABATAN : <?= $carta->title ?></b></td>
                    </tr>
                </table>
            </td>
            <td style="width:15%; text-align: right;"><img src="./assets/images/kkm_logo_110h.png" ></td>
        </tr>
    </table>
    <br/>

    <table class="biasa" style="width: 100%;">
      <thead>
        <tr>
          <th style="width:5%;">BIL</th>
          <th style="width:70%;">TAJUK KURSUS</th>
          <th style="width:10%;">MULA</th>
          <th style="width:10%;">TAMAT</th>
          <th style="width:5%;">BIL. HARI</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 1 ?>
        <?php $mycpdp = 0 ?>
        <?php $jumlah = 0;
        foreach ($sen_kursus as $kursus) : ?>
        <tr>
            <td style="width:5%;"><?= $x++ ?></td>
            <td style="width:70%;"> <?= $kursus->tajuk ?></td>
            <td style="width:10%;"><?= date("d M Y h:i A", strtotime($kursus->tkh_mula)) ?></td>
            <td style="width:10%;"><?= date("d M Y h:i A", strtotime($kursus->tkh_tamat)) ?></td>
            <td style="width:5%;"><?= $kursus->hari ?></td>
        </tr>
        <?php endforeach ?>
       </tbody>
   </table>
</page>
