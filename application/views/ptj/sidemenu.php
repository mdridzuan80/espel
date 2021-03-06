<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu Utama</h3>
    <ul class="nav side-menu">
      <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
      <li><a><i class="fa fa-laptop"></i>Modul Kursus <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= base_url('kursus/takwim') ?>">Pengurusan Kursus</a></li>
          <!-- <li><a href="<?= base_url('kursus/separa_takwim') ?>">Kursus Separa Siap</a></li> -->
          <li><a href="<?= base_url('kursus/pengesahan_kehadiran') ?>">Pengesahan Kehadiran</a></li>
        </ul>
      </li>
      <?php if ($has_peruntukan) : ?>
     <li><a><i class="fa fa-money"></i>Peruntukan <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?= base_url('peruntukan/prestasi') ?>"></i>Prestasi Peruntukan</a></li>
          </ul>
      </li>
      <?php endif ?>
      <li><a><i class="fa fa-smile-o"></i> Borang Soal Selidik <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= base_url('selidik/analisa_boranga') ?>">Analisa Borang A</a></li>
          <li><a href="<?= base_url('selidik/analisa_borangb') ?>">Analisa Borang B</a></li>
          <li><a href="<?= base_url('laporan/x_jawab_borang_a') ?>">Tidak Menjawab Borang A</a></li>
          <li><a href="<?= base_url('laporan/x_jawab_borang_b') ?>">Tidak Menjawab Borang B</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart"></i> Laporan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= base_url("laporan/penganjur_kursus") ?>">laporan Penganjuran Kursus</a></li>
          <li><a href="<?= base_url('laporan/pengguna_hadir_kursus_ptj') ?>">Laporan Senarai Kehadiran Individu</a></li>
          <!-- <li><a href="<?= base_url('laporan/prestasi_kursus_individu') ?>">Laporan Senarai Prestasi Individu</a></li> -->
          <li><a href="<?= base_url('laporan/prestasi_kursus_keseluruhan') ?>">Laporan Prestasi Keseluruhan</a></li>
          <?php if ($has_peruntukan) : ?>
          <li><a href="<?= base_url('laporan/prestasi_kewangan') ?>">Laporan Prestasi Kewangan</a></li>
          <?php endif ?>
        </ul>
      </li>
      <li><a><i class="fa fa-users"></i> Modul Pengguna <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= base_url("pengguna") ?>">Senarai Pengguna</a></li>
          <li><a href="<?= base_url("pengguna/pengecualian") ?>">Senarai Pengecualian Kursus</a></li>
        </ul>
      </li>

<!--       <li><a><i class="fa fa-gear"></i> Konfigurasi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= base_url('mockup/ptj/konfigurasi/surat') ?>">Surat Panggilan Kursus</a></li>
        </ul>
      </li>
 -->    </ul>
  </div>

    <?php if ($filterMenu) : ?>
  <div class="menu_section">
    <h3>PAPAR JENIS TAKWIM</h3>
    <ul class="nav side-menu">
      <li>&nbsp;&nbsp;&nbsp;
        <div class="pretty p-default p-curve p-fill">
            <input class="jenis" type="checkbox" value="r" data-medan="jenis" checked/>
            <div class="state p-rancang">
                <label style="color:white;">Kursus Rancang</label>
            </div>
        </div>
      </li>
      <li>&nbsp;&nbsp;&nbsp;
        <div class="pretty p-default p-curve p-fill">
            <input class="jenis" type="checkbox" value="s" data-medan="jenis" checked/>
            <div class="state p-siap">
                <label style="color:white;">Kursus Siap</label>
            </div>
        </div>
      </li>
    </ul>
  </div>
  <?php endif ?>

</div>
<!-- /sidebar menu -->
