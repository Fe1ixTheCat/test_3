window.onload = function() {
  let username = document.getElementById('username');
  let nameinput = document.getElementById('nameinput');
  let addform = document.getElementById('addform');
  let admininterface = document.getElementsByClassName('news-item__interface');

  let users = localStorage.getItem('user');
  if (!users) {
    username.innerHTML = "Авторизоваться";
    addform.style.display = "none";
    for (let i = 0; i < admininterface.length; i++) {
      admininterface[i].style.display = "none";
    }
  } else {
    username.innerHTML = users;
    nameinput.style.display = "none";
    addform.style.display = "none";
    for (let i = 0; i < admininterface.length; i++) {
      admininterface[i].style.display = "none";
    }
    if (users.toLowerCase() == 'admin') {
      addform.style.display = "block";
      for (let i = 0; i < admininterface.length; i++) {
        admininterface[i].style.display = "block";
      }
    }
  }

}


function setUser() {
  if (!localStorage.getItem('user')) {
    if (nameinput.value) {
      localStorage.setItem('user', nameinput.value);
      location.reload();
    } else {
      alert("Ошибка. Введено пустое поле");
    }
  } else if (localStorage.getItem('user')) {
    localStorage.removeItem('user');
    location.reload();
  }
}

function formLocation() {
  location.assign('form.php');
}

document.addEventListener('keydown', function(e) {
 if (e.keyCode == 13 && !localStorage.getItem('user')) {
   setUser();
 }
});

function deleteItem(id) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'delete.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(id);

  xhr.onreadystatechange = handleFunc;

  function handleFunc() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      location.reload();
    }
  }
}

function editItem(id) {
  location.assign('edit.php/?id=' + id);
}
