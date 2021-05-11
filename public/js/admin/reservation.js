const reservation = document.querySelector('#reservation');
const logout = document.querySelector('#logout');


initReservation();


async function initReservation() {
  const resposne = await fetch('http://localhost:8080/api/reservation');
  const { body } = await resposne.json();
  body.forEach(_r => reservation.insertAdjacentHTML('afterbegin', card(_r)));
  feather.replace();
}

function card(params) {
  const { type, origin, destination, departing, returning, price, seats, firstName, lastName } = params;
  return `<div class='card mt-4' style='width: 18rem;'>
  <div class='card-body'>
    <h6 class='card-title'>${firstName} ${lastName}</h6>
    <ul class='list-group  mt-3'>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Type :</span> ${type}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Origin :</span> ${origin}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Destination :</span> ${destination}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Price :</span> ${price} MAD</li>
    </ul>
  </div>
  <div class='card-body'>
    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">View</button>
    <ul class="dropdown-menu dropdown-menu-dark" style="cursor: pointer;">
      <li class="dropdown-item d-flex justify-content-around align-items-center"><span data-feather="calendar"></span> ${departing}</li>
      <li class="dropdown-item d-flex justify-content-around align-items-center ${returning == 'null' && 'd-none'}"><span data-feather="calendar"></span> ${returning}</li>
    </ul>
  </div>
</div>`;
}


logout.onclick = () => {
  const user = {
    logout: true
  }
  postData('http://localhost:8080/a/account/logout', user);
}

async function postData(url, data) {
  const resposne = await fetch(url, config(data));
  const body = await resposne.json();
  if (body.error === false) {
    return location.href = 'http://localhost:8080/a/account/signin';
  }
}

function config(data) {
  return {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  }
}