<?= $vlevel ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-info"></i> Pengesahan Kehadiran Kursus</h2>
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
                        <h2 id="cur_title">Senarai Peserta</h2>
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
                
                <?php if(count($sen_calon)) : ?>
                    <a href="#" id="cmdTidahHadir" class="btn btn-sm btn-danger pull-right" role="button" title="Daftar peserta di dalam kursus ini">Tidak Hadir</a>
                    <a href="#" id="cmdHadir" class="btn btn-sm btn-info pull-right" role="button" title="Daftar peserta di dalam kursus ini">Hadir</a>

          <table id="peserta" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama</th>
                <th>Gred</th>
                <th>Kumpulan</th>
                <th>Jabatan</th>
                <th>Status Kehadiran</th>
                <th style="text-align:center">
                    <input type="checkbox" name="chkAll" id="chkAll">
                </th>
              </tr>
            </thead>

            <tbody>

                <?php foreach($sen_calon as $calon):?>
              <tr>
                <td><?=$calon->nama?></td>
                <td><?=$calon->gred?></td>
                <td><?=$calon->kumpulan?></td>
                <td><?=$calon->jabatan?></td>
                <td>
                    <?php if($calon->stat_hadir) : ?>
                        <?= (($calon->stat_hadir == 'Y') ? 'HADIR' : 'TIDAK HADIR') ?>
                    <?php else : ?>
                        BELUM DISAHKAN
                    <?php endif ?>
                </td>
                <td align="center">
                    <input type="checkbox" name="chkKehadiran[]" id="chkPeserta" value="<?= $calon->id ?>">
                </td>
              </tr>
          <?php endforeach?>
      <?php else: ?>
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                  Tiada Peserta!
                </div>
      <?php endif ?>
             </tbody>
          </table>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>
<br/>
