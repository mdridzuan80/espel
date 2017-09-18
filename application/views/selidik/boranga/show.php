<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Borang Keberkesanan Kursus oleh Peserta</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if(count($sen_kursus)):?>
            <table class="datatable table table-striped table-bordered jambo_table">
              <thead>
                <tr class="headings">
                  <th>Tajuk</th>
                  <th>Program</th>
                  <th>Mula</th>
                  <th>Tamat</th>
                  <th style="text-align:center">Operasi</th>
                </tr>
              </thead>


              <tbody>
                  <?php foreach($sen_kursus as $kursus):?>
                <tr>
                  <td><?=$kursus->tajuk?></td>
                  <td><?=$kursus->program?></td>
                  <td><?=date('d M Y',strtotime($kursus->tkh_mula))?></td>
                  <td><?=date('d M Y',strtotime($kursus->tkh_tamat))?></td>
                  <td align="center">
                      <a href="<?=base_url('kursus/view_luar/' . $kursus->id)?>" class="btn btn-info btn-xs" title="Info">Info</a>
                      <a href="<?=base_url('selidik/boranga_jawab/' . $kursus->id)?>" class="btn btn-primary btn-xs" title="Menjawab soal selidik">Jawab</a>
                  </td>
                </tr>
                <?php endforeach?>
               </tbody>
            </table>
            <?php else:?>
            <div class="alert alert-warning " role="warning">
              <strong>INFO!</strong> Tiada rekod
            </div>
            <?php endif?>
        </div>
      </div>
    </div>
  </div>
</div>
