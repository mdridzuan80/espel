
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tukar Peranan | ESPeL</title>

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
            <form>
              <h1>Tukar Peranan</h1>
              <div>
                <a href="<?=base_url("profil/tukar_peranan/" . $currentPeranan->row()->kump_id)?>" type="button" class="btn btn-primary" style="text-shadow: none;text-decoration:none;"><?=$currentPeranan->row()->nama?></a>
                <?php foreach($availPeranan->result() as $peranan): ?>
                <a href="<?=base_url("profil/tukar_peranan/" . $peranan->id)?>" class="btn btn-default"><?=$peranan->nama?></a>
                <?php endforeach?>
              </div>

              <div class="clearfix"></div>

            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="<?=base_url("mockup/super/dashboard")?>">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="<?=base_url("assets/js/jquery.min.js")?>"></script>

    <script type="text/javascript">
        $('.submit').click(function(){
            event.preventDefault();
            location.href = '<?=base_url()?>/'+$('.peranan').val();
        });
    </script>
  </body>
</html>
