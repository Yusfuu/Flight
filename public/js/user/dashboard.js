
const logout = document.querySelector('#logout');
const passengers = document.querySelector("#passengers");
const passangersInfo = document.querySelector("#passangersInfo");
const submitPassengers = document.querySelector('#submitPassengers');
const spinner = document.querySelector('#spinner');


passengers.onchange = () => {
  let n = passengers.value;
  passangersInfo.innerHTML = '';
  for (let index = 1; index < n; index++) {
    passangersInfo.insertAdjacentHTML('afterbegin', passengersForm());
  }
  feather.replace();
}

submitPassengers.onclick = () => {
  const fid = submitPassengers.dataset.id;
  let passengers = [];

  [...document.querySelectorAll('.pinfo')].forEach(p => {
    const name = p.children[0].children[1].value;
    const birth = p.children[1].children[1].value;
    passengers.push({
      name,
      birth
    });
  });


  const reservation = {
    fid,
    passengers
  }

  fetch('http://localhost:8080/account/reservation', config(reservation))
    .then(resposne => resposne.json())
    .then(data => {
      if (data.error === false) {
        const places = document.querySelector(`[data-fid="${fid}"]`).parentElement.children[1].children[1].children[2].children[1];
        let n = places.innerText.split('Seats')[0] - (reservation.passengers.length + 1);
        places.innerText = n + " Seats";
        sweetAlert('success', data.message);
      } else {
        sweetAlert('warning', data.message);
      }
    });
}

function _reserve(button) {
  const {
    fid
  } = button.dataset;
  submitPassengers.dataset.id = fid;
  passangersInfo.innerHTML = '';
  passengers.value = 1;
}

logout.onclick = () => {
  const user = {
    logout: true
  }
  postData('http://localhost:8080/account/logout', user);
}

async function postData(url, data) {
  const resposne = await fetch(url, config(data));
  const body = await resposne.json();
  if (body.error === false) {
    return location.href = 'http://localhost:8080/account/signin';
  }
}

function passengersForm() {
  return `<div class="pinfo"><div class="mb-3">
            <label class="form-label"><span data-feather="user"></span>Passenger Name</label>
            <input type="text" class="form-control">
            </div><div class="mb-3">
            <label class="form-label"><span data-feather="calendar"></span>Passenger Birth</label>
            <input type="date" class="form-control"></div></div><hr>`;
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

function sweetAlert(_icon, _title) {
  Swal.fire({
    position: 'top-end',
    icon: _icon,
    title: _title,
    showConfirmButton: false,
    timer: 1500
  })
}


let isLoading = false;
let offset = 0;
let noLoad = false;
document.onscroll = async () => {
  let toLoad = (spinner.getBoundingClientRect().top) < window.innerHeight && !isLoading;
  if (toLoad && !noLoad) {
    loadFlight();
  }
}

async function loadFlight() {
  spinner.style.display = "";
  isLoading = true;
  const response = await fetch('http://localhost:8080/api/reservation/pagination', config({ offset }));
  const { body, offset: _offset } = await response.json();
  boxs = [...boxs, ...body];
  const promises = await Promise.all(body.map(({ destination }) => fetch(apiPic(destination))));
  const jsons = await Promise.all(promises.map(pic => pic.json()));
  const x = await Promise.all(jsons.map(src => fetch(src.results[0].urls.regular)));
  const y = await Promise.all(x.map(p => p.blob()));
  let srcs = y.map(c => URL.createObjectURL(c));
  let cards = srcs.map((_, i) => card(body[i], _)).join('');
  document.querySelector("#main").insertAdjacentHTML('beforeend', cards);

  body.length === 0 && (noLoad = true);
  isLoading = false;
  offset = _offset + 6;
  feather.replace();
  spinner.style.display = "none";
}

function apiPic(word) {
  return `https://api.unsplash.com/search/photos/?query=${word}&per_page=1&client_id=3_v4aIq-B4A3TR9izR8OFOZW_jfOpd_UsJN7jkUcyng`;
}

function card(params, src) {
  const { id, type, origin, destination, departing, returning, price, seats } = params;

  return `<div class="col cardini text-dark">
            <div style="border: none;" class="card">
              <img class="imgMax" src="${src}">
              <div class="card-body" style="text-align: left;">
                <h5 class="card-title">${type}</h5>
                <h6 class="card-subtitle mb-2 text-muted mb-4">${origin} <span style="margin: 0 5px;width: 20px;height: 20px;color:#007bff" data-feather="git-commit"></span> ${destination}</h6>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button onclick="_reserve(this)" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#Modal" data-fid=${id}>Reserve</button>
                    <div class="btn-group">
                      <button id="btnGroupDrop1" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">Detail</button>
                      <ul style="cursor: pointer;" class="dropdown-menu dropdown-menu-dark">
                        <li class="dropdown-item"><span data-feather="calendar"></span>${departing}</li>
                        <li class="dropdown-item ${returning == 'null' && 'd-none'}"><span data-feather="calendar"></span>${returning}</li>
                        <li class="dropdown-item"><span data-feather="users"></span><span>${seats} Seats</span></li>
                      </ul>
                    </div>
                  </div>
                  <small class="text-muted">${+price} MAD</small>
                </div>
              </div>
            </div>
          </div>`;
}

loadFlight();

let search = document.querySelector("body > div > header > div > input");
let boxs = [];

search.addEventListener('input', () => {
  let value = search.value.toLocaleLowerCase();

  const filterBoxs = boxs.filter(flight => {
    return (flight.type.toLocaleLowerCase().includes(value) ||
      flight.origin.toLocaleLowerCase().includes(value) ||
      flight.destination.toLocaleLowerCase().includes(value));
  });
  ids = filterBoxs.map(e => e.id);

  document.querySelectorAll('[data-fid]').forEach(element => {
    let ell = element.parentElement.parentElement.parentElement.parentElement.parentElement;
    if (ids.includes(element.dataset.fid)) {
      ell.style.display = '';
    } else {
      ell.style.display = 'none';
    }
  });
});