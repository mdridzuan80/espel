<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Takwim Kursus</h2>
                    <a href="<?=base_url('kursus/daftar_jabatan')?>" class="btn btn-primary pull-right" role="button" title="Daftar kursus yang dianjurkan">Daftar Kursus</a>
                    <a href="<?=base_url('mockup/ptj/kursus/daftar')?>" class="btn btn-primary pull-right" role="button" title="Daftar kursus yang dianjurkan">List</a>
                    <a href="<?=base_url('mockup/ptj/kursus/daftar')?>" class="btn btn-primary pull-right" role="button" title="Daftar kursus yang dianjurkan">Kalendar</a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?=$objCal->generate() ?>
                </div>
            </div>
        </div>
    </div>
</div>
