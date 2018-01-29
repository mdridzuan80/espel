  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Laporan Prestasi Keseluruhan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
                      <div>
              <form method="post" class="form-horizontal form-label-left">
                  <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tahun</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtTahun" name="txtTahun" class="form-control input-sm" value="<?= date('Y') ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNama" name="txtNama" class="form-control input-sm" >
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. KP</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNoKP" name="txtNoKP" class="form-control input-sm">
                    </div>
                  </div>
                  <div class="form-group">
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <table>
                        <tr>
                          <td><input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?= $jab_ptj   ?>" ></td>
                          <td>&nbsp;Sub&nbsp;Jabatan&nbsp;</td>
                          <td><input id="chk_subjabatan" type="checkbox" checked></td>
                        <tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comKelas" name="comKelas[]" multiple>
                          <?php foreach($sen_kumpulan as $kumpulan):?>
                          <option value="<?=$kumpulan['id']?>" selected><?=$kumpulan['kod']?></option>
                          <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Skim Perkhidmatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comSkim" name="comSkim[]" multiple>
                          <option value="0" selected>Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comGred" name="comGred[]" multiple>
                          <option value="0" selected>Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bilangan Hari</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comHari" name="comHari[]" multiple>
                          <option value="1" selected>Tidak pernah hadir</option>
                          <option value="2" selected>1 hari</option>
                          <option value="3" selected>2 hari</option>
                          <option value="4" selected>3 hari</option>
                          <option value="5" selected>4 hari</option>
                          <option value="6" selected>5 hari</option>
                          <option value="7" selected>6 hari</option>
                          <option value="8" selected>7 hari</option>
                          <option value="9" selected>Lebih 7 hari</option>
                        </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-success btn-papar btn-sm" name="button">Papar</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

<div id=rptPapar></div>

<!-- Modal -->
<div id="myLaporanModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
 
  </div>
</div>
