<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
                <div class="x_title">
                      <h2>Maklumat Peruntukan</h2>
                      <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tarikh waran">Jabatan Penyelaras</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" value="<?=$info_peruntukan->jabatan->nama?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tarikh waran">Jenis Peruntukan
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" value="<?=$info_peruntukan->jns_peruntukan->nama?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tarikh waran">Jumlah Peruntukan
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" readonly="readonly" value="RM<?=number_format($objPeruntukan->peruntukan_semasa($info_peruntukan),2,'.',',')?>">
                            </div>
                        </div>
                    </form>
                </div>
          </div>
    </div>
</div>

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Transaksi Peruntukan Semasa</h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <?php if(count($sen_transaksi)):?>
        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered jambo_table">
              <thead>
                <tr class="headings">
                  <th>Tarikh</th>
                  <th>Waran</th>
                  <th>Jumlah (RM)</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach($sen_transaksi as $transaksi):?>
                <tr>
                  <td><?=date("d M Y",strtotime($transaksi->tarikh))?></td>
                  <td><?=$transaksi->no_waran?></td>
                  <td>RM<?=number_format($transaksi->jumlah,2,'.',',')?></td>
                </tr>
                <?php endforeach?>
               </tbody>
            </table>
          </div>
        </div>
        <?php else:?>
        <div class="alert alert-warning " role="warning">
          <strong>INFO!</strong> Tiada rekod
        </div>
        <?php endif?>
    </div>
  </div>
</div>
</div>
