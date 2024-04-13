//barra de pesquisa 
document.getElementById('searchbtn').addEventListener('click', function(event) {
  event.preventDefault();
  fetchResults();
});

document.getElementById('searchInput').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
      event.preventDefault();
      fetchResults();
  }
});

function fetchResults() {
  let searchInput = document.getElementById('searchInput').value.toLowerCase();
  let divs = document.querySelectorAll('.co');

  divs.forEach(function(div) {
      var nome = div.querySelector('figcaption').innerText.toLowerCase();
      if (nome.includes(searchInput)) { // Assegura que usamos a variável correta
          div.style.display = '';
      } else {
          div.style.display = 'none';
      }
  });
}
//paginação
document.addEventListener('DOMContentLoaded', function() {
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
document.addEventListener('DOMContentLoaded', function() {
  const settingsBtn = document.getElementById('settingsBtn');
  const settingsMenu = document.getElementById('settingsMenu');

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

//barra de pesquisa para não estár chata
document.addEventListener('DOMContentLoaded', function() {
  var searchBox = document.querySelector('.search-box');
  var searchInput = document.getElementById('searchInput');

  // Adiciona a classe 'active' quando há interação com a caixa de pesquisa
  searchBox.addEventListener('mouseover', function() {
      this.classList.add('active');
  });

  // Verifica cliques fora da caixa de pesquisa
  document.addEventListener('click', function(event) {
      // Se o clique foi fora da searchBox, remova a classe 'active'
      if (!searchBox.contains(event.target)) {
          searchBox.classList.remove('active');
      }
  });

  // Manter a caixa ativa enquanto o usuário interage com o input
  searchInput.addEventListener('click', function(event) {
      event.stopPropagation(); // Impede que o clique propague para elementos pai
  });
});


