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
          <h2>Laporan Senarai Prestasi Kursus</h2>
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
                        <input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="6792" >
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
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bilangan Hari</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comHari">
                        <option selected="selected" value="0">Pilihan</option>
                          <option value="1">Tidak pernah hadir</option>
                          <option value="2">Lebih atau sama dengan 1 hari</option>
                          <option value="3">Lebih atau sama dengan 2 hari</option>
                          <option value="4">Lebih atau sama dengan 3 hari</option>
                          <option value="4">Lebih atau sama dengan 4 hari</option>
                          <option value="5">Lebih atau sama dengan 5 hari</option>
                          <option value="6" >Lebih atau sama dengan 6 hari</option>
                          <option value="7">Lebih atau sama dengan 7 hari</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-success btn-sm" name="submit">Papar PDF</button>
                      <button class="btn btn-primary btn-sm" type="reset">Reset</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
