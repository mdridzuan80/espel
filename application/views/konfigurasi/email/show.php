<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Konfigurasi Email</h2>
          <a href="<?=base_url("konfigurasi/email/add")?>" class="btn btn-primary pull-right" role="button">Tambah Konfigurasi E-mail</a>
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
          <?php if(count($mails)):?>
          <div class="table-responsive">
              <table class="table table-striped table-bordered jambo_table datatable">
                <thead>
                  <tr class="headings">
                    <th>Nama</th>
                    <th>Host</th>
                    <th>Username</th>
                    <th>Port</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>


                <tbody>
                <?php foreach($mails as $mail):?>
                  <tr>
                    <td><?=$mail->nama?></td>
                    <td><?=$mail->host?></td>
                    <td><?=$mail->user?></td>
                    <td><?=$mail->port?></td>
                    <td align="center">
                        <a href="<?=base_url('konfigurasi/email/' . $mail->id . "/default")?>" class="btn btn-round btn-xs <?=($mail->status)?"btn-warning":"btn-default"?>" data-toggle="tooltip" title="Aktifkan"><i class="fa fa-star"></i></a>
                        <a href="<?=base_url('konfigurasi/email/' . $mail->id . "/kemaskini")?>" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" title="Kemaskini"><i class="fa fa-edit"></i></button>
                        <a href="<?=base_url('konfigurasi/email/' . $mail->id . "/hapus")?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
                    </td>
                  </tr>
                <?php endforeach?>
                 </tbody>
              </table>
            </div>
          </div>
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
