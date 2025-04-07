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
            //  transform="scale(var(--map-scale))"
            // Wrapper do Estado
            $widgetsWrapper = sprintf(
                '<svg x="%d" y="%d" class="widgets-container state-%s">',
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

                $widgetsWrapper .= '<svg class="'.$class.'" style="overflow:visible;">';

                $widgetsWrapper .= '<foreignobject style="width:1px; height:1px; overflow:visible; transform:translate(var(--translate-foreing-x),var(--translate-foreing-y))">';
                
                // Renderiza imagem, se existir
                if (!empty($widget['src'])) {

                    if (isset($link['url']) && !empty($link['url'])) {

                        $target = $link['is_external'] ? ' target="_blank"' : '';
                       
                        $rel = [];
                        $arialabel = '';
                        $title = '';

                        // tratando do rel, se for bricks ou elementor
                        if ($link['is_Bricks']) {

                            $rel = [];

                            if ($link['rel']) {
                                $rel[] = $link['rel'];
                            }
                            if ($link['arialabel']) {
                                $arialabel = 'aria-label="' . $link['arialabel'] . '"';
                            }

                            echo $link['arialabel'];

                            if ($link['title']) {
                                $title = 'title="' . $link['title'] . '"';
                            }

                            $relAttr = !empty($rel) ? ' rel="' . implode(' ', $rel) . '"' : '';

                        }else{

                            if ($link['is_external']) {
                                $rel[] = 'noopener noreferrer';
                            }
                            if ($link['nofollow']) {
                                $rel[] = 'nofollow';
                            }
                             
                          
                            $relAttr = !empty($rel) ? ' rel="' . implode(' ', $rel) . '"' : '';
                            
                        }

                        $widgetsWrapper .= sprintf('<a href="%s" %s %s %s %s>', $link['url'], $target, $relAttr, $arialabel, $title);
                        
                    }

                    $width = $widget['options']['width'] ?? 'fit-content';
                    $height = $widget['options']['height'] ?? '30';

                    if($widget['options']['titleHover']){
                        $widgetsWrapper .= '<div class="widget-image show-title">';
                    }else{
                        $widgetsWrapper .= '<div class="widget-image">';
                    }

                    $widgetsWrapper .= '';

                    $widgetsWrapper .= sprintf(
                        '<image x="%d" y="%d" id="%s" style="min-width:%s" height="%s" src="%s" />',
                        $position['x'],
                        $position['y'],
                        $id,
                        $width,
                        $height,
                        $widget['src']
                    );
                    $widgetsWrapper .= '</div>';


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
                    
                        $widgetsWrapper .= sprintf('<a href="%s"%s%s>', $link['url'], $target, $relAttr);
                    }

                    $styles = [];

                    // Adiciona os estilos somente se estiverem definidos
                    if (!empty($widget['options']['fontSize'])) {
                        $styles[] = 'font-size:' . $widget['options']['fontSize'] . ';';
                    }

                    // if (!empty($widget['options']['fontWeight'])) {
                    //     $styles[] = 'font-weight:;';
                    // }

                    // if (!empty($widget['options']['color'])) {
                    //     $styles[] = 'color:' . $widget['options']['color'] . ';';
                    // }

                    // Junta os estilos em uma única string
                    $style = implode(' ', $styles);

                    $widgetsWrapper .= sprintf(
                        '<div class="widget-content"><div style="%s"><div style="min-width:fit-content">%s</div></div></div>',
                        $style, $widget['content']
                    );

                    if ($link) {
                        $widgetsWrapper .= '</a>';
                    }


                }

                $widgetsWrapper .= '</foreignobject>';

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
        'AC' => ['name' => 'Acre', 'position' => [35, 127]],
        'AL' => ['name' => 'Alagoas', 'position' => [337, 129]],
        'AP' => ['name' => 'Amapá', 'position' => [192, 30]],
        'AM' => ['name' => 'Amazonas', 'position' => [80, 80]],
        'BA' => ['name' => 'Bahia', 'position' => [285, 154]],
        'CE' => ['name' => 'Ceará', 'position' => [305, 90]],
        'DF' => ['name' => 'Distrito Federal', 'position' => [236.7, 183.1]],
        'ES' => ['name' => 'Espírito Santo', 'position' => [300, 215]],
        'GO' => ['name' => 'Goiás', 'position' => [210, 190]],
        'MA' => ['name' => 'Maranhão', 'position' => [249, 85]],
        'MT' => ['name' => 'Mato Grosso', 'position' => [158, 160]],
        'MS' => ['name' => 'Mato Grosso do Sul', 'position' => [168, 228]],
        'MG' => ['name' => 'Minas Gerais', 'position' => [258, 210]],
        'PA' => ['name' => 'Pará', 'position' => [180, 90]],
        'PB' => ['name' => 'Paraíba', 'position' => [339.5, 105]],
        'PR' => ['name' => 'Paraná', 'position' => [198, 269]],
        'PE' => ['name' => 'Pernambuco', 'position' => [317, 116]],
        'PI' => ['name' => 'Piauí', 'position' => [279, 112]],
        'RJ' => ['name' => 'Rio de Janeiro', 'position' => [280, 246]],
        'RN' => ['name' => 'Rio Grande do Norte', 'position' => [335, 94]],
        'RS' => ['name' => 'Rio Grande do Sul', 'position' => [180, 320]],
        'RO' => ['name' => 'Rondônia', 'position' => [95, 140]],
        'RR' => ['name' => 'Roraima', 'position' => [110, 23]],
        'SC' => ['name' => 'Santa Catarina', 'position' => [210, 295]],
        'SP' => ['name' => 'São Paulo', 'position' => [225, 245]],
        'SE' => ['name' => 'Sergipe', 'position' => [330, 136]],
        'TO' => ['name' => 'Tocantins', 'position' => [226, 139]],
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