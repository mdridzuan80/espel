
          <?php if(count($profiles)):?>
              <table class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Nama</th>
                    <th>No. KP</th>
                    <th>Skim Perkhidmatan</th>
                    <th>Gred</th>
                    <th>Jabatan</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach($profiles as $profile):?>
                  <tr>
                    <td><?=$profile->nama?></td>
                    <td><?=$profile->nokp?></td>
                    <td><?=$profile->skim?></td>
                    <td><?=$profile->gred_id?></td>
                    <td><?=$profile->jabatan?></td>
                    <td align="center">
                      <table>
                        <th><a href="<?=base_url("profil/" . $profile->nokp)?>" type="button" class="btn btn-round btn-default btn-xs" title="Lihat pengguna"><i class="fa fa-file-o"></i></a></th>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/reset_katalaluan")?>" type="button" class="btn btn-round btn-default btn-xs" title="Reset pengguna"><i class="fa fa-key"></i></a></th>
                        <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])) : ?>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/kump")?>" type="button" class="btn btn-round btn-default btn-xs" title="Tukar peranan"><i class="fa fa-tasks"></i></a></th>
                        <?php endif ?>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/kecuali")?>" type="button" class="btn btn-round btn-default btn-xs" title="Cipta Pengecualian"><i class="fa fa-code-fork"></i></a></th>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/status")?>" type="button" class="btn btn-round btn-default btn-xs" title="Kemaskini status" onclick="return confirm('Anda pasti untuk proses ini?')"><i class="fa fa-star-o"></i></a></th>
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
