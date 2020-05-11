<head>
  <!-- style -->
  <link rel="stylesheet" href="<?=base_url()?>/css/custom.css" />
</head>

    <form id="RegisterForm" class="form-signin" action="/member/Register" method="POST">
      <div class="text-center mb-4">
        <img class="mb-4" src="/images/login.png" alt="" width="120" height="120">
        <h1 class="h3 mb-3 font-weight-normal">和泰聯網 W食堂</h1>
        <p>Register Page</p>
      </div>

      <div class="form-label-group">
        <input name="name" type="name" id="inputName" class="form-control" placeholder="Name address" required autofocus>
        <label for="inputName">Name</label>
      </div>

      <div class="form-label-group">
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
        <label for="inputEmail">Email address</label>
      </div>

      <div class="form-label-group">
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="form-label-group">
        <input name="PasswordConfirm" type="password" id="inputPasswordConfirm" class="form-control" placeholder="PasswordConfirm" required>
        <label for="inputPasswordConfirm">PasswordConfirm</label>
      </div>

      <button class="btn btn-lg btn-warning btn-block" type="button" id="SignUpBtn">Sign up</button>
      <?=$COPYRIGHTS?>
    </form>