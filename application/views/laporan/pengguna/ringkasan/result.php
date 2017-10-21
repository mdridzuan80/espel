  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Ringkasan Kursus <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="datatable table table-striped table-bordered jambo_table">
              <thead>
                <tr>
                  <th style="width:5%;">Bil</th>
                  <th style="width:75%;">Program latihan</th>
                  <th style="width:20%;">Bilangan hari</th>
                </tr>
              </thead>
              <tbody>
                  <?php $total = 0;?>
                  <?php $x=1; foreach($program as $key => $prog):?>
                      <?php $total += $prog["hari"]?>
                <tr>
                    <td><?=$x++?></td>
                    <td><?=$prog["nama"]?></td>
                    <?php if($key != 'cpd'):?>
                    <td><?=round($prog["hari"],2)?></td>
                    <?php else:?>
                    <td><?= "<b>MATA:</b> " . $prog["hari"] . ", <b>HARI:</b> " . round(($prog["hari"]/40)*7,2)?></td>
                    <?php endif?>
                </tr>
                <?php endforeach?>
                <tr>
                    <td colspan="2">Jumlah Keseluruhan</td>
                    <td><?=$total?></td>
                </tr>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
