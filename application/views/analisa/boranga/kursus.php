<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Analisa Borang A</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table class="table table-striped table-bordered jambo_table datatable">
                <thead>
                    <tr class="headings">
                    <th>Nama Kursus</th>
                    <th>Tarikh Mula</th>
                    <th>Tarikh Tamat</th>
                    <th style="text-align:center">Operasi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(count($sen_kursus)) : ?>
                    <?php foreach($sen_kursus as $kursus):?>
                    <tr>
                    <td><?=$kursus->tajuk?></td>
                    <td><?=date("d M Y h:i A",strtotime($kursus->tkh_mula))?></td>
                    <td><?=date("d M Y h:i A",strtotime($kursus->tkh_tamat))?></td>
                    <td align="center">
                        <a href="<?=base_url('#' . $kursus->id)?>" class="btn btn-primary btn-xs" title="Info">Analisa</a>
                    </td>
                    </tr>
                <?php endforeach?>
                <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
