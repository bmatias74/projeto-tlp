//barra de pesquisa 
pesquisaR = document.getElementById('pesquisaR');
mainRestaurante = document.getElementById('mainR');

document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('searchbtn').addEventListener('click', function (event) {
    event.preventDefault();
    fetchResults();
  });

  document.getElementById('searchInput').addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
      event.preventDefault();
      fetchResults();
    }
  });

  function fetchResults() {
    if (pesquisaR.value == 'pesquisa') {
     mainRestaurante.innerHTML = ''
    }
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const searchterm = searchInput;
    if (searchterm) {
      fetch(`index.php?search=${searchterm}`)
        .then(response => response.json())
        .then(data => {
          const rContainer = document.querySelector('.imagens');
          rContainer.innerHTML = '';
          if (data.length > 0) {
            data.forEach(restaurant => {
              const restaurantDiv = document.createElement('div');
              restaurantDiv.classList.add('co');
              restaurantDiv.innerHTML = `
                <a href='restaurante.php?id=${restaurant.id_restaurante}'><img src='IMG_restaurante/${restaurant.imagem_p}' alt='Restaurante ${restaurant.nome}'></a>
                <figcaption for='text'>${restaurant.nome}</figcaption>`;
              rContainer.appendChild(restaurantDiv);
            });
          } else {
            rContainer.innerHTML = '<p class="s_restaurante">Nenhum Restaurante Encontrado</p>';
          }
        })
        .catch(error => console.error('Error:', error));
    }
  }
});
// Tela do restaurante
const nome_r = document.getElementById('nome-rh');
const tituloHeader = document.getElementById('tituloh');
if(nome_r){
  tituloHeader.innerText = nome_r.value;
}
//paginação
document.addEventListener('DOMContentLoaded', function () {
  let itemsPerPage = 8;
  const coItems = document.querySelectorAll('.co');
  let totalPages = Math.ceil(coItems.length / itemsPerPage);
  let currentPage = 1;

  function showPage(page) {
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    coItems.forEach((item, index) => {
      item.style.display = (index >= start && index < end) ? 'flex' : 'none';
    });
    currentPage = page;
    updatePaginationButtons();
  }

  function updatePaginationButtons() {
    totalPages = Math.ceil(coItems.length / itemsPerPage); // Recalcular o total de páginas após a atualização
    const container = document.getElementById('pagination-container');
    container.innerHTML = ''; // Limpa botões antigos
    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement('button');
      button.innerText = i;
      button.addEventListener('click', () => showPage(i));
      if (currentPage === i) button.disabled = true; // Desativa o botão da página atual
      container.appendChild(button);
    }
  }

  function updateItemsPerPage() {
    if (window.innerWidth < 290) {
      itemsPerPage = 3;
    } else if (window.innerWidth < 445) {
      itemsPerPage = 6;
    } else if (window.innerWidth < 995) {
      itemsPerPage = 9;
    } else {
      itemsPerPage = 12;
    }
    showPage(currentPage);
  }

  window.addEventListener('resize', updateItemsPerPage);


  updateItemsPerPage();

  showPage(1);
});
//menu do wi logado
document.addEventListener('DOMContentLoaded', function () {
  const settingsBtn = document.getElementById('settingsBtn');
  const settingsMenu = document.getElementById('settingsMenu');

  settingsBtn.addEventListener('click', function () {
    settingsMenu.classList.toggle('visible');
  });

  // Fechar o menu ao clicar fora dele
  window.addEventListener('click', function (event) {
    if (!settingsBtn.contains(event.target) && !settingsMenu.contains(event.target)) {
      settingsMenu.classList.remove('visible');
    }
  });
});

//barra de pesquisa para não estár chata
document.addEventListener('DOMContentLoaded', function () {
  var searchBox = document.querySelector('.search-box');
  var searchInput = document.getElementById('searchInput');

  // Adiciona a classe 'active' quando há interação com a caixa de pesquisa
  searchBox.addEventListener('mouseover', function () {
    this.classList.add('active');
  });

  // Verifica cliques fora da caixa de pesquisa
  document.addEventListener('click', function (event) {
    // Se o clique foi fora da searchBox, remova a classe 'active'
    if (!searchBox.contains(event.target)) {
      searchBox.classList.remove('active');
    }
  });

  // Manter a caixa ativa enquanto o usuário interage com o input
  searchInput.addEventListener('click', function (event) {
    event.stopPropagation(); // Impede que o clique propague para elementos pai
  });
});
//botão de limpar
const eraseButton = document.getElementById('erasebtn');
let searchInput = document.getElementById('searchInput');


searchInput.addEventListener('load', function () {

});


searchInput.addEventListener('input', function () {
  if (searchInput.value.length > 0) {
    eraseButton.style.display = 'block';
  } else {
    eraseButton.style.display = 'none';
  }
});

eraseButton.addEventListener('click', function () {
  searchInput.value = '';
  eraseButton.style.display = 'none';
});




