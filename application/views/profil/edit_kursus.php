<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Kemaskini Maklumat Kursus Profil : <?= $profil->nama . ' (' . $profil->nokp . ')' ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Tarikh Mula</th>
                <th>Tarikh Tamat</th>
                <th>Bil. Hari</th>
              </tr>
            </thead>
            <tbody>
                <?php if(count($sen_hadir) == 0) : ?>
                    <tr>
                        <td colspan="5"><span style="color:red;">TIADA REKOD KURSUS</span></td>
                    </tr>
                <?php endif ?>
              <?php $jumlah = 0;

                foreach ($sen_hadir as $hadir) : ?>
              <tr>
                <td><?= "<a class=\"btnEdit\" href = \"#\" style = \"color:blue;\" data-kursus_id=\"". $hadir->id . "\" data-program_id=\"". $hadir->program_id ."\" >" . $hadir->tajuk . "</a>" ?></td>
                <td><?= ($hadir->anjuran == 'D') ? $hadir->anjuran_dalam : $hadir->anjuran_luar ?></td>
                <td><?= date("d M Y h:i A", strtotime($hadir->tkh_mula)) ?></td>
                <td><?= date("d M Y h:i A", strtotime($hadir->tkh_tamat)) ?></td>
                <td><?= $hadir->hari ?></td>
                <?php
                $jumlah += $hadir->hari;
                ?>
              </tr>
              <?php endforeach ?>
              <tr>
                <td colspan="2">MYCPD</td>
                <td colspan="2">Point : <?= $mycpd->point ?></td>
                <td>
                <?php
                if ($mycpd->point != 0) :
                    echo $mycpd = round(($mycpd->point / 40) * 7);
                else :
                    echo $mycpd = 0;
                endif
                ?>
                </td>
              </tr>
              <tr>
                <td colspan="4">JUMLAH HARI</td>
                <td><?= round($jumlah + $mycpd) ?></td>
              </tr>
             </tbody>
          </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(25,188,157); color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myLargeModalLabel">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>
