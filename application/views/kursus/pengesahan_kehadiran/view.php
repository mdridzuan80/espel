<?php if($kursus->program_id == 1 || $kursus->program_id == 2):?>
<div class="row espel_latihan">
  <div class="col-md-3 col-sm-2 col-xs-3">
      <div class="x_panel">
        <div class="x_title">
          <h2><?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'Status' : 'Operasi' ?></h2>
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
              <strong>RALAT!</strong> Proses tidak berjaya. Sila pastikan pegawai ini mempunyai elamat email Pegawai Penilai Pertama
            </div>
            <?php endif?>
            <?php endif?>
            <form method="post" class="form-horizontal form-label-left" action="<?= base_url('kursus/do_sah/' . $kursus->id) ?>">
            <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
            <label>Keperluan Borang Soal Selidik :</label>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="checkbox">
                    <label>
                      <input name="chkBorangA" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangA', "Y", $kursus->stat_soal_selidik_a=="Y"); ?> <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> > Soal Selidik KKM/P&amp;P/2013(A)
                    </label>
                  </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="checkbox">
                    <label>
                      <input name="chkBorangB" type="checkbox" value="Y" <?php echo set_checkbox('chkBorangB', "Y", $kursus->stat_soal_selidik_b=="Y"); ?> <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> > Soal Selidik KKM/P&amp;P/2013(B)
                    </label>
                  </div>
              </div>
            </div>
            <label>Pengesahan Kehadiran :</label>
            <div class="form-group">
                <select class="form-control espel_program" name="comKehadiran" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?>>
                    <option value="M" <?=set_select('comProgram', "M", "M"==$kursus->stat_hadir)?>>PERMOHONAN</option>
                    <option value="L" <?=set_select('comProgram', "L", "L"==$kursus->stat_hadir)?>>LULUS</option>
                    <option value="T" <?=set_select('comProgram', "T", "T"==$kursus->stat_hadir)?>>TOLAK</option>
                </select>
            </div>
            <?php if(auth()->hasPeranan(appsess()->getSessionData("username"),['PTJ']) && appsess()->getSessionData('kumpulan')=='PTJ') :?>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <a href="<?=base_url("kursus/pengesahan_kehadiran")?>" class="btn btn-primary" type="reset">Batal</a>
                </div>
            </div>
            <?php endif ?>
        </form>
        </div>
    </div>
  </div>
  <div class="col-md-9 col-sm-9 col-xs-9">
    <div class="x_panel">
      <div class="x_title">
        <h2>Maklumat Kursus Program Latihan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left" action="<?= base_url('kursus/do_sah_kemaskini/' . $kursus->id) ?>" >
                    <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
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
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option value="0">Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_lat as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?> ><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y H:i A',strtotime($kursus->tkh_mula)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y H:i A',strtotime($kursus->tkh_tamat)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjur" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjur" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <?php if($kursus->stat_hadir == 'M') :?>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" class="btn btn-success" name="submit">Submit</button>
                          <a href="<?=base_url("kursus/pengesahan_kehadiran")?>" class="btn btn-primary" type="reset">Batal</a>
                      </div>
                  </div>
                  <?php endif ?>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<!-- latihan -->

<!-- pembelajaran -->
<?php if($kursus->program_id == 3 || $kursus->program_id == 4):?>
<div class="row espel_pembelajaran1">
  <div class="col-md-10 col-sm-10 col-xs-10">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left" action="<?= base_url('kursus/do_sah_kemaskini/' . $kursus->id) ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
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
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <?php if($kursus->program_id == 3):?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb1 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <?php endif?>
                  <?php if($kursus->program_id == 4):?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?>>
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb2 as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <?php endif?>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat" value="<?=set_value('txtTempat',$kursus->tempat)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?>>
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjur" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjur" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" class="btn btn-success" name="submit">Submit</button>
                          <a href="<?=base_url("kursus/pengesahan_kehadiran")?>" class="btn btn-primary" type="reset">Batal</a>
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
<div class="row espel_kendiri">
  <div class=""col-md-10 col-sm-10 col-xs-10"">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Pembelajaran Kendiri</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left" action="<?= base_url('kursus/do_sah_kemaskini/' . $kursus->id) ?>">
                  <input type="hidden" class="hddProgram" name="hddProgram" value="<?=set_value('hddProgram', $kursus->program_id)?>" />
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
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk" value="<?=set_value('txtTajuk', $kursus->tajuk)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_kendiri as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comAktiviti', $key, $key==$kursus->aktiviti_id)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula" value="<?=set_value('txtTkhMula',date('d-m-Y',strtotime($kursus->tkh_mula)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat" value="<?=set_value('txtTkhTamat',date('d-m-Y',strtotime($kursus->tkh_tamat)))?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtSumber" required="required" class="form-control col-md-7 col-xs-12" name="txtSumber" value="<?=set_value('txtSumber', $kursus->sumber)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Pembentangan
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" type="text" id="txtTempat" name="txtTempat" value="<?=set_value('txtTempat', $kursus->tempat)?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penyelia</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPenyelia" id="comPenyelia" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_penyelia as $key => $val):?>
                            <option value="<?=$key?>" <?=set_select('comPenyelia', $key, $key==$kursus->penyelia_nokp)?>><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                            <option selected="selected" >Sila buat pilihan</option>
                            <option value="D" <?=set_select('comAnjuran', 'D', 'D'==$kursus->anjuran)?> >Dalaman</option>
                            <option value="L" <?=set_select('comAnjuran', 'L', 'L'==$kursus->anjuran)?> >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" <?=($kursus->anjuran=='L'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjur" class="form-control col-md-7 col-xs-12" name="txtPenganjur" value="<?=$kursus->penganjur?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group" <?=($kursus->anjuran=='D'?"":"style=\"display:none;\"")?> >
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjur" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'" value="<?=$kursus->penganjur_id?>" <?= ($this->appsess->getSessionData("kumpulan") == AppAuth::PENGGUNA) ? 'disabled' : '' ?> >
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <button type="submit" class="btn btn-success" name="submit">Submit</button>
                          <a href="<?=base_url("kursus/pengesahan_kehadiran")?>" class="btn btn-primary" type="reset">Batal</a>
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
