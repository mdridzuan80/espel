<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Pengguna</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if(appsess()->getFlashSession()):?>
            <?php if(appsess()->getFlashSession('success')):?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>INFO!</strong> Proses telah berjaya dilaksanakan.
            </div>
            <?php else:?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>RALAT!</strong> Proses tidak berjaya dilaksanakan.
            </div>
            <?php endif?>
            <?php endif?>
            <?php if(count($profiles)):?>
              <table class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Nama</th>
                    <th>No. KP</th>
                    <th>Skim</th>
                    <th>Gred</th>
                    <th>Jabatan</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($profiles as $profile):?>
                  <tr>
                    <td><?=$profile->nama?></td>
                    <td><?=$profile->nokp?></td>
                    <td><?=$profile->skim?></td>
                    <td><?=$profile->gred_id?></td>
                    <td><?=$profile->jabatan?></td>
                    <td align="center">
                        <a href="<?=base_url("profil/" . $profile->nokp)?>" type="button" class="btn btn-round btn-default btn-xs" data-toggle="tooltip" title="Lihat pengguna"><i class="fa fa-file-o"></i></a>
                        <a href="<?=base_url("profil/" . $profile->nokp . "/reset_katalaluan")?>" type="button" class="btn btn-round btn-default btn-xs" data-toggle="tooltip" title="Reset pengguna"><i class="fa fa-key"></i></a>
                    </td>
                  </tr>
                  <?php endforeach?>
                 </tbody>
              </table>
              <?= $links ?>
          <?php else:?>
          <div class="alert alert-warning " role="warning">
            <strong>INFO!</strong> Tiada rekod
          </div>
          <?php endif?>
                </div>
            </div>
        </div>
    </div>
</div>
