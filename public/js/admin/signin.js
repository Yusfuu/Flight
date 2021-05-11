const submit = document.querySelector('#submit');
const email = document.querySelector('#email');
const password = document.querySelector('#password');

submit.onclick = () => {
  const user = {
    email: email.value,
    password: password.value
  }
  postData('http://localhost:8080/a/account/signin', user);
}

async function postData(url, data) {
  const config = {
    method: 'POST',
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json'
    }
  }
  const resposne = await fetch(url, config);
  const body = await resposne.json();
  if (body.error === false) {
    return location.href = 'http://localhost:8080/a/account/dashboard';
  } else {
    sweetAlert('error', body.message);
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