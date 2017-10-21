<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Buku Log Kursus</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">
              <div class="form-group">
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="txtTahun" id="txtTahun" required="required" class="form-control col-md-7 col-xs-12" value="<?=date('Y')?>">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="button" class="btn btn-success btn-papar btn-sm" name="button">Papar</button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div id=rptPapar></div>
