  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>LAPORAN SENARAI ANGGOTA YANG TIDAK MENJAWAB BORANG B <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered jambo_table datatable">
              <thead>
                <tr>
                  <th style="width:1%;">Bil</th>
                  <th style="width:20%;">Nama PPP</th>
                  <th style="width:20%;">Jabatan PPP</th>
                  <th style="width:20%;">Kumpulan Gred PPP</th>
                  <th style="width:20%;">Skim Perkhidmatan PPP</th>
                  <th style="width:5%;">Gred PPP</th>
                   <th style="width:5%;">Nama PYD</th>
                  <th style="width:5%;">Tajuk Kursus</th>
                </tr>
              </thead>
              <tbody>
                <?php $x = 1 ?>
                <?php foreach($sen_anggota as $anggota) : ?>
                <tr>
                    <td><?= $x++ ?></td>
                    <td><?= $anggota->nama ?></td>
                    <td><?= $anggota->jabatan_ppp ?></td>
                    <td><?= $anggota->kumpulan_ppp ?></td>
                    <td><?= $anggota->skim_ppp ?></td>
                    <td><?= $anggota->gred_id ?></td>
                    <td><?= $anggota->peserta ?></td>
                    <td><?= $anggota->tajuk ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
