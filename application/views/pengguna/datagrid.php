
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
                        <a href="<?=base_url("profil/" . $profile->nokp)?>" type="button" class="btn btn-round btn-default btn-xs" data-toggle="tooltip" title="Lihat pengguna"><i class="fa fa-file-o"></i></a>
                        <a href="<?=base_url("profil/" . $profile->nokp . "/reset_katalaluan")?>" type="button" class="btn btn-round btn-default btn-xs" data-toggle="tooltip" title="Reset pengguna"><i class="fa fa-key"></i></a>
                    </td>
                  </tr>
                  <?php endforeach?>
                 </tbody>
              </table>
              <div class="dataTables_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div>
              <div class="dataTables_paginate paging_simple_numbers"><?= $links ?></div>         
          <?php else:?>
          <div class="alert alert-warning " role="warning">
            <strong>INFO!</strong> Tiada rekod
          </div>
          <?php endif?>
