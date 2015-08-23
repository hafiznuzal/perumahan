 <div class="container">

      <img style="margin-top:10px;margin-right:auto; margin-left:auto; display:block;"  src="<?php  echo site_url()?>assets/img/sidoarjo.png">
      
      <?php if($loginStat=='failed'){?>
          <div id="addSuccess" class="alert alert-danger"style="margin-top: 25px;margin-left: 100px;margin-right: 100px;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Login Gagal!</strong> Username dan Password salah
          </div>
      <?php } ?>
      <form class="form-signin"id="formlogin" method="POST" action="<?php echo site_url();?>/c_verifylogin">
        <h2 class="form-signin-heading" style="text-align:center;">Silahkan Login </h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="username"id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <input type="hidden" id="tahunLg" name="tahunLg">
        <input type="hidden" id="periodeLg" name="periodeLg">
        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> -->
        <button class="btn btn-lg btn-primary btn-block" id="submitLogin"type="submit">Log in</button>
      </form>

    </div> <!-- /container -->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#formlogin").submit(function(){
          $("#tahunLg").val($("#tahun").val());
          $("#periodeLg").val($("#periode").val());

        });          

      });
    </script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>