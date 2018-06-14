<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kedudukan Pengurusan Kursus</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 1) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">1</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?= base_url('kursus/edit_jabatan/' . $kursus_id) ?>">Info</a></h3>
                <p>Info maklumat kursus</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 2) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">2</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/pencalonan/' . $kursus_id)?>">Pencalonan</a></h3>
                <p>Menguruskan pencalonan peserta bagi kursus yang dianjurkan</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 3) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">3</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/pelaksanaan/' . $kursus_id)?>">Pelaksanaan</a></h3>
                <p>Melaksanakan kursus yang dianjurkan</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 4) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">4</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/sah_calon/' . $kursus_id)?>">Pengesahan Kehadiran</a></h3>
                <p>Mengesahkan kehadiran kursus yang dianjurkan</p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

