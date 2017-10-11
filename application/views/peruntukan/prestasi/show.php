<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Peruntukan Semasa</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Prestasi Peruntukan 2017</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="x_content">
              <table class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Jenis Peruntukan</th>
                    <th>Peruntukan (RM)</th>
                    <th>Belanja (RM)</th>
                    <th>Baki (RM)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($peruntukan_semasa as $peruntukan) : ?>
                  <tr>
                    <td><?= $peruntukan->nama ?></td>
                    <td>RM<?= $peruntukan->jumlah ?></td>
                    <?php $belanja = $objPeruntukan->peruntukan->belanja($peruntukan->jns_peruntukan_id, implode (",", flattenArray(get_penyelaras_related_jabatan($this->appsess->getSessionData('username')))),date('Y')) ?>
                    <td>RM<?= $belanja ?></td>
                    <td>RM <?= $peruntukan->jumlah - $belanja ?></td>
                  </tr>
                  <?php endforeach ?>
                 </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
