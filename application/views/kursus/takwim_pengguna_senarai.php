    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="<?= base_url() ?>">Home</a>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Takwim Kursus</h2>
                        <button id="linkDaftarKursus" class="btn btn-primary pull-right btn-sm" role="button"><i class="fa fa-copy"></i> Daftar Kursus Luar</button>
                        <a href="<?=base_url("kursus/takwim_pengguna_senarai/$takwim->tahun/$takwim->bulan")?>" class="btn btn-primary btn-sm pull-right" role="button" title="Papar senarai"><i class="fa fa-list-ul"></i> Senarai</a>
                        <a href="<?=base_url("kursus/takwim_pengguna_2/$takwim->tahun/$takwim->bulan")?>" class="btn btn-primary btn-sm pull-right" role="button" title="Papar kalendar"><i class="fa fa-calendar"></i> Kalendar</a>
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
                                    <td><?=$kursus['program']?></td>
                                    <td><?=date('d M Y h:i A',strtotime($kursus['tkh_mula']))?></td>
                                    <td><?=date('d M Y h:i A',strtotime($kursus['tkh_tamat']))?></td>
                                    <td align="center">
                                        <?php if(strtotime($kursus['tkh_mula']) > strtotime(date('Y-m-d h:i A')) && is_null($kursus['stat_mohon']) && $kursus['stat_laksana'] == 'R') : ?>
                                        <a href="<?=base_url('kursus/info_kursus_pengguna/' . $kursus['id'])?>" class="btn btn-primary btn-sm" title="Mohon">Mohon</a>
                                        <?php else : ?>
                                            <?php if($kursus['stat_laksana'] == 'L') : ?>
                                                <span class="label label-success">SELESAI</span>
                                            <?php else: ?>
                                                <?php if($kursus['stat_mohon'] == 'M') : ?>
                                                    <span class="label label-warning">TELAH MEMOHON</span>
                                                <?php endif ?>
                                                <?php if($kursus['stat_mohon'] == 'L') : ?>
                                                    <span class="label label-warning">PERMOHONAN LULUS</span>
                                                <?php endif ?>
                                            <?php endif ?>
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

    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(25,188,157); color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myLargeModalLabel">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>
