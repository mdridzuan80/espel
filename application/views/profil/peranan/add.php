<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Peranan</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Peranan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="comPeranan" class="select2_single form-control" name="comPeranan">
                            <?php foreach($senPeranan as $peranan):?>
                            <option value="<?=$peranan->id?>"><?=$peranan->nama?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div id="jabatan-penyelaras" class="form-group" style="display:none;">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="comJabatanPenyelaras" name="comPenganjur" class="easyui-combotree form-control col-md-7 col-xs-12" data-options="url:'<?=base_url("welcome/get_tree_jabatan")?>',method:'get'">
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
