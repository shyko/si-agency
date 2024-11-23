// Підключення функціоналу "Чертоги Фрілансера"
import { isMobile } from "./functions.js";
// Підключення списку активних модулів
import { flsModules } from "./modules.js";


const form = document.querySelector('.consult-form__form');

if (form) {
  form.addEventListener('submit', formSubmitAction);
}

async function formSubmitAction(e) {
  e.preventDefault();
  const form = e.target;
  const formAction = form.getAttribute('action') ? form.getAttribute('action').trim() : '#';
  const formMethod = form.getAttribute('method') ? form.getAttribute('method').trim() : 'GET';
  const formData = new FormData(form);
  form.classList.add('form-sending');

  const response = await fetch(formAction, {
    method: formMethod,
    body: formData,
  });

  if (response.ok) {
    alert('Дякуємо! Ми зв\'яжемось з вами найближчим часом.');
    form.classList.remove('form-sending');
  }

}


