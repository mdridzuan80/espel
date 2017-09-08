<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Senarai Kursus</h2>
          <a href="<?=base_url("kursus/daftar")?>" class="btn btn-primary pull-right" role="button">Daftar Kursus</a>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php if(appsess()->getFlashSession()):?>
          <?php if(appsess()->getFlashSession('success')):?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>INFO!</strong> Proses telah berjaya dilaksanakan.
          </div>
          <?php else:?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>RALAT!</strong> Proses tidak berjaya dilaksanakan.
          </div>
          <?php endif?>
          <?php endif?>
          <?php //if($bajets->num_rows()):?>
          <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered jambo_table">
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
                      <?php foreach($kursuss->result() as $kursus):?>
                    <tr>
                      <td><?=$kursus->tajuk?></td>
                      <td><?=$kursus->program?></td>
                      <td><?=date('d-m-Y',strtotime($kursus->tkh_mula))?></td>
                      <td><?=date('d-m-Y',strtotime($kursus->tkh_tamat))?></td>
                      <td align="center">
                          <a href="<?=base_url('kursus/edit/' . $kursus->id)?>" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" title="Kemaskini"><i class="fa fa-edit"></i></a>
                          <a href="<?=base_url('kursus/delete/' . $kursus->id)?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
                      </td>
                    </tr>
                    <?php endforeach?>
                   </tbody>
               </table>
            </div>
          </div>
          <?php //else:?>
          <!--<div class="alert alert-warning " role="warning">
            <strong>INFO!</strong> Tiada rekod
          </div>-->
          <?php //endif?>
        </div>
      </div>
    </div>
  </div>
</div>
