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
            <td style="width:1%;"><img src="<?= base_url('assets/images/coa-malaysia-govt.png') ?>" ></td>
            <td style="width: 75%;">
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="width: 100%; text-align:center; font-size: 12px">LAPORAN KESELURUHAN PRESTASI <?= $tahun ?></td>
                                </tr>
                            </table>               
                        </td>
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
        <?php
            $jbiltotal = 0;
            $jbil0='';
            $jbil1='';
            $jbil2='';
            $jbil3='';
            $jbil4='';
            $jbil5='';
            $jbil6='';
            $jbil7='';
            $jbilover7='';
            $jbil7addover7='';
        ?>
        <?php foreach($sen_kelas as $kelas) : ?>
        <tr>
                <td><?= $x++ ?></td>
                <td><?= $kelas->kumpulan ?></td>
                <td><?= $kelas->pengisian ?></td>
                <td><?= (in_array('1',$objFilter->hari)) ? $bil0 = $kelas->kosong : '' ?></td>
                <td><?= (in_array('2',$objFilter->hari)) ? $bil1 = $kelas->satu : '' ?></td>
                <td><?= (in_array('3',$objFilter->hari)) ? $bil2 = $kelas->dua : '' ?></td>
                <td><?= (in_array('4',$objFilter->hari)) ? $bil3 = $kelas->tiga : '' ?></td>
                <td><?= (in_array('5',$objFilter->hari)) ? $bil4 = $kelas->empat : '' ?></td>
                <td><?= (in_array('6',$objFilter->hari)) ? $bil5 = $kelas->lima : '' ?></td>
                <td><?= (in_array('7',$objFilter->hari)) ? $bil6 = $kelas->enam : '' ?></td>
                <?php $tujuh =  (in_array('8',$objFilter->hari)) ? $bil7 = $kelas->tujuh : '' ?>
                <td><?= $tujuh ?></td>
                <?php $over_tujuh =  (in_array('9',$objFilter->hari)) ? $bilover7 = $kelas->over_7 : '' ?>
                <td><?= $over_tujuh ?></td>
                <td><?= (in_array('8',$objFilter->hari)&&in_array('9',$objFilter->hari)) ? $kelas->over_77 : '' ?></td>
                <td><?= (in_array('8',$objFilter->hari)&&in_array('9',$objFilter->hari)) ? round(($kelas->over_77/$kelas->pengisian),2)*100 : '' ?></td>
                <?php
                $jbiltotal += $kelas->pengisian;
                //dd((int) $jbil0);
                if(in_array('1',$objFilter->hari)) { $jbil0 = (int) $jbil0; (int) $jbil0 += (int) $bil0; };
                if(in_array('2',$objFilter->hari)) { $jbil1 = (int) $jbil1; (int) $jbil1 += (int) $bil1; };
                if(in_array('3',$objFilter->hari)) { $jbil2 = (int) $jbil2; (int) $jbil2 += (int) $bil2; };
                if(in_array('4',$objFilter->hari)) { $jbil3 = (int) $jbil3; (int) $jbil3 += (int) $bil3; };
                if(in_array('5',$objFilter->hari)) { $jbil4 = (int) $jbil4; (int) $jbil4 += (int) $bil4; };
                if(in_array('6',$objFilter->hari)) { $jbil5 = (int) $jbil5; (int) $jbil5 += (int) $bil5; };
                if(in_array('7',$objFilter->hari)) { $jbil6 = (int) $jbil6; (int) $jbil6 += (int) $bil6; };
                if(in_array('8',$objFilter->hari)) { $jbil7 = (int) $jbil7; (int) $jbil7 += (int) $bil7; };
                if(in_array('9',$objFilter->hari)) { $jbilover7 = (int) $jbilover7; (int) $jbilover7 += (int) $bilover7; };
                if(in_array('8',$objFilter->hari)&&in_array('9',$objFilter->hari)) { $jbil7addover7 = (int) $jbil7addover7; (int)$jbil7addover7 += (int)$jbil7+(int)$jbilover7;};
                ?>
            </tr>
        <?php endforeach ?>
            <tr>
                <td><?= $x++ ?></td>
                <td>Jumlah</td>
                <td><?= $jbiltotal ?></td>
                <td><?= (in_array('1',$objFilter->hari)) ? (int)$jbil0 : '' ?></td>
                <td><?= (in_array('2',$objFilter->hari)) ? (int)$jbil1 : '' ?></td>
                <td><?= (in_array('3',$objFilter->hari)) ? (int)$jbil2 : '' ?></td>
                <td><?= (in_array('4',$objFilter->hari)) ? (int)$jbil3 : '' ?></td>
                <td><?= (in_array('5',$objFilter->hari)) ? (int)$jbil4 : '' ?></td>
                <td><?= (in_array('6',$objFilter->hari)) ? (int)$jbil5 : '' ?></td>
                <td><?= (in_array('7',$objFilter->hari)) ? (int)$jbil6 : '' ?></td>
                <?php $tujuh =  (in_array('8',$objFilter->hari)) ? (int)$jbil7 : '' ?>
                <td><?= $tujuh ?></td>
                <?php $over_tujuh =  (in_array('9',$objFilter->hari)) ? (int)$jbilover7 : '' ?>
                <td><?= $over_tujuh ?></td>
                <td><?= (in_array('8',$objFilter->hari)&&in_array('9',$objFilter->hari)) ? ((int)$tujuh + (int)$over_tujuh) : '' ?></td>
                <td><?= (in_array('8',$objFilter->hari)&&in_array('9',$objFilter->hari)) ? round((((int)$tujuh + (int)$over_tujuh)/(int)$jbiltotal),2)*100 : '' ?></td>
            </tr>
       </tbody>
   </table>
</page>
