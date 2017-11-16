    <div class="table-responsive">
        <table class="table table-striped table-bordered jambo_table datatable">
            <thead>
            <tr class="headings">
                <th>Tajuk</th>
                <th>Program</th>
                <th>Mula</th>
                <th>Tamat</th>
                <th>Pengesahan</th>
                <th>Dokumen Sokongan</th>
                <th style="text-align:center">Operasi</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($sen_kursus as $kursus):?>
            <tr>
                <td><?= strtoupper($kursus->tajuk)?></td>
                <td><?= strtoupper($kursus->program->nama) ?></td>
                <td><?= strtoupper(date('d M Y h:i A',strtotime($kursus->tkh_mula))) ?></td>
                <td><?= strtoupper(date('d M Y h:i A',strtotime($kursus->tkh_tamat))) ?></td>
                <td>
                <?php if($kursus->stat_hadir == 'M'):?>
                <span class="label label-warning">BELUM DISAHKAN</span>
                <?php endif?>
                <?php if($kursus->stat_hadir == 'L'):?>
                <span class="label label-success">DISAHKAN</span>
                <?php endif?>
                <?php if($kursus->stat_hadir == 'T'):?>
                <span class="label label-danger">TIDAK DISAHKAN</span>
                <?php endif?>
                </td>
                <td>
                <?php if($kursus->dokumen_path) : ?>
                <a class="btn btn-info btn-sm" target="_blank" href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>">PAPAR DOKUMEN</a></td>
                <?php endif ?>
                <td align="center">
                    <?php if($kursus->stat_hadir == 'M'):?>
                    <a href="<?=base_url('kursus/edit_luar/' . $kursus->id)?>" class="btn btn-round btn-primary btn-xs" title="Kemaskini"><i class="fa fa-edit"></i></a>
                    <a href="<?=base_url('kursus/delete_luar/' . $kursus->id)?>" class="btn btn-round btn-danger btn-xs" title="Hapus"><i class="fa fa-eraser"></i></a>
                    <?php endif?>
                </td>
            </tr>
            <?php endforeach?>
            </tbody>
        </table>
    </div>