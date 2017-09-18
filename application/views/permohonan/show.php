<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Senarai Permohonan Kursus</h2>

        <div class="clearfix"></div>
      </div>
      <div class="x_content">
          <table id="datatable" class="table table-striped table-bordered jambo_table">
            <thead>
              <tr class="headings">
                <th>Nama Kursus</th>
                <th>Anjuran</th>
                <th>Tarikh</th>
                <th>Tarikh Tutup</th>
                <th>Jumlah Permohonan</th>
                <th style="text-align:center">Operasi</th>
              </tr>
            </thead>

            <tbody>
                <?php foreach($sen_permohonan as $permohonan):?>
              <tr>
                <td><?=$permohonan->tajuk?></td>
                <td><?=$permohonan->jabatan?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_mula))?></td>
                <td><?=date("d M Y h:i A",strtotime($permohonan->tkh_tamat))?></td>
                <td><?=$permohonan->total?></td>
                <td align="center">
                    <a href="<?=base_url('kursus/permohonan_calon_kursus/' . $permohonan->id)?>" class="btn btn-primary btn-xs" title="Info">Calon</a>
                </td>
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
