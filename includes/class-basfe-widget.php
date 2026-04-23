<?php
/**
 * Widget class.
 *
 * @package BeforeAfterSliderForElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BASFE_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'basfe_before_after_slider';
	}

	public function get_title() {
		return esc_html__( 'Before / After Slider', 'anwar-before-after-slider-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-image-before-after';
	}

	public function get_categories() {
		return array( 'basic' );
	}

	public function get_keywords() {
		return array( 'before', 'after', 'image comparison', 'slider', 'elementor' );
	}

	public function get_style_depends() {
		return array( 'basfe-widget' );
	}

	public function get_script_depends() {
		return array( 'basfe-widget' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'anwar-before-after-slider-for-elementor' ),
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => esc_html__( 'Before Image', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => esc_html__( 'After Image', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'before_label',
			array(
				'label'       => esc_html__( 'Before Label', 'anwar-before-after-slider-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Before', 'anwar-before-after-slider-for-elementor' ),
				'placeholder' => esc_html__( 'Before', 'anwar-before-after-slider-for-elementor' ),
			)
		);

		$this->add_control(
			'after_label',
			array(
				'label'       => esc_html__( 'After Label', 'anwar-before-after-slider-for-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'After', 'anwar-before-after-slider-for-elementor' ),
				'placeholder' => esc_html__( 'After', 'anwar-before-after-slider-for-elementor' ),
			)
		);

		$this->add_control(
			'show_overlay',
			array(
				'label'        => esc_html__( 'Show Labels', 'anwar-before-after-slider-for-elementor' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'anwar-before-after-slider-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'anwar-before-after-slider-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'start_position',
			array(
				'label'      => esc_html__( 'Starting Position (%)', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( '%' ),
				'range'      => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => '%',
					'size' => 50,
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'          => esc_html__( 'Height', 'anwar-before-after-slider-for-elementor' ),
				'type'           => \Elementor\Controls_Manager::SLIDER,
				'size_units'     => array( 'px', 'vh' ),
				'range'          => array(
					'px' => array(
						'min' => 200,
						'max' => 1200,
					),
					'vh' => array(
						'min' => 20,
						'max' => 100,
					),
				),
				'default'        => array(
					'unit' => 'px',
					'size' => 450,
				),
				'tablet_default' => array(
					'unit' => 'px',
					'size' => 350,
				),
				'mobile_default' => array(
					'unit' => 'px',
					'size' => 250,
				),
				'selectors'      => array(
					'{{WRAPPER}} .basfe-compare' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_fit',
			array(
				'label'   => esc_html__( 'Image Fit', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => array(
					'cover'   => esc_html__( 'Cover', 'anwar-before-after-slider-for-elementor' ),
					'contain' => esc_html__( 'Contain', 'anwar-before-after-slider-for-elementor' ),
					'fill'    => esc_html__( 'Fill', 'anwar-before-after-slider-for-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .basfe-image img' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$positions = array(
			'center center' => esc_html__( 'Center Center', 'anwar-before-after-slider-for-elementor' ),
			'left center'   => esc_html__( 'Left Center', 'anwar-before-after-slider-for-elementor' ),
			'right center'  => esc_html__( 'Right Center', 'anwar-before-after-slider-for-elementor' ),
			'center top'    => esc_html__( 'Center Top', 'anwar-before-after-slider-for-elementor' ),
			'center bottom' => esc_html__( 'Center Bottom', 'anwar-before-after-slider-for-elementor' ),
			'left top'      => esc_html__( 'Left Top', 'anwar-before-after-slider-for-elementor' ),
			'right top'     => esc_html__( 'Right Top', 'anwar-before-after-slider-for-elementor' ),
			'left bottom'   => esc_html__( 'Left Bottom', 'anwar-before-after-slider-for-elementor' ),
			'right bottom'  => esc_html__( 'Right Bottom', 'anwar-before-after-slider-for-elementor' ),
		);

		$this->add_control(
			'before_position',
			array(
				'label'   => esc_html__( 'Before Image Position', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => $positions,
				'selectors' => array(
					'{{WRAPPER}} .basfe-image-before img' => 'object-position: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'after_position',
			array(
				'label'   => esc_html__( 'After Image Position', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => $positions,
				'selectors' => array(
					'{{WRAPPER}} .basfe-image-after img' => 'object-position: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 18,
				),
				'selectors'  => array(
					'{{WRAPPER}} .basfe-compare' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_labels',
			array(
				'label' => esc_html__( 'Labels', 'anwar-before-after-slider-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'label_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .basfe-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'label_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.72)',
				'selectors' => array(
					'{{WRAPPER}} .basfe-label' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .basfe-label',
			)
		);

		$this->add_responsive_control(
			'label_padding',
			array(
				'label'      => esc_html__( 'Padding', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .basfe-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'label_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 999,
				),
				'selectors' => array(
					'{{WRAPPER}} .basfe-label' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'label_offset_x',
			array(
				'label'      => esc_html__( 'Horizontal Offset', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .basfe-label-before' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .basfe-label-after'  => 'right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'label_offset_y',
			array(
				'label'      => esc_html__( 'Vertical Offset', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 16,
				),
				'selectors'  => array(
					'{{WRAPPER}} .basfe-label' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_divider',
			array(
				'label' => esc_html__( 'Divider & Handle', 'anwar-before-after-slider-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'divider_color',
			array(
				'label'     => esc_html__( 'Divider Color', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .basfe-divider' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'divider_width',
			array(
				'label'      => esc_html__( 'Divider Width', 'anwar-before-after-slider-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 2,
				),
				'selectors'  => array(
					'{{WRAPPER}} .basfe-divider' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-1 * {{SIZE}}{{UNIT}} / 2);',
				),
			)
		);

		$this->add_control(
			'handle_bg_color',
			array(
				'label'     => esc_html__( 'Handle Background', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .basfe-handle' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_border_color',
			array(
				'label'     => esc_html__( 'Handle Border Color', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#1f2937',
				'selectors' => array(
					'{{WRAPPER}} .basfe-handle' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_icon_color',
			array(
				'label'     => esc_html__( 'Handle Icon Color', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#1f2937',
				'selectors' => array(
					'{{WRAPPER}} .basfe-handle' => '--basfe-handle-icon-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'handle_style',
			array(
				'label'   => esc_html__( 'Handle Icon Style', 'anwar-before-after-slider-for-elementor' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => array(
					'arrows' => esc_html__( 'Arrows', 'anwar-before-after-slider-for-elementor' ),
					'lines'  => esc_html__( 'Lines', 'anwar-before-after-slider-for-elementor' ),
					'none'   => esc_html__( 'None', 'anwar-before-after-slider-for-elementor' ),
				),
			)
		);

		$this->add_responsive_control(
			'handle_size',
			array(
				'label'     => esc_html__( 'Handle Size', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 28,
						'max' => 100,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 52,
				),
				'selectors' => array(
					'{{WRAPPER}} .basfe-handle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'handle_border_width',
			array(
				'label'     => esc_html__( 'Handle Border Width', 'anwar-before-after-slider-for-elementor' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 10,
					),
				),
				'default'   => array(
					'unit' => 'px',
					'size' => 2,
				),
				'selectors' => array(
					'{{WRAPPER}} .basfe-handle' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'handle_shadow',
				'selector' => '{{WRAPPER}} .basfe-handle',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$before_url = ! empty( $settings['before_image']['url'] ) ? $settings['before_image']['url'] : '';
		$after_url  = ! empty( $settings['after_image']['url'] ) ? $settings['after_image']['url'] : '';
		$position   = isset( $settings['start_position']['size'] ) ? (float) $settings['start_position']['size'] : 50;
		$position   = max( 0, min( 100, $position ) );

		if ( empty( $before_url ) || empty( $after_url ) ) {
			return;
		}

		$before_alt  = ! empty( $settings['before_label'] ) ? $settings['before_label'] : esc_html__( 'Before image', 'anwar-before-after-slider-for-elementor' );
		$after_alt   = ! empty( $settings['after_label'] ) ? $settings['after_label'] : esc_html__( 'After image', 'anwar-before-after-slider-for-elementor' );
		$handle_style = ! empty( $settings['handle_style'] ) ? $settings['handle_style'] : 'arrows';
		?>
		<div class="basfe-compare" data-start="<?php echo esc_attr( $position ); ?>">
			<div class="basfe-image basfe-image-after" style="left: <?php echo esc_attr( $position ); ?>%; width: <?php echo esc_attr( 100 - $position ); ?>%;">
				<img src="<?php echo esc_url( $after_url ); ?>" alt="<?php echo esc_attr( $after_alt ); ?>" loading="lazy" />
				<?php if ( 'yes' === $settings['show_overlay'] && ! empty( $settings['after_label'] ) ) : ?>
					<span class="basfe-label basfe-label-after"><?php echo esc_html( $settings['after_label'] ); ?></span>
				<?php endif; ?>
			</div>

			<div class="basfe-image basfe-image-before" style="width: <?php echo esc_attr( $position ); ?>%;">
				<img src="<?php echo esc_url( $before_url ); ?>" alt="<?php echo esc_attr( $before_alt ); ?>" loading="lazy" />
				<?php if ( 'yes' === $settings['show_overlay'] && ! empty( $settings['before_label'] ) ) : ?>
					<span class="basfe-label basfe-label-before"><?php echo esc_html( $settings['before_label'] ); ?></span>
				<?php endif; ?>
			</div>

			<div class="basfe-divider" style="left: <?php echo esc_attr( $position ); ?>%;">
				<span class="basfe-handle basfe-handle-style-<?php echo esc_attr( $handle_style ); ?>" aria-hidden="true">
					<span class="basfe-handle-icon basfe-handle-icon-left"></span>
					<span class="basfe-handle-icon basfe-handle-icon-right"></span>
				</span>
			</div>

			<input class="basfe-range" type="range" min="0" max="100" value="<?php echo esc_attr( $position ); ?>" aria-label="<?php esc_attr_e( 'Before and after image comparison slider', 'anwar-before-after-slider-for-elementor' ); ?>" />
		</div>
		<?php
	}
}
