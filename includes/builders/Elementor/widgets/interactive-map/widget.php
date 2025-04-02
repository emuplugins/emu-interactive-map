<?php

class EmuInteractiveMap_Elementor extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'emuInteractiveMap';
	}

	public function get_title(): string {
		return esc_html__( 'Interactive Map', 'elementor-addon' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'basic' ];
	}

	public function get_keywords(): array {
		return [ 'map', 'interactive', 'emu' ];
	}


    protected function register_controls(): void {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Widgets', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        // iniciando repetidor dos itens do mapa
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'widget_name',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Name', 'textdomain' ),
				'placeholder' => esc_html__( 'Widget name', 'textdomain' ),
			]
		);

        $repeater->add_control(
            'widget_state',
            [
                'label' => esc_html__( 'State', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
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
                ]
            ]
        );

        $repeater->add_control(
			'widget_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
                'dynamic' => [
                'active' => true,
            ],
			]
		);

		$repeater->start_controls_tabs(
			'content_tabs'
		);
		
		$repeater->start_controls_tab(
			'image_Tab',
			[
				'label' => esc_html__( 'Image', 'textdomain' ),
			]
		);

        $repeater->add_control(
			'widget_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        $repeater->add_responsive_control(
			'image_pos_x',
			[
				'label' => esc_html__( 'Horizontal Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
						'step' => 5,
					],
				],
				'default' => ['px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} image' => 'x: {{SIZE}};',
				],
			]
		);

        $repeater->add_responsive_control(
			'image_pos_y',
			[
				'label' => esc_html__( 'Vertical Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} image' => 'y: {{SIZE}};',
				],
			]
		);

        $repeater->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $repeater->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Image Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$repeater->end_controls_tab();


		$repeater->start_controls_tab(
			'content_Tab',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
			]
		);


		// CONTEUDO
        $repeater->add_control(
			'widget_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Sample Text' , 'textdomain' ),
				'label_block' => true,
			]
		);

        $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} foreignObject *',
			]
		);

		$repeater->add_control(
			'widget_color',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject *' => 'color: {{VALUE}}!important'
				],
				'default' => '#ffffff',
			]
		);
		$repeater->add_control(
			'widget_background',
			[
				'label' => esc_html__( 'Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div' => 'background-color: {{VALUE}}!important'
				],
			]
		);
        
		$repeater->add_responsive_control(
			'text_pos_x',
			[
				'label' => esc_html__( 'Horizontal Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject' => 'transform: translate( {{SIZE}}{{UNIT}}, {{text_pos_y.SIZE}}{{text_pos_y.UNIT}} );',
				],
			]
		);

        $repeater->add_responsive_control(
			'text_pos_y',
			[
				'label' => esc_html__( 'Vertical Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject' => 'transform: translate( {{text_pos_x.SIZE}}{{text_pos_x.UNIT}}, {{SIZE}}{{UNIT}});',
				],
			]
		);

		$repeater->add_responsive_control(
			'text_width',
			[
				'label' => esc_html__( 'text Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject, {{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $repeater->add_responsive_control(
			'text_height',
			[
				'label' => esc_html__( 'text Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => ['px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject, {{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border-radius',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div',
			]
		);
		$repeater->add_control(
			'content_border-radius',
			[
				'label' => esc_html__( 'Border radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} foreignObject > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$repeater->end_controls_tab();
		
		$repeater->end_controls_tabs();

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ widget_name }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'map_styles',
			[
				'label' => esc_html__( 'Map styles', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_responsive_control(
			'Map width',
			[
				'label' => esc_html__( 'Map width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => ['px',
					'size' => 1.4,
				],
				'selectors' => [
					'{{WRAPPER}} .brazil-map' => '--map-scale: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'state_typography .default > foreignObject > div',
			]
		);

		$this->add_control(
			'state_color',
			[
				'label' => esc_html__( 'State Name color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .default > foreignObject > div' => 'color: {{VALUE}}'
				],
			]
		);


		$this->start_controls_tabs(
			'state_tabs'
		);
		
		$this->start_controls_tab(
			'state_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		); 

		$this->add_control(
			'state_background',
			[
				'label' => esc_html__( 'State background', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state' => 'fill: {{VALUE}}!important'
				],
			]
		);
		
		$this->add_control(
			'state_border_color',
			[
				'label' => esc_html__( 'State border color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state' => 'stroke: {{VALUE}}!important'
				],
			]
		);

		
        $this->add_responsive_control(
			'state_border_width',
			[
				'label' => esc_html__( 'State border width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => ['px',
					'size' => 0.5,
				],
				'selectors' => [
					'{{WRAPPER}} .state' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_tab();


		$this->start_controls_tab(
			'state_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);

		$this->add_control(
			'state_background_hover',
			[
				'label' => esc_html__( 'State background', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state:hover' => 'fill: {{VALUE}}!important'
				],
			]
		);
		
		$this->add_control(
			'state_border_color_hover',
			[
				'label' => esc_html__( 'State border color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state:hover' => 'stroke: {{VALUE}}!important'
				],
			]
		);

		
        $this->add_responsive_control(
			'state_border_width_hover',
			[
				'label' => esc_html__( 'State border width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .state:hover' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'state_active_tab',
			[
				'label' => esc_html__( 'active', 'textdomain' ),
			]
		);

		$this->add_control(
			'states_active_list',
			[
				'label' => esc_html__( 'States active', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
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
                ]
			]
		);

		$this->add_control(
			'state_background_active',
			[
				'label' => esc_html__( 'State background', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state.active' => 'fill: {{VALUE}}!important'
				],
			]
		);
		
		$this->add_control(
			'state_border_color_active',
			[
				'label' => esc_html__( 'State border color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state.active' => 'stroke: {{VALUE}}!important'
				],
			]
		);

		
        $this->add_responsive_control(
			'state_border_width_active',
			[
				'label' => esc_html__( 'State border width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .state.active' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		// HOVER



		$this->add_control(
			'state_background_active_hover',
			[
				'label' => esc_html__( 'State background', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state.active:hover' => 'fill: {{VALUE}}!important'
				],
			]
		);
		
		$this->add_control(
			'state_border_color_active_hover',
			[
				'label' => esc_html__( 'State border color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .state.active:hover' => 'stroke: {{VALUE}}!important'
				],
			]
		);

		
        $this->add_responsive_control(
			'state_border_width_active_hover',
			[
				'label' => esc_html__( 'State border width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .state.active:hover' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();
    
    }


    // Renderiza o mapa
	protected function render(): void {

        
		require_once(EIM_PLUGIN_DIR . 'brazilClass.php');

        // criando um novo mapa
        $mapaBrasil = new EmuBrazilMap;

        $settings = $this->get_settings_for_display();

		if (!empty($settings['states_active_list'])) {
			$activeStates = [];
		
			foreach ($settings['states_active_list'] as $item) {
				$activeStates[$item] = true; // Usa o próprio estado como chave
			}
		}

		if ( $settings['list'] ) {
			foreach (  $settings['list'] as $item ) {

                // definindo os dados de um widget
                $widgetText = [
                'code' => $item['widget_state'],
                'src' => $item['widget_image']['url'],
                'content' => $item['widget_content'],
                'options' => [
                    'link' => [
                        'url'=> $item['widget_link']['url'],
                        'is_external' => $item['widget_link']['is_external'],
                        'nofollow' => $item['widget_link']['nofollow']
                    ],
                    'class' => 'elementor-repeater-item-' . $item['_id']
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

        // renderizando mapa
        echo $mapaBrasil->renderMap($activeStates);

	}
}