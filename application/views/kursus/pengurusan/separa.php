<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kedudukan Pengurusan Kursus Separa Siap</h2>
        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <div class="row">
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 1) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">1</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/edit_separa_jabatan/' . $kursus_id)?>">Info</a></h3>
                <p>Menguruskan maklumat kursus yang telah dijalankan</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 2) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">2</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/separa_pencalonan/' . $kursus_id)?>">Pencalonan</a></h3>
                <p>Menguruskan pencalonan peserta kursus yang telah dijalankan</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats <?= ($level == 3) ? 'aktif' : '' ?>">
                <div class="icon"><i class="fa">3</i>
                </div>
                <div class="count">&nbsp;</div>

                <h3><a href="<?=base_url('kursus/separa_pelaksanaan/' . $kursus_id)?>">Pelaksanaan</a></h3>
                <p>Melaksanakan kursus yang telah dijalankan</p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

