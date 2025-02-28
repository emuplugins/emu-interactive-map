document.addEventListener("DOMContentLoaded", function () {
    var widgetsList = document.getElementById("widgets-list");

    // Adicionar novo widget
    document.getElementById("add-widget").addEventListener("click", function () {
        var widgetName = document.getElementById("widget-name")?.value.trim();
        var widgetType = document.getElementById("widget-type")?.value.trim();
        var widgetOptions = document.getElementById("widget-options")?.value.trim();
        var widgetLink = document.getElementById("widget-link")?.value.trim();
        var widgetPositionX = document.getElementById("widget-x")?.value.trim();
        var widgetPositionY = document.getElementById("widget-y")?.value.trim();
        var widgetWeight = document.getElementById("widget-weight")?.value.trim();
        var widgetColor = document.getElementById("widget-color")?.value.trim();
        var widgetStateCode = document.getElementById("widget-state-code")?.value.trim();
        var widgetCustomClass = document.getElementById("widget-custom-class")?.value.trim();
        var postId = document.querySelector(".emu-box-wrapper")?.getAttribute("data-post-id");

        // Validação
        if (widgetName === '' || widgetType === '') {
            alert('Por favor, insira os campos obrigatórios.');
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'admin-ajax.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    var newWidgetDiv = document.createElement("div");
                    newWidgetDiv.className = "emu-group emu-group-11-columns";

                    // Adiciona o índice do widget como um atributo
                    var widgetIndex = response.data.widget_index;
                    newWidgetDiv.setAttribute("data-widget-index", widgetIndex);

                    // Gera os campos do widget com os IDs e names corretos
                    newWidgetDiv.innerHTML = `
                        <div class="emu-row-item">
                            <input type="text" id="widget-name_${widgetIndex}" name="widgets[${widgetIndex}][0]" value="${widgetName}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-type_${widgetIndex}" name="widgets[${widgetIndex}][1]" value="${widgetType}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-options_${widgetIndex}" name="widgets[${widgetIndex}][2]" value="${widgetOptions}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-link_${widgetIndex}" name="widgets[${widgetIndex}][3]" value="${widgetLink}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-x_${widgetIndex}" name="widgets[${widgetIndex}][4]" value="${widgetPositionX}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-y_${widgetIndex}" name="widgets[${widgetIndex}][5]" value="${widgetPositionY}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-weight_${widgetIndex}" name="widgets[${widgetIndex}][6]" value="${widgetWeight}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="color" id="widget-color_${widgetIndex}" name="widgets[${widgetIndex}][7]" value="${widgetColor}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-state-code_${widgetIndex}" name="widgets[${widgetIndex}][8]" value="${widgetStateCode}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" id="widget-custom-class_${widgetIndex}" name="widgets[${widgetIndex}][9]" value="${widgetCustomClass}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <button type="button" onclick="reloadMap()" class="reload-map-button remove-widget button emu-button emu-button-danger" data-widget-index="${widgetIndex}">
                                Remover
                            </button>
                        </div>
                    `;

                    widgetsList.appendChild(newWidgetDiv);
                    clearInputFields(); // Limpa os campos de entrada
                    attachRemoveEventHandlers(); // Reanexa os manipuladores de eventos de remoção
                } else {
                    alert(response.data.message);
                }
            }
        };

        xhr.send("action=emu_add_widget&widget_name=" + encodeURIComponent(widgetName) +
            "&widget_type=" + encodeURIComponent(widgetType) +
            "&widget_options=" + encodeURIComponent(widgetOptions) +
            "&widget_link=" + encodeURIComponent(widgetLink) +
            "&widget_pos_x=" + encodeURIComponent(widgetPositionX) +
            "&widget_pos_y=" + encodeURIComponent(widgetPositionY) +
            "&widget_weight=" + encodeURIComponent(widgetWeight) +
            "&widget_color=" + encodeURIComponent(widgetColor) +
            "&widget_state_code=" + encodeURIComponent(widgetStateCode) +
            "&widget_custom_class=" + encodeURIComponent(widgetCustomClass) +
            "&post_id=" + postId);
    });

    // Função para limpar os campos de entrada após adicionar um widget
    function clearInputFields() {
        document.getElementById("widget-name").value = "";
        document.getElementById("widget-type").value = "";
        document.getElementById("widget-options").value = "";
        document.getElementById("widget-link").value = "";
        document.getElementById("widget-x").value = "";
        document.getElementById("widget-y").value = "";
        document.getElementById("widget-weight").value = "";
        document.getElementById("widget-color").value = "";
        document.getElementById("widget-state-code").value = "";
        document.getElementById("widget-custom-class").value = "";
    }

    // Remover evento
    function attachRemoveEventHandlers() {
        document.querySelectorAll(".remove-widget").forEach(function (button) {
            button.addEventListener("click", function () {
                var widgetIndex = this.getAttribute("data-widget-index");
                var widgetItem = this.closest(".emu-group");

                if (!confirm("Tem certeza que deseja excluir este widget?")) {
                    return;
                }

                var xhr = new XMLHttpRequest();
                var postId = document.querySelector(".emu-box-wrapper").getAttribute("data-post-id");

                xhr.open("POST", 'admin-ajax.php', true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            widgetItem.remove(); // Remove o widget da interface
                        } else {
                            alert(response.data.message);
                        }
                    }
                };

                xhr.send("action=emu_remove_widget&post_id=" + postId + "&widget_index=" + widgetIndex);
            });
        });
    }

    attachRemoveEventHandlers(); // Anexa os manipuladores de eventos ao carregar a página
});

// Atribui evento de blur para os inputs dentro de cada widget
document.querySelectorAll('.emu-group input[type="text"]').forEach(function(input) {
    input.addEventListener('blur', function() {
        // Obtém o índice do widget
        var widgetIndex = this.closest('.emu-group').getAttribute('data-widget-index');
        var fieldIndex = this.name.split('[')[2].split(']')[0]; // Extrai o índice do campo

        // Obtém o valor atual do campo e remove espaços extras
        var newValue = this.value.trim();

        // Obtém o ID do post (pode ser utilizado para atualizar dados específicos)
        var postId = document.querySelector(".emu-box-wrapper").getAttribute("data-post-id");

        // Cria uma requisição AJAX para salvar as alterações
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'admin-ajax.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Função chamada quando a requisição AJAX é concluída
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                // Verifica se a operação foi bem-sucedida e exibe a mensagem de sucesso ou erro
                if (response.success) {
                    console.log('Alteração salva com sucesso!', response.data.message, response.data);
                } else {
                    console.log('Erro ao salvar alteração:', response.data.message);
                }
            }
        };

        // Envia a requisição com os parâmetros necessários (ID do post, índice do widget, índice do campo, e o novo valor)
        xhr.send("action=emu_update_widget&post_id=" + postId + "&widget_index=" + widgetIndex + "&field_index=" + fieldIndex + "&new_value=" + encodeURIComponent(newValue));
    });
});
