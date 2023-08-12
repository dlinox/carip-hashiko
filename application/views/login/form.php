<div class="login-box">
 
  <!-- /.login-logo -->
  <div class="card card-outline card-purple">

    <div class="card-header text-center">
      <h2><a href="<?= base_url(); ?>" class="text-purple text-uppercase">Hashiko </a></h2>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese para iniciar sesion</p>

      <form action="<?php echo base_url() ?>login/verificar_login" method="POST">
        <?php if (isset($_GET["t"])) : ?>
          <div class="callout callout-danger">
            <p class="text-danger"><?= $_GET["t"] ?></p>
          </div>
        <?php endif; ?>

        <div class="input-group mb-3">
          <input name="user" type="text" class="form-control" placeholder="Usuario" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
         
          <?php
          if (isset($_COOKIE["captcha_count"])) :
            if ($_COOKIE["captcha_count"] > 3) :
          ?>
              <div class="text-center">
                <?php echo $cap['image']; ?>
              </div>
              <div class="form-group">
                <label for="login-capcha">Capcha</label>
                <input type="text" placeholder="captcha" name="captcha" class="form-control" id="login-captcha">
              </div>
          <?php
            endif;
          endif;
          ?>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn bg-purple btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <!--<p class="mb-1">
        <a href="#">Olvide mi Contraseña</a>
      </p-->
      <p class="mt-4 text-center">
        <a href="#" class="text-center text-purple">Registrar nuevo usuario</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>