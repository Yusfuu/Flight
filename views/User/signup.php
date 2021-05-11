<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="/css/user/access.css">
  <title>Create an account</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row no-gutter" style="flex-direction: row-reverse;">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading" style="font-weight: 500;">Create an account</h3>
                <p class="text-muted mb-3 fw-normal" style="font-size: .9rem;">
                  Already have an account? <a href="/account/signin" style="color: #1473e6;">Sign in</a>.
                </p>
                <div>

                  <div class="form-label-group">
                    <input type="email" class="form-control" id="email" placeholder="Email address" required autofocus>
                    <label for="email">Email</label>
                  </div>

                  <div class="form-label-group">
                    <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
                    <label for="firstName">First name</label>
                  </div>

                  <div class="form-label-group">
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                    <label for="lastName">Last name</label>
                  </div>



                  <div class="form-label-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                  </div>

                  <div class="form-label-group">
                    <button class="btn btn-lg btn-primary btn-block btn-login" id="submit">
                      <div class="loader">
                      </div>
                      <span>
                        Create
                        an account
                      </span>
                    </button>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="/js/user/signup.js"></script>

</html>