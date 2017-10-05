<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-info"></i> Maklumat Kursus</h2>
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
                <div id="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table class="table table-bordered">
                      <tbody>
                          <tr>
                          <th scope="row">Program</th>
                          <td colspan="3"><?=$kursus->program->nama?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tajuk Kursus</th>
                          <td colspan="3"><?=$kursus->tajuk?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tarikh Mula</th>
                          <td><?=$kursus->tkh_mula?></td>
                          <th scope="row">Tarikh Tamat</th>
                          <td><?=$kursus->tkh_tamat?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tempat</th>
                          <td colspan="3"><?=$kursus->tempat?></td>
                        </tr>
                        <tr>
                          <th scope="row">Penganjur</th>
                          <td colspan="3"><?=($kursus->anjuran == 'D') ? $kursus->penganjur->nama : $kursus->penganjur ?></td>
                        </tr>
                      </tbody>
                    </table>
                    <?php if(!$kursus->peruntukan_id) : ?>
                    <button type="button" class="btn btn-success" name="submit">Laksana</button>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($kursus->peruntukan_id) : ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Maklumat Perbelanjaan</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form method="post" class="form-horizontal form-label-left">
                    <?php $csrf = [
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                        ];
                    ?>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control input-sm" id="comStat" name="comStat">
                                <option value="T">Tanggungan</option>
                                <option value="S">Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama">No. LO<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtNoLO" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtNoLO" value="<?=(isset($belanja->no_lo)) ? $belanja->no_lo : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Host">Tarikh LO<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtTkhLO" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtTkhLO" value="<?=(isset($belanja->tkh_lo)) ? date('d-m-Y',strtotime($belanja->tkh_lo)) : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Jumlah<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtJumlah" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtJumlah" value="<?=(isset($belanja->jumlah)) ? $belanja->jumlah : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">No. Resit<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtNoResit" class="form-control col-md-7 col-xs-12 input-sm" name="txtNoResit" value="<?=(isset($belanja->no_resit)) ? $belanja->no_resit : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">Tarikh Resit<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtTkhResit" class="form-control col-md-7 col-xs-12 input-sm" name="txtTkhResit" value="<?=(isset($belanja->tkh_resit)) ? date('d-m-Y',strtotime($belanja->tkh_resit)) : ''?>">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-primary" name="submit">Laksana</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif ?>
