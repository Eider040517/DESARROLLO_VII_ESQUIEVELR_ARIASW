document.addEventListener('DOMContentLoaded', () => {
    // Botones para agregar ingredientes y pasos
    const agregarIngredienteBtn = document.getElementById('agregarIngrediente');
    const agregarPasoBtn = document.getElementById('agregarPaso');

    // Contenedores de ingredientes y pasos
    const ingredientesContainer = document.getElementById('ingredientes');
    const pasosContainer = document.getElementById('pasos');

    // Función para agregar un nuevo ingrediente
    agregarIngredienteBtn.addEventListener('click', () => {
        const nuevoIngrediente = document.createElement('div');
        nuevoIngrediente.classList.add('ingrediente');
        nuevoIngrediente.innerHTML = `
            <input type="text" name="ingredientes[]" placeholder="Nuevo ingrediente" required>
            <button type="button" class="eliminar-btn">Eliminar</button>
        `;
        ingredientesContainer.appendChild(nuevoIngrediente);

        agregarEliminarFuncion(nuevoIngrediente.querySelector('.eliminar-btn'));
    });

    // Función para agregar un nuevo paso
    agregarPasoBtn.addEventListener('click', () => {
        const nuevoPaso = document.createElement('div');
        nuevoPaso.classList.add('paso');
        const numeroPaso = pasosContainer.children.length + 1;
        nuevoPaso.innerHTML = `
            <input type="text" name="pasos[]" placeholder="Paso ${numeroPaso}" required>
            <button type="button" class="eliminar-btn">Eliminar</button>
        `;
        pasosContainer.appendChild(nuevoPaso);

        agregarEliminarFuncion(nuevoPaso.querySelector('.eliminar-btn'));
    });

    // Agregar funcionalidad para eliminar un campo
    const agregarEliminarFuncion = (botonEliminar) => {
        botonEliminar.addEventListener('click', (e) => {
            e.target.parentElement.remove();
        });
    };
});
