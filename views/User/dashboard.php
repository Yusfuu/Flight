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

  <title>Dashboard</title>

</head>

<body class="d-flex text-center text-white bg-dark">

  <div class="container d-flex w-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div class=" d-flex justify-content-around">
        <h3 class="float-md-start mb-0">{{firstName}} {{lastName}}</h3>
        <input type="search" placeholder="What're you searching for ?" class="form-control w-25">
        <nav class="nav nav-masthead justify-content-center float-md-end">
          <a class="nav-link active" aria-current="page" href="/account/dashboard">Flights</a>
          <a class="nav-link" href="/account/reservation">Reservation</a>
          <div style="cursor: pointer;" class="nav-link" id="logout">Logout</div>
        </nav>
      </div>
    </header>

    <main class="px-3 my-5">
      <h1>Flights</h1>
    </main>

    <div class="album py-5 bg-dark text-white">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="main">


          <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content text-dark text-start">
                <div class="modal-header">
                  <h5 class="modal-title " id="exampleModalLabel">Reservation</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="passengers" class="form-label">Passengers</label>
                    <input max="10" min="1" value="1" type="number" class="form-control" id="passengers">
                  </div>
                  <hr>
                  <div id="passangersInfo">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-id="" id="submitPassengers">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="spinner-border text-light mx-auto" id="spinner"></div>

  </div>

</body>

<script src="/js/user/dashboard.js"></script>

</html>