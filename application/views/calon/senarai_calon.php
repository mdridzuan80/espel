          <table id="datatable" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>No KP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Jumlah Hari</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>

            <tbody>
              <?php if(count($sen_calon)) : ?>
                <?php foreach($sen_calon as $calon):?>
              <tr>
                <td><?=$calon->nokp?></td>
                <td><?=$calon->nama?></td>
                <td><?=$calon->jabatan?></td>
                <td><?=$calon->hari?></td>
                <td align="center">
                  <a class="btn btn-primary btn-xs" title="Info">Pilih</a>
                </td>
              </tr>
          <?php endforeach?>
          
          <?php endif ?>
             </tbody>
          </table>
