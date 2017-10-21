  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Senarai Kursus Yang Hadir <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="datatable table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Tarikh Mula</th>
                <th>Tarikh Tamat</th>
                <th>Bil. Hari</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($sen_hadir as $hadir): ?>
              <tr>
                <td><?=$hadir->tajuk?></td>
                <td><?=$hadir->jabatan?></td>
                <td><?=date("d M Y h:i A",strtotime($hadir->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($hadir->tkh_tamat))?></td>
                <td><?=$hadir->hari?></td>
              </tr>
          <?php endforeach?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
