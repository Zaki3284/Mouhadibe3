
document.addEventListener('DOMContentLoaded', () => {
    const nextButtons = document.querySelectorAll('.btn-next');
    const prevButtons = document.querySelectorAll('.btn-prev');
    const formSteps = document.querySelectorAll('.form-step');
    const steps = document.querySelectorAll('.step');

    let formStepNum = 0;

    nextButtons.forEach(button => {
        button.addEventListener('click', () => {
            formStepNum++;
            updateFormSteps();
            updateStepper();
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', () => {
            formStepNum--;
            updateFormSteps();
            updateStepper();
        });
    });

    function updateFormSteps() {
        formSteps.forEach((formStep, index) => {
            if (index === formStepNum) {
                formStep.classList.add('form-step-active');
            } else {
                formStep.classList.remove('form-step-active');
            }
        });
    }

    function updateStepper() {
        steps.forEach((step, index) => {
            if (index === formStepNum) {
                step.classList.add('active');
            } else {
                step.classList.remove('active');
            }
        });
    }
});
