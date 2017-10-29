<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pengecualian Kelayakan Kursus <?= $profil->nama . ' (' . $profil->nokp . ')' ?></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form method="post" class="form-horizontal form-label-left">
                    <?php $csrf = [
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                        ];
                    ?>
                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarikh Mula</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control input-sm" id="txtTkhMulaKecuali" name="txtTkhMulaKecuali" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarikh Tamat</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control input-sm" id="txtTkhTamatKecuali" name="txtTkhTamatKecuali" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Catatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" class="form-control input-sm" id="txtCatatan" name="txtCatatan" required></textarea>
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

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Senarai pengecualian kelayakan kursus</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Mula</th>
                            <th>Tamat</th>
                            <th>Catatan</th>
                            <th style="text-align:center">Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sen_kecuali as $kecuali):?>
                            <tr>
                            <td><?= date('d-M-Y', strtotime($kecuali->mula)) ?></td>
                            <td><?= date('d-M-Y', strtotime($kecuali->tamat)) ?></td>
                            <td><?= $kecuali->catatan ?></td>
                               <td align="center">
                                <a href="<?=base_url("profil/" . $kecuali->nokp . "/kecuali/" . $kecuali->id . "/hapus")?>" class="btn btn-round btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
                                </td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

