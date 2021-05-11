<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link href="/css/custom.css" rel="stylesheet">
  <title>Fly</title>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .reservationNow {
      background: linear-gradient(65deg, #0270D7 0, #0F8AFD 100%);
      border: none;
      border-radius: 2px;
    }

    .section1 {
      background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=753&q=80');
    }

    .section2 {
      background: url('https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80');
      background-position: bottom;
    }
  </style>


</head>

<body>

  <main>
    <div class="container py-4">
      <header class="pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="#0982f4" stroke-width="1.5">
            <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
            <line x1="16" y1="8" x2="2" y2="22"></line>
            <line x1="17.5" y1="15" x2="9" y2="15"></line>
          </svg>
          <span class="fs-4 mx-2">Flyex</span>
        </a>
      </header>

      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Get hundreds of flight sites at once.
          </h1>
          <p class="col-md-8 fs-4">

            Save money on airfare by searching for cheap flight tickets on Flyex. Flyexsearches for flight deals on hundreds of airline ticket sites to help you find the cheapest flights. Whether you are looking for a last-minute flight or a cheap plane ticket for a later date, you can find the best deals faster at Flyex
          </p>
          <button class="btn btn-primary btn-lg reservationNow" type="button">Explore Now</button>
        </div>
      </div>

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <div class="section1 h-100 p-5 text-dark bg-dark rounded-3">
            <h2>You know where to go</h2>
            <p>Select an airport in the search form
            </p>
            <a href="/account/dashboard" style="background: linear-gradient(135deg,#ff690f 0%,#e8381b 100%);border: 0;" class="btn btn-outline-light text-white" type="button">Search</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="section2 h-100 p-5 bg-light  text-white border rounded-3">
            <h2>You don't know where to go</h2>
            <p>See where you can go on your budget</p>
            <a href="/account/reservation" style="background: linear-gradient(135deg,#ff690f 0%,#e8381b 100%);border: 0;" class="btn btn-outline-secondary text-white" type="button">Explore</a>
          </div>
        </div>
      </div>

      <footer class="pt-3 mt-4 text-muted border-top">
        &copy; 2021
      </footer>
    </div>
  </main>



</body>

</html>