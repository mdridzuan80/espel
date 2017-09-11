
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

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
              <h1>Reset Katalaluan</h1>
              <div>
                <input type="password" class="form-control" name="katalaluan" placeholder="katalaluan" required />
              </div>
              <div>
                <input type="password" class="form-control" name="reKatalaluan" placeholder="re-katalaluan" required />
              </div>

              <div>
                <button class="btn btn-default submit" name="reset">Reset</button>
              </div>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
