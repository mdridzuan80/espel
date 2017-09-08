<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Kemaskini Aktiviti</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Aktiviti
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="txtAktiviti" name="txtAktiviti" required="required" class="form-control col-md-7 col-xs-12"><?=$activity->nama?></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <a href="<?= base_url('kamus/program_edit/' . $activity->program_id)?>" class="btn btn-primary" type="reset">Cancel</a>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
