<?php 

class State 
{
    private $name, $code, $widgets = [];

    public function __construct($name, $code = '') {
        $this->name = $name;
        $this->code = $code;
    }

    public function addWidget(Widget $widget) {
        $this->widgets[] = $widget;
    }

    public function renderWidgets() {
        $positions = [
            'AC' => [35, 135],    // Acre
            'AL' => [335, 135],    // Alagoas
            'AP' => [188, 37],     // Amapá
            'AM' => [70, 90],    // Amazonas
            'BA' => [285, 160],    // Bahia
            'CE' => [300, 93],    // Ceará
            'DF' => [236, 189],    // Distrito Federal
            'ES' => [297, 230],    // Espírito Santo
            'GO' => [207, 197],    // Goiás
            'MA' => [243, 95],    // Maranhão
            'MT' => [150, 170],    // Mato Grosso
            'MS' => [150, 235],    // Mato Grosso do Sul
            'MG' => [250, 220],    // Minas Gerais
            'PA' => [180, 100],    // Pará
            'PB' => [337, 112],    // Paraíba
            'PR' => [195, 275],    // Paraná
            'PE' => [317, 122],    // Pernambuco
            'PI' => [275, 120],    // Piauí
            'RJ' => [280, 252],    // Rio de Janeiro
            'RN' => [335, 99],    // Rio Grande do Norte
            'RS' => [164, 325],    // Rio Grande do Sul
            'RO' => [90, 150],    // Rondônia
            'RR' => [105, 35],     // Roraima
            'SC' => [210, 300],    // Santa Catarina
            'SP' => [215, 250],    // São Paulo
            'SE' => [329, 143],    // Sergipe
            'TO' => [218, 145]     // Tocantins
        ];
    
        $pos = $positions[$this->code] ?? [0, 0];
        
        if (empty($this->widgets)) {
            return '';
        }
    
        $output = sprintf(
            '<svg x="%d" y="%d" transform="scale(var(--map-scale))" class="widgets-container state-%s">', 
            $pos[0], 
            $pos[1],
            strtolower($this->code)
        );
        foreach ($this->widgets as $widget) {
            $output .= $widget->render();
        }
        $output .= '</svg>';
        
        return $output;
    }
}
