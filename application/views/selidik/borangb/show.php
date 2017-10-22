<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Borang Keberkesanan Kursus oleh Pegawai Penilai</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if(count($sen_borangb)):?>
            <table class="datatable table table-striped table-bordered jambo_table">
              <thead>
                <tr class="headings">
                  <th>Peserta</th>
                  <th>Tajuk</th>
                  <th>Program</th>
                  <th>Mula</th>
                  <th>Tamat</th>
                  <th style="text-align:center">Operasi</th>
                </tr>
              </thead>


              <tbody>
                  <?php foreach($sen_borangb as $kursus):?>
                <tr>
                  <td><?=$kursus->nama?></td>
                  <td><?=$kursus->tajuk?></td>
                  <td><?=$kursus->program?></td>
                  <td><?=date('d M Y h:i A',strtotime($kursus->tkh_mula))?></td>
                  <td><?=date('d M Y h:i A',strtotime($kursus->tkh_tamat))?></td>
                  <td align="center">
                      <a href="<?=base_url('selidik/borangb_jawab/' . $kursus->borangaid)?>" class="btn btn-primary btn-xs" title="Menjawab soal selidik">Jawab</a>
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
