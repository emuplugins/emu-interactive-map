<?php

require_once('includes/templates/brazil.php');

class EmuBrazilMap
{
    private $widgets;

    public function __construct($widgets = []) {
        require_once 'includes/statesWidgets.php';
        $this->widgets = $widgets;
    }

    public function addWidget($widget) {
        // Adiciona ao array de widgets
        $this->widgets[] = $widget;
    }    


    public function renderMap() {
        $mapContent = ''; // Armazena o conteúdo de todos os estados
    
        // Renderiza os estados (e seus widgets aninhados)
        foreach ($this->states as $stateKey => $state) {
            
            // Wrapper do Estado
            $widgetsWrapper = sprintf(
                '<svg x="%d" y="%d" transform="scale(var(--map-scale))" class="widgets-container state-%s">',
                $state['position'][0] ?? 0, // X com fallback para 0
                $state['position'][1] ?? 0, // Y com fallback para 0
                strtolower($stateKey) // Nome do estado em minúsculas
            );
    
            // Renderiza apenas os widgets pertencentes a este estado
            foreach ($this->widgets as $widget) {
                if ($widget['code'] !== $stateKey) continue; // Garante que o widget pertence ao estado atual
    
                $class = $widget['options']['class'] ?? '';
                $link = $widget['options']['link'] ?? null;
    
                // Garante que a posição existe, senão define valores padrão
                $position = isset($widget['position']) && is_array($widget['position'])
                    ? $widget['position']
                    : ['x' => 0, 'y' => 0];

                // Se houver link, abre a tag <a>
                if ($link) {
                    $widgetsWrapper .= sprintf('<a xlink:href="%s" class="link__'. $class .'">', $link);
                }
    
                // Renderiza o widget de texto
                if ($widget['type'] === 'text') {
                    $fontSize = $widget['options']['fontSize'] ?? '12px';
                    $fontWeight = $widget['options']['fontWeight'] ?? '600';
                    $color = $widget['options']['color'] ?? '';
    
                    $widgetsWrapper .= sprintf(
                        '<text x="%d" y="%d" class="state-label %s" style="font-size:%s; font-weight:%s; fill:%s;">%s</text>',
                        $position['x'] ?? 0, // Fallback para 0
                        $position['y'] ?? 0, // Fallback para 0
                        $class,
                        $fontSize,
                        $fontWeight,
                        $color,
                        $widget['content']
                    );
                }
                // Renderiza o widget de imagem
                elseif ($widget['type'] === 'image') {
                    $width = $widget['options']['width'] ?? '30';
                    $height = $widget['options']['height'] ?? '30';
    
                    $widgetsWrapper .= sprintf(
                        '<image x="%d" y="%d" width="%s" height="%s" href="%s"%s />',
                        $position['x'] ?? 0,
                        $position['y'] ?? 0,
                        $width,
                        $height,
                        $widget['content'],
                        !empty($class) ? ' class="' . trim($class) . '"' : ''
                    );
                }
                // Renderiza qualquer outro tipo de widget
                else {
                    $widgetsWrapper .= sprintf(
                        '<g transform="translate(%d, %d)"%s>%s</g>',
                        $position['x'] ?? 0,
                        $position['y'] ?? 0,
                        !empty($class) ? ' class="' . trim($class) . '"' : '',
                        $widget['content']
                    );
                }
    
                // Fecha a tag <a> se houver link
                if ($link) {
                    $widgetsWrapper .= '</a>';
                }
            }
    
            // Fecha o wrapper do estado
            $widgetsWrapper .= '</svg>';
    
            // Adiciona ao mapa final
            $mapContent .= $widgetsWrapper;
        }
    
        // Passa o conteúdo completo para a função doBrazilMap()
        return doBrazilMap($mapContent);
    }
        

    private $states = [
        'AC' => ['name' => 'Acre', 'position' => [35, 135]],
        'AL' => ['name' => 'Alagoas', 'position' => [335, 135]],
        'AP' => ['name' => 'Amapá', 'position' => [188, 37]],
        'AM' => ['name' => 'Amazonas', 'position' => [70, 90]],
        'BA' => ['name' => 'Bahia', 'position' => [285, 160]],
        'CE' => ['name' => 'Ceará', 'position' => [300, 93]],
        'DF' => ['name' => 'Distrito Federal', 'position' => [236, 189]],
        'ES' => ['name' => 'Espírito Santo', 'position' => [297, 230]],
        'GO' => ['name' => 'Goiás', 'position' => [207, 197]],
        'MA' => ['name' => 'Maranhão', 'position' => [243, 95]],
        'MT' => ['name' => 'Mato Grosso', 'position' => [150, 170]],
        'MS' => ['name' => 'Mato Grosso do Sul', 'position' => [150, 235]],
        'MG' => ['name' => 'Minas Gerais', 'position' => [250, 220]],
        'PA' => ['name' => 'Pará', 'position' => [180, 100]],
        'PB' => ['name' => 'Paraíba', 'position' => [337, 112]],
        'PR' => ['name' => 'Paraná', 'position' => [195, 275]],
        'PE' => ['name' => 'Pernambuco', 'position' => [317, 122]],
        'PI' => ['name' => 'Piauí', 'position' => [275, 120]],
        'RJ' => ['name' => 'Rio de Janeiro', 'position' => [280, 252]],
        'RN' => ['name' => 'Rio Grande do Norte', 'position' => [335, 99]],
        'RS' => ['name' => 'Rio Grande do Sul', 'position' => [164, 325]],
        'RO' => ['name' => 'Rondônia', 'position' => [90, 150]],
        'RR' => ['name' => 'Roraima', 'position' => [105, 35]],
        'SC' => ['name' => 'Santa Catarina', 'position' => [210, 300]],
        'SP' => ['name' => 'São Paulo', 'position' => [215, 250]],
        'SE' => ['name' => 'Sergipe', 'position' => [329, 143]],
        'TO' => ['name' => 'Tocantins', 'position' => [218, 145]],
    ];
    

}
/*
$widgetText = [
'code' => 'SP',
'content' => 'Conteúdo exemplo',
'type' => 'text',
'options' => [
    'fontSize' => '6.5em',
    'fontWeight' => '600',
    'color' => '#000',
    'link' => 'https://site.com',
    'class' => '',
],
'position' => [
    'y' => 0,
    'x' => 0,
]
];
$widgetImage = [
'code' => 'SP',
'content' => 'https://site.com/imagem.png',
'type' => 'image',
'options' => [
    'width' => '30',
    'height' => '30',
    'class' => '',
],
'position' => [
    'y' => 0,
    'x' => 0,
]
];
*/