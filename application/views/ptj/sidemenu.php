<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu Utama</h3>
    <ul class="nav side-menu">
      <li><a href="<?=base_url()?>"><i class="fa fa-home"></i> Dashboard</a></li>
      <li><a><i class="fa fa-users"></i> Modul Pengguna <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?=base_url("pengguna")?>">Senarai Pengguna</a></li>
          <li><a href="<?=base_url("pengguna/pengecualian")?>">Senarai Pengecualian Kursus</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-laptop"></i>Modul Kursus <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?=base_url('kursus/pengurusan')?>">Pengurusan Kursus</a></li>
          <li><a href="<?=base_url('kursus/takwim')?>">Takwim Kursus</a></li>
          <li><a href="<?=base_url('kursus/permohonan_kursus')?>">Senarai Permohonan</a></li>
          <li><a href="<?=base_url('kursus/pengesahan_kehadiran')?>">Pengesahan Kehadiran</a></li>
          <li><a href="<?=base_url('kursus/Kursus_separa')?>">Kursus Separa Siap</a></li>
        </ul>
      </li>
      <?php if($has_peruntukan) : ?>
     <li><a><i class="fa fa-money"></i>Peruntukan <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?=base_url('peruntukan/prestasi')?>"></i>Prestasi Peruntukan</a></li>
          </ul>
      </li>
      <?php endif ?>
      <li><a><i class="fa fa-smile-o"></i> Borang Soal Selidik <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?=base_url('selidik/analisa_boranga')?>">Analisa Borang A</a></li>
          <li><a href="<?=base_url('selidik/analisa_borangb')?>">Analisa Borang B</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bar-chart"></i> Laporan <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?=base_url('laporan/pengguna_hadir_kursus_ptj')?>">Laporan Senarai Kehadiran Individu</a></li>
          <li><a href="<?=base_url('laporan/prestasi_kursus_individu')?>">Laporan Senarai Prestasi Individu</a></li>
          <li><a href="<?=base_url('laporan/prestasi_kursus_keseluruhan')?>">Laporan Prestasi Keseluruhan</a></li>
          <?php if($has_peruntukan) : ?>
          <li><a href="<?=base_url('laporan/prestasi_kewangan')?>">Laporan Prestasi Kewangan</a></li>
          <?php endif ?>
          <li><a href="<?=base_url('laporan/x_jawab_borang_a')?>">Tidak Menjawab Borang A</a></li>
          <li><a href="<?=base_url('laporan/x_jawab_borang_b')?>">Tidak Menjawab Borang B</a></li>
        </ul>
      </li>

<!--       <li><a><i class="fa fa-gear"></i> Konfigurasi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?=base_url('mockup/ptj/konfigurasi/surat')?>">Surat Panggilan Kursus</a></li>
        </ul>
      </li>
 -->    </ul>
  </div>
</div>
<!-- /sidebar menu -->
