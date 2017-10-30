<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Maklumat Program dan Definisi</h2>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Jenis Program</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($sen_program as $program) : ?>
              <tr>
                <td><?= $program->nama ?></td>
                <td><?= $program->keterangan ?></td>
              </tr>
            <?php endforeach ?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
