  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Pengesahan Kehadiran</h2>
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
              <strong>RALAT!</strong> Proses tidak berjaya dilaksanakan.
            </div>
            <?php endif?>
            <?php endif?>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="#" id="cmdTidahHadir" class="btn btn-danger pull-right" role="button" title="Daftar peserta di dalam kursus ini">Tidak Hadir</a>
            <a href="#" id="cmdHadir" class="btn btn-info pull-right" role="button" title="Daftar peserta di dalam kursus ini">Hadir</a>
            </div>
            </div>

            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
            <table class="table table-striped table-bordered jambo_table datatable">
              <thead>
                <tr class="headings">
                  <th><input id="chkAll" type="checkbox" value="0"></th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Tajuk</th>
                  <th>Program</th>
                  <th>Mula</th>
                  <th>Tamat</th>
                  <th>Dokumen Sokongan</th>
                  <!-- <th>Soal selidik Borang A</th>
                  <th>Soal selidik Borang B</th> -->
                  <th style="text-align:center">Operasi</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($sen_kursus as $kursus):?>
                <tr>
                  <td><input class="chkKursusLuar" type="checkbox" value="<?=$kursus->id?>"></td>
                  <td><?=$kursus->nama?></td>
                  <td><?=$kursus->jabatan?></td>
                  <td><?=$kursus->tajuk?></td>
                  <td><?=$kursus->program?></td>
                  <td><?=date('d M Y h:i A',strtotime($kursus->tkh_mula))?></td>
                  <td><?=date('d M Y h:i A',strtotime($kursus->tkh_tamat))?></td>
                  <td><a target="_blank" class="btn btn-info btn-xs" href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" >Papar Dokumen</a></td>
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
</div>
