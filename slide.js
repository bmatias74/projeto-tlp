document.addEventListener('DOMContentLoaded', (event) => {
const root = document.documentElement;
let contador = 1;
const slidesContainer = document.querySelector('.slides');
const radioButtons = document.querySelectorAll('#radio1, #radio2, #radio3, #radio4');
const navegador = document.querySelectorAll('#radion1, #radion2, #radion3, #radion4');
function updateSlider(index){
    navegador.forEach((radion, ind) => {
        radion.style.backgroundColor = '';
        if (ind === index) {
            radion.style.backgroundColor = 'yellow';
        }
    });
}

const marginLeft = -200 * index;
slidesContainer.style.marginLeft = `${marginLeft}%`;
radioButtons.forEach((radio, index) => {
    radio.addEventListener('change', () => {
        if (radio.checked) {
            
        }
    });
});
setInterval(function() {
    document.getElementById('radio' + contador).checked = true;
    radioButtons[contador - 1].dispatchEvent(new Event ('change'));
    contador++;
    if (contador > 4) {
        contador = 1;
    }
}, 10000);

  });

//menu do wi logado
document.addEventListener('DOMContentLoaded', function() {
    const settingsBtn = document.getElementById('settingsBtn');
    const settingsMenu = document.getElementById('settingsMenu');
    settingsBtn.style.cursor = 'pointer';
    settingsBtn.addEventListener('click', function() {
        settingsMenu.classList.toggle('visible');
    });
  
    // Fechar o menu ao clicar fora dele
    window.addEventListener('click', function(event) {
        if (!settingsBtn.contains(event.target) && !settingsMenu.contains(event.target)) {
            settingsMenu.classList.remove('visible');
        }
    }); 
});