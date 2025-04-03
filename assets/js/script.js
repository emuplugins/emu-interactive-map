// Espera a página carregar
window.addEventListener('load', () => {

    setTimeout(function () {
        let scrollOffset = 0; /* Deslocamento de rolagem desde o topo do título */

        const tabsAccordionToggleTitles = document.querySelectorAll('.e-n-accordion-item-title, .e-n-tab-title, .elementor-tab-title');

        // Função para abrir a aba com base no âncorar
        const clickTitleWithAnchor = (anchor) => {

            tabsAccordionToggleTitles.forEach(title => {
                if (title.querySelector(`#${anchor}`) != null || title.id === anchor || (title.closest('details') && title.closest('details').id === anchor)) {
                    if (title.getAttribute('aria-expanded') !== 'true' && !title.classList.contains('elementor-active')) title.click();
                    let timing = 0;
                    let scrollTarget = title;
                    if (getComputedStyle(title.closest('.elementor-element')).getPropertyValue('--n-tabs-direction') == 'row') scrollTarget = title.closest('.elementor-element');
                    if (title.closest('.e-n-accordion, .elementor-accordion-item, .elementor-toggle-item')) {
                        timing = 400;
                    }
                }
            });

        };

        // Evento de clique para âncoras nos links dentro do SVG
        document.querySelectorAll('.widgets-container a').forEach(link => {
            link.addEventListener('click', function (event) {
                const anchor = link.getAttribute('href').substring(1); // Pega o id do link
                if (anchor) {
                    event.preventDefault(); // Evita a navegação normal
                    clickTitleWithAnchor(anchor); // Abre a aba
                }
            });
        });

        // Verifica a âncora atual na URL e abre a aba correspondente
        const currentAnchor = extractAnchor(window.location.href);
        if (currentAnchor) {
            clickTitleWithAnchor(currentAnchor);
        }

        // Função para extrair a âncora da URL
        function extractAnchor(url) {
            const match = url.match(/#([^?]+)/);
            return match ? match[1] : null;
        }

    }, 300);
});