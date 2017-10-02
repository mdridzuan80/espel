          <table id="datatable" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama</th>
                <th>Gred</th>
                <th>Kumpulan</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>

            <tbody>
              <?php if(count($sen_calon)) : ?>
                <?php foreach($sen_calon as $calon):?>
              <tr>
                <td><?=$calon->nama?></td>
                <td><?=$calon->gred?></td>
                <td><?=$calon->kumpulan?></td>
                <td><?=$calon->jabatan?></td>
                <td>
                  <?php
                    switch($calon->stat_mohon)
                    {
                      case 'M':
                        echo '<span class="label label-warning">Mohon</span>';
                        break;
                      case 'T':
                        echo '<span class="label label-danger">Tolak</span>';
                        break;
                      case 'L':
                        echo '<a class="label label-success">Lulus</a>';
                        break;
                    }
                  ?>
                </td>
                <td align="center">
                  <a href="<?=base_url('kursus/percalonan/' . $calon->id)?>" class="btn btn-primary btn-xs" title="Info">Lulus</a>
                  <a href="<?=base_url('kursus/percalonan/' . $calon->id)?>" class="btn btn-primary btn-xs" title="Info">Tolak</a>
                </td>
              </tr>
          <?php endforeach?>
          
          <?php endif ?>
             </tbody>
          </table>
