document.addEventListener('DOMContentLoaded', function() {
    const widgetList = document.getElementById('widget-list');
    const addWidgetButton = document.getElementById('add-widget');

    // Função para adicionar um novo widget
addWidgetButton.addEventListener('click', function () {
    const index = widgetList.children.length;
    const widgetItem = document.createElement('div');
    widgetItem.classList.add('widget-item');
    widgetItem.setAttribute('data-index', index);

    widgetItem.innerHTML = `
        <h4>Widget ${index + 1} <button type="button" class="remove-widget">Remover</button></h4>
        
        <p>
            <label for="widget-${index}-content"><strong>Content</strong> (nome ou conteúdo):</label><br>
            <input type="text" id="widget-${index}-content" name="widget[${index}][content]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-type"><strong>Type</strong> (text ou image):</label><br>
            <select id="widget-${index}-type" name="widget[${index}][type]" style="width:100%;">
                <option value="text">Text</option>
                <option value="image">Image</option>
            </select>
        </p>

        <p>
            <label for="widget-${index}-fontSize"><strong>Font Size</strong> (para text):</label><br>
            <input type="text" id="widget-${index}-fontSize" name="widget[${index}][fontSize]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-width"><strong>Image Width</strong> (para image):</label><br>
            <input type="text" id="widget-${index}-width" name="widget[${index}][width]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-height"><strong>Image Height</strong> (para image):</label><br>
            <input type="text" id="widget-${index}-height" name="widget[${index}][height]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-link"><strong>Link</strong> (URL):</label><br>
            <input type="text" id="widget-${index}-link" name="widget[${index}][link]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-x"><strong>X</strong> (posição):</label><br>
            <input type="number" id="widget-${index}-x" name="widget[${index}][x]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-y"><strong>Y</strong> (posição):</label><br>
            <input type="number" id="widget-${index}-y" name="widget[${index}][y]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-weight"><strong>Weight</strong> (peso):</label><br>
            <input type="number" id="widget-${index}-weight" name="widget[${index}][weight]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-color"><strong>Color</strong> (cor):</label><br>
            <input type="text" id="widget-${index}-color" name="widget[${index}][color]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-state_code"><strong>State Code</strong> (código do estado, ex: AC):</label><br>
            <input type="text" id="widget-${index}-state_code" name="widget[${index}][state_code]" style="width:100%;" />
        </p>

        <p>
            <label for="widget-${index}-customClass"><strong>Custom Class</strong> (classe CSS adicional):</label><br>
            <input type="text" id="widget-${index}-customClass" name="widget[${index}][customClass]" style="width:100%;" />
        </p>
    `;

    widgetList.appendChild(widgetItem);
});


    // Função para remover um widget
    widgetList.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-widget')) {
            const widgetItem = e.target.closest('.widget-item');
            widgetItem.remove();
            updateWidgetIndexes();
        }
    });

    // Função para atualizar os índices dos widgets
    function updateWidgetIndexes() {
        const widgetItems = widgetList.querySelectorAll('.widget-item');
        widgetItems.forEach((item, index) => {
            item.setAttribute('data-index', index);
            item.querySelector('h4').textContent = `Widget ${index + 1}`;
            item.querySelectorAll('input, label').forEach(input => {
                const name = input.getAttribute('name') || input.getAttribute('for');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, `[${index}]`);
                    input.setAttribute('name', newName);
                    input.setAttribute('id', newName);
                }
            });
        });
    }
});