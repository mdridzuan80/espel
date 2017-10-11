<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Laporan</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Prestasi Kursus Keseluruhan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="x_content">
                <br />
                <form method="post" data-parsley-validate class="form-horizontal form-label-left">
                  <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTahun" name="txtTahun" required="required" class="form-control col-md-7 col-xs-12" value="2017">
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-success" type="submit" name="submit">Papar PDF</a>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
