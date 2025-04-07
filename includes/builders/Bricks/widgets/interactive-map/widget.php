<?php 
// element-test.php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Bricks\Helpers;
class EmuInteractiveMap_Bricks extends \Bricks\Element {
  
	// Element properties
  public $category     = 'general'; // Use predefined element category 'general'
  public $name         = 'emu-interactive-map'; // Make sure to prefix your elements
  public $icon         = 'ti-bolt-alt'; // Themify icon font class
  public $css_selector = 'emu-interactive-map-wrapper'; // Default CSS selector

  // Return localised element label
  public function get_label() {
    return esc_html__( 'Emu Interactive Map', 'bricks' );
  }

  // Set builder control groups
  public function set_control_groups() {

    $this->control_groups['widgets'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'Widgets', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];
    
    $this->control_groups['states'] = [ // Unique group identifier (lowercase, no spaces)
      'title' => esc_html__( 'States', 'bricks' ), // Localized control group title
      'tab' => 'content', // Set to either "content" or "style"
    ];

    $this->control_groups['settings'] = [
      'title' => esc_html__( 'Settings', 'bricks' ),
      'tab' => 'content',
    ];
  }
 
  // Set builder controls
  public function set_controls() {

    $this->controls['widgetsRepeater'] = [
      'tab' => 'content',
      'group' => 'widgets',
      'label' => esc_html__( 'Repeater', 'bricks' ),
      'type' => 'repeater',
	    'selector'      => 'fieldId',
      'titleProperty' => 'title', // Default 'title'
      'default' => [
        [
          'title' => 'Marker',
          'titleHover' => true,
          'imageSize' => '20px',
          'imagePositionY' => '-5px',
          'imagePositionX' => '13px',
          'titlePosY' => '0px',
          'titlePosX' => '0px',
          'id' => Helpers::generate_random_id( false ),
        ]
      ],
      'placeholder' => esc_html__( 'Widget', 'bricks' ),
      'fields' => [
        'state' => [
          'label' => esc_html__( 'state', 'bricks' ),
          'type' => 'select',
          'default' => 'SP',
          'options' => [
              'AC' => esc_html__( 'Acre', 'textdomain' ),
              'AL' => esc_html__( 'Alagoas', 'textdomain' ),
              'AP' => esc_html__( 'Amapá', 'textdomain' ),
              'AM' => esc_html__( 'Amazonas', 'textdomain' ),
              'BA' => esc_html__( 'Bahia', 'textdomain' ),
              'CE' => esc_html__( 'Ceará', 'textdomain' ),
              'DF' => esc_html__( 'Distrito Federal', 'textdomain' ),
              'ES' => esc_html__( 'Espírito Santo', 'textdomain' ),
              'GO' => esc_html__( 'Goiás', 'textdomain' ),
              'MA' => esc_html__( 'Maranhão', 'textdomain' ),
              'MT' => esc_html__( 'Mato Grosso', 'textdomain' ),
              'MS' => esc_html__( 'Mato Grosso do Sul', 'textdomain' ),
              'MG' => esc_html__( 'Minas Gerais', 'textdomain' ),
              'PA' => esc_html__( 'Pará', 'textdomain' ),
              'PB' => esc_html__( 'Paraíba', 'textdomain' ),
              'PR' => esc_html__( 'Paraná', 'textdomain' ),
              'PE' => esc_html__( 'Pernambuco', 'textdomain' ),
              'PI' => esc_html__( 'Piauí', 'textdomain' ),
              'RJ' => esc_html__( 'Rio de Janeiro', 'textdomain' ),
              'RN' => esc_html__( 'Rio Grande do Norte', 'textdomain' ),
              'RS' => esc_html__( 'Rio Grande do Sul', 'textdomain' ),
              'RO' => esc_html__( 'Rondônia', 'textdomain' ),
              'RR' => esc_html__( 'Roraima', 'textdomain' ),
              'SC' => esc_html__( 'Santa Catarina', 'textdomain' ),
              'SP' => esc_html__( 'São Paulo', 'textdomain' ),
              'SE' => esc_html__( 'Sergipe', 'textdomain' ),
              'TO' => esc_html__( 'Tocantins', 'textdomain' ),
          ],
          'clearable' => false,
        ],
        'posX' => [
          'label' => esc_html__('Position X', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -200,
              'max' => 200,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => '--translate-foreing-x',
            ],
          ],
          'default' => '0px'
        ],

        'posY' => [
          'label' => esc_html__('Position Y', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -200,
              'max' => 200,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => '--translate-foreing-y',
            ],
          ],
          'default' => '0px'
        ],
        'image' => [
          'label' => esc_html__( 'Image', 'bricks' ),
          'type' => 'image',
        ],
        'imageSize' => [
          'label' => esc_html__('Image Size', 'bricks'),
          'type'  => 'number',
          'units' => true,
          'css' => [
            [
              'property' => 'height',
              'selector' => 'div.widget-image, img',
            ],
          ],
          'default' => '50px',
        ],

        'imagePositionY' => [
          'label' => esc_html__('Position y', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -200,
              'max' => 200,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => '--translate-image-y',
            ],
          ],
        ],
        'imagePositionX' => [
          'label' => esc_html__('Position x', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -200,
              'max' => 200,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => '--translate-image-x',
            ],
          ],
        ],
        'title' => [
          'label' => esc_html__( 'Title', 'bricks' ),
          'type' => 'text',
        'css' => [
          [
                'property' => 'content',
                'selector' => '.widget-image:after',
                'value' => '"%s"',
              ],
          ]
        ],
        'titleHover' => [
          'label' => esc_html__( 'Show title ever', 'bricks' ),
          'type' => 'checkbox',
          'inline' => true,
          'small' => true,
          'default' => true,
        ],
        'titlePosX' => [
          'label' => esc_html__('Title Position X', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -100,
              'max' => 100,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => 'left',
              'selector' => '.widget-image:after',
            ],
          ],
          'default'       => ['50px']
        ],

        'titlePosY' => [
          'label' => esc_html__('Title Position Y', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -50,
              'max' => 50,
              'step' => 1,
            ],
          ],
          'css' => [
            [
              'property' => 'bottom',
              'selector' => '.widget-image:after',
            ],
          ],
          'default'       => ['0px']
        ],
        'link' => [
          'label' => esc_html__( 'Link', 'bricks' ),
          'pasteStyles' => false,
          'type' => 'link',
        ],
      ],
    ];

    $this->controls['titleTypography'] = [
      'tab' => 'content',
      'group' => 'widgets',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.widget-image:after',
        ],
      ],
      'default' => [
        'color' => [
          'hex' => '#fff',
        ],
      ],
      'inline' => true,
    ];

    $this->controls['titleBorder'] = [
      'tab' => 'content',
      'group' => 'widgets',
      'label' => esc_html__( 'Title border', 'bricks' ),
      'type' => 'border',
      'css' => [
        [
          'property' => 'border',
          'selector' => '.widget-image:after',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'radius' => [
          'top' => 3,
          'right' => 3,
          'bottom' => 3,
          'left' => 3,
        ],
      ],
    ];

    $this->controls['widgetBackground'] = [ // Setting key
      'tab' => 'content',
      'group' => 'widgets',
      'label' => esc_html__( 'Background', 'bricks' ),
      'type' => 'background',
      'css' => [
        [
          'property' => 'background',
          'selector' => '.widget-image:after',
        ],
      ],
      'exclude' => [
        // 'color',
        'image',
        'parallax',
        'attachment',
        'position',
        'positionX',
        'positionY',
        'repeat',
        'size',
        'custom',
        'videoUrl',
        'videoScale',
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'color' => [
          'hex' => '#000000c9',
        ],
      ],
    ];

    $this->controls['titlePadding'] = [
      'tab' => 'content',
      'group' => 'widgets',
      'label' => esc_html__( 'Title padding', 'bricks' ),
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.widget-image:after',
        ]
      ],
      'default' => [
        'top' => '3px',
        'right' => '7px',
        'bottom' => '3px',
        'left' => '7px',
      ]
    ];

    $this->controls['stateCodeTypography'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Typography', 'bricks' ),
      'type' => 'typography',
      'css' => [
        [
          'property' => 'typography',
          'selector' => '.default div.widget-content > div > div',
        ],
      ],
      'default' => [
        'color' => [
          'hex' => '#fff',
        ],
      ],
      'inline' => true,
    ];


    $this->controls['stateCodeOffset'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
          'label' => esc_html__('Offset', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => -5,
              'max' => 10,
              'step' => 0.1,
            ],
          ],
          'css' => [
            [
              'property' => 'transform',
              'selector' => '.default div.widget-content > div',
              'value' => 'translate(%s, %s);'
            ],
          ],
          'default' => '0'
        ];

    $this->controls['stateBackgroundColor'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Background Color', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'fill',
          'selector' => '.state',
        ],
      ],
      'default' => [
        'color' => [
          'hex' => '#000000c9',
        ],
      ],
    ];

    $this->controls['stateBorderSize'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__('Border Size', 'bricks'),
      'type'  => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'stroke-width',
          'selector' => '.state',
        ],
      ],
      'default' => '0.5px',
    ];

    $this->controls['stateBorderColor'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Border Color', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'stroke',
          'selector' => '.state',
        ],
      ],
      'default' => [
        'color' => [
          'hex' => '#000000c9',
        ],
      ],
    ];

    // ON HOVER

    $this->controls['stateBackgroundColorHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Hover Background', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'fill',
          'selector' => '.state:hover',
        ],
      ],
    ];

    $this->controls['stateBorderSizeHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__('Hover Border Size', 'bricks'),
      'type'  => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'stroke-width',
          'selector' => '.state:hover',
        ],
      ],
    ];

    $this->controls['stateBorderColorHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Hover Border Color', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'stroke',
          'selector' => '.state:hover',
        ],
      ],
    ];

    // ON active

    $this->controls['stateBackgroundColorActive'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Active Background', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'fill',
          'selector' => '.state.active',
        ],
      ],
    ];

    $this->controls['stateBorderSizeActive'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__('Active Border Size', 'bricks'),
      'type'  => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'stroke-width',
          'selector' => '.state.active',
        ],
      ],
    ];

    $this->controls['stateBorderColorActive'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Active Border Color', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'stroke',
          'selector' => '.state.active',
        ],
      ],
    ];

    // ON active hover

    $this->controls['stateBackgroundColorActiveHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Hover Background', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'fill',
          'selector' => '.state.active:hover',
        ],
      ],
    ];

    $this->controls['stateBorderSizeActiveHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__('Hover Border Size', 'bricks'),
      'type'  => 'number',
      'units' => true,
      'css' => [
        [
          'property' => 'stroke-width',
          'selector' => '.state.active:hover',
        ],
      ],
    ];

    $this->controls['stateBorderColorActiveHover'] = [ // Setting key
      'tab' => 'content',
      'group' => 'states',
      'label' => esc_html__( 'Hover Border Color', 'bricks' ),
      'type' => 'color',
      'css' => [
        [
          'property' => 'stroke',
          'selector' => '.state.active:hover',
        ],
      ],
    ];

    // settings

    $this->controls['Map Size'] = [ // Setting key
      'tab' => 'content',
      'group' => 'settings',
          'label' => esc_html__('Map Size', 'bricks'),
          'type'  => 'slider',
          'units' => [
            'px' => [
              'min' => 0,
              'max' => 5,
              'step' => 0.1,
            ],
          ],
          'css' => [
            [
              'property' => '--map-scale',
              'selector' => '.brazil-map'
            ],
          ],
          'default' => '2.1'
        ];

        $this->controls['activeStates'] = [
          'tab' => 'content',
          'group' => 'settings',
          'label' => esc_html__( 'Active States', 'bricks' ),
          'type' => 'select',
          'options' => [
                    'AC' => esc_html__( 'Acre', 'textdomain' ),
                    'AL' => esc_html__( 'Alagoas', 'textdomain' ),
                    'AP' => esc_html__( 'Amapá', 'textdomain' ),
                    'AM' => esc_html__( 'Amazonas', 'textdomain' ),
                    'BA' => esc_html__( 'Bahia', 'textdomain' ),
                    'CE' => esc_html__( 'Ceará', 'textdomain' ),
                    'DF' => esc_html__( 'Distrito Federal', 'textdomain' ),
                    'ES' => esc_html__( 'Espírito Santo', 'textdomain' ),
                    'GO' => esc_html__( 'Goiás', 'textdomain' ),
                    'MA' => esc_html__( 'Maranhão', 'textdomain' ),
                    'MT' => esc_html__( 'Mato Grosso', 'textdomain' ),
                    'MS' => esc_html__( 'Mato Grosso do Sul', 'textdomain' ),
                    'MG' => esc_html__( 'Minas Gerais', 'textdomain' ),
                    'PA' => esc_html__( 'Pará', 'textdomain' ),
                    'PB' => esc_html__( 'Paraíba', 'textdomain' ),
                    'PR' => esc_html__( 'Paraná', 'textdomain' ),
                    'PE' => esc_html__( 'Pernambuco', 'textdomain' ),
                    'PI' => esc_html__( 'Piauí', 'textdomain' ),
                    'RJ' => esc_html__( 'Rio de Janeiro', 'textdomain' ),
                    'RN' => esc_html__( 'Rio Grande do Norte', 'textdomain' ),
                    'RS' => esc_html__( 'Rio Grande do Sul', 'textdomain' ),
                    'RO' => esc_html__( 'Rondônia', 'textdomain' ),
                    'RR' => esc_html__( 'Roraima', 'textdomain' ),
                    'SC' => esc_html__( 'Santa Catarina', 'textdomain' ),
                    'SP' => esc_html__( 'São Paulo', 'textdomain' ),
                    'SE' => esc_html__( 'Sergipe', 'textdomain' ),
                    'TO' => esc_html__( 'Tocantins', 'textdomain' ),
          ],
          'inline' => true,
          'placeholder' => esc_html__( 'Select an option', 'bricks' ),
          'multiple' => true, 
          'searchable' => true,
          'clearable' => true,
          'default' => 'SP',
        ];



  }

  // Render element HTML
  public function render() {

	// require the map class
	require_once(EIM_PLUGIN_DIR . 'brazilClass.php');

	// criando um novo mapa
	$mapaBrasil = new EmuBrazilMap;

	if (is_array($this->settings['activeStates']) && !empty($this->settings['activeStates'])) {    

		$activeStates = [];
	
		foreach ($this->settings['activeStates'] as $item) {
			$activeStates[$item] = true; // Usa o próprio estado como chave
		}
	}

	$items = $this->settings['widgetsRepeater'] ?? null;

    // Set element attributes
    $root_classes[] = 'emu-interactive-map-wrapper';

    if ( ! empty( $this->settings['type'] ) ) {
      $root_classes[] = "color-{$this->settings['type']}";
    }

    // Add 'class' attribute to element root tag
    $this->set_attribute( '_root', 'class', $root_classes );

	// Render element HTML
    // '_root' attribute is required (contains element ID, class, etc.)
	echo "<div {$this->render_attributes( '_root' )}>"; // Element root attributes
    echo "<div {$this->render_attributes('child')}>";

	if ( $items >= 1 ) {

		foreach (  $items as $item ) {

      if( isset($item['image'])){
        
			$image_info = wp_get_attachment_image_src( $item['image']['id'] ?? '', $item['image']['size'] );

      }
			// definindo os dados de um widget
			$widgetText = [
			'code' => $item['state'] ?? 'SP',
			'src' => $image_info[0] ?? EIM_PLUGIN_URL . 'assets/images/mark.svg',
			// 'content' => $item['title'] ?? '',
			'options' => [
				'link' => [
					'url'=> $item['link']['url'] ?? '',
					'rel' => $item['link']['rel'] ?? '',
					'is_external' => $item['link']['newTab'] ?? '',
					'arialabel' => $item['link']['ariaLabel'] ?? '',
					'title' => $item['link']['title'] ?? '',
          'is_Bricks' => true,
				],
        'titleHover' => $item['titleHover'] ?? '',
			'class' => 'repeater-item',
			'customAttr' => 'data-field-id="' . $item['id'] .'"',
			],
			'position' => [
				'x' => 0,
				'y' => 0,
			]
			];

			
			// adicionando widget no mapa
			$mapaBrasil->addWidget($widgetText);
		}

	  }

	// if ( ! empty( $this->settings['content'] ) ) {
    
	// }
	
	echo $mapaBrasil->renderMap($activeStates ?? '');

    echo '</div></div>';

  }
}