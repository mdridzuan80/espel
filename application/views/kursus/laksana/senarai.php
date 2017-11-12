          <table class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Penganjur</th>
                <th>Tarikh Mula</th>
                <th>Tarikh Tamat</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>

            <tbody>
              <?php if(count($sen_permohonan)) : ?>
                <?php foreach($sen_permohonan as $permohonan):?>
              <tr>
                <td><?=$permohonan->tajuk?></td>
                <td><?=$permohonan->penganjur?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_tamat))?></td>
                <td>
                    <?php if($permohonan->stat_laksana == 'R') : ?>
                    <span class="label label-warning">Rancang</span>
                    <?php endif ?>
                    <?php if($permohonan->stat_laksana == 'L') : ?>
                    <span class="label label-success">Selesai</span>
                    <?php endif ?>
                    <span class="label label-info"><?=$objMohonKursus->count_by('kursus_id', $permohonan->id)?> Peserta</span>
                    <?php if($permohonan->peruntukan_id) : ?>
                      <?php if($permohonan->stat_byr == 'T') : ?>
                        <span class="label label-alert">Bayaran : Tanggungan</span>
                      <?php endif ?>
                      <?php if($permohonan->stat_byr == 'S') : ?>
                        <span class="label label-success">Bayaran : Selesai</span>
                      <?php endif ?>
                    <?php endif ?>
                </td>
                <td align="center">
                    <a href="<?=base_url('kursus/pelaksanaan/' . $permohonan->id)?>" class="btn btn-primary btn-xs" title="Info">Pelaksanaan</a>
                </td>
              </tr>
          <?php endforeach?>
          <?php endif ?>
             </tbody>
          </table>
