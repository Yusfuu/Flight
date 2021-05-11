<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="/css/user/access.css">

  <title>Login</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading" style="font-weight: 500;">Sign in</h3>
                <p class="text-muted mb-3 fw-normal" style="font-size: .9rem;">
                  New user? <a href="/account/signup" style="color: #1473e6;">Create an account</a>.
                </p>
                <div>
                  <div class="form-label-group">
                    <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
                    <label for="email">Email address</label>
                    <div class="error form-text"></div>
                  </div>

                  <div class="form-label-group">
                    <input type="password" id="password" class="form-control" placeholder="Password" required>
                    <label for="password">Password</label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block btn-login" id="submit" type="submit">
                    <div class="loader">
                    </div>
                    <span>Sign in</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="/js/user/signin.js"></script>

</html>