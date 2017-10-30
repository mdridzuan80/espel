<div class="row espel_latihan">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Program Latihan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <div class="x_content">
              <form method="post" class="form-horizontal form-label-left">
                  <?php $csrf = [
                      'name' => $this->security->get_csrf_token_name(),
                      'hash' => $this->security->get_csrf_hash()
                      ];
                  ?>
                  <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                  <table class="table table-bordered">
                      <tr>
                        <th>Program</th>
                        <td><?= $kursus->program ?></td>
                      </tr>
                      <tr>
                        <th>Jenis Aktiviti</th>
                        <td><?= $kursus->aktiviti ?></td>
                      </tr>
                      <tr>
                        <th>Tajuk</th>
                        <td><?= $kursus->tajuk ?></td>
                      </tr>
                      <tr>
                        <th>Tarikh</th>
                        <td><?= date("d M Y h:i A",strtotime($kursus->tkh_mula)) ?> - <?= date('d M Y h:i A',strtotime($kursus->tkh_tamat)) ?> </td>
                      </tr>
                      <tr>
                        <th>Tempat</th>
                        <td><?= $kursus->tempat ?></td>
                      </tr>
                      <tr>
                        <th>Anjuran</th>
                        <td><?= ($kursus->anjuran == 'D') ? $kursus->penganjur_dalam : $kursus->penganjur_luar ?></td>
                      </tr>
                      <tr>
                        <th>Hubungi</th>
                        <td>
                          <?= $kursus->telefon ?>
                          <?= ($kursus->email) ? ('<br>' . $kursus->email) : '' ?>
                        </td>
                      </tr>
                      <?php if($kursus->program_id == 5) : ?>
                      <tr>
                        <th>Sumber</th>
                        <td>
                          <?= $kursus->sumber ?>
                        </td>
                      </tr>
                       <tr>
                        <th>Penyelia</th>
                        <td>
                          <?= $kursus->penyelia ?>
                        </td>
                      </tr>
                      <?php endif ?>
                  </table>
                  <?php if(!status_mohon($kursus->id, appsess()->getSessionData('username'))) : ?>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button type="submit" class="btn btn-success" name="mohon">Mohon</button>
                    </div>
                  </div>
                  <?php endif ?>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>

