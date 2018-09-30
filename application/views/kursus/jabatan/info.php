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
                          <?php if($kursus->stat_laksana == 'R'): ?>
                            <span class="label label-warning">RANCANG</span>
                          <?php else: ?>
                            <span class="label label-success">SELESAI</span>
                          <?php endif ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Bilangan Peserta</th>
                        <td>
                          <?= strtoupper($kursus->bil_peserta) ?>
                        </td>
                      </tr>
                  </table>
                    <button id="btn-urus" data-kursusid="<?= $kursus->id ?>" type="button" class="btn btn-primary btn-sm">Pengurusan Kursus</button>
                    <!-- <button id="btn-edit" data-kursusid="<?= $kursus->id ?>" data-programid="<?= $kursus->program_id ?>" type="button" class="btn btn-primary btn-sm">Edit</button> -->
                    <button id="btn-hapus" data-kursusid="<?= $kursus->id ?>" type="button" class="btn btn-danger btn-sm">Hapus</button>
              </form>
          </div>
      </div>
  </div>
</div>

