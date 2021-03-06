  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Pengesahan Kehadiran</h2>
          <button id="btnCarianPengesahan" class="btn btn-default btn-sm pull-right"><i class="fa fa-search"></i> Carian</button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if (appsess()->getFlashSession()):?>
            <?php if (appsess()->getFlashSession('success')):?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>INFO!</strong> Proses telah berjaya dilaksanakan.
            </div>
            <?php else:?>
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong>RALAT!</strong> Proses tidak berjaya dilaksanakan.
            </div>
            <?php endif?>
            <?php endif?>
            
            <div id="frmFilter">
              <form method="post" class="form-horizontal form-label-left">
                <?php $csrf = [
                  'name' => $this->security->get_csrf_token_name(),
                  'hash' => $this->security->get_csrf_hash()
                ];
                ?>
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNama" name="txtNama" class="form-control col-md-7 col-xs-12 input-sm" value="" >
                    </div>
                  </div>

                    <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nokp</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNoKP" name="txtNoKP" class="form-control col-md-7 col-xs-12 input-sm" value="" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <table>
                        <tr>
                          <td><input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?= base_url("welcome/get_tree_jabatan_related") ?>',method:'get'" value="<?= $jab_ptj ?>" ></td>
                          <td>&nbsp;Lihat&nbsp;Sub&nbsp;Jabatan&nbsp;</td>
                          <td><input id="chk_subjabatan" type="checkbox" checked></td>
                        <tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comKelas" name="comKelas">
                          <option selected="selected" value="0">Pilih Semua</option>
                          <?php foreach ($sen_kumpulan as $kumpulan) : ?>
                          <option value="<?= trim($kumpulan['id']) ?>"><?= $kumpulan['kod'] ?></option>
                          <?php endforeach ?>
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
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comStatus" name="comStatus">
                        <option selected="selected" value="Y">Aktif</option>
                        <option value="T">Tidak Aktif</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button id='cmdDoTapis' class="btn btn-success btn-sm" name="papar">Cari</button>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                </form>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive" id="placePengesahan">
                  <table class="table table-striped table-bordered jambo_table dtPengesahan">
                    <thead>
                      <tr class="headings">
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Tajuk</th>
                        <th>Program</th>
                        <th>Mula</th>
                        <th>Tamat</th>
                        <th>Dokumen Sokongan</th>
                        <th style="text-align:center">Operasi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sen_kursus as $kursus):?>
                      <tr>
                        <td><?=$kursus->nama?></td>
                        <td><?=$kursus->jabatan?></td>
                        <td><?=$kursus->tajuk?></td>
                        <td><?=$kursus->program?></td>
                        <td><?=date('d M Y h:i A',strtotime($kursus->tkh_mula))?></td>
                        <td><?=date('d M Y h:i A',strtotime($kursus->tkh_tamat))?></td>
                        <td>
                          <?php if($kursus->dokumen_path) : ?>
                          <a target="_blank" class="btn btn-info btn-xs" href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" >Papar Dokumen</a>
                          <?php endif ?>
                        </td>
                        <!-- <td align="center"><?=($kursus->stat_soal_selidik_a == "Y")? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>"?></td>
                        <td align="center"><?=($kursus->stat_soal_selidik_b == "Y")? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>"?></td> -->
                        <td align="center">
                            <a href="<?=base_url('kursus/view_luar/' . $kursus->id)?>" class="btn btn-round btn-default btn-xs" title="Info"><i class="fa fa-file-o"></i></a>
                    </td>
                      </tr>
                      <?php endforeach?>
                      </tbody>
                  </table>
                </div>
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
          <h2>Senarai yang telah disahkan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
<!--             <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#" id="cmdTidahHadir" class="btn btn-danger pull-right" role="button" title="Daftar peserta di dalam kursus ini">Tidak Hadir</a>
            <a href="#" id="cmdHadir" class="btn btn-info pull-right" role="button" title="Daftar peserta di dalam kursus ini">Hadir</a>
            </div>
            </div>
 -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered jambo_table datatable">
                    <thead>
                      <tr class="headings">
                        <!-- <th><input id="chkAll" type="checkbox" value="0"></th> -->
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Tajuk</th>
                        <th>Program</th>
                        <th>Mula</th>
                        <th>Tamat</th>
                        <th>Pengsahan</th>
                        <!-- <th>Soal selidik Borang A</th>
                        <th>Soal selidik Borang B</th> -->
                        <th style="text-align:center">Operasi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sen_kursus_luar as $kursus_luar) : ?>
                        <tr>
                            <!-- <td><input class="chkKursusLuar" type="checkbox" value="<?= $kursus->id ?>"></td> -->
                            <td><?= $kursus_luar->nama ?></td>
                            <td><?= $kursus_luar->jabatan ?></td>
                            <td><?= $kursus_luar->tajuk ?></td>
                            <td><?= $kursus_luar->program ?></td>
                            <td><?= date('d M Y h:i A', strtotime($kursus_luar->tkh_mula)) ?></td>
                            <td><?= date('d M Y h:i A', strtotime($kursus_luar->tkh_tamat)) ?></td>
                            <td>
                                <?php if($kursus_luar->stat_hadir == 'L') : ?>
                                    <span class="label label-success">HADIR</span>
                                <?php endif ?>
                                <?php if ($kursus_luar->stat_hadir == 'T') : ?>
                                    <span class="label label-danger">TOLAK</span>
                                <?php endif ?>
                                
                            <td align="center">
                                <a href="<?= base_url('kursus/view_luar/' . $kursus_luar->id) ?>" class="btn btn-round btn-info btn-xs" title="Info"><i class="fa fa-file-o"></i> INFO</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

