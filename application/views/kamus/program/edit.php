<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Kemaskini Program</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="txtProgram" name="txtProgram" required="required" class="form-control col-md-7 col-xs-12" value="<?=$program->nama?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="txtKeterangan" name="txtKeterangan" required="required" class="form-control col-md-7 col-xs-12"><?=$program->keterangan?></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <a href="<?= base_url('kamus/program/')?>" class="btn btn-primary" type="reset">Cancel</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Aktiviti terlibat</h2>
          <a href="<?=base_url("kamus/aktiviti_add/" . $program->id)?>" class="btn btn-primary pull-right" role="button">Tambah Aktiviti</a>
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
          <?php if(count($program->list_aktiviti)):?>
          <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Aktiviti</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>


                <tbody>
                <?php foreach($program->list_aktiviti as $aktiviti):?>
                  <tr>
                    <td><?=$aktiviti->nama?></td>
                    <td align="center">
                        <a href="<?=base_url('kamus/aktiviti_edit/' . $aktiviti->id)?>" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" title="Kemaskini"><i class="fa fa-edit"></i></a>
                        <a href="<?=base_url('kamus/aktiviti_delete/' . $aktiviti->id)?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
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
