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
          <h2>Laporan Prestasi Kursus</h2>
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
                      <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="2017">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parent Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comPenganjur" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Skim</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option selected="selected">Pilihan</option>
                          <option>JUSA</option>
                          <option>Pengurusan dan Profesional</option>
                          <option>Sokongan 1</option>
                          <option>Sokongan 2</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        <option selected="selected">Pilihan</option>
                          <option>Jusa A</option>
                          <option>Jusa B</option>
                          <option>Jusa C</option>
                          <option>Jusa M54</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bilangan Hari</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                        <option selected="selected">Pilihan</option>
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
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Anggota</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option selected="selected">Sila pilih</option>
                          <option>Md Ridzuan bin Mohammad Latiah</option>
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