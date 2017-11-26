<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <a href="<?= base_url() ?>">Home</a> > <a href="<?= base_url('kursus/separa_takwim') ?>">Modul Kursus :: Takwim Kursus Separa Siap</a> > Pencalonan
  </div>
</div>
<br/>
<?= $vlevel ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-info"></i> Maklumat Kursus</h2>
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
                          <td colspan="3"><?=($kursus->anjuran == 'D') ? $objJabatan->jabatan->get_by('buid', $kursus->penganjur_id)->title : $kursus->penganjur ?></td>
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
                                <a id="cmdShowTapis" class="btn btn-default btn-sm" style="margin:0"><i class="fa fa-search"></i> Carian</a>
                                <a id="cmdSenarai" class="btn btn-primary btn-sm" style="margin:0"></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <?php if(appsess()->getFlashSession()):?>
                <?php if(appsess()->getFlashSession('success')):?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>INFO!</strong> Proses telah berjaya dilaksanakan.
                </div>
                <?php else:?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>RALAT!</strong> Proses telah berjaya dilaksanakan. Tetapi email tidak dapat dihantar.
                </div>
                <?php endif?>
                <?php endif?>
                <div id="filter" style="display:none">
                <form method="post" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txtNama" name="txtNama" class="form-control col-md-7 col-xs-12 input-sm" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. KP</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="txtNoKP" name="txtNoKP" class="form-control col-md-7 col-xs-12 input-sm" >
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                       <table>
                        <tr>
                          <td><input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?= $jabatan_id ?>" ></td>
                          <td>&nbsp;Lihat&nbsp;Sub&nbsp;Jabatan&nbsp;</td>
                          <td><input id="chk_subjabatan" type="checkbox" checked></td>
                        <tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Perkhidmatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comKelas" name="comKelas">
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
                        <select class="form-control input-sm" id="comGred" name="comGred">
                        <option selected="selected" value="0">Pilihan Semua</option>
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
                        <button id='cmdDoTapis' class="btn btn-success btn-sm" name="papar">Cari</button>
                    </div>
                </form>
                <br/>
                </div>

                <div id="sen_calon"></div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
