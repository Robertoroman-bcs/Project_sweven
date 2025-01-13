let prevScrollpos = window.scrollY; // Usamos window.scrollY en lugar de pageYOffset
let navbar = document.getElementById("navbar");
let menuIcon = document.getElementById("menu-icon");
let contentSection = document.getElementById("content");

// Función que detecta si el color del fondo es oscuro o claro
function detectBackgroundColor() {
    // Obtenemos el color del fondo de la sección donde se encuentra el navbar
    let backgroundColor = window.getComputedStyle(contentSection).backgroundColor;

    // Convertimos el color RGB a valores más comprensibles para comparar
    let rgba = backgroundColor.match(/rgba?\((\d+), (\d+), (\d+)(?:, (\d+(\.\d+)?))?\)/);
    let r = parseInt(rgba[1]);
    let g = parseInt(rgba[2]);
    let b = parseInt(rgba[3]);

    // Calculamos el brillo promedio para determinar si es oscuro o claro
    let brightness = 0.2126 * r + 0.7152 * g + 0.0722 * b;

    // Si el brillo es mayor que un umbral (por ejemplo, 128), consideramos que el fondo es claro
    if (brightness > 128) {
        navbar.style.backgroundColor = "rgba(255, 255, 255, 0.9)"; // Fondo blanco en el navbar
        navbar.style.color = "#333"; // Texto oscuro
    } else {
        navbar.style.backgroundColor = "rgba(0, 0, 0, 0.7)"; // Fondo oscuro en el navbar
        navbar.style.color = "#fff"; // Texto claro
    }
}

// Funcionalidad para el menú hamburguesa
menuIcon.addEventListener("click", function() {
    navbar.classList.toggle("active");
    
    
});

// Función para cambiar el color del navbar solo cuando estamos en la parte superior
window.onscroll = function() {
    let currentScrollPos = window.scrollY; // Usamos window.scrollY en lugar de pageYOffset

    // Si estamos en la parte superior de la página
    if (currentScrollPos === 0) {
        navbar.style.backgroundColor = "rgba(0, 0, 0, 0.1)"; // Navbar oscuro por defecto al principio
        navbar.style.color = "#fff"; // Texto claro por defecto
    } else {
        detectBackgroundColor(); // Cambiar el color dependiendo del fondo debajo del navbar
    }

    // Si estamos desplazándonos hacia abajo, el navbar se oculta
    if (prevScrollpos > currentScrollPos) {
        navbar.style.top = "0"; // Mostrar el navbar
    } else {
        navbar.style.top = "-155px"; // Ocultar el navbar mas hacia arriba
    }
    prevScrollpos = currentScrollPos;
};

document.querySelectorAll('.menu-hover').forEach(item => {
    item.addEventListener('mouseenter', () => {
      item.querySelector('.modal-menu').style.display = 'block';
    });
    item.addEventListener('mouseleave', () => {
      item.querySelector('.modal-menu').style.display = 'none';
    });
  });


  ///Del siguiente text quier que me digas que servicios se pueden ofrecer y cuales serian los sectores en los que entrarias: 

  
