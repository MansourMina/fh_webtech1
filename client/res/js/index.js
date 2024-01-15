// Enable Tooltips from Bootstrap
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]',
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl),
);

// Open Bootstrap Modal
function openModal(id) {
  let myModal = new bootstrap.Modal(document.getElementById(id));
  myModal.show();
}

function loadFile(event) {
  // Show the selected image for client
  let image = document.getElementById('profile-img');
  image.src = URL.createObjectURL(event.target.files[0]);

  // Update the profile image and enable the save butto
  let save = document.getElementById('saveButton');
  save.removeAttribute('disabled');
}

function toggleReadOnly(buttonName, inputName, value, saveButton) {
  let input = document.getElementById(inputName);
  let button = document.getElementById(buttonName);

  // Toggle edit icon when clicked, except for the passwordButton
  if (input.readOnly) {
    button.style.display = 'none';
    input.readOnly = !input.readOnly;
  }

  // Enable save button if any changes happen
  input.addEventListener('change', function (e) {
    if (e.target.value.trim() !== value.trim()) {
      let save = document.getElementById(saveButton);

      if (
        buttonName != 'memberEmailButton' &&
        buttonName != 'memberPasswordButton'
      ) {
        save.removeAttribute('disabled');
      } else {
        save.style.display = 'block';
      }
    }
  });
}

// Clear password fields when the modal is closed
function closePassword() {
  let oldPasswordField = document.getElementById('old_password');
  let newPasswordField = document.getElementById('new_password');
  oldPasswordField.value = '';
  newPasswordField.value = '';
}

document.addEventListener('DOMContentLoaded', function () {
  let textContainers = document.querySelectorAll('.news_content');
  textContainers.forEach(function (textContainer) {
    let textContent = textContainer.innerHTML;
    // Search for ** and replace HTML-Tag for bold
    let transformedTextBold = textContent.replace(
      /\*\*(.*?)\*\*/g,
      '<strong>$1</strong>',
    );
    // Search for * and replace HTML-Tag for italic
    let transformedTextItalic = transformedTextBold.replace(
      /\*(.*?)\*/g,
      '<em>$1</em>',
    );
    textContainer.innerHTML = transformedTextItalic;
  });
});
