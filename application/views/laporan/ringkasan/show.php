<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Ringkasan Kursus <?=$tahun?></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered jambo_table">
              <thead>
                <tr class="headings">
                  <th>Bil</th>
                  <th>Program latihan</th>
                  <th>Bilangan hari</th>
                </tr>
              </thead>
              <tbody>
                  <?php $x=1; foreach($program as $key => $prog):?>
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
               </tbody>
           </table>
        </div>
      </div>
    </div>
  </div>
</div>
