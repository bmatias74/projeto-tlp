const slidesContainer = document.querySelector('.slides');
const radioButtons = document.querySelectorAll('#radio1, #radio2, #radio3, #radio4');
const navegador = document.querySelectorAll('#radion1, #radion2, #radion3, #radion4');

radioButtons.forEach((radio, index) => {
    radio.addEventListener('change', () => {
        if (radio.checked) {
            navegador.forEach((radion, ind) => {
                 radion.style.backgroundColor = '';
                 if (ind === index) {
                     radion.style.backgroundColor = 'yellow';
                 }
             });
             const marginLeft = -200 * index;
            slidesContainer.style.marginLeft = `${marginLeft}%`;
        }
    });
});