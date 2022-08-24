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
            <td style="width:15%;"><img src="<?= ('/var/www/html/espel/assets/images/coa-malaysia-govt.png') ?>" ></td>
            <td style="width:70%;">
                <table>
                    <tr>
                        <td><b>LAPORAN SENARAI KURSUS YANG DIHADIRI PADA <?= $tahun ?></b></td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?=$profil->nama ?></td>
                                </tr>
                            </table>               
                        </td>
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
          <th style="width:40%;">TAJUK KURSUS</th>
          <th style="width:30%;">ANJURAN</th>
          <th style="width:10%;">MULA</th>
          <th style="width:10%;">TAMAT</th>
          <th style="width:5%;">BIL. HARI</th>
        </tr>
      </thead>
      <tbody>
        <?php $x = 1 ?>
        <?php $mycpdp = 0 ?>
        <?php $jumlah=0; foreach($sen_hadir as $hadir) : ?>
        <tr>
            <td style="width:5%;"><?= $x++ ?></td>
            <td style="width:40%;"> <?=$hadir->tajuk?></td>
            <td style="width:30%;"><?= ($hadir->anjuran == 'D') ? $hadir->anjuran_dalam : $hadir->anjuran_luar ?></td>
            <td style="width:10%;"><?=date("d M Y h:i A",strtotime($hadir->tkh_mula))?></td>
            <td style="width:10%;"><?=date("d M Y h:i A",strtotime($hadir->tkh_tamat))?></td>
            <td style="width:5%;"><?=$hadir->hari?></td>
            <?php
                $jumlah += $hadir->hari;
            ?>
        </tr>
        <?php endforeach ?>
        <tr>
                <td colspan="3">MYCPD</td>
                <td colspan="2">Point : <?= $mycpd->point ?></td>
                <td>
                <?php
                  if($mycpd->point != 0):
                    echo $mycpdp = round(($mycpd->point/40)*7);
                  else:
                    echo 0;
                  endif
                ?>
                </td>
              </tr>
              <tr>
                <td colspan="5">JUMLAH HARI</td>
                <td><?= round($jumlah + $mycpdp) ?></td>
              </tr>
       </tbody>
   </table>
</page>
