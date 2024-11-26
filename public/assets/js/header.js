// Obtener elementos
const userButton = document.getElementById('userButton');
const dropdownMenu = document.getElementById('userDropdown');

// Mostrar/ocultar el menú al hacer clic en el botón
userButton.addEventListener('click', (event) => {
  console.log('Estoy dentro del clik');

  event.stopPropagation();
  
  const isVisible = dropdownMenu.style.display === 'block';
  console.log(isVisible);
  dropdownMenu.style.display = isVisible ? 'none' : 'block';
});

// Cerrar el menú al hacer clic fuera de él
window.addEventListener('click', (event) => {
  if (event.target !== userButton && !dropdownMenu.contains(event.target)) {
    dropdownMenu.style.display = 'none';
  }
});
//action para cerrar session
document.getElementById('logoutLink').addEventListener('click', (event) => {
  event.preventDefault(); // Evita que el enlace se comporte como un link estándar
  document.getElementById('logoutForm').submit(); // Envía el formulario
});

function header(event){
  event.preventDefault(); // Evita que el enlace se comporte como un link estándar
  document.getElementById('recipeForm').submit();
}


