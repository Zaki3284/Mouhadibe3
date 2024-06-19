document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const feedback = document.getElementById('formFeedback');

  form.addEventListener('submit', function (event) {
      event.preventDefault();

      
  });

  document.getElementById("night-mode-toggle").addEventListener("click", function () {
      document.body.classList.toggle("night-mode");
  });

  window.confirmLogout = function (event) {
      event.preventDefault(); // Prevent the form from submitting
      const dialog = document.createElement('div');
      dialog.className = 'confirmation-dialog';
      dialog.innerHTML = `
      <i class="fas fa-sign-out-alt fa-2x"></i>
          <div>هل أنت متأكد أنك تريد تسجيل الخروج؟</div>
          <button class="btn btn-confirm">نعم</button>
          <button class="btn btn-cancel">إلغاء</button>
      `;

      document.body.appendChild(dialog);

      const btnConfirm = dialog.querySelector('.btn-confirm');
      const btnCancel = dialog.querySelector('.btn-cancel');

      btnConfirm.addEventListener('click', () => {
          document.getElementById('logout-form').submit(); // Submit the form
      });

      btnCancel.addEventListener('click', () => {
          dialog.remove(); // Remove the dialog
      });
  };
});