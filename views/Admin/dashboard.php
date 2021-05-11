<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/custom.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="/css/admin/dashboard.css">
  <title>Dashboard</title>

</head>

<body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">{{name}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <div style="cursor: pointer;" class="nav-link" id="logout">Sign out</div>
      </li>
    </ul>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">

            <li class="nav-item">
              <a class="nav-link active" href="/a/account/dashboard">
                <span data-feather="layers"></span>
                Flights
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/a/account/reservation">
                <span data-feather="bar-chart-2"></span>
                Reservations
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Flights</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button id="plusCircle" data-bs-toggle="modal" data-bs-target="#Modal" class="btn btn-sm btn-outline-secondary">
                <span data-feather="plus-circle"></span>
              </button>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row justify-content-center justify-content-around mb-4" id="flights">
          </div>
        </div>


      </main>
    </div>
  </div>

  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Flight Type</label>
            <select id="type" style="cursor: pointer;" class="form-select">
              <option selected>One way</option>
              <option>Round trip</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="origin" class="form-label">Where from ?</label>
            <input type="text" class="form-control" id="origin">
            <div style="display: none;" class="form-text">some errors</div>
          </div>

          <div class="mb-3">
            <label for="destination" class="form-label">Where to ?</label>
            <input type="text" class="form-control" id="destination">
          </div>

          <div class="mb-3">
            <label for="destination" class="form-label">Departing</label>
            <input type="date" class="form-control" id="departing">
          </div>

          <div class="mb-3 d-none" id="returningDate">
            <label for="destination" class="form-label">Returning</label>
            <input type="date" class="form-control" id="returning">
          </div>


          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price">
          </div>

          <div class="mb-3">
            <label for="seats" class="form-label">Seats</label>
            <input type="text" class="form-control" id="seats">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addFlight" data-bs-dismiss="modal">Save</button>
          <button type="button" class="btn btn-primary" data-id="" id="editeFlight" data-bs-dismiss="modal">Save Edite</button>
        </div>
      </div>
    </div>
  </div>


</body>
<script src="/js/admin/dashboard.js"></script>

</html>