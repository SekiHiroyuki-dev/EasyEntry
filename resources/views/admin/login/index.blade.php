<html lang="ja">
  <head>
    <base href="./">
    <meta name="robots" content="noindex,nofollow,noarchive">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>
        @if (View::hasSection('title'))
            @yield('title')
            |
        @endif
        {{ config('app.name', 'ITSUMEN') }}
    </title>
    <!-- Icons-->
    <link rel="icon" type="image/ico" href="{{ app_asset('/favicon.ico') }}" sizes="any" />
    <link href="{{ app_asset('/coreui/node_modules/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ app_asset('/coreui/node_modules/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ app_asset('/coreui/node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ app_asset('/coreui/node_modules/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ app_asset('/coreui/src/css/style.css') }}" rel="stylesheet">
    <link href="{{ app_asset('/coreui/src/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <style>
    .h4 {
        font-family: 'Noto Sans', sans-serif;
    }
    .h4 img {
        max-width: 30px;
    }
    </style>
  </head>

  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-6">
            <img src="{{ app_asset('/img/itsumen_logo.png') }}" class="img-fluid mx-auto mb-2 d-block">
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-sm-6">

          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <?php if (session()->has("status")) {  ?>
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading">エラー</h5>
                        <?php echo \e(session('status')); ?>
                    </div>
                <?php } ?>

                <?php if (count($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading">エラー</h5>
                        <ul class="m-0">
                            <?php foreach ($errors->all() as $error) { ?>
                                <li><?php echo $error; ?> </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>


                <h1>管理画面 ログイン</h1>

                <form action="{{ url('/admin/login') }}" method="post">
                    <?php echo csrf_field()?>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-envelope"></i>
                        </span>
                      </div><!-- /input-group-prepend -->
                      <input class="form-control" name="id" type="text" value="{{ old('id') }}" placeholder="Email">
                    </div><!-- /input-group mb-3 -->
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="icon-lock"></i>
                        </span>
                      </div><!-- /input-group-prepend -->
                      <input class="form-control" name="password" type="password" placeholder="Password">
                    </div><!-- /input-group mb-4 -->
                    <div class="row">
                      <div class="col-sm-6">
                        <p class="mb-0 text-muted">
                            <small> 推奨ブラウザ:</small><span class="h4"> <img src="{{ app_asset('/img/chrome_icon.svg') }}"> Chrome</span>
                        </p>
                      </div>

                      <div class="col-sm-6 text-right">
                        <button class="btn btn-primary px-4" type="submit">Login</button>
                      </div>
                    </div><!-- /row -->
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ app_asset('/coreui/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/pace-progress/pace.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/@coreui/coreui/dist/js/coreui.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ app_asset('/coreui/node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}"></script>
    <script src="{{ app_asset('/coreui/src/js/main.js') }}"></script>
  </body>
</html>
