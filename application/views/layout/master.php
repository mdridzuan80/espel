
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem eSPeL</title>

    <!-- Bootstrap -->
    <link href="<?=base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url("assets/css/font-awesome.min.css")?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url("assets/css/nprogress.css")?>" rel="stylesheet">
    <!-- Datatable -->
    <link href="<?=base_url("assets/js/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/js/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/js/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/js/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/js/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/pengurusan.css")?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/css/custom.min.css')?>" rel="stylesheet">

    <!-- easyui -->
    <link href="<?=base_url("assets/css/easyui.css")?>" rel="stylesheet">

    <?php
    if(isset($plugins) && count($plugins))
    {
        if(isset($plugins["css"]))
        {
            foreach($plugins["css"] as $plugin)
            {
                echo '<link href="' . base_url($plugin) . '" rel="stylesheet">';
            }
        }
    }
    ?>

    <!-- Custom Theme Style -->
    <link href="<?=base_url("assets/css/custom.min.css")?>" rel="stylesheet">
  </head>

  <body class="nav-md menu_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url()?>" class="site_title"><img src="<?=base_url("assets/images/jknmelaka-logo-x.png")?>" width="64" height="64"/> <span>eSPeL</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!-- <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url("assets/images/img.jpg")?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
          </div> -->
            <!-- /menu profile quick info -->

            <br />

            <?php $this->load->view($sidemenu);?>

            <!-- /menu footer buttons -->
            <!--
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
        -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="<?=base_url("assets/images/img.jpg")?>" alt=""> --><?=$login_profil->nama?> (<span style="color:blue;"><?=auth()->peranan_desc(appsess()->getSessionData("kumpulan"))?></span>)
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?=base_url('profil/' . $login_profil->nokp)?>"> Profil Pengguna</a></li>
                    <!--
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                  </li> -->
                    <!-- <li><a href="javascript:;">Help</a></li> -->
                    <?php if(count($availPeranan)):?>
                    <li class="divider"></li>
                    <?php endif ?>

                    <?php if(appsess()->getSessionData('kumpulan') != appauth::PENGGUNA) : ?>
                      <?php if(appsess()->getSessionData('username') != 'admin') : ?>
                      <li><a href="<?=base_url('profil/tukar_peranan/' . appauth::PENGGUNA)?>">Pengguna</a></li>
                      <?php endif ?>
                    <?php endif ?>
                    <?php if(count($availPeranan)):?>
                    <?php foreach($availPeranan as $peranan):?>
                    <?php if($peranan->kumpulan->kod <> appsess()->getSessionData('kumpulan')) : ?>
                    <li><a href="<?=base_url('profil/tukar_peranan/' . $peranan->kumpulan->kod)?>"><?=$peranan->kumpulan->nama?></a></li>
                    <?php endif ?>
                    <?php endforeach?>
                    <li class="divider"></li>
                    <?php endif?>
                    <li><a href="<?=base_url("profil/".appsess()->getSessionData("username")."/reset_katalaluan")?>">Reset katalaluan</a></li>
                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="<?=base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?=base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?=base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?=base_url("assets/images/img.jpg")?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
              </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php $this->load->view($pageContent)?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            eSPeL - Jabatan Kesihatan Negeri Melaka</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url("assets/js/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/js/jquery-ajax-native.js")?>"></script>
    
    <!-- Bootstrap -->
    <script src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>

    <script>
    var base_url = "<?=base_url()?>";
    var csrf_name = "<?= $this->security->get_csrf_token_name() ?>"
    var csrf_token = "<?= $this->security->get_csrf_hash() ?>"
    $(".easyui-combotree").css("width", $(".col-md-6").width()-5);
    </script>
    <!-- FastClick -->
    <script src="<?=base_url("assets/js/fastclick.js")?>"></script>
    <!-- NProgress -->
    <script src="<?=base_url("assets/js/nprogress.js")?>"></script>
    <!-- Datatables -->
    <script src="<?=base_url("assets/js/vendors/datatables.net/js/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-buttons/js/buttons.flash.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-buttons/js/buttons.html5.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-buttons/js/buttons.print.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/datatables.net-scroller/js/dataTables.scroller.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/jszip/dist/jszip.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/pdfmake/build/pdfmake.min.js")?>"></script>
    <script src="<?=base_url("assets/js/vendors/pdfmake/build/vfs_fonts.js")?>"></script>

    <!-- easyui -->
    <script src="<?=base_url("assets/js/jquery.easyui.min.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.min.js" integrity="sha256-hhRjXZ7KoeIPcBloYVc0fvx6RQVcSEKsNJcGEu1nn78=" crossorigin="anonymous"></script>

    <?php
    if(isset($plugins) && count($plugins))
    {
        if(isset($plugins["js"]))
        {
            foreach($plugins["js"] as $plugin)
            {
                echo "<script src=\"" . base_url($plugin) . "\"></script>";
            }
        }
    }
    ?>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url("assets/js/custom.min.js")?>"></script>
    <script src="<?=base_url("assets/js/espel.js")?>"></script>
    <?php
    if(isset($plugins) && count($plugins))
    {
        if(isset($plugins["embedjs"]))
        {
            foreach($plugins["embedjs"] as $plugin)
            {
                echo $plugin;
            }
        }
    }
    ?>
    </body>
</html>
