function loadFile(event) {
  let image = document.getElementById('profile');
  image.src = URL.createObjectURL(event.target.files[0]);
  let save = document.getElementById('saveButton');
  save.removeAttribute('disabled');
}

// function toggle(input, button) {

// }

// function showSaveButton(input, save, value) {

// }
function toggleReadOnly(buttonName, inputName, value) {
  if (buttonName == 'passwordButton') {
    let myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();
  }
  let input = document.getElementById(inputName);
  let button = document.getElementById(buttonName);

  if (buttonName != 'passwordButton') {
    if (input.readOnly) {
      button.style.display = 'none';
      input.readOnly = !input.readOnly;
    }
  }

  input.addEventListener('change', function (e) {
    if (e.target.value.trim() !== value.trim()) {
      if (buttonName != 'memberEmailButton') {
        let save = document.getElementById('saveButton');
        save.removeAttribute('disabled');
      } else {
        var saveMemberEmail = document.getElementById('saveMemberEmail');
        saveMemberEmail.style.display = 'block';
      }
    }
  });
}

// function changeMemberEmail(buttonName, inputName, value) {
//   let input = document.getElementById(inputName);
//   let button = document.getElementById(buttonName);
//   let save = document.getElementById('saveButton');
//   toggle(input, button);
//   showSaveButton(input, save, value);
// }

function closePassword() {
  let oldPasswordField = document.getElementById('old_password');
  let newPasswordField = document.getElementById('new_password');
  oldPasswordField.value = '';
  newPasswordField.value = '';
}
