<div class="row espel_latihan">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left">
                  <table class="table table-bordered">
                      <tr>
                        <tr>
                          <th>TAJUK</th>
                          <td><?= strtoupper($kursus->tajuk) ?></td>
                        </tr>
                        <th>PROGRAM</th>
                        <td><?= strtoupper($kursus->program) ?></td>
                      </tr>
                      <tr>
                        <th>JENIS AKTIVITI</th>
                        <td><?= strtoupper($kursus->aktiviti) ?></td>
                      </tr>
                      <tr>
                        <th>TARIKH</th>
                        <td><?= strtoupper(date("d M Y h:i A",strtotime($kursus->tkh_mula))) ?> - <?= strtoupper(date('d M Y h:i A',strtotime($kursus->tkh_tamat))) ?> </td>
                      </tr>
                      <tr>
                        <th>TEMPAT</th>
                        <td><?= strtoupper($kursus->tempat) ?></td>
                      </tr>
                      <tr>
                        <th>ANJURAN</th>
                        <td><?= ($kursus->anjuran == 'D') ? strtoupper($kursus->penganjur_dalam) : strtoupper($kursus->penganjur_luar) ?></td>
                      </tr>
                      <?php if($kursus->stat_jabatan == 'Y') : ?>
                      <tr>
                        <th>HUBUNGI</th>
                        <td>
                          <?php if($kursus->telefon){ echo $kursus->telefon; } ?>
                          <?php if($kursus->email){ echo '<br>' . strtoupper($kursus->email); } ?>
                        </td>
                      </tr>
                      <?php endif ?>
                      <?php if($kursus->program_id == 5) : ?>
                      <tr>
                        <th>SUMBER</th>
                        <td>
                          <?= strtoupper($kursus->sumber) ?>
                        </td>
                      </tr>
                       <tr>
                        <th>PENYELIA</th>
                        <td>
                          <?= strtoupper($kursus->penyelia) ?>
                        </td>
                      </tr>
                      <?php endif ?>
                      <tr>
                        <th>Status</th>
                        <td>
                          
                        </td>
                      </tr>
                  </table>
              </form>
          </div>
      </div>
  </div>
</div>

