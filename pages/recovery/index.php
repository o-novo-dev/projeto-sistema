    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth">
      <!-- form -->
      <form class="auth-form auth-form-reflow">
        <div class="text-center mb-4">
          <div class="mb-4">
            <img class="rounded" src="<?= ASSETS_URL ?>/assets/apple-touch-icon.png" alt="" height="72">
          </div>
          <h1 class="h3"> Reset Your Password </h1>
        </div>
        <p class="mb-4"> Tempora iusto officia magnam fugiat sequi aliquam cum consectetur aperiam beatae, rerum obcaecati ea. </p><!-- .form-group -->
        <div class="form-group mb-4">
          <label class="d-block text-left" for="inputUser">Username</label> <input type="text" id="inputUser" class="form-control form-control-lg" required="" autofocus="">
          <p class="text-muted">
            <small>We'll send password reset link to your email.</small>
          </p>
        </div><!-- /.form-group -->
        <!-- actions -->
        <div class="d-block d-md-inline-block mb-2">
          <button class="btn btn-lg btn-block btn-primary" type="submit">Reset Password</button>
        </div>
        <div class="d-block d-md-inline-block">
          <a href="auth-signin-v1.html" class="btn btn-block btn-light">Return to signin</a>
        </div>
      </form><!-- /.auth-form -->
      <footer class="auth-footer mt-5"> © 2018 All Rights Reserved. Loper is Responsive Admin Theme build on top of latest Bootstrap 4. <a href="#">Privacy</a> and <a href="#">Terms</a>
      </footer>
    </main><!-- /.auth -->