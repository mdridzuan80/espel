<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu Utama</h3>
    <ul class="nav side-menu">
      <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="<?=base_url("kursus/takwim_pengguna_2")?>"><i class="fa fa-calendar"></i> Takwim Kursus</a></li>
        <li><a href="#"><i class="fa fa-smile-o"></i>Soal Selidik Kursus <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="<?=base_url("selidik/boranga")?>">KKM/P&P/2013(A) <?php if($bil_boranga) : ?><span class="badge bg-green"><?=$bil_boranga?></span><?php endif ?></a></li>
              <?php if($soalSelidikB) : ?>
              <li><a href="<?=base_url("selidik/borangb")?>">KKM/P&P/2013(B) <?php if($bil_borangb) : ?><span class="badge bg-green"><?=$bil_borangb?></span><?php endif ?></a></li>
              <?php endif ?>
            </ul>
        </li>
        <li><a><i class="fa fa-bar-chart"></i> Laporan <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="<?=base_url("laporan/pengguna_hadir_kursus")?>">Kursus yang dihadiri</a></li>
            <li><a href="<?=base_url("laporan/bukulog")?>">Format Buku Log</a></li>
            <li><a href="<?=base_url("laporan/ringkasan")?>">Ringkasan</a></li>
          </ul>
        </li>
    </ul>
  </div>

  <?php if($filterMenu) : ?>
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
