<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Initial Peruntukan Semasa</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pusat Tanggungjawab (PTJ)
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" name="comJabatan">
                        <?php foreach($jabatans->result() as $jabatan):?>
                        <option value="<?=$jabatan->id?>"><?=$jabatan->nama?></option>
                        <?php endforeach?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Peruntukan
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="form-control" name="comJnsPeruntukan">
                          <?php foreach($jnsperuntukans->result() as $jnsperuntukan):?>
                          <option value="<?=$jnsperuntukan->id?>"><?=$jnsperuntukan->nama?></option>
                          <?php endforeach?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tarikh waran">Tarikh Waran
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="txtTkhWaran" id="txtTkhWaran" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="waran">No. Waran
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="txtWaran" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah (RM)
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="txtJumlah" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea required="required" class="form-control col-md-7 col-xs-12" name="txtKeterangan"></textarea>
                  </div>
                </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <a href="<?= base_url('peruntukan')?>" class="btn btn-primary" type="reset">Cancel</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
