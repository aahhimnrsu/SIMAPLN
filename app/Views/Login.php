<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIMAPLN</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url('assets/css/app.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/bundles/bootstrap-social/bootstrap-social.css') ?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
  <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/img/icon.png') ?>" />
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header d-flex justify-content-center align-items-center">
                <img src="<?= base_url('assets/img/logo.png') ?>" style="width: 40px; margin-right: 10px;">
                <h4>SIMAPLN</h4>
              </div>
              <div class="card-body">
                <div class="text-center font-weight-bold mb-2">
                  Scan QR Code Anda
                </div>
                <video id="preview" width="100%" playsinline></video>
                <form method="POST" action="<?= base_url('prosesqrcode') ?>" class="needs-validation" novalidate="">
                  <input type="text" name="id" id="text" readonly="" placeholder="Username" class="form-control" hidden>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" hidden>
                      Masuk
                    </button>
                    <a href="<?= base_url('/login')?>" class="btn btn-info btn-lg btn-block mt-3">Masuk Dengan Username</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        alert('No cameras found');
      }

    }).catch(function(e) {
      console.error(e);
    });

    scanner.addListener('scan', function(c) {
      document.getElementById('text').value = c;
      document.forms[0].submit();
    });
  </script>
  <!-- General JS Scripts -->
  <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
  <!-- Custom JS File -->
  <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>