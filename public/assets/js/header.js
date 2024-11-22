// Obtener elementos
const userButton = document.getElementById('userButton');
const dropdownMenu = document.getElementById('userDropdown');

// Mostrar/ocultar el menú al hacer clic en el botón
userButton.addEventListener('click', () => {
  const isVisible = dropdownMenu.style.display === 'block';
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