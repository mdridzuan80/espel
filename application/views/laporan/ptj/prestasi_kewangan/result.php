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
                  <th style="width:10%;" rowspan="3">Bahagian / Jabatan</th>
                  <th style="width:10%;" rowspan="3">Jenis Peruntukan</th>
                  <th style="width:90%;" colspan="10">Prestasi</th>
                </tr>
                <tr>
                    <th style="width:9%;" rowspan="2">Jumlah Peruntukan</th>
                    <th style="width:9%;" rowspan="2">Bil. Kursus Dirancang</th>
                    <th style="width:9%;" rowspan="2">Bil. Kursus Dianjurkan</th>
                    <th style="width:27%;" colspan="3">Bil. Pegawai Hadir Kursus</th>
                    <th style="width:9%;" rowspan="2">Perbelanjaan (RM)</th>
                    <th style="width:9%;" rowspan="2">Perbelanjaan (%)</th>
                    <th style="width:9%;" rowspan="2">Tanggungan</th>
                    <th style="width:9%;" rowspan="2">Baki Peruntukan</th>
                </tr>
                <tr>
                    <th style="width:9%;">Sokongan</th>
                    <th style="width:9%;">P & P</th>
                    <th style="width:9%;">Jumlah Keseluruhan</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($peruntukan_semasa as $semasa) : ?>
                <tr>
                <td><?= $semasa->title ?></td>
                <td><?= $semasa->nama ?></td>
                <td>RM <?= $semasa->jumlah ?></td>
                <td><?= $objKursus->kursus->rancang(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id)->num_rows() ?></td>
                <td><?= $objKursus->kursus->laksana(implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y'),$semasa->jns_peruntukan_id)->num_rows() ?></td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <?php $belanja = $objPeruntukan->peruntukan->belanja($semasa->jns_peruntukan_id, implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y')) ?>
                <td>RM <?= $belanja ?></td>
                <td><?= ($belanja/$semasa->jumlah)*100 ?></td>
                <?php $tanggungan = $objPeruntukan->peruntukan->tanggungan($semasa->jns_peruntukan_id, implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y')) ?>
                <td>RM <?= $tanggungan ?></td>
                <td>RM <?= $semasa->jumlah - $belanja ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
