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
                        <div class="table-responsive">
                            <table id="senarai-event" class="table table-striped table-bordered jambo_table dt-responsive responsive">
                                <thead>
                                <tr class="headings">
                                    <th>Tajuk</th>
                                    <th>Mula</th>
                                    <th>Tamat</th>
                                    <th style="text-align:center">Operasi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        </div>
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

<!-- Modal -->
<div id="MyModalKursusInfo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="MyModalKursusEdit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>
