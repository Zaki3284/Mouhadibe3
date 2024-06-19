document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('stepperForm');
  const formSteps = document.querySelectorAll('.form-step');
  const steps = document.querySelectorAll('.step');
  const nextButtons = document.querySelectorAll('.btn-next');
  const prevButtons = document.querySelectorAll('.btn-prev');

  let currentStep = 0;

  nextButtons.forEach(button => {
      button.addEventListener('click', () => {
          if (validateCurrentStep()) {
              currentStep++;
              updateFormSteps();
              updateStepper();
          }
      });
  });

  prevButtons.forEach(button => {
      button.addEventListener('click', () => {
          currentStep--;
          updateFormSteps();
          updateStepper();
      });
  });

  function validateCurrentStep() {
      const currentFormStep = formSteps[currentStep];
      const inputs = currentFormStep.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea');

      for (let i = 0; i < inputs.length; i++) {
          const input = inputs[i];
          if (input.hasAttribute('required') && input.value.trim() === '') {
              alert('يرجى ملء جميع الحقول المطلوبة في هذه الخطوة.');
              return false;
          }
      }

      return true;
  }

  function updateFormSteps() {
      formSteps.forEach((formStep, index) => {
          if (index === currentStep) {
              formStep.classList.add('form-step-active');
          } else {
              formStep.classList.remove('form-step-active');
          }
      });
  }

  function updateStepper() {
      steps.forEach((step, index) => {
          if (index === currentStep) {
              step.classList.add('active');
          } else {
              step.classList.remove('active');
          }
      });
  }
});
