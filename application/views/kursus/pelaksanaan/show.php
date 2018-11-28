<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <a href="<?= base_url() ?>">Home</a> &gt; <a href="<?= base_url('kursus/takwim') ?>">Modul Kursus :: Takwim Kursus (Rancang)</a> &gt; Pelaksanaan Kursus
  </div>
</div>
<br/>
<?= $vlevel ?>
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
                          <td colspan="3"><?=($kursus->anjuran == 'D') ? $objJabatan->jabatan->get_by('buid', $kursus->penganjur_id)->title : $kursus->penganjur ?></td>
                        </tr>
                      </tbody>
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">                            
        <div class="x_panel">
            <form method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />

                <div class="x_title">
                    <h2>Surat Rasmi Kursus / Aturcara Kursus</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Surat Jemputan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="file" name="userfile" <?= ($kursus->stat_laksana == 'R') ? 'required' : '' ?> >
                        </div>
                    </div>
                    <?php if($kursus->stat_laksana == 'L' && $kursus->surat): ?>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-info btn-sm" target="_blank" href="<?= base_url('assets/uploads/' . $kursus->surat )?>"><?= $kursus->dokumen_path ?></a>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <br/>
                <?php if($kursus->peruntukan_id) : ?>
                <div class="x_title">
                    <h2>Maklumat Perbelanjaan Kursus</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control input-sm" id="comStat" name="comStat" required>
                                <option value="T" <?=(isset($belanja->stat_byr)) ? ($belanja->stat_byr=='T') ? 'selected' : '' : ''?>>Tanggungan</option>
                                <option value="S" <?=(isset($belanja->stat_byr)) ? ($belanja->stat_byr=='S') ? 'selected' : '' : ''?>>Selesai</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama">No. LO
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtNoLO" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtNoLO" value="<?=(isset($belanja->no_lo)) ? $belanja->no_lo : ''?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Host">Tarikh LO
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtTkhLO" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtTkhLO" value="<?=(isset($belanja->tkh_lo)) ? date('d-m-Y',strtotime($belanja->tkh_lo)) : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Jumlah
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtJumlah" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtJumlah" value="<?=(isset($belanja->jumlah)) ? $belanja->jumlah : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">No. Resit
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtNoResit" class="form-control col-md-7 col-xs-12 input-sm" name="txtNoResit" value="<?=(isset($belanja->no_resit)) ? $belanja->no_resit : ''?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">Tarikh Resit
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="txtTkhResit" class="form-control col-md-7 col-xs-12 input-sm" name="txtTkhResit" value="<?=(isset($belanja->tkh_resit)) ? date('d-m-Y',strtotime($belanja->tkh_resit)) : ''?>">
                        </div>
                    </div>
                    <?php endif ?>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <?php if($kursus->stat_laksana == 'R') : ?>
                            <button type="submit" class="btn btn-primary" name="submit">Laksana</button>
                            <?php else : ?>
                            <button type="submit" class="btn btn-primary" name="submit">Kemaskini dokumen</button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
