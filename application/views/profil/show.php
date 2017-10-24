<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Profil <span style="text-transform: capitalize;"><?=$profil->nama?></span></h2>
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
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <div class="col-md-4 col-sm-4 col-xs-12 profile_left">

                      <h3><?=$profil->nama?></h3>
                      <h4><?=$profil->nokp?></h4>
                      <?php if($profil->nokp != 'admin') : ?>
                      <ul class="list-unstyled user_data">
                          <li>
                            <?php $skim_keterangan = $skim->get_by('kod',$profil->skim_id); ?>
                            <i class="fa fa-briefcase user-profile-icon"></i> <?= ($skim_keterangan) ? $skim_keterangan->keterangan : '-' ?>, Gred <?= $profil->gred_id ?>
                          </li>
                          <li>
                            <?php $jabatan_keterangan = $jabatan->get_by('buid',$profil->jabatan_id); ?>
                            <i class="fa fa-map-marker user-profile-icon"></i> <?= ($jabatan_keterangan) ? $jabatan_keterangan->title : '-' ?>
                          </li>
                        <li>
                          <i class="fa fa-users user-profile-icon"></i>
                          <?php $ppp = $mprofil->profil->get_by('nokp', $profil->nokp_ppp); ?>
                          <?= $ppp->nama ?> (<?= $ppp->nokp ?>)
                        </li>
                        <li>
                          <i class="fa fa-users user-profile-icon"></i>
                          <?php $ppk = $mprofil->profil->get_by('nokp', $profil->nokp_ppk); ?>
                          <?= $ppk->nama ?> (<?= $ppk->nokp ?>)
                        </li>
                        <li>
                          <i class="fa fa-bookmark user-profile-icon"></i>
                            <?=$profil->email?>
                        </li>
                      </ul>
                      <?php endif ?>
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
                              <?php foreach($sen_log as $logs) :?>
                              <li>
                                <div class="block">
                                  <div class="block_content">
                                    <h2 class="title">
                                                      <a><?= $logs->event ?></a>
                                                  </h2>
                                    <div class="byline">
                                      <span><?= $logs->date ?></span> by <a><?= $logs->nokp ?></a>
                                    </div>
                                    <?php if($logs->sql) : ?>
                                    <p class="excerpt">
                                      <?= $logs->sql ?>
                                    </p>
                                    <?php endif ?>
                                  </div>
                                </div>
                              </li>
                              <?php endforeach ?>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
