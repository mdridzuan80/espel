
          <?php if(count($profiles)):?>
              <table class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Bil.</th>
                    <th>Nama</th>
                    <th>No. KP</th>
                    <th>Skim Perkhidmatan</th>
                    <th>Gred</th>
                    <th>Jabatan</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $bil = $mula; foreach($profiles as $profile):?>
                  <tr>
                    <td><?=$bil++?></td>
                    <td><?=$profile->nama?></td>
                    <td><?=$profile->nokp?></td>
                    <td><?=$profile->skim?></td>
                    <td><?=$profile->gred_id?></td>
                    <td><?=$profile->jabatan?></td>
                    <td align="center">
                      <table>
                        <th><a data-username="<?= $profile->nokp ?>" type="button" class="btn btn-round btn-default btn-xs btn-papar-profil" title="Lihat Profil Pengguna"><i class="fa fa-file-o"></i></a></th>
                        <th><a data-username="<?= $profile->nokp ?>" type="button" class="btn btn-round btn-default btn-xs btn-reset-password" title="Reset Katalaluan Pengguna"><i class="fa fa-key"></i></a></th>
                        <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])) : ?>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/kump")?>" type="button" class="btn btn-round btn-default btn-xs" title="Tukar Peranan Pengguna"><i class="fa fa-tasks"></i></a></th>
                        <?php endif ?>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/kecuali")?>" type="button" class="btn btn-round btn-default btn-xs" title="Cipta Pengecualian Pengguna"><i class="fa fa-code-fork"></i></a></th>
                        <th><a data-username="<?= $profile->nokp ?>" type="button" class="btn btn-round btn-default btn-xs btn-nyahaktif" title="Nyahaktif Pengguna"><i class="fa fa-star-o"></i></a></th>
                        <th><a href="<?= base_url("profil/edit_kursus/" . $profile->nokp . "/" . date('Y')) ?>" data-username="<?= $profile->nokp ?>" type="button" class="btn btn-round btn-default btn-xs btn-papar-kursus" title="Kemaskini Kursus"><i class="fa fa-edit"></i></a></th>
                      </table>
                    </td>
                  </tr>
                  <?php endforeach?>
                 </tbody>
              </table>
              <div class="dataTables_info" role="status" aria-live="polite">Showing <?=$mula?> to <?=$hingga?> of <?=$total?> entries</div>
              <div class="dataTables_paginate paging_simple_numbers"><?= $links ?></div>         
          <?php else:?>
          <div class="alert alert-warning " role="warning">
            <strong>INFO!</strong> Tiada rekod
          </div>
          <?php endif?>
