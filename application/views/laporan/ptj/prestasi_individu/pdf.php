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

<page style="font-size: 10px">
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
            <td style="width:1%;"><img src="<?= base_url('assets/images/coa-malaysia-govt.png') ?>" ></td>
            <td style="width: 75%;">
                <table>
                    <tr>
                        <td><b>LAPORAN PRESTASI SENARAI ANGGOTA <?= $tahun ?></b></td>
                    </tr>
                </table>
            </td>
            <td style="width:1%;"><img src="<?= base_url('assets/images/kkm_logo_110h.png') ?>" ></td>
        </tr>
    </table>
    <br/>
    <table class="biasa">
      <thead>
        <tr>
          <th style="width:5%;">Bil</th>
          <th style="width:20%;">Nama</th>
          <th style="width:20%;">Jabatan</th>
          <th style="width:20%;">Kumpulan Gred</th>
          <th style="width:20%;">Skim Perkhidmatan</th>
          <th style="width:5%;">Gred</th>
          <th style="width:5%;">Hari</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 1 ?>
        <?php foreach($sen_anggota as $anggota) : ?>
        <tr>
            <td><?= $x++ ?></td>
            <td><?= $anggota->nama ?></td>
            <td><?= $anggota->jabatan ?></td>
            <td><?= $anggota->kumpulan ?></td>
            <td><?= $anggota->skim ?></td>
            <td><?= $anggota->gred_id ?></td>
            <td><?= $anggota->hari ?></td>
        </tr>
        <?php endforeach ?>
       </tbody>
   </table>
</page>
