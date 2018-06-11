<div class="row espel_latihan">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Maklumat Kursus</h2>
        <div class="clearfix"></div>
      </div>
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
                          <?php if($kursus->stat_jabatan == 'Y') : ?>
                            <?php if(strtotime($kursus->tkh_mula) > time()) : ?>
                              <?php if($kursus->stat_laksana == 'R') : ?>
                                <?php if($kursus->jenis == 'R') : ?>
                                  <?php if($kursus->stat_mohon) : ?>
                                    <span class="label label-warning">MOHON</span>
                                  <?php else : ?>
                                    <span class="label label-info">PERMOHONAN DIBUKA</span>
                                  <?php endif ?>
                                <?php else : ?>
                                  <?php if($kursus->stat_mohon) : ?>
                                    <span class="label label-warning">DICALONKAN</span>
                                  <?php else : ?>
                                    <span class="label label-info">PERMOHONAN TUTUP</span>
                                  <?php endif ?>
                                <?php endif ?>
                              <?php elseif($kursus->stat_laksana == 'L') : ?>
                                <?php if($kursus->stat_mohon) : ?>
                                  <span class="label label-warning">MOHON</span>
                                <?php else : ?>
                                  <span class="label label-info">PERMOHONAN TUTUP</span>
                                <?php endif ?>
                              <?php else : ?>
                                <span class="label label-info">PERMOHONAN DIBUKA</span>
                              <?php endif ?>
                            <?php else : ?>
                              <span class="label label-info">PERMOHONAN TUTUP</span>
                            <?php endif ?>
                          <?php else : ?>
                            <?php if($kursus->stat_hadir == 'M') : ?>
                              <?php if($kursus->jenis == 'L') : ?>
                                <span class="label label-warning">BELUM DISAHKAN</span>
                              <?php else : ?>
                                <span class="label label-warning">MOHON</span>
                              <?php endif ?>
                            <?php endif ?>
                            <?php if($kursus->stat_hadir == 'T') : ?>
                              <span class="label label-danger">TOLAK</span>
                            <?php endif ?>
                            <?php if($kursus->stat_hadir == 'L') : ?>
                              <?php if ($kursus->jenis == 'L') : ?>
                                <span class="label label-success">DISAHKAN</span>
                              <?php else : ?>
                                <span class="label label-success">HADIR</span>
                              <?php endif ?>
                            <?php endif ?>
                          <?php endif ?>
                        </td>
                      </tr>
                  </table>
                  <?php if($kursus->stat_jabatan == 'Y') : ?>
                    <?php if($kursus->jenis == 'R' ) : ?>
                      <?php if(strtotime($kursus->tkh_mula) > time() && $kursus->stat_laksana == 'R' && is_null($kursus->stat_mohon)) : ?>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button id="btnMohon" type="submit" class="btn btn-primary btn-sm" name="mohon" data-kursus_id="<?= $kursus->id ?>">MOHON</button>
                        </div>
                      <?php endif ?>
                    <?php endif ?>
                  </div>
                  <?php else : ?>
                    <?php if($kursus->stat_hadir != 'L') : ?>
                    <div class="ln_solid"></div>
                    <div class="pull-right">
                      <button id="btnEdit" type="submit" class="btn btn-primary btn-sm" name="mohon" data-kursus_id="<?= $kursus->id ?>" data-program_id="<?= $kursus->program_id ?>">EDIT</button>
                      <button id="btnHapus" type="submit" class="btn btn-danger btn-sm" name="mohon" data-kursus_id="<?= $kursus->id ?>">HAPUS</button>
                    </div
                    <?php endif ?>
                  <?php endif ?>
              </form>
      </div>
    </div>
  </div>
</div>

