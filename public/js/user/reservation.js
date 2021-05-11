// 
initReservationUser();

document.querySelector('#logout').onclick = () => {
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

function config(data) {
  return {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  }
}


async function initReservationUser() {
  const resposne = await fetch('http://localhost:8080/account/api/reservation');
  const {
    body
  } = await resposne.json();
  body.forEach(async _r => {
    document.querySelector("#main").insertAdjacentHTML('afterbegin', await card(_r));
    feather.replace();
  });

}



async function card(params) {
  const { rid, type, origin, destination, departing, returning, price } = params;
  const response = await fetch(`https://api.unsplash.com/search/photos/?query=${destination}&per_page=1&client_id=3_v4aIq-B4A3TR9izR8OFOZW_jfOpd_UsJN7jkUcyng`)
  const data = await response.json();
  const src = data.results[0].urls.regular;
  return `<div class='card mt-4 p-0' style='width: 18rem;'>
  <img class="imgMax" src="${src}">
  <div class='card-body'>
    <ul class='list-group'>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Origin :</span> ${origin}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Destination :</span> ${destination}</li>
      <li class='list-group-item'><span class='card-subtitle text-muted fw-bold'>Price :</span> ${price} MAD</li>
    </ul>
  </div>
  <div class='card-body'>
  <button class="btn btn-outline-danger btn-sm" onclick="_reserveDelete(this)" data-rid="${rid}">Cancel</button>
    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">View</button>
    <ul class="dropdown-menu dropdown-menu-dark" style="cursor: pointer;">
      <li class="dropdown-item"><span data-feather="git-commit"></span>${type}</li>
      <li class="dropdown-item"><span data-feather="calendar"></span>${departing}</li>
      <li class="dropdown-item ${returning == 'null' && 'd-none'}"><span data-feather="calendar"></span>${returning}</li>
    </ul>
  </div>
</div>`;
}

function _reserveDelete(button) {

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(async (result) => {
    if (result.isConfirmed) {
      rid = button.dataset.rid;
      const resposne = await fetch('http://localhost:8080/account/api/reservation/delete', config({ rid }));
      const data = await resposne.json();
      if (data.error === false) {
        button.parentElement.parentElement.remove();
        Swal.fire(
          'Deleted!',
          'Your reservation has been deleted.',
          'success'
        )
      }
    }
  })
}