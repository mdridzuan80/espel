    <?php if(count($sen_calon)) : ?>
          <table id="pencalonan" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <td><input id="chkAll" type="checkbox" value="0"></td>
                <th>No KP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Jumlah Hari</th>
              </tr>
            </thead>

            <tbody>
                <?php foreach($sen_calon as $calon):?>
              <tr>
                <td><input class="chkCalon" type="checkbox" value="<?=$calon->nokp?>"></td>
                <td><?=$calon->nokp?></td>
                <td><?=$calon->nama?></td>
                <td><?=$calon->jabatan?></td>
                <td><?=$calon->jum_hari?></td>
              </tr>
          <?php endforeach?>
      <?php else: ?>
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                  Tiada Senarai Pencalonan!
                </div>
          <?php endif ?>
             </tbody>
          </table>
