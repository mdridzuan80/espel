<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Peranan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="frmKumpulan" method="post" class="form-horizontal form-label-left">
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Peranan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="comPeranan" class="select2_single form-control" name="comPeranan">
                            <option value="0">Pilih Peranan</option>
                            <?php foreach($senPeranan as $peranan):?>
                            <option value="<?=$peranan->id?>"><?=$peranan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div id="jabatan-penyelaras" class="form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comJabatanPenyelaras" name="comJabatanPenyelaras" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'">
                    </div>
                </div>
                <div id="jabatan-tree" class="form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Lihat Sub Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="comSubTree" class="select2_single form-control" name="comSubTree">
                            <option value="F" selected>TIDAK</option>
                            <option value="T" >YA</option>
                        </select>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Maklumat Peranan Semasa (<?= $profil->nama ?>)</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered jambo_table">
                <thead>
                    <tr class="headings">
                        <th>Kumpulan</th>
                        <th>Jabatan</th>
                        <th>Lihat Sub jabatan</th>
                        <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
                        <th style="text-align:center">Operasi</th>
                        <?php endif?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($sen_subscribe as $subscribe):?>
                <tr>
                <td><?= $subscribe->nama ?></td>
                <td>
                <?php if($subscribe->kumpulan_id == 3): ?>
                <?= $subscribe->title ?>
                <?php endif?>
                </td>
                <td>
                <?php if($subscribe->kumpulan_id == 3): ?>
                <?= ($subscribe->sub_tree == 'T')? 'YA' : 'TIDAK' ?>
                <?php endif?>
                </td>
                <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
                <td align="center">
                <?php if($profil->nokp != $this->appsess->getSessionData('username')) : ?>
                <a href="<?=base_url("profil/" . $profil->nokp . "/kump/" . $subscribe->id . "/hapus")?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
                <?php endif?>
                </td>
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