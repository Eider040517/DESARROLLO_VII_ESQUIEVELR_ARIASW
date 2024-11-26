document.addEventListener("DOMContentLoaded", () => {
  // Botones para agregar ingredientes y pasos
  const agregarIngredienteBtn = document.getElementById("agregarIngrediente");
  const agregarPasoBtn = document.getElementById("agregarPaso");

  // Contenedores de ingredientes y pasos
  const ingredientesContainer = document.getElementById("ingredientes");
  const pasosContainer = document.getElementById("pasos");

  // Función para agregar un nuevo ingrediente
  agregarIngredienteBtn.addEventListener("click", () => {
    const nuevoIngrediente = document.createElement("li");
    nuevoIngrediente.classList.add("ingrediente");
    const numeroIngrediente = ingredientesContainer.children.length;
    nuevoIngrediente.innerHTML = `
            <input type="text" name="ingredientInfo[${numeroIngrediente}][ingredient_name]" placeholder="Ingrediente ${
      numeroIngrediente + 1
    }" required>
            <button type="button" class="eliminar-btn">Eliminar</button>
        `;
    ingredientesContainer.appendChild(nuevoIngrediente);

    agregarEliminarFuncion(nuevoIngrediente.querySelector(".eliminar-btn"));
  });

  // Función para agregar un nuevo paso
  agregarPasoBtn.addEventListener("click", () => {
    const nuevoPaso = document.createElement("li");
    nuevoPaso.classList.add("paso");
    const numeroPaso = pasosContainer.children.length;
    nuevoPaso.innerHTML = `
            <input type="hidden" name="stepInfo[${numeroPaso}][step_number]" value="${numeroPaso}">
            <input type="text" name="stepInfo[${numeroPaso}][step_description]" placeholder="Paso ${
      numeroPaso + 1
    }" required>
            <button type="button" class="eliminar-btn">Eliminar</button>
        `;
    pasosContainer.appendChild(nuevoPaso);

    agregarEliminarFuncion(nuevoPaso.querySelector(".eliminar-btn"));
  });

  // Agregar funcionalidad para eliminar un campo
  const agregarEliminarFuncion = (botonEliminar) => {
    botonEliminar.addEventListener("click", (e) => {
      e.target.parentElement.remove();
    });
  };
});

// Obtener elementos
const userButton = document.getElementById("userButton");
const dropdownMenu = document.getElementById("userDropdown");

// Mostrar/ocultar el menú al hacer clic en el botón
userButton.addEventListener("click", (event) => {
  console.log("Estoy dentro del clik");

  event.stopPropagation();

  const isVisible = dropdownMenu.style.display === "block";
  console.log(isVisible);
  dropdownMenu.style.display = isVisible ? "none" : "block";
});

// Cerrar el menú al hacer clic fuera de él
window.addEventListener("click", (event) => {
  if (event.target !== userButton && !dropdownMenu.contains(event.target)) {
    dropdownMenu.style.display = "none";
  }
});
//action para cerrar session
document.getElementById("logoutLink").addEventListener("click", (event) => {
  event.preventDefault(); // Evita que el enlace se comporte como un link estándar
  document.getElementById("logoutForm").submit(); // Envía el formulario
});

const form = document.getElementById("recipeForm");
const actionInput = document.getElementById("actionInput");

// Botón Guardar
const btnSave = document.getElementById("btnSave");
if (btnSave) {
  btnSave.addEventListener("click", () => {
    actionInput.value = "create"; // Acción para guardar
    form.submit();
  });
}

// Botón Eliminar
const btnDelete = document.getElementById("btnDelete");
if (btnDelete) {
  btnDelete.addEventListener("click", () => {
    actionInput.value = "delete"; // Acción para eliminar
    form.submit();
  });
}

// Botón Actualizar
const btnUpdate = document.getElementById("btnUpdate");
if (btnUpdate) {
  btnUpdate.addEventListener("click", () => {
    actionInput.value = "update"; // Acción para actualizar
    form.submit();
  });
}
