  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>LAPORAN KESELURUHAN PRESTASI <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered jambo_table">
              <thead>
                <tr>
                  <th style="width:5%;" rowspan="2">Bil</th>
                  <th style="width:10%;" rowspan="2">Gred / Kumpulan</th>
                  <th style="width:10%;" rowspan="2">Bilangan Pengisian</th>
                  <th style="width:10%;" colspan="8" style="text-align:center;">Bilangan Hari</th>
                  <th style="width:10%;" rowspan="2">Lebih 7 hari</th>
                  <th style="width:9%;" rowspan="2">Jumlah (7 dan Lebih 7 hari)</th>
                  <th style="width:9%;" rowspan="2">Pencapaian (7 dan Lebih 7 Hari) (%)</th>
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
                    <td><?= (in_array('1',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"0\" data-kelas=\"" . $kelas->kelas . "\">" . $bil0 = $kelas->kosong . "</a>" : '' ?></td>
                    <td><?= (in_array('2',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"1\" data-kelas=\"" . $kelas->kelas . "\">" . $bil1 = $kelas->satu . "</a>" : '' ?></td>
                    <td><?= (in_array('3',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"2\" data-kelas=\"" . $kelas->kelas . "\">" . $bil2 = $kelas->dua . "</a>" : '' ?></td>
                    <td><?= (in_array('4',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"3\" data-kelas=\"" . $kelas->kelas . "\">" . $bil3 = $kelas->tiga . "</a>" : '' ?></td>
                    <td><?= (in_array('5',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"4\" data-kelas=\"" . $kelas->kelas . "\">" . $bil4 = $kelas->empat . "</a>" : '' ?></td>
                    <td><?= (in_array('6',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"5\" data-kelas=\"" . $kelas->kelas . "\">" . $bil5 = $kelas->lima . "</a>" : '' ?></td>
                    <td><?= (in_array('7',$objFilter->hari)) ? "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"6\" data-kelas=\"" . $kelas->kelas . "\">" . $bil6 = $kelas->enam . "</a>" : '' ?></td>
                    <?php $tujuh =  (in_array('8',$objFilter->hari)) ? $bil7 = $kelas->tujuh : '' ?>
                    <td><?= "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"7\" data-kelas=\"" . $kelas->kelas . "\">" . $tujuh . "</a>" ?></td>
                    <?php $over_tujuh =  (in_array('9',$objFilter->hari)) ? $bilover7 = $kelas->over_7 : '' ?>
                    <td><?= "<a class=\"pdetail\" style=\"text-decoration: underline\" href=\"prestasi_detail\" data-hari=\"8\" data-kelas=\"" . $kelas->kelas . "\">" . $over_tujuh . "</a>" ?></td>
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
        </div>
      </div>
    </div>
  </div>
