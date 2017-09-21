<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Konfigurasi Email</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="post" class="form-horizontal form-label-left" novalidate>
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nama">Nama<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtNama" required="required" class="form-control col-md-7 col-xs-12" name="txtNama" value="<?=$mail_conf->nama?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Host">Host<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtHost" required="required" class="form-control col-md-7 col-xs-12" name="txtHost" value="<?=$mail_conf->host?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Alamat e-mail<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtAlamat" required="required" class="form-control col-md-7 col-xs-12" name="txtAlamat" value="<?=$mail_conf->from?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Login<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comLogin" name="comLogin">
                            <option value="F" <?=set_select('comLogin', 'F', 'F' == $mail_conf->auth)?> >Tidak</option>
                            <option value="T" <?=set_select('comLogin', 'T', 'T' == $mail_conf->auth)?> >Ya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="input-username" <?=($mail_conf->auth == 'F') ? 'style="display:none;"' : '' ?> >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Username">Username<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtUsername" required="required" class="form-control col-md-7 col-xs-12" name="txtUsername" value="<?=$mail_conf->user?>">
                    </div>
                </div>
                <div class="form-group" id="input-password" <?=($mail_conf->auth == 'F') ? 'style="display:none;"' : '' ?>>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Password">Password<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="txtPassword" required="required" class="form-control col-md-7 col-xs-12" name="txtPassword" value="<?=$mail_conf->pass?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Alamat e-mail">Security<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="comSecurity" name="comSecurity">
                            <option value="NONE" <?=set_select('comSecurity', 'NONE', 'NONE' == $mail_conf->secure)?> >NONE</option>
                            <option value="TLS" <?=set_select('comSecurity', 'TLS', 'TLS' == $mail_conf->secure)?>>TLS</option>
                            <option value="SSL" <?=set_select('comSecurity', 'SSL', 'SSL' == $mail_conf->secure)?>>SSL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">Port<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtPort" required="required" class="form-control col-md-7 col-xs-12" name="txtPort" value="<?=$mail_conf->port?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Port">Debug<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtDebug" required="required" class="form-control col-md-7 col-xs-12" name="txtDebug" value="<?=$mail_conf->debug?>">
                    </div>
                </div>
                <?php if(!$mail_conf->status):?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="chkAktif">Aktif
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" name="chkAktif">
                            </label>
                          </div>
                    </div>
                </div>
                <?php endif?>
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
