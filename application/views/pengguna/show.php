<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Senarai Pengguna</h2>
        <button id="cmdFilter" class="btn btn-default btn-sm pull-right"><i class="fa fa-search"></i> Carian</button>
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

            <div id="frmFilter">
              <form method="post" class="form-horizontal form-label-left">
              <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                   <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNama" name="txtNama" class="form-control col-md-7 col-xs-12 input-sm" value="" >
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nokp</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txtNoKP" name="txtNoKP" class="form-control col-md-7 col-xs-12 input-sm" value="" >
                    </div>
                  </div>
                   <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <table>
                        <tr>
                          <td><input id="comJabatan" name="comJabatan" class="easyui-combotree form-control col-md-7 col-xs-12 input-sm" data-options="url:'<?=base_url("welcome/get_tree_jabatan_related")?>',method:'get'" value="<?= $jab_ptj->jabatan_id ?>" ></td>
                          <td>&nbsp;Sub&nbsp;Jabatan&nbsp;</td>
                          <td><input id="chk_subjabatan" type="checkbox" checked></td>
                        <tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comKelas" name="comKelas">
                          <option selected="selected" value="0">Pilih Semua</option>
                          <?php foreach($sen_kumpulan as $kumpulan):?>
                          <option value="<?=trim($kumpulan['id'])?>"><?=$kumpulan['kod']?></option>
                          <?php endforeach?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Skim Perkhidmatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comSkim" name="comSkim">
                        <option selected="selected" value="0">Pilih Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gred</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comGred" name="comGred">
                        <option selected="selected" value="0">Pilih Semua</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control input-sm" id="comStatus" name="comStatus">
                        <option selected="selected" value="Y">Aktif</option>
                        <option value="T">Tidak Aktif</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button id='cmdDoTapis' class="btn btn-success btn-sm" name="papar">Cari</button>
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                </form>
            </div>
            <div id="datagrid"></div>
      </div>
    </div>
  </div>
</div>

