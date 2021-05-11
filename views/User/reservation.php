<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="/css/user/dashboard.css">

  <title>Reservation</title>

</head>

<body class="d-flex text-center text-white bg-dark">

  <div class="container d-flex w-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <h3 class="float-md-start mb-0">{{firstName}} {{lastName}}</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link" aria-current="page" href="/account/dashboard">Flights</a>
          <a class="nav-link active" href="/account/reservation">Reservation</a>
          <div style="cursor: pointer;" class="nav-link" id="logout">Logout</div>
        </nav>
      </div>
    </header>

    <main class="px-3 my-5">
      <h1>Reservation</h1>
    </main>

    <div class="album py-5 bg-dark text-white">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-around" id="main">

        </div>
      </div>
    </div>




    <footer class="mt-auto text-white-50">
      <p>Flight is Flight</p>
    </footer>
  </div>

</body>

<script src="/js/user/reservation.js"></script>

</html>