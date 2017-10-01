<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <h2>Kursus yang ditawarkan</h2>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div style="float:right">
                <form id="formTapis" class="form-inline">
                  <div class="form-group">
                    <label>Tapisan Rekod : </label>
                    <select id="comBulan" class="form-control input-sm">
                      <?php foreach(array_bulan() as $index => $desc) : ?>
                      <option value="<?= $index ?>" <?= ($index==date('m')) ? 'selected' : '' ?>><?= ucfirst(key($desc)) ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select id="comTahun" class="form-control input-sm">
                      <option>2017</option>
                    </select>
                  </div>
                  <a id="cmdTapis" class="btn btn-primary btn-sm" style="margin:0">Tapis</a>
                </form>
              </div>
            </div>
          </div>
            
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div id="sen_permohonan_ph"></div>
        </div>
      </div>
    </div>
</div>
<br/>
<br/>
<br/>
