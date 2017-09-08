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
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Kursus yang dianjurkan</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Kursus anjuran luar</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <table class="datatable table table-striped table-bordered jambo_table">
                      <thead>
                        <tr class="headings">
                          <th>Tajuk</th>
                          <th>Program</th>
                          <th>Mula</th>
                          <th>Jumlah Permohonan</th>
                          <th style="text-align:center">Operasi</th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <td>Kursus 2</td>
                          <td>Latihan - Dalam Negara</td>
                          <td>5 Ogos 2017</td>
                          <td>2</td>
                          <td align="center">
                              <div class="btn-group">
                                  <a href="<?=base_url('mockup/ptj/kursus/pengesahan/peserta')?>" class="btn btn-round btn-default btn-xs" data-toggle="tooltip" title="Lihat Peserta"><i class="fa fa-file-o"></i></a>
                              </div>
                          </td>
                        </tr>
                       </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <?php if(count($sen_kursus)):?>
                    <a href="#" id="cmdTidahHadir" class="btn btn-danger pull-right" role="button" title="Daftar peserta di dalam kursus ini">Tidak Hadir</a>
                    <a href="#" id="cmdHadir" class="btn btn-info pull-right" role="button" title="Daftar peserta di dalam kursus ini">Hadir</a>
                    <table class="datatable table table-striped table-bordered jambo_table">
                      <thead>
                        <tr class="headings">
                          <th><input id="chkAll" type="checkbox" value="0"></th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Tajuk</th>
                          <th>Program</th>
                          <th>Mula</th>
                          <th>Tamat</th>
                          <th>Soal selidik Borang A</th>
                          <th>Soal selidik Borang B</th>
                          <th style="text-align:center">Operasi</th>
                        </tr>
                      </thead>


                      <tbody>
                          <?php foreach($sen_kursus as $kursus):?>
                        <tr>
                          <td><input type="checkbox" value="<?=$kursus->id?>"></td>
                          <td><?=$kursus->nama?></td>
                          <td><?=$kursus->jabatan?></td>
                          <td><?=$kursus->tajuk?></td>
                          <td><?=$kursus->program?></td>
                          <td><?=date('d M Y',strtotime($kursus->tkh_mula))?></td>
                          <td><?=date('d M Y',strtotime($kursus->tkh_tamat))?></td>
                          <td align="center"><?=($kursus->stat_soal_selidik_a == "Y")? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>"?></td>
                          <td align="center"><?=($kursus->stat_soal_selidik_b == "Y")? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>"?></td>
                          <td align="center">
                              <a href="<?=base_url('kursus/view_luar/' . $kursus->id)?>" class="btn btn-info btn-xs" title="Info">Info</a>
                      </td>
                        </tr>
                        <?php endforeach?>
                       </tbody>
                    </table>
                    <?php else:?>
                    <div class="alert alert-warning " role="warning">
                      <strong>INFO!</strong> Tiada rekod
                    </div>
                    <?php endif?>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
