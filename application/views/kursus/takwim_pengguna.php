<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Takwim Kursus</h2>
                    <a href="<?=base_url("kursus/takwim_pengguna_senarai/$tahun/$bulan")?>" class="btn btn-primary pull-right btn-sm" role="button" title="Papar senarai">Senarai</a>
                    <a href="<?=base_url("kursus/takwim_pengguna/$tahun/$bulan")?>" class="btn btn-primary pull-right btn-sm" role="button" title="Papar kalendar">Kalendar</a>
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
                    <?=$objCal->generate($tahun,$bulan) ?>
                </div>
            </div>
        </div>
    </div>
</div>
