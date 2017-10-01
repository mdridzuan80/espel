<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bars"></i> Maklumat Kursus</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>            

            <div class="x_content">
                <div id="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table class="table table-bordered">
                      <tbody>
                          <tr>
                          <th scope="row">Program</th>
                          <td colspan="3"><?=$kursus->program->nama?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tajuk Kursus</th>
                          <td colspan="3"><?=$kursus->tajuk?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tarikh Mula</th>
                          <td><?=$kursus->tkh_mula?></td>
                          <th scope="row">Tarikh Tamat</th>
                          <td><?=$kursus->tkh_tamat?></td>
                        </tr>
                        <tr>
                          <th scope="row">Tempat</th>
                          <td colspan="3"><?=$kursus->tempat?></td>
                        </tr>
                        <tr>
                          <th scope="row">Penganjur</th>
                          <td colspan="3"><?=($kursus->anjuran == 'D') ? $kursus->penganjur->nama : $kursus->penganjur ?></td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                        <h2 id="cur_title"></h2>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div style="float:right">
                                <input id="kursus_id" type="hidden" value="<?=$kursus->id?>">
                                <a id="cmdTapis" class="btn btn-primary btn-sm" style="margin:0"><i class="fa fa-filter"></i></a>
                                <a id="cmdSenarai" class="btn btn-primary btn-sm" style="margin:0"></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <div class="clearfix"></div>
            </div>            

            <div class="x_content">
                <div id="filter" style="display:none">
                    <form method="post" class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="1">
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
                        <button target="_blank" class="btn btn-success" name="papar">Papar</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                  </div>
                </form>
                </div>
                <div id="sen_calon"></div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
