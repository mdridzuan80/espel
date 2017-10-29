<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Takwim Kursus</h2>
                    <a href="<?=base_url("kursus/takwim_pengguna_senarai/$takwim->tahun/$takwim->bulan")?>" class="btn btn-primary btn-sm pull-right" role="button" title="Papar senarai">Senarai</a>
                    <a href="<?=base_url("kursus/takwim_pengguna_2/$takwim->tahun/$takwim->bulan")?>" class="btn btn-primary btn-sm pull-right" role="button" title="Papar kalendar">Kalendar</a>
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

                    <?=$objCal->generate($takwim->tahun,$takwim->bulan) ?>
                    <?php if(count($sen_kursus)):?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered jambo_table">
                            <thead>
                              <tr class="headings">
                                <th>Tajuk</th>
                                <th>Program</th>
                                <th>Mula</th>
                                <th>Tamat</th>
                                <th style="text-align:center">Operasi</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sen_kursus as $kursus):?>
                              <tr>
                                <td><?=$kursus['tajuk']?></td>
                                <td><?=$kursus['nama']?></td>
                                <td><?=date('d M Y h:i A',strtotime($kursus['tkh_mula']))?></td>
                                <td><?=date('d M Y h:i A',strtotime($kursus['tkh_tamat']))?></td>
                                <td align="center">
                                    <?php if($kursus['stat_laksana'] == 'L') : ?>
                                        <span class="label label-success">SELESAI</span>
                                    <?php endif ?>
                                    <?php if(strtotime($kursus['tkh_mula']) > strtotime(date('Y-m-d')) && is_null($kursus['stat_mohon']) && $kursus['stat_laksana'] == 'R') : ?>
                                    <a href="<?=base_url('kursus/info_kursus_pengguna/' . $kursus['id'])?>" class="btn btn-primary btn-sm" title="Mohon">Mohon</a>
                                    <?php endif ?>
                                </td>
                              </tr>
                              <?php endforeach?>
                             </tbody>
                         </table>
                      </div>
                    </div>
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
