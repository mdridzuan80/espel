 <div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Kursus</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Latihan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control espel_program" name="comProgram" disabled>
                                <option value="0">-pilih-</option>
                                <?php foreach($sen_program as $key=>$val):?>
                                <option value="<?=$key?>" <?=set_select('comProgram', $key, $key==$kursus->program_id)?> ><?=$val?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($kursus->program_id == 1 || $kursus->program_id == 2):?>
<div class="row espel_latihan">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kemaskini Daftar Kursus Program Latihan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
            <form method="post" class="form-horizontal form-label-left frm-edit-daftar-kursus" enctype="multipart/form-data">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
                  <input type="hidden" class="hddKursusId" name="hddKursusId" value="<?=set_value('hddKursusId', $kursus->id)?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option value="">Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_lat as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-63 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula" required="required" value="<?= set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula))) ?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat" required="required" value="<?= set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat))) ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMula" name="txtMasaMula" required="required" value="<?=set_value('txtTkhMula',date('h:i A',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamat" name="txtMasaTamat" required="required" value="<?=set_value('txtTkhTamat',date('h:i A',strtotime($kursus->tkh_tamat)))?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurLatihan" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurLatihan" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("dashboard/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <?php if($kursus->dokumen_path) : ?>
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" target="_blank" class="btn btn-primary btn-sm">Papar Dokumen</a>
                      </div>
                  </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Sokongan</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="userfile">
                        <span>*Hanya PDF/imej berformat jpeg/jpg/gif/png sahaja dibenarkan</span>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <?php if(appsess()->getSessionData("kumpulan") == AppAuth::PENYELARAS) : ?>
                        <button type="button" class="btn btn-danger btn-hapus-penyelaras" data-kursus_id="<?= $kursus->id ?>" name="submit">Hapus</button>
                        <?php endif ?>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<!-- latihan -->

<!-- pembelajaran 1 -->
<?php if($kursus->program_id == 3):?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kemaskini Daftar Kursus Program Sesi Pembelajaran (Bersemuka)</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-daftar-kursus" enctype="multipart/form-data">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
                  <input type="hidden" class="hddKursusId" name="hddKursusId" value="<?=set_value('hddKursusId', $kursus->id)?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb1 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-63 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb" name="txtTkhMula" required="required" value="<?= set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula))) ?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb" name="txtTkhTamat" required="required" value="<?= set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat))) ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaPemb" name="txtMasaMula" required="required" value="<?=set_value('txtTkhMula',date('h:i A',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatPemb" name="txtMasaTamat" required="required" value="<?=set_value('txtTkhTamat',date('h:i A',strtotime($kursus->tkh_tamat)))?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat',$kursus->tempat)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranPemb">
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur-pemb" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur-pemb" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("dashboard/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <?php if($kursus->dokumen_path) : ?>
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" target="_blank" class="btn btn-primary btn-sm">Papar Dokumen</a>
                      </div>
                  </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Sokongan</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="userfile">
                        <span>*Hanya PDF/imej berformat jpeg/jpg/gif/png sahaja dibenarkan</span>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <?php if (appsess()->getSessionData("kumpulan") == AppAuth::PENYELARAS) : ?>
                        <button type="button" class="btn btn-danger btn-hapus-penyelaras" data-kursus_id="<?= $kursus->id ?>" name="submit">Hapus</button>
                        <?php endif ?>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<!-- Sesi pembelajaran -->

<!-- pembelajaran 2 -->
<?php if($kursus->program_id == 4):?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kemaskini Daftar Kursus Program Sesi Pembelajaran (Tidak Bersemuka)</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-daftar-kursus" enctype="multipart/form-data">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
                  <input type="hidden" class="hddKursusId" name="hddKursusId" value="<?=set_value('hddKursusId', $kursus->id)?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb2 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-63 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb2" name="txtTkhMula" required="required" value="<?= set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula))) ?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb2" name="txtTkhTamat" required="required" value="<?= set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat))) ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaPemb2" name="txtMasaMula" required="required" value="<?=set_value('txtTkhMula',date('h:i A',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatPemb2" name="txtMasaTamat" required="required" value="<?=set_value('txtTkhTamat',date('h:i A',strtotime($kursus->tkh_tamat)))?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat',$kursus->tempat)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranPemb2">
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur-pemb2" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb2" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur-pemb2" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb2" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("dashboard/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <?php if($kursus->dokumen_path) : ?>
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" target="_blank" class="btn btn-primary btn-sm">Papar Dokumen</a>
                      </div>
                  </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Sokongan</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="userfile">
                        <span>*Hanya PDF/imej berformat jpeg/jpg/gif/png sahaja dibenarkan</span>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <?php if (appsess()->getSessionData("kumpulan") == AppAuth::PENYELARAS) : ?>
                        <button type="button" class="btn btn-danger btn-hapus-penyelaras" data-kursus_id="<?= $kursus->id ?>" name="submit">Hapus</button>
                        <?php endif ?>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<!-- Sesi pembelajaran -->

<!-- Kendiri -->
<?php if($kursus->program_id == 5):?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Pembelajaran Kendiri</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-daftar-kursus" enctype="multipart/form-data">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
                  <input type="hidden" class="hddKursusId" name="hddKursusId" value="<?=set_value('hddKursusId', $kursus->id)?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_kendiri as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-63 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaKend" name="txtTkhMula" required="required" value="<?= set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula))) ?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatKend" name="txtTkhTamat" required="required" value="<?= set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat))) ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaKend" name="txtMasaMula" required="required" value="<?=set_value('txtTkhMula',date('h:i A',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatKend" name="txtMasaTamat" required="required" value="<?=set_value('txtTkhTamat',date('h:i A',strtotime($kursus->tkh_tamat)))?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtSumber" required="required" class="form-control col-md-7 col-xs-12" name="txtSumber" value="<?=set_value('txtSumber', $kursus->sumber)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Pembentangan *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" type="text" id="txtTempat" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penyelia *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPenyelia" id="comPenyelia">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_penyelia as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comPenyelia', $key, $key==$kursus->penyelia_nokp)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranKend">
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur-kend" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurKend" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur-kend" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurKend" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("dashboard/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <?php if($kursus->dokumen_path) : ?>
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" target="_blank" class="btn btn-primary btn-sm">Papar Dokumen</a>
                      </div>
                  </div>
                  <?php endif ?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Sokongan</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="userfile">
                        <span>*Hanya PDF/imej berformat jpeg/jpg/gif/png sahaja dibenarkan</span>
                    </div>
                  </div>                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <?php if (appsess()->getSessionData("kumpulan") == AppAuth::PENYELARAS) : ?>
                        <button type="button" class="btn btn-danger btn-hapus-penyelaras" data-kursus_id="<?= $kursus->id ?>" name="submit">Hapus</button>
                        <?php endif ?>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<!-- Kendiri -->
