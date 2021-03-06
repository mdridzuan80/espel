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
                            <select class="form-control espel_program">
                                <option selected="selected" >Sila buat pilihan</option>
                                <?php foreach($programs->result() as $program):?>
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

<div class="row espel_latihan" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Program Latihan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left">
                  <input type="hidden" class="hddProgram" name="hddProgram" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTajuk" required="required" class="form-control col-md-7 col-xs-12" name="txtTajuk">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Program</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comNegara" id="comNegara">
                            <option selected="selected" value="Y">Dalam Negara</option>
                          <option value="T">Luar Negara</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Aktiviti</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="comAktiviti" id="comAktiviti">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($aktivitis->result() as $aktiviti):?>
                            <option value="<?=$aktiviti->id?>"><?=$aktiviti->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhMula" name="txtTkhMula">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarikh Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control espel-cal-input" id="txtTkhTamat" name="txtTkhTamat">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anjuran</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comAnjuran" name="comAnjuran">
                            <option selected="selected" >Sila buat pilihan</option>
                            <?php foreach($jabatans->result() as $jabatan):?>
                            <option value="<?=$jabatan->id?>"><?=$jabatan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Terbuka ?</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comTerbuka" name="comTerbuka">
                            <option value="T">Ya</option>
                          <option selected="selected" value="T">Tidak</option>
                        </select>
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
<!-- latihan -->

<!-- pembelajaran -->
<div class="row espel_pembelajaran" style="display:none">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Kursus Untuk Program Sesi Pembelajaran</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                            <option selected="selected">Bersemuka</option>
                          <option value="1">Tidak bersemuka</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control form_datetime" type="text" value="2012-06-15 14:45" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control form_datetime" value="2012-06-15 15:45" readonly>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button">Batal</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <a href="<?=base_url('mockup/ptj/kursus')?>" class="btn btn-success">Simpan</a>
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
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tajuk
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sumber
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa Mula
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control form_datetime" type="text" value="2012-06-15 14:45" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Masa Akhir
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control form_datetime" value="2012-06-15 15:45" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pegawai Penyelia
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option selected="selected">Sila buat pilihan</option>
                          <option value="1">Penyelia 1</option>
                          <option value="2">Penyelia 2</option>
                          <option value="3">Penyelia 3</option>
                        </select>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button class="btn btn-primary" type="button">Batal</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <a href="<?=base_url('mockup/ptj/kursus')?>" class="btn btn-success">Simpan</a>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Kendiri -->
