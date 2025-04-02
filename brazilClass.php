<?php

require_once('includes/templates/brazil.php');

class EmuBrazilMap
{
    private $widgets;

    public function __construct($widgets = [], $activeStates = []) {
        require_once 'includes/statesWidgets.php';
        $this->widgets = $widgets;
    }

    public function addWidget($widget) {
        // Adiciona ao array de widgets
        $this->widgets[] = $widget;
    }    


    public function renderMap($activeStates) {
        $mapContent = ''; // Armazena o conteúdo de todos os estados
    
        // Renderiza os estados (e seus widgets aninhados)
        foreach ($this->states as $stateKey => $state) {
            
            // Wrapper do Estado
            $widgetsWrapper = sprintf(
                '<svg x="%d" y="%d" transform="scale(var(--map-scale))" class="widgets-container state-%s">',
                $state['position'][0] ?? '', // X com fallback para 0
                $state['position'][1] ?? '', // Y com fallback para 0
                strtolower($stateKey) // Nome do estado em minúsculas
            );
    
            foreach ($this->widgets as $widget) {
                if ($widget['code'] !== $stateKey) continue;

                $class = $widget['options']['class'] ?? '';
                $id = $widget['options']['id'] ?? '';
                $link = $widget['options']['link'] ?? null;

                $position = $widget['position'] ?? ['x' => '', 'y' => ''];

                $widgetsWrapper .= '<svg class="'.$class.'" style="overflow:visible">';

                
                
                // Renderiza imagem, se existir
                if (!empty($widget['src'])) {

                    if (isset($link['url']) && !empty($link['url'])) {

                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        
                        $rel = [];
                    
                        if ($link['is_external']) {
                            $rel[] = 'noopener noreferrer';
                        }
                        if ($link['nofollow']) {
                            $rel[] = 'nofollow';
                        }
                    
                        $relAttr = !empty($rel) ? ' rel="' . implode(' ', $rel) . '"' : '';
                    
                        $widgetsWrapper .= sprintf('<a xlink:href="%s"%s%s>', $link['url'], $target, $relAttr);
                    }

                    $width = $widget['options']['width'] ?? '30';
                    $height = $widget['options']['height'] ?? '30';

                    $widgetsWrapper .= sprintf(
                        '<image x="%d" y="%d" id="%s" width="%s" height="%s" href="%s" />',
                        $position['x'],
                        $position['y'],
                        $id,
                        $width,
                        $height,
                        $widget['src']
                    );

                    if ($link) {
                        $widgetsWrapper .= '</a>';
                    }
                }

                // Renderiza texto, se existir
                if (!empty($widget['content'])) {


                    if (isset($link['url']) && !empty($link['url'])) {

                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        
                        $rel = [];
                    
                        if ($link['is_external']) {
                            $rel[] = 'noopener noreferrer';
                        }
                        if ($link['nofollow']) {
                            $rel[] = 'nofollow';
                        }
                    
                        $relAttr = !empty($rel) ? ' rel="' . implode(' ', $rel) . '"' : '';
                    
                        $widgetsWrapper .= sprintf('<a xlink:href="%s"%s%s>', $link['url'], $target, $relAttr);
                    }

                    $fontSize = $widget['options']['fontSize'] ?? '';
                    $fontWeight = $widget['options']['fontWeight'] ?? '';
                    $color = $widget['options']['color'] ?? '';

                    $widgetsWrapper .= sprintf(
                        '<foreignObject><div>%s</div></foreignObject>',
                        $widget['content']
                    );

                    if ($link) {
                        $widgetsWrapper .= '</a>';
                    }

                }

                // fechando wrapper do widget
                $widgetsWrapper .= '</svg>';

            }
    
            // Fecha o wrapper do estado
            $widgetsWrapper .= '</svg>';
    
            // Adiciona ao mapa final
            $mapContent .= $widgetsWrapper;
        }
    
        // Passa o conteúdo completo para a função doBrazilMap()
        return doBrazilMap($mapContent, $activeStates);
    }

    private $states = [
        'AC' => ['name' => 'Acre', 'position' => [35, 125]],
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
        'RO' => ['name' => 'Rondônia', 'position' => [95, 140]],
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