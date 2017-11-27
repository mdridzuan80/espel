  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Senarai Anggota Yang Tidak Menjawab Borang B</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
                      <div>
              <form method="post" class="form-horizontal form-label-left">
              <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtTahun" name="txtTahun" class="form-control input-sm" value="<?= date('Y') ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?= $jab_ptj->jabatan_id ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comKelas" name="comKelas">
                          <option selected="selected" value="0">Pilih Semua</option>
                          <?php foreach($sen_kumpulan as $kumpulan):?>
                          <option value="<?=$kumpulan['id']?>"><?=$kumpulan['kod']?></option>
                          <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Skim Perkhidmatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comSkim" name="comSkim">
                        <option selected="selected" value="0">Pilih Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comGred" name="comGred">
                        <option selected="selected" value="0">Pilih Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-success btn-papar btn-sm" name="button">Papar</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

<div id=rptPapar></div>
