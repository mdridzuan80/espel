<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Kursus Luar</h2>
          <a href="<?=base_url("kursus/daftar_luar")?>" class="btn btn-primary pull-right" role="button">Daftar Kursus Luar</a>
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
          <?php if(count($sen_kursus)):?>
          <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered jambo_table">
                  <thead>
                    <tr class="headings">
                      <th>Tajuk</th>
                      <th>Program</th>
                      <th>Mula</th>
                      <th>Tamat</th>
                      <th>Pengesahan</th>
                      <th>Dokumen Sokongan</th>
                      <th style="text-align:center">Operasi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($sen_kursus as $kursus):?>
                    <tr>
                      <td><?=$kursus->tajuk?></td>
                      <td><?=$kursus->program->nama?></td>
                      <td><?=date('d M Y h:i A',strtotime($kursus->tkh_mula))?></td>
                      <td><?=date('d M Y h:i A',strtotime($kursus->tkh_tamat))?></td>
                      <td>
                        <?php if($kursus->stat_hadir == 'M'):?>
                        <span class="label label-warning">Belum disahkan</span>
                        <?php endif?>
                        <?php if($kursus->stat_hadir == 'L'):?>
                        <span class="label label-success">disahkan</span>
                        <?php endif?>
                        <?php if($kursus->stat_hadir == 'T'):?>
                        <span class="label label-danger">Tidak disahkan</span>
                        <?php endif?>
                      </td>
                      <td>
                      <?php if($kursus->dokumen_path) : ?>
                      <a class="btn btn-info btn-sm" target="_blank" href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>">Papar dokumen</a></td>
                      <?php endif ?>
                      <td align="center">
                          <?php if($kursus->stat_hadir == 'M'):?>
                          <a href="<?=base_url('kursus/edit_luar/' . $kursus->id)?>" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" title="Kemaskini"><i class="fa fa-edit"></i></a>
                          <a href="<?=base_url('kursus/delete_luar/' . $kursus->id)?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
                          <?php endif?>
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
