        <?php if(count($sen_calon)) : ?>
          <table id="peserta" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama</th>
                <th>Gred</th>
                <th>Kumpulan</th>
                <th>Jabatan</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>

            <tbody>

                <?php foreach($sen_calon as $calon):?>
              <tr>
                <td><?=$calon->nama?></td>
                <td><?=$calon->gred?></td>
                <td><?=$calon->kumpulan?></td>
                <td><?=$calon->jabatan?></td>
                <td align="center">
                  <!-- <?php if($calon->stat_mohon == 'M') : ?>
                    <a href="<?=base_url('kursus/terima_pencalonan/' . $calon->id)?>" class="btn btn-round btn-default btn-xs" title="Terima"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <a href="<?=base_url('kursus/tolak_pencalonan/' . $calon->id)?>" class="btn btn-round btn-default btn-xs" title="Tolak"><i class="fa fa-close" aria-hidden="true"></i></a>
                  <?php endif ?> -->
                  <?php if(appsess()->getSessionData('kumpulan') == $calon->role) : ?>
                  <a data-calon_id="<?= $calon->id ?>" href="<?=base_url('kursus/hapus_pencalonan/' . $calon->id)?>" class="btn btn-round btn-default btn-xs btn-hapus-peserta" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  <?php endif ?>
                </td>
              </tr>
          <?php endforeach?>
      <?php else: ?>
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                  Tiada Peserta!
                </div>
      <?php endif ?>
             </tbody>
          </table>
