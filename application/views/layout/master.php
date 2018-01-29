
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
    <link rel="stylesheet" href="<?=base_url("assets/css/bootstrap-timepicker.min.css")?>"> 

    <!-- Custom Theme Style -->
    <link href="<?=base_url("assets/css/custom.min.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

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

            <br />

            <?php $this->load->view($sidemenu,['filterMenu'=>$filterMenu]);?>
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
                    <?=$login_profil->nama?> (<span style="color:blue;"><?=auth()->peranan_desc(appsess()->getSessionData("kumpulan"))?></span>)
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a id="linkProfil" data-username="<?= $login_profil->nokp ?>"> Profil Pengguna</a></li>
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
                    <?php if($peranan->kumpulan->kod <> appsess()->getSessionData('kumpulan') || $peranan->jabatan_id != appsess()->getSessionData("ptj_jabatan_id")) : ?>
                    <li><a href="<?=base_url('profil/tukar_peranan/'.$peranan->kumpulan->kod."/".$peranan->jabatan_id)?>" title="<?= get_jabatan($peranan->jabatan_id)->title ?>"><?= $peranan->kumpulan->nama ?></a></li>
                    <?php endif ?>
                    <?php endforeach?>
                    <li class="divider"></li>
                    <?php endif?>
                    <li><a id="linkResetKatalaluan" data-username="<?= appsess()->getSessionData("username") ?>">Reset katalaluan</a></li>
                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
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

    <!-- Modal -->
      <div id="myGlobalModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myLargeGlobalModalLabel">...</h4>
            </div>
            <div class="modal-body">
              <p>...</p>
            </div>
          </div>
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
    $(".easyui-combotree").css("width", $(".col-md-6").width()-9);

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
    <script src="<?=base_url("assets/js/jquery.actual.min.js")?>"></script>
    <script src="<?=base_url("assets/js/bootstrap-timepicker.min.js")?>"></script>
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
