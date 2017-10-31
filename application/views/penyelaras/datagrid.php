
          <?php if(count($profiles)):?>
              <table class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Nama</th>
                    <th>No. KP</th>
                    <th>Skim Perkhidmatan</th>
                    <th>Gred</th>
                    <th>Jabatan</th>
                    <th>Penyelaras untuk</th>
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
                    <td><?=$profile->penyelaras?></td>
                    <td align="center">
                      <table>
                        <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])) : ?>
                        <th><a href="<?=base_url("profil/" . $profile->nokp . "/kump")?>" type="button" class="btn btn-round btn-default btn-xs" title="Tukar peranan"><i class="fa fa-tasks"></i></a></th>
                        <?php endif ?>
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
