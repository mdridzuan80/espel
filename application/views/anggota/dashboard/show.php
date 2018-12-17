<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Maklumat Program dan Definisi</h2>
        <ul class="nav navbar-right panel_toolbox" style="min-width: 0px">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="table-responsive">
          <table class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Jenis Program</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($sen_program as $program) : ?>
              <tr>
                <td><?= $program->nama ?></td>
                <td><?= $program->keterangan ?></td>
              </tr>
            <?php endforeach ?>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Senarai Kursus Yang dihadiri <?= date('Y') ?></h2>
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
                <?php foreach ($sen_hadir as $hadir) : ?>
              <tr>
                <td><?= $hadir->tajuk ?></td>
                <td><?= ($hadir->anjuran == 'D') ? $hadir->anjuran_dalam : $hadir->anjuran_luar ?></td>
                <td><?= date("d M Y h:i A", strtotime($hadir->tkh_mula)) ?></td>
                <td><?= date("d M Y h:i A", strtotime($hadir->tkh_tamat)) ?></td>
                <td><?= $hadir->hari ?></td>
              </tr>
          <?php endforeach ?>
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
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($sen_dicalonkan as $dicalonkan) : ?>
              <tr>
                <td><?= $dicalonkan->tajuk ?></td>
                <td><?= ($dicalonkan->anjuran == 'D') ? $dicalonkan->anjuran_dalam : $dicalonkan->anjuran_luar ?></td>
                <td><?= date("d M Y h:i A", strtotime($dicalonkan->tkh_mula)) ?></td>
                <td><?= date("d M Y h:i A", strtotime($dicalonkan->tkh_tamat)) ?></td>
                <td align="center">
                    <?php if ($dicalonkan->stat_laksana == 'L') : ?>                      
                      <?php if ($dicalonkan->stat_mohon == 'M') : ?>
                        <span class="label label-warning">BELUM DIJAWAB</span>
                      <?php endif ?>
                      <?php if ($dicalonkan->stat_mohon == 'L') : ?>
                        <span class="label label-success">TERIMA</span>
                        <?php if ($dicalonkan->stat_hadir == 'Y') : ?>
                        <span class="label label-success">HADIR</span>
                      <?php endif ?>
                      <?php if ($dicalonkan->stat_hadir == 'T') : ?>
                        <span class="label label-danger">TIDAK HADIR</span>
                      <?php endif ?>
                      <?php endif ?>
                      <?php if ($dicalonkan->stat_mohon == 'T') : ?>
                        <span class="label label-danger">TOLAK</span>
                      <?php endif ?>
                    <?php else : ?>
                      <?php if ($dicalonkan->stat_mohon == 'M') : ?>
                        <span class="label label-warning">BELUM DIJAWAB</span>
                      <?php endif ?>
                      <?php if ($dicalonkan->stat_mohon == 'L') : ?>
                        <span class="label label-success">TERIMA</span>
                      <?php endif ?>
                      <?php if ($dicalonkan->stat_mohon == 'T') : ?>
                        <span class="label label-danger">TOLAK</span>
                      <?php endif ?>
                    <?php endif ?>
                </td>
                <td align="center">
                  <?php if ($dicalonkan->stat_laksana == 'L' && $dicalonkan->surat) : ?>
                  <a href="<?= base_url('assets/uploads/' . $dicalonkan->surat) ?>" class="btn btn-info btn-xs" target="_blank" >Papar surat</a>
                  <?php endif ?>
                  <a class="btn btn-info btn-xs btnPapar" data-kursusid="<?= $dicalonkan->id ?>" data-tajuk="<?= $dicalonkan->tajuk ?>">Info</a>
                </td>
              </tr>
          <?php endforeach ?>
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
                <th style="text-align:center">Status</th>
                <th>Info</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($sen_permohonan as $permohonan) : ?>
              <tr>
                <td><?= $permohonan->tajuk ?></td>
                <td><?= ($permohonan->anjuran == 'D') ? $permohonan->anjuran_dalam : $permohonan->anjuran_luar ?></td>
                <td><?= date("d M Y h:i A", strtotime($permohonan->tkh_mula)) ?></td>
                <td><?= date("d M Y h:i A", strtotime($permohonan->tkh_tamat)) ?></td>
                <td align="center">
                    <?php if ($permohonan->stat_mohon == 'T') : ?>
                    <span class="label label-danger">Tolak</span>
                    <?php endif ?>
                    <?php if ($permohonan->stat_mohon == 'M') : ?>
                    <span class="label label-warning">Baru</span>
                    <?php endif ?>
                    <?php if ($permohonan->stat_mohon == 'L') : ?>
                    <span class="label label-success">Lulus</span>
                    <?php endif ?>
                </td>
                <td>
                  <a class="btn btn-info btn-xs btnPapar" data-kursusid="<?= $permohonan->id ?>" data-tajuk="<?= $permohonan->tajuk ?>" >Info</a>
                </td>
              </tr>
          <?php endforeach ?>
             </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="MyModalKursusInfo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(25,188,157); color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myLargeModalLabel">...</h4>
      </div>
      <div class="modal-body">
        <p>...</p>
      </div>
    </div>
  </div>
</div>

<br/>
<br/>
<br/>