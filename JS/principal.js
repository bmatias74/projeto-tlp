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
