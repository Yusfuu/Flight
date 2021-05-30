feather.replace();

initFlights();

function query(_) {
  return document.querySelector(_);
}

const logout = query('#logout');
const addFlight = query('#addFlight');
const seats = query('#seats');
const price = query('#price');
const destination = query('#destination');
const origin = query('#origin');
const type = query('#type');
const flights = query('#flights');
const plusCircle = query('#plusCircle');
const returning = query('#returning');
const departing = query('#departing');
const returningDate = query('#returningDate');

type.onchange = () => {
  if (type.value === 'One way') {
    returningDate.classList.add('d-none');
  } else {
    returningDate.classList.remove('d-none');
  }
}

function flightInputs(_type = 'One way', _origin = '', _destination = '', _departing = '', _returning = '', _price = '', _seats = '') {
  type.value = _type;
  origin.value = _origin;
  destination.value = _destination;
  departing.value = _departing;
  returning.value = _returning;
  price.value = _price;
  seats.value = _seats;
  _type === 'One way' ? returningDate.classList.add('d-none') : returningDate.classList.remove('d-none');
}

plusCircle.onclick = () => {
  editeFlight.style.display = "none";
  addFlight.style.display = "";
  flightInputs();
}

editeFlight.onclick = async () => {
  const id = editeFlight.dataset.id;
  const flight = {
    id,
    type: type.value,
    origin: origin.value,
    destination: destination.value,
    departing: departing.value,
    returning: type.value === 'One way' ? 'null' : returning.value,
    price: price.value,
    seats: seats.value,
  }

  const response = await fetch('http://localhost:8080/api/flights/edite', config(flight));
  const data = await response.json();

  if (data.error === false) {
    let card = query(`[data-fid="${id}"]`);

    card.children[1].dataset.flight = JSON.stringify({
      id,
      type: type.value,
      origin: origin.value,
      destination: destination.value,
      departing: departing.value,
      returning: returning.value,
      price: price.value,
      seats: seats.value,
    });

    card.children[0].innerHTML = `<h6 class="card-title">${flight.type}</h6>
             <span class="card-subtitle mb-2 text-muted">${flight.seats} Seats</span>
             <ul class="list-group  mt-3">
               <li class="list-group-item"><span class="card-subtitle text-muted fw-bold">Origin :</span> ${flight.origin}</li>
               <li class="list-group-item"><span class="card-subtitle text-muted fw-bold">Destination :</span> ${flight.destination}</li>
               <li class="list-group-item"><span class="card-subtitle text-muted fw-bold">Price :</span> ${flight.price} MAD</li>
             </ul>`;

    card.children[1].children[3].innerHTML = `<li class="dropdown-item"><span class="fw-bold">Departing:</span> ${flight.departing}</li>
  <li class="dropdown-item ${flight.returning == 'null' && 'd-none'}"><span class="fw-bold">Returning:</span> ${flight.returning}</li>`;
    sweetAlert('success', data.message);
  } else {
    sweetAlert('error', data.message);
  }

}


addFlight.onclick = async () => {

  const flight = {
    type: type.value,
    origin: origin.value,
    destination: destination.value,
    price: price.value,
    seats: seats.value,
    departing: departing.value,
    returning: returning.value || 'null'
  }

  const response = await fetch('http://localhost:8080/api/flights/add', config(flight));
  const data = await response.json();

  if (data.error === false) {
    flight.id = data.id;
    flights.insertAdjacentHTML('afterbegin', card(flight));
    sweetAlert('success', data.message);
  } else {
    sweetAlert('error', data.message);
  }

}


logout.onclick = () => {
  const user = {
    logout: true
  }
  postData('http://localhost:8080/a/account/logout', user);
}



async function initFlights() {
  const resposne = await fetch('http://localhost:8080/api/flights');
  const { body } = await resposne.json();
  boxs = [...body]
  body.forEach(_f => flights.insertAdjacentHTML('afterbegin', card(_f)));
}

async function postData(url, data) {
  const resposne = await fetch(url, config(data));
  const body = await resposne.json();
  if (body.error === false) {
    return location.href = 'http://localhost:8080/a/account/signin';
  }
}

async function _edite(button) {
  const { id, type, origin, destination, seats, price, departing, returning } = JSON.parse(button.parentElement.dataset.flight);
  editeFlight.dataset.id = id;

  flightInputs(type, origin, destination, departing, returning, price, seats);
  editeFlight.style.display = "";
  addFlight.style.display = "none";
}


async function _delete(button) {
  const { id } = JSON.parse(button.parentElement.dataset.flight);
  const resposne = await fetch('http://localhost:8080/api/flights/delete', config({ id }));
  const data = await resposne.json();
  if (data.error === false) {
    button.parentNode.parentNode.remove();
    sweetAlert('success', data.message);
  } else {
    sweetAlert('error', data.message);
  }
}


function card(params) {
  const { id, type, origin, destination, departing, returning, price, seats, } = params;
  return `<div class='card mt-4' style='width: 18rem;' data-fid=${id}>
  <div class='card-body'>
    <h6 class='card-title'>${type}</h6>
    <span class='card-subtitle mb-2 text-muted'>${seats} Seats</span>
    <ul class='list-group  mt-3'>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Origin :</span> ${origin}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Destination :</span> ${destination}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Price :</span> ${price} MAD</li>
    </ul>
  </div>
  <div class='card-body' data-flight='{"id":${id},"type":"${type}","origin":"${origin}","destination":"${destination}","price":${price},"seats":${seats},"departing":"${departing}","returning":"${returning}"}'>
    <button onclick="_delete(this)" class='btn btn-outline-danger btn-sm'>Delete</button>
    <button data-bs-toggle="modal" data-bs-target="#Modal" onclick="_edite(this)" style='color: white;' class='btn btn-info btn-sm'>Edite</button>
    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">View</button>
    <ul class="dropdown-menu dropdown-menu-dark" style="cursor: pointer;">
      <li class="dropdown-item"><span class="fw-bold">Departing:</span> ${departing}</li>
      <li class="dropdown-item ${returning == 'null' && 'd-none'}"><span class="fw-bold">Returning:</span> ${returning}</li>
    </ul>
  </div>
</div>`;
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


// animation delete card
// let card = button.parentNode.parentNode;
// thisCard = card.animate([{
//   opacity: '0'
// }], 300);

// thisCard.onfinish = () => {
//   card.remove();
// }

function sweetAlert(_icon, _title) {
  Swal.fire({
    position: 'top-end',
    icon: _icon,
    title: _title,
    showConfirmButton: false,
    timer: 1500
  })
}


let search = document.querySelector("body > header > input");
let boxs = [...document.querySelectorAll('[data-flight]')];

search.addEventListener('input', () => {
  let value = search.value.toLocaleLowerCase();
  const filteredFlights = boxs.filter(flight => {
    return (flight.type.toLocaleLowerCase().includes(value) ||
      flight.origin.toLocaleLowerCase().includes(value) ||
      flight.destination.toLocaleLowerCase().includes(value));
  });
  flights.innerHTML = "";
  filteredFlights.forEach(_f => flights.insertAdjacentHTML('afterbegin', card(_f)));
});