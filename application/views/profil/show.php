<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Profil <span style="text-transform: capitalize;"><?=$profil->nama?></span></h2>
            <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
            <!--<a href="<?=base_url("mockup/admin/pengguna/add")?>" class="btn btn-info pull-right" role="button">Tambah Pengguna</a>-->
            <?php endif?>
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
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Profil</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Kumpulan</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">

                      <h3><?=$profil->nama?></h3>
                      <h4><?=$profil->nokp?></h4>
                      <ul class="list-unstyled user_data">
                          <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> <?=$profil->jawatan->perihal?>, Gred <?=$profil->gred->kod?>
                          </li>
                          <li>
                            <i class="fa fa-map-marker user-profile-icon"></i> <?=$profil->jabatan->nama?>
                          </li>
                        <li>
                          <i class="fa fa-users user-profile-icon"></i>
                          <?=$profil->email?>
                        </li>
                        <li>
                          <i class="fa fa-bookmark user-profile-icon"></i>
                            <?=$profil->email?>
                        </li>
                      </ul>
                      <br />
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Log Aktiviti Terkini <small>Sessions</small></h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="dashboard-widget-content">

                            <ul class="list-unstyled timeline widget">
                              <li>
                                <div class="block">
                                  <div class="block_content">
                                    <h2 class="title">
                                                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                  </h2>
                                    <div class="byline">
                                      <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="block">
                                  <div class="block_content">
                                    <h2 class="title">
                                                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                  </h2>
                                    <div class="byline">
                                      <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="block">
                                  <div class="block_content">
                                    <h2 class="title">
                                                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                  </h2>
                                    <div class="byline">
                                      <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div class="block">
                                  <div class="block_content">
                                    <h2 class="title">
                                                      <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                                  </h2>
                                    <div class="byline">
                                      <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                  </div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="x_title">
                      <h2>Senarai Kumpulan</h2>
                        <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
                        <a href="<?=base_url("profil/" . $profil->nokp . "/kump/add")?>" class="btn btn-primary pull-right" role="button">Tambah Kumpulan</a>
                        <?php endif?>
                      <div class="clearfix"></div>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered jambo_table">
                      <thead>
                        <tr class="headings">
                            <th>Kumpulan</th>
                            <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
                            <th style="text-align:center">Operasi</th>
                            <?php endif?>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach($profil->kumpulan_profil as $kumpulan):?>
                        <tr>
                            <?php
                            $jabatan = jabatan()->get($kumpulan->jabatan_id);
                            if($jabatan){ $jabatan = "(" . $jabatan->nama . ")";}
                            ?>
                          <td><?=$kumpulan->kumpulan->nama . " " . $jabatan?></td>
                          <?php if($this->appauth->hasPeranan($this->appsess->getSessionData("username"),['SUPER','ADMIN'])):?>
                          <td align="center">
                              <a href="<?=base_url("profil/" . $profil->nokp . "/kump/" . $kumpulan->id . "/hapus")?>" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Hapus" onclick="return confirm('Anda pasti untuk menghapuskan maklumat ini?')"><i class="fa fa-eraser"></i></a>
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
      </div>
    </div>
  </div>
</div>
