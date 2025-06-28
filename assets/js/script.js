document.addEventListener("DOMContentLoaded", function () {
    // Validación básica para agregar rollo
    const agregarForm = document.querySelector("form[action='']");
    if (agregarForm) {
      agregarForm.addEventListener("submit", function (e) {
        const largo = parseFloat(agregarForm.largo.value);
        if (isNaN(largo) || largo <= 0) {
          e.preventDefault();
          alert("El largo debe ser un número positivo.");
        }
      });
    }
  
    // Validación básica para vender metros
    const venderForm = document.querySelector("form[action='']");
    if (venderForm && venderForm.metros) {
      venderForm.addEventListener("submit", function (e) {
        const metros = parseFloat(venderForm.metros.value);
        if (isNaN(metros) || metros <= 0) {
          e.preventDefault();
          alert("Los metros a vender deben ser un número positivo.");
        }
      });
    }
  });
  