<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <a href="<?= base_url() ?>">Home</a> > <a href="<?= base_url('kursus/takwim') ?>">Modul Kursus :: Takwim Kursus Separa Siap</a> > Info Kursus
  </div>
</div>
<br/>
<?= $vlevel ?>
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Info Jenis Program</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Latihan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control espel_program" disabled>
                                <option selected="selected" >Sila buat pilihan</option>
                                <?php foreach($sen_program as $program):?>
                                <option value="<?= $program->id ?>" <?=set_select('comProgram', $program->id, $program->id==$kursus->program_id)?> ><?=$program->nama?></option>
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
        <h2>Info Maklumat Program Latihan Dalam Negara / Luar Negara</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-separa-kursus" data-kursus_id="<?= $kursus->id ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?= $kursus->program_id ?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_lat as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>">
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
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
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
                        <input id="comPenganjurLatihan" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon" value="<?= $kursus->telefon ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail" value="<?= $kursus->email ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" <?=set_select('comTerbuka', 'T', 'T'==$kursus->stat_terbuka)?> >Tidak</option>
                            <option value="Y" <?=set_select('comTerbuka', 'Y', 'Y'==$kursus->stat_terbuka)?> >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" <?=set_select('comPeruntukan', $peruntukan->id, $peruntukan->id==$kursus->peruntukan_id)?> ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangA','Y', 'Y'==$kursus->stat_soal_selidik_a); ?> > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangB','Y','Y'==$kursus->stat_soal_selidik_b); ?> > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-danger btn-hapus-separa" type="button" data-kursus_id="<?= $kursus->id ?>">Hapus</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif?>
<!-- latihan -->

<?php if($kursus->program_id == 3):?>
<!-- pembelajaran -->
<div class="row espel_pembelajaran1">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran (Bersemuka)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-separa-kursus" data-kursus_id="<?= $kursus->id ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?= $kursus->program_id ?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb1 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>">
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
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon" value="<?= $kursus->telefon ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail" value="<?= $kursus->email ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" <?=set_select('comTerbuka', 'T', 'T'==$kursus->stat_terbuka)?>  >Tidak</option>
                            <option value="Y" <?=set_select('comTerbuka', 'Y', 'Y'==$kursus->stat_terbuka)?> >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" <?=set_select('comPeruntukan', $peruntukan->id, $peruntukan->id==$kursus->peruntukan_id)?> ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangA','Y', 'Y'==$kursus->stat_soal_selidik_a); ?> > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangB','Y', 'Y'==$kursus->stat_soal_selidik_b); ?> > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-danger btn-hapus-separa" type="button" data-kursus_id="<?= $kursus->id ?>">Hapus</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Sesi pembelajaran -->
<?php endif?>

<?php if($kursus->program_id == 4):?>
<!-- pembelajaran 2 -->
<div class="row espel_pembelajaran2">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran (Tidak Bersemuka)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-separa-kursus" data-kursus_id="<?= $kursus->id ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?= $kursus->program_id ?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb2 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb2" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb2" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>">
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
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb2" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>">
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon" value="<?= $kursus->telefon ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail" value="<?= $kursus->email ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" <?=set_select('comTerbuka', 'T', 'T'==$kursus->stat_terbuka)?> >Tidak</option>
                            <option value="Y" <?=set_select('comTerbuka', 'Y', 'Y'==$kursus->stat_terbuka)?> >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" <?=set_select('comPeruntukan', $peruntukan->id, $peruntukan->id==$kursus->peruntukan_id)?> ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangA','Y', 'Y'==$kursus->stat_soal_selidik_a); ?> > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangB','Y', 'Y'==$kursus->stat_soal_selidik_b); ?> > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-danger btn-hapus-separa" type="button" data-kursus_id="<?= $kursus->id ?>">Hapus</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Sesi pembelajaran -->
<?php endif?>

<?php if($kursus->program_id == 5):?>
<!-- Kendiri -->
<div class="row espel_kendiri">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Pembelajaran Kendiri</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left frm-edit-separa-kursus" data-kursus_id="<?= $kursus->id ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?= $kursus->program_id ?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_kendiri as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaKend" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatKend" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>">
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtSumber" required="required" class="form-control col-md-7 col-xs-12" name="txtSumber" value="<?=set_value('txtSumber', $kursus->sumber)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Pembentangan
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" type="text" id="txtTempat" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penyelia</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPenyelia" id="comPenyelia">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_penyelia as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comPenyelia', $key, $key==$kursus->penyelia_nokp)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?= ($kursus->anjuran=='D') ? '' : 'style="display:none;"' ?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurKend" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?=$kursus->penganjur_id?>">
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?= ($kursus->anjuran=='L') ? '' : 'style="display:none;"' ?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurKend" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?= $kursus->penganjur ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon" value="<?= $kursus->telefon ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail" value="<?= $kursus->email ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" <?=set_select('comTerbuka', 'T', 'T'==$kursus->stat_terbuka)?> >Tidak</option>
                            <option value="Y" <?=set_select('comTerbuka', 'Y', 'Y'==$kursus->stat_terbuka)?> >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" <?=set_select('comPeruntukan', $peruntukan->id, $peruntukan->id==$kursus->peruntukan_id)?> ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangA','Y', 'Y'==$kursus->stat_soal_selidik_a); ?> > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangB','Y', 'Y'==$kursus->stat_soal_selidik_b); ?> > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-danger btn-hapus-separa" type="button" data-kursus_id="<?= $kursus->id ?>">Hapus</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Kendiri -->
<?php endif?>
