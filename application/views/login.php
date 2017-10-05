
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Espel | Jabatan Kesihatan Negeri Melaka</title>

    <!-- Bootstrap -->
    <link href="<?=base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url("assets/css/font-awesome.min.css")?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url("assets/css/nprogress.css")?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?=base_url("assets/css/animate.min.css")?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url("assets/css/custom.min.css")?>" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>


      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
              <img src="<?=base_url("assets/images/jknmelaka-logo-x.png")?>"/>
            <form method="POST">
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
              <h1>E-SPeL JKNM</h1>
              <div>
                <input type="text" class="form-control input-sm" name="username" placeholder="Username" required />
              </div>
              <div>
                <input type="password" class="form-control input-sm" name="password" placeholder="Password" required />
              </div>

              <div>
                <button class="btn btn-default submit input-sm" name="login">Log in</button>
              </div>

              <div class="clearfix"></div>
              <?php if(appsess()->getFlashSession()):?>
                <?php if(!appsess()->getFlashSession('success')):?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong>RALAT!</strong> Kombinasi id pengguna dan katalaluan tidak sah!
                </div>
                <?php endif?>
              <?php endif?>
            <div class="separator">
                <p class="change_link">
                  <a href="#signup" class="to_register">Lupa katalauan</a>
                </p>

                <div class="clearfix"></div>
                <br />
                <!-- <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
              </div> -->
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
              <img src="<?=base_url("assets/images/jknmelaka-logo-x.png")?>"/>
            <form method="post" action="<?=base_url("lupa_katalaluan")?>">
                <?php $csrf = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                    ];
                ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
              <h1>Reset Katalaluan</h1>
              <div>
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
                <input type="text" class="form-control" placeholder="Username" required="" name="txtUsername" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" name="reset-password" >Reset Katalaluan</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Kembali semula
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--
                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
            -->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
