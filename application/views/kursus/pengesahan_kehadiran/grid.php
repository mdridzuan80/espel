    <table class="table table-striped table-bordered jambo_table dtPengesahan">
        <thead>
            <tr class="headings">
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Tajuk</th>
            <th>Program</th>
            <th>Mula</th>
            <th>Tamat</th>
            <th>Dokumen Sokongan</th>
            <th style="text-align:center">Operasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sen_kursus as $kursus) : ?>
            <tr>
            <td><?= $kursus->nama ?></td>
            <td><?= $kursus->jabatan ?></td>
            <td><?= $kursus->tajuk ?></td>
            <td><?= $kursus->program ?></td>
            <td><?= date('d M Y h:i A', strtotime($kursus->tkh_mula)) ?></td>
            <td><?= date('d M Y h:i A', strtotime($kursus->tkh_tamat)) ?></td>
            <td>
                <?php if ($kursus->dokumen_path) : ?>
                <a target="_blank" class="btn btn-info btn-xs" href="<?= base_url('assets/uploads/' . $kursus->dokumen_path) ?>" >Papar Dokumen</a>
                <?php endif ?>
            </td>
            <!-- <td align="center"><?= ($kursus->stat_soal_selidik_a == "Y") ? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>" ?></td>
            <td align="center"><?= ($kursus->stat_soal_selidik_b == "Y") ? "<span class=\"label label-default\">YA</span>" : "<span class=\"label label-default\">TIDAK</span>" ?></td> -->
            <td align="center">
                <a href="<?= base_url('kursus/view_luar/' . $kursus->id) ?>" class="btn btn-round btn-default btn-xs" title="Info"><i class="fa fa-file-o"></i></a>
            </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
