  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Anggota yang berkaitan</h2>
          <!-- <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button> -->
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="datatable table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama</th>
                <th>Nokp</th>
                <th>jabatan</th>
                <th>Kumpulan Gred</th>
                <th>Bil. Hari</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($sen_detail as $detail) : ?>
              <tr>
                <td><?= $detail->nama ?></td>
                <td><?= $detail->nokp ?></td>
                <td><?= $detail->jabatan ?></td>
                <td><?= $detail->kumpulan ?></td>
                <td><?= $detail->jum_hari ?></td>
              </tr>
          <?php endforeach ?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
