
    <!-- BEGIN BASE JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?= ASSETS_URL ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?= ASSETS_URL ?>/assets/vendor/aos/aos.js"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?= ASSETS_URL ?>/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/r-2.3.0/datatables.min.js"></script> -->

    <?php
      foreach ($this->arrJS as $key => $value) {
        echo "<script src=".ASSETS_URL."/assets/javascript/view/{$value}></script>";
      }
    ?>
  </body>
</html>