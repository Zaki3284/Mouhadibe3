document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    const feedback = document.getElementById('formFeedback');
  
    form.addEventListener('submit', function (event) {
        event.preventDefault();
  
        // Ajoutez ici le code de traitement du formulaire
    });
  
    document.getElementById("night-mode-toggle").addEventListener("click", function () {
        document.body.classList.toggle("night-mode");
    });
  
    window.confirmLogout = function (event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre
        const dialog = document.createElement('div');
        dialog.className = 'confirmation-dialog';
        dialog.innerHTML = `
        <i class="fas fa-sign-out-alt fa-2x"></i>
            <div>Êtes-vous sûr de vouloir vous déconnecter ?</div>
            <button class="btn btn-confirm">Oui</button>
            <button class="btn btn-cancel">Annuler</button>
        `;
  
        document.body.appendChild(dialog);
  
        const btnConfirm = dialog.querySelector('.btn-confirm');
        const btnCancel = dialog.querySelector('.btn-cancel');
  
        btnConfirm.addEventListener('click', () => {
            document.getElementById('logout-form').submit(); // Soumet le formulaire
        });
  
        btnCancel.addEventListener('click', () => {
            dialog.remove(); // Supprime la boîte de dialogue
        });
    };
  });
  