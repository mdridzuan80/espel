<?= $vlevel ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <h2>Pengesahan kehadiran kursus yang dilaksanakan</h2>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div style="float:right">
                  <button id="cmdCarian" class="btn btn-default btn-sm pull-right"><i class="fa fa-search"></i> Carian</button>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div id="frmFilter">
            <form method="post" class="form-horizontal form-label-left">
              <?php $csrf = [
                  'name' => $this->security->get_csrf_token_name(),
                  'hash' => $this->security->get_csrf_hash()
                  ];
              ?>
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tajuk Kursus</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="txtTajuk" name="txtTajuk" class="form-control col-md-7 col-xs-12 input-sm" value="" >
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bulan</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="comBulan" class="form-control input-sm">
                      <option value="0">--Semua--</option>
                      <?php foreach(array_bulan() as $index => $desc) : ?>
                      <option value="<?= $index ?>"><?= ucfirst(key($desc)) ?></option>
                      <?php endforeach ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <div class="form-group">
                    <select id="comTahun" class="form-control input-sm">
                      <option value="0">--Semua--</option>
                      <?php foreach($sen_tahun as $tahun) : ?>
                      <option value="<?= $tahun->tahun ?>" <?= ($tahun->tahun == date('Y')) ? 'selected' : '' ?> ><?= $tahun->tahun ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button id='cmdDoTapis' class="btn btn-success btn-sm" name="papar">Cari</button>
                </div>
              </div>
              <div class="ln_solid"></div>
          </div>
          <div id="sen_permohonan_pelaksanaan"></div>
        </div>
      </div>
    </div>
</div>
<br/>
<br/>
<br/>
