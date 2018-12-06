        <?php if (count($sen_calon)) : ?>
          <table id="peserta" class="table table-striped table-bordered jambo_table">
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

                <?php foreach ($sen_calon as $calon) : ?>
              <tr>
                <td><?= $calon->nama ?></td>
                <td><?= $calon->gred ?></td>
                <td><?= $calon->kumpulan ?></td>
                <td><?= $calon->jabatan ?></td>
                <td>
                  <?php if ($calon->stat_jabatan == 'Y') : ?>
                            <?php if (strtotime($calon->tkh_mula) > time()) : ?>
                              <?php if ($calon->role == 'PTJ') : ?>
                                  <?php if ($calon->stat_mohon == 'M') : ?>
                                    <span class="label label-warning">DICALONKAN</span>
                                  <?php endif ?>
                                  <?php if ($calon->stat_mohon == 'L') : ?>
                                    <span class="label label-success">TERIMA</span>
                                  <?php endif ?>
                                  <?php if ($calon->stat_mohon == 'T') : ?>
                                    <span class="label label-success">TOLAK</span>
                                  <?php endif ?>
                                
                              <?php elseif ($calon->role == 'PENGGUNA') : ?>
                                <?php if ($calon->stat_mohon == 'T') : ?>
                                  <span class="label label-warning">PERMOHONAN TOLAK</span>
                                <?php elseif ($calon->stat_mohon == 'L') : ?>
                                  <span class="label label-info">PERMOHONAN LULUS</span>
                                <?php else : ?>
                                  <span class="label label-info">PERMOHONAN DITUTUP</span>
                                <?php endif ?>
                              <?php else : ?>
                                <span class="label label-info">PERMOHONAN DIBUKA</span>
                              <?php endif ?>
                            <?php else : ?>
                              <?php if ($calon->stat_laksana !== 'L') : ?>
                                <span class="label label-info">TEMPOH PERMOHONAN TUTUP</span>
                              <?php else : ?>
                                <span class="label label-info">KURSUS TELAH DILAKSANAKAN</span>
                              <?php endif ?>
                            <?php endif ?>
                          <?php else : ?>
                            <?php if ($calon->stat_hadir == 'M') : ?>
                              <?php if ($calon->jenis == 'L') : ?>
                                <span class="label label-warning">BELUM DISAHKAN</span>
                              <?php else : ?>
                                <span class="label label-warning">MOHON</span>
                              <?php endif ?>
                            <?php endif ?>
                            <?php if ($calon->stat_hadir == 'T') : ?>
                              <span class="label label-danger">TOLAK</span>
                            <?php endif ?>
                            <?php if ($calon->stat_hadir == 'L') : ?>
                              <?php if ($calon->jenis == 'L') : ?>
                                <span class="label label-success">DISAHKAN</span>
                              <?php else : ?>
                                <span class="label label-success">HADIR</span>
                              <?php endif ?>
                            <?php endif ?>
                          <?php endif ?>
                </td>
                <td align="center">
                  <!-- <?php if ($calon->stat_mohon == 'M') : ?>
                    <a href="<?= base_url('kursus/terima_pencalonan/' . $calon->id) ?>" class="btn btn-round btn-default btn-xs" title="Terima"><i class="fa fa-check" aria-hidden="true"></i></a>
                    <a href="<?= base_url('kursus/tolak_pencalonan/' . $calon->id) ?>" class="btn btn-round btn-default btn-xs" title="Tolak"><i class="fa fa-close" aria-hidden="true"></i></a>
                  <?php endif ?> -->
                  <?php if (appsess()->getSessionData('kumpulan') == $calon->role) : ?>
                  <a data-calon_id="<?= $calon->id ?>" href="<?= base_url('kursus/hapus_pencalonan/' . $calon->id) ?>" class="btn btn-round btn-default btn-xs btn-hapus-peserta" title="Hapus"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  <?php endif ?>
                </td>
              </tr>
          <?php endforeach ?>
      <?php else : ?>
          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                  Tiada Peserta!
                </div>
      <?php endif ?>
             </tbody>
          </table>
