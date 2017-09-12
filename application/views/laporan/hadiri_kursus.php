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
          <h2>Laporan Anggota Yang Menghadiri Kursus</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="x_content">
                <br />
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tahun
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="txtTahun" name="txtTahun" required="required" class="form-control col-md-7 col-xs-12" value="2017">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'" value="1">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Perkhidmatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comKelas" name="comKelas">
                          <option selected="selected" value="0">Pilihan Semua</option>
                          <?php foreach($sen_kelas as $key=>$val):?>
                          <option value="<?=$key?>"><?=$val?></option>
                          <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comGred" name="comGred">
                        <option selected="selected" value="0">Pilihan Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bilangan Hari</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        <option selected="selected" value="0">Pilihan</option>
                          <option>Tidak pernah hadir</option>
                          <option>Lebih atau sama dengan 1 hari</option>
                          <option>Lebih atau sama dengan 2 hari</option>
                          <option>Lebih atau sama dengan 3 hari</option>
                          <option>Lebih atau sama dengan 4 hari</option>
                          <option>Lebih atau sama dengan 5 hari</option>
                          <option>Lebih atau sama dengan 6 hari</option>
                          <option>Lebih atau sama dengan 7 hari</option>
                        </select>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="<?=base_url('assets/doc/laporan_prestasi.pdf')?>" target="_blank" class="btn btn-success">Papar</a>
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
