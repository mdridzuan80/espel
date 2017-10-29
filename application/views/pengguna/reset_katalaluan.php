<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Reset Katalaluan Pengguna <?= $profil->nama . ' (' . $profil->nokp . ')' ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php if(appsess()->getFlashSession()):?>
                    <?php if(appsess()->getFlashSession('success')):?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>INFO!</strong> Reset katalaluan telah berjaya.
                    </div>
                    <?php else:?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>RALAT!</strong> Reset katalaluan tidak berjaya.
                    </div>
                    <?php endif?>
                <?php endif?>
                    <form method="post" class="form-horizontal form-label-left">
                        <?php $csrf = [
                            'name' => $this->security->get_csrf_token_name(),
                            'hash' => $this->security->get_csrf_hash()
                        ];?>
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="Nama">Katalaluan Baru<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="txtKatalaluan" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtKatalaluan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="Nama">Re-Katalaluan Baru<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" id="txtReKatalaluan" required="required" class="form-control col-md-7 col-xs-12 input-sm" name="txtReKatalaluan">
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
