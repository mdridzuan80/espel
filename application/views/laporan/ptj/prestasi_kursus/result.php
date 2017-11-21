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
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 0, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 1, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 2, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 3, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 4, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 5, $kelas->id) ?></td>
                    <td><?= $objKursus->kursus->bil_prestasi_kelas($objFilter, 6, $kelas->id) ?></td>
                    <?php $tujuh =  $objKursus->kursus->bil_prestasi_kelas($objFilter, 7, $kelas->id) ?>
                    <td><?= $tujuh ?></td>
                    <?php $over_tujuh =  $objKursus->kursus->bil_prestasi_kelas($objFilter, 8, $kelas->id) ?>
                    <td><?= $over_tujuh ?></td>
                    <td><?= $tujuh + $over_tujuh ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
