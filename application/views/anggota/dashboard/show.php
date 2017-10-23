<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Status / Senarai Kursus Yang Dicalonkan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <table class="datatable table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Masa Mula</th>
                <th>Masa Tamat</th>
                <th>Operasi</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($sen_dicalonkan as $dicalonkan): ?>
              <tr>
                <td><?=$dicalonkan->tajuk?></td>
                <td><?=($dicalonkan->anjuran=='D') ? $dicalonkan->penganjur_dalam : $dicalonkan->penganjur_luar ?></td>
                <td><?=date("d M Y h:i A",strtotime($dicalonkan->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($dicalonkan->tkh_tamat))?></td>
                <td align="center">
                  <a href="<?= base_url('assets/uploads/' . $dicalonkan->surat) ?>" class="btn btn-info btn-xs" target="_blank" >Papar surat</a>
                  <a href="<?= base_url('kursus/info_kursus_pengguna/' . $dicalonkan->id) ?>" class="btn btn-info btn-xs" >Info</a>
                </td>
              </tr>
          <?php endforeach?>
             </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Status / Senarai Kursus Yang Dipohon</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <table class="datatable table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Masa Mula</th>
                <th>Masa Tamat</th>
                <th>Tarikh Mohon</th>
                <th style="text-align:center">Status</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($sen_permohonan as $permohonan): ?>
              <tr>
                <td><?=$permohonan->tajuk?></td>
                <td><?=$permohonan->nama?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_tamat))?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh))?></td>
                <td align="center">
                    <?php if($permohonan->stat_mohon == 'M'):?>
                    <span class="label label-warning">Baru</span>
                    <?php endif?>
                    <?php if($permohonan->stat_mohon == 'L'):?>
                    <span class="label label-success">Lulus</span>
                    <?php endif?>
                </td>
              </tr>
          <?php endforeach?>
             </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Senarai Kursus Yang dihadiri <?=date('Y')?></h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 0px">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <table class="datatable table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Tarikh Mula</th>
                <th>Tarikh Tamat</th>
                <th>Bil. Hari</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($sen_hadir as $hadir): ?>
              <tr>
                <td><?=$hadir->tajuk?></td>
                <td><?=$hadir->jabatan?></td>
                <td><?=date("d M Y h:i A",strtotime($hadir->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($hadir->tkh_tamat))?></td>
                <td><?=$hadir->hari?></td>
              </tr>
          <?php endforeach?>
             </tbody>
          </table>

      </div>
    </div>
  </div>
</div>
<br/>
<br/>
<br/>