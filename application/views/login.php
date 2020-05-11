<head>
  <!-- style -->
  <link rel="stylesheet" href="<?=base_url()?>/css/custom.css" />
</head>

    <?php if($WRONG === TRUE) { ?>
      <div class="m-3 fixed-top alert alert-warning alert-dismissible fade show" role="alert" style="max-width:420px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>Jesus !</strong> You should check in on some of those fields below.
      </div>
    <?php } // endif ?>

     <form id="LoginForm" class="form-signin" method="POST" action="/member/login">
      <div class="text-center mb-4">
        <img class="mb-4" src="/images/login.png" alt="" width="200" height="200">
        <h1 class="h3 mb-3 font-weight-normal">Web 食堂</h1>
      </div>

      <div class="form-label-group">
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" 
          value="<?=(get_cookie('rememberme') !== null) ? get_cookie('rememberme') : '' ; ?>"
        required autofocus>
        <label for="inputEmail">Email address</label>
      </div>

      <div class="form-label-group">
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="rememberme" value="1" <?=(get_cookie('rememberme') !== NULL) ? 'checked' : '' ; ?>> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" id="LoginBtn">Login</button>
      <button class="btn btn-lg btn-warning btn-block" type="button" id="RegisterBtn">Register</button>
      <?=$COPYRIGHTS?>
    </form>