<?php

function render_metabox_preview($post) {

    $widgets = get_post_meta($post->ID, 'widgets', true);

    if(empty($widgets)) {
        $widgets = array();
    }

?>


<style>

    /* GRUPOS DE CAMPOS*/
    .emu-box-wrapper {
        --input-height: 40px;
        --input-padding: 10px;
        --input-line-height: 1.5em;
        --input-font-size: 1em;
        position: relative;
    }

    .emu-td-wrapper {
        width: 100%!important;
    }

    .emu-box-wrapper {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        margin-top: 20px;
        gap:20px;
        display: flex;
        flex-direction: column;
        width: auto;
        max-width: 100%;

    }
    .emu-box-wrapper label, .emu-box-wrapper .emu-field-label {
        font-weight: 600!important;
        font-family: 'Poppins', sans-serif!important;
        color: #1b1b1f!important;
    }

    .emu-group {
        display: grid;
        gap: 25px;
        margin-bottom: 20px;
    }

    .emu-group-4-columns {
        grid-template-columns: repeat(4, 1fr);
    }

    .emu-group-2-columns {
        grid-template-columns: repeat(2, 1fr);
    }
    .emu-group-7-columns {
        grid-template-columns: repeat(7, 1fr);
    }

    .emu-group-8-columns {
        grid-template-columns: repeat(8, 1fr);
    }
    .emu-group-9-columns {
        grid-template-columns: repeat(9, 1fr);
    }

    .emu-group-10-columns {
        grid-template-columns: repeat(10, 1fr);
    }

    .emu-group-11-columns {
        grid-template-columns: repeat(11, 1fr);
    }

    .emu-group-selection-columns {
        grid-template-columns: 2.8fr 1fr;
    }

    .emu-row-item {
        display: flex;
        flex-direction: row;
        gap: 25px;
    }

    .emu-row-item {
        display: grid;
        flex-direction: column;
        gap: 25px;
        align-items: start;
        align-content: start;
    }

    .emu-box-wrapper  input, .emu-box-wrapper textarea {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
            
        font-family: 'Poppins', sans-serif;
        color: #1b1b1f;
        width: fit-content;
        min-width: 100%;
        resize: none;
        height: fit-content;
        field-sizing: content;
        min-height: var(--input-height);
        padding: var(--input-padding)!important;
        line-height: var(--input-line-height)!important;
        font-size: var(--input-font-size)!important;
    }
    .emu-box-wrapper button {
        min-height: var(--input-height)!important;
        padding: var(--input-padding)!important;
        line-height: var(--input-line-height)!important;
        font-size: var(--input-font-size)!important;
    }

    .emu-button{
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 1em;
        padding: 10px;
        border-radius: 5px;
        border: none!important;
        cursor: pointer!important;
        transition: background-color 0.3s ease;
    }
    .emu-button-default{
        background-color: #005db4!important;
        color: #fff!important;
    }

    .emu-button-default:hover {
        background-color: #004a99!important;
        color: #fff!important;
    }
    .emu-button-sucess:hover {
        background-color: #006b38!important;
        color: #fff!important;
    }

    .emu-button-danger {
        background-color: #c42a43!important;
        color: #fff!important;
    }

    .emu-button-danger:hover {
        background-color: #a12238!important;
        color: #fff!important;
    }

    .emu-row-item-2-columns {
        grid-column: span 2!important;
    }

    .emu-message{
        margin:0;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid
    }

    .emu-success-message {
        color: #008a49;
        background-color: #dcfce4;
        border-color: #008000;
    }
    .emu-error-message {
        color: #ff0000;
        background-color: #f8d7da;
        border-color: #ff0000;
    }
    .emu-info-message {
        color: #004085;
        background-color: #cfe2ff;
        border-color: #004085;
    }
    .emu-list-wrapper {
        display: grid;
        gap: 25px;
    }


</style>

<tr class="emu-tr-wrapper" style="display: flex; width: auto; max-width: 100%;">

    <td  class="emu-td-wrapper" style="width: 100%; display: flex;  padding: 0px!important; ">

        <div class="emu-box-wrapper" data-post-id="<?php echo esc_attr($post->ID); ?>">

            <label class="emu-field-label">

            Adicionar Widget:

            </label>


            <div class="emu-group emu-group-11-columns" style="margin-bottom: 0px!important;">

            <div class="emu-row-item">
                <label for="widget-name">Conteúdo</label>
                <input type="text" id="widget-name" placeholder="Conteúdo" />
                <input type="hidden" id="widget-id" value="<?php echo esc_attr(json_encode($widgets)); ?>" />
            </div>

            <div class="emu-row-item">
                <label for="widget-type">Tipo</label>
                <select id="widget-type" placeholder="Tipo">
                    <option value="text">Texto</option>
                    <option value="image">Imagem</option>
                </select>
            </div>

            <div class="emu-row-item">
                <label for="widget-options">Opções</label>
                <input type="text" id="widget-options" placeholder="Opções" />
            </div>

            <div class="emu-row-item">
                <label for="widget-link">Link</label>
                <input type="text" id="widget-link" placeholder="Link" />
            </div>

            <div class="emu-row-item">
                <label for="widget-position-x">Posição X</label>
                <input type="text" id="widget-position-x" placeholder="Posição X" />
            </div>

            <div class="emu-row-item">
                <label for="widget-position-y">Posição Y</label>
                <input type="text" id="widget-position-y" placeholder="Posição Y" />
            </div>

            <div class="emu-row-item">
                <label for="widget-weight">Peso</label>
                <input type="number" id="widget-weight" placeholder="Peso" step="100" value="600" />
            </div>

            <div class="emu-row-item">
                <label for="widget-color">Cor</label>
                <input type="color" id="widget-color" placeholder="Cor" />
            </div>

            <div class="emu-row-item">
                <label for="widget-state-code">Código do Estado</label>
                <select id="widget-state-code" placeholder="Código do Estado">
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MG">MG</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="PR">PR</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="RS">RS</option>
                    <option value="SC">SC</option>
                    <option value="SE">SE</option>
                    <option value="SP">SP</option>
                    <option value="TO">TO</option>
                </select>
            </div>


            <div class="emu-row-item">
                <label for="widget-custom-class">Classe Personalizada</label>
                <input type="text" id="widget-custom-class" placeholder="Classe Personalizada" />
            </div>

            <div class="emu-row-item">
                <button type="button" id="add-widget" class="reload-map-button button emu-button emu-button-default""><?php _e('Adicionar Novo', 'my_domain'); ?></button>
            </div>
                
            </div>

            <p id="widget-status" class="emu-message emu-success-message emu-row-item emu-row-item-2-columns"><?php _e('Widget adicionado!', 'my_domain'); ?></p>

        </div>

        <div class="emu-box-wrapper">

            <label for="" class="emu-field-label">

            Widgets cadastrados:

            </label>

            <div id="widgets-list" class="emu-list-wrapper">

            <?php  
            if(!is_array($widgets)) {
                $widgets = array();
            }

            foreach ($widgets as $index => $widget) : 
            
            ?>

    <div class="emu-group emu-group-11-columns" style="margin-bottom: 0px!important;">
    
            <!-- Conteúdo do Widget -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][content]" value="<?php echo esc_attr($widget[0]); ?>" placeholder="Conteúdo do widget">
        </div>

        <!-- Tipo do Widget -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][type]" value="<?php echo esc_attr($widget[1]); ?>" placeholder="Tipo do widget">
        </div>

        <!-- Opções -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][options]" value="<?php echo esc_attr($widget[2]); ?>" placeholder="Opções">
        </div>

        <!-- Link -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][link]" value="<?php echo esc_attr($widget[3]); ?>" placeholder="Link">
        </div>

        <!-- Posição X -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][x]" value="<?php echo esc_attr($widget[4]); ?>" placeholder="Posição X">
        </div>

        <!-- Posição Y -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][y]" value="<?php echo esc_attr($widget[5]); ?>" placeholder="Posição Y">
        </div>

        <!-- Peso -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][weight]" value="<?php echo esc_attr($widget[6]); ?>" placeholder="Peso">
        </div>

        <!-- Cor -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][color]" value="<?php echo esc_attr($widget[7]); ?>" placeholder="Cor">
        </div>

        <!-- Código do Estado -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][state_code]" value="<?php echo esc_attr($widget[8]); ?>" placeholder="Código do Estado">
        </div>

        <!-- Classe Personalizada -->
        <div class="emu-row-item">
            <input type="text" name="widgets[<?php echo $index; ?>][custom_class]" value="<?php echo esc_attr($widget[9]); ?>" placeholder="Classe Personalizada">
        </div>


            <!-- Remover Widget -->
            <div class="emu-row-item">
                <button type="button" class="reload-map-button remove-widget button emu-button emu-button-danger" data-id="<?php echo esc_attr($widget['0']); ?>" data-widget-index="<?php echo esc_attr($index); ?>">Remover</button>
            </div>

    </div> 

<?php endforeach; ?>


            </div>

            

        </div>

        <div class="emu-box-wrapper">

                <label for="" class="emu-field-label">
                    Preview do mapa:
                </label>

                <style>
                    .brazil-map {
                        width: 500px!important;
                        height: 100%!important;
                    }
                </style>

                    <div class="preview-map">
                        <?php 
                            if ($post->ID) {
                                // Aqui o mapa será renderizado
                                echo do_shortcode('[interactive_map post_id="' . $post->ID . '"]');
                            } else {
                                echo '<p>Salve o post primeiro para ver o preview do mapa.</p>';
                            }
                        ?>
                    </div>


            </div>
        
    </td>

</tr>


<script>
document.addEventListener("DOMContentLoaded", function () {

    var widgetsList = document.getElementById("widgets-list");

    // Adicionar novo widget
    document.getElementById("add-widget").addEventListener("click", function () {
        var widgetName = document.getElementById("widget-name")?.value.trim();
        var widgetType = document.getElementById("widget-type")?.value.trim();
        var widgetOptions = document.getElementById("widget-options")?.value.trim();
        var widgetLink = document.getElementById("widget-link")?.value.trim();
        var widgetPositionX = document.getElementById("widget-position-x")?.value.trim();
        var widgetPositionY = document.getElementById("widget-position-y")?.value.trim();
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
        xhr.open("POST", "<?php echo admin_url('admin-ajax.php'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    var newWidgetDiv = document.createElement("div");
                    newWidgetDiv.className = "emu-group emu-group-9-columns";

                    // Adiciona o índice do widget como um atributo
                    newWidgetDiv.setAttribute("data-widget-index", response.data.widget_index);

                    newWidgetDiv.innerHTML = `
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][0]" value="${response.data.widget_name}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][1]" value="${response.data.widget_type}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][2]" value="${response.data.widget_options}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][3]" value="${response.data.widget_link}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][4]" value="${response.data.widget_pos_x}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][5]" value="${response.data.widget_pos_y}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][6]" value="${response.data.widget_weight}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][7]" value="${response.data.widget_color}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][8]" value="${response.data.widget_state_code}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <input type="text" name="widgets[${response.data.widget_index}][9]" value="${response.data.widget_custom_class}" readonly>
                        </div>
                        <div class="emu-row-item">
                            <button type="button" onclick="reloadMap()" class="reload-map-button remove-widget button emu-button emu-button-danger" data-widget-index="${response.data.widget_index}">
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
        document.getElementById("widget-position-x").value = "";
        document.getElementById("widget-position-y").value = "";
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

                xhr.open("POST", "<?php echo admin_url('admin-ajax.php'); ?>", true);
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

// Função para recarregar o mapa via AJAX
function reloadMap() {
    
    var previewMap = document.querySelector('.preview-map');

    var postId = <?php echo $post->ID; ?>; // Pega o ID do post atual
    var reloadButton = document.querySelectorAll('.reload-map-button');
    // Dados para a requisição AJAX
    var data = {
        action: 'reload_map',
        post_id: postId
    };

    // Realiza a requisição AJAX
    jQuery.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
        // Atualiza o conteúdo da div com a resposta do AJAX
        previewMap.innerHTML = response;
    });

    reloadButton.forEach(button => {
        button.addEventListener('click', reloadMap);
    });

}

</script>

<?php

}

add_action('edit_form_after_title', 'render_metabox_preview');

// ============================== ADICIONAR WIDGET ==============================
function emu_add_widget() {
    // Verifica permissão
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permissão negada.', 'my_domain')));
        return;
    }

    // Verifica se o ID do post e o nome do widget foram enviados
    if (!isset($_POST['post_id']) || empty($_POST['post_id']) || !isset($_POST['widget_name']) || empty($_POST['widget_name'])) {
        wp_send_json_error(array('message' => __('Dados inválidos.', 'my_domain')));
        return;
    }

    $post_id = intval($_POST['post_id']);
    $widget_name = sanitize_text_field($_POST['widget_name']);
    $widget_type = sanitize_text_field($_POST['widget_type']);
    $widget_options = sanitize_text_field($_POST['widget_options']);
    $widget_link = sanitize_text_field($_POST['widget_link']);
    $widget_pos_x = sanitize_text_field($_POST['widget_pos_x']);
    $widget_pos_y = sanitize_text_field($_POST['widget_pos_y']);
    $widget_weight = sanitize_text_field($_POST['widget_weight']);
    $widget_color = sanitize_text_field($_POST['widget_color']);
    $widget_state_code = sanitize_text_field($_POST['widget_state_code']);
    $widget_custom_class = sanitize_text_field($_POST['widget_custom_class']);
    

    // Recupera widgets existentes
    $widgets = get_post_meta($post_id, 'widgets', true);
    if (!is_array($widgets)) {
        $widgets = array();
    }

    // Verifica se o widget já existe
    foreach ($widgets as $widget) {
        if ($widget['0'] === $widget_name) {
            wp_send_json_error(array('message' => __('Este widget já foi adicionado.', 'my_domain')));
            return;
        }
    }

    // Adiciona o novo widget como um array com índices contínuos
    $new_widget = array(
        $widget_name,         // 0 => widget_name
        $widget_type,         // 1 => widget_type
        $widget_options,      // 2 => widget_options
        $widget_link,         // 3 => widget_link
        $widget_pos_x,   // 4 => widget_position_x
        $widget_pos_y,   // 5 => widget_position_y
        $widget_weight,       // 6 => widget_weight
        $widget_color,        // 7 => widget_color
        $widget_state_code,   // 8 => widget_state_code
        $widget_custom_class  // 9 => widget_custom_class
    );

    $widgets[] = $new_widget;  // Adiciona o widget ao array

    // Atualiza o post meta com o array de widgets
    $update_result = update_post_meta($post_id, 'widgets', $widgets);
    
    if (!$update_result) {
        wp_send_json_error(array('message' => __('Erro ao salvar widget.', 'my_domain')));
        return;
    }

    // Retorna o índice do widget adicionado
    $widget_index = count($widgets) - 1;

    wp_send_json_success(array(
        'message' => __('Widget adicionado com sucesso!', 'my_domain'),
        'widget' => $new_widget,
        'widget_index' => $widget_index
    ));
}
add_action('wp_ajax_emu_add_widget', 'emu_add_widget');


// ============================== REMOVER WIDGET ==============================
function emu_remove_widget() {
    // Verifica permissão
    if (!current_user_can('edit_posts')) {
        wp_send_json_error(array('message' => __('Permissão negada.', 'my_domain')));
        return;
    }

    // Verifica se os parâmetros foram enviados
    if (!isset($_POST['post_id']) || empty($_POST['post_id']) || !isset($_POST['widget_index'])) {
        wp_send_json_error(array('message' => __('Dados inválidos.', 'my_domain')));
        return;
    }

    $post_id = intval($_POST['post_id']);
    $widget_index = intval($_POST['widget_index']);
    
    // Recupera widgets existentes
    $widgets = get_post_meta($post_id, 'widgets', true);
    if (!is_array($widgets) || !isset($widgets[$widget_index])) {
        wp_send_json_error(array('message' => __('Widget não encontrado.', 'my_domain')));
        return;
    }

    // Remove o widget específico com o índice fornecido
    array_splice($widgets, $widget_index, 1);

    // Reindexa o array para garantir que os índices sejam contínuos (caso seja necessário)
    $widgets = array_values($widgets);

    // Atualiza o post meta com o array atualizado
    $update_result = update_post_meta($post_id, 'widgets', $widgets);

    if (!$update_result) {
        wp_send_json_error(array('message' => __('Erro ao remover widget.', 'my_domain')));
        return;
    }

    wp_send_json_success(array(
        'message' => __('Widget removido com sucesso!', 'my_domain'),
        'widgets' => $widgets
    ));
}
add_action('wp_ajax_emu_remove_widget', 'emu_remove_widget');


function save_widget_metabox_data($post_id) {
    // Verifique se o post é válido e não está sendo salvo automaticamente
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

    // Verifique se o usuário tem permissão para salvar os dados
    if (!current_user_can('edit_post', $post_id)) return $post_id;

    // Salve os dados do metabox (substitua os nomes dos campos conforme necessário)
    if (isset($_POST['widgets'][$post_id]['content'])) {
        update_post_meta($post_id, 'widgets', sanitize_text_field($_POST['widgets'][$post_id]['content']));
    }
    // Repita o processo para os outros campos conforme necessário

    return $post_id;
}


add_action('save_post', 'save_widget_metabox_data');








// Função para manipular o recarregamento do mapa via AJAX
function handle_reload_map() {
    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        
        // Executa o shortcode com o post_id
        echo do_shortcode('[interactive_map post_id="' . $post_id . '"]');
    }
    die(); // Termina a execução da requisição AJAX
}

// Registra a ação do AJAX no WordPress
add_action('wp_ajax_reload_map', 'handle_reload_map');
add_action('wp_ajax_nopriv_reload_map', 'handle_reload_map');
