<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Program Latihan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control espel_program">
                                <option selected="selected" value="0" >Sila buat pilihan</option>
                                <?php foreach($sen_program as $program):?>
                                <option value="<?=$program->id?>"><?=$program->nama?></option>
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

<!-- latihan -->
<div class="row espel_latihan" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Program Latihan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
              <form id="frm-program-latihan" method="post" class="form-horizontal form-label-left">
                  <input type="hidden" class="hddProgram" name="hddProgram" />
                  <input type="hidden" name="laksana" value="R" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_lat as $key => $val):?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMula" name="txtMasaMula" required="required">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamat" name="txtMasaTamat" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuran">
                            <option selected="selected" value="D" >Dalaman</option>
                            <option value="L" >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-com-penganjur" class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurLatihan" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'">
                    </div>
                  </div>
                  <div id="input-txt-penganjur" class="form-group" style="display:none;">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurLatihan" class="form-control col-md-7 col-xs-12" name="txtPenganjur">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" >Tidak</option>
                            <option value="Y" >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control comPeruntukan" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
              </form>
      </div>
    </div>
  </div>
</div>
<!-- latihan -->

<!-- pembelajaran -->
<div class="row espel_pembelajaran1" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran (Bersemuka)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form id="frm-pembelajaran-bersemuka" method="post" class="form-horizontal form-label-left">
                  <input type="hidden" class="hddProgram" name="hddProgram" />
                  <input type="hidden" name="laksana" value="R" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb1 as $key => $val):?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb" name="txtTkhMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb" name="txtTkhTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaPemb" name="txtMasaMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatPemb" name="txtMasaTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranPemb">
                            <option selected="selected" value="D" >Dalaman</option>
                            <option value="L" >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-com-penganjur-pemb" class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'">
                    </div>
                  </div>
                  <div id="input-txt-penganjur-pemb" class="form-group" style="display:none;">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb" class="form-control col-md-7 col-xs-12" name="txtPenganjur">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" >Tidak</option>
                            <option value="Y" >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control comPeruntukan" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Sesi pembelajaran -->

<!-- pembelajaran 2 -->
<div class="row espel_pembelajaran2" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran (Tidak Bersemuka)</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form id="frm-pembelajaran-tidak-bersemuka" method="post" class="form-horizontal form-label-left">
                  <input type="hidden" class="hddProgram" name="hddProgram" />
                  <input type="hidden" name="laksana" value="R" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_pemb2 as $key => $val):?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaPemb2" name="txtTkhMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatPemb2" name="txtTkhTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaPemb2" name="txtMasaMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatPemb2" name="txtMasaTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tempat *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTempat" required="required" class="form-control col-md-7 col-xs-12" name="txtTempat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranPemb2">
                            <option selected="selected" value="D" >Dalaman</option>
                            <option value="L" >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-com-penganjur-pemb2" class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurPemb2" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'">
                    </div>
                  </div>
                  <div id="input-txt-penganjur-pemb2" class="form-group" style="display:none;">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurPemb2" class="form-control col-md-7 col-xs-12" name="txtPenganjur">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" >Tidak</option>
                            <option value="Y" >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control comPeruntukan" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Sesi pembelajaran -->

<!-- Kendiri -->
<div class="row espel_kendiri" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Pembelajaran Kendiri</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form id="frm-kendiri" method="post" class="form-horizontal form-label-left">
                  <input type="hidden" class="hddProgram" name="hddProgram" />
                  <input type="hidden" name="laksana" value="R" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti" required="required">
                            <option selected="selected" value="" >Sila buat pilihan</option>
                            <?php foreach($sen_xtvt_kendiri as $key => $val):?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMulaKend" name="txtTkhMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamatKend" name="txtTkhTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa *
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaMulaKend" name="txtMasaMula">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtMasaTamatKend" name="txtMasaTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtSumber" required="required" class="form-control col-md-7 col-xs-12" name="txtSumber">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tempat Pembentangan *
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" type="text" id="txtTempat" name="txtTempat" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penyelia</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comPenyelia" id="comPenyelia">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($sen_penyelia as $key => $val):?>
                            <option value="<?=$key?>"><?=$val?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAnjuran" id="comAnjuranKend">
                            <option selected="selected" value="D" >Dalaman</option>
                            <option value="L" >Luaran</option>
                        </select>
                    </div>
                  </div>
                  <div id="input-com-penganjur-kend" class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div id="anjuran-area" class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjurKend" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'">
                    </div>
                  </div>
                  <div id="input-txt-penganjur-kend" class="form-group" style="display:none;">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPenganjurKend" class="form-control col-md-7 col-xs-12" name="txtPenganjur">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telefon Penganjur *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtTelefon" required="required" class="form-control col-md-7 col-xs-12" name="txtTelefon">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Penganjur</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtEmail" class="form-control col-md-7 col-xs-12" name="txtEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka *</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comTerbuka" id="comTerbuka">
                            <option value="T" >Tidak</option>
                            <option value="Y" >Ya</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peruntukan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control comPeruntukan" name="comPeruntukan" id="comPeruntukan">
                            <option value="0" >Tiada</option>
                            <?php foreach($sen_peruntukan as $peruntukan): ?>
                            <option value="<?=$peruntukan->id?>" ><?=$peruntukan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik A</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangA" type="checkbox" value="Y" > Borang keberkesanan kursus oleh peserta
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Soal Selidik B</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                          <label>
                            <input name="chkBorangB" type="checkbox" value="Y" > Borang keberkesanan kursus oleh penyelia
                          </label>
                        </div>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
              </form>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Kendiri -->

