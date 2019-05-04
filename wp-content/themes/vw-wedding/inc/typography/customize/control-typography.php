<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Wedding_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-wedding' ),
				'family'      => esc_html__( 'Font Family', 'vw-wedding' ),
				'size'        => esc_html__( 'Font Size',   'vw-wedding' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-wedding' ),
				'style'       => esc_html__( 'Font Style',  'vw-wedding' ),
				'line_height' => esc_html__( 'Line Height', 'vw-wedding' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-wedding' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-wedding-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-wedding-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-wedding' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-wedding' ),
        'Acme' => __( 'Acme', 'vw-wedding' ),
        'Anton' => __( 'Anton', 'vw-wedding' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-wedding' ),
        'Arimo' => __( 'Arimo', 'vw-wedding' ),
        'Arsenal' => __( 'Arsenal', 'vw-wedding' ),
        'Arvo' => __( 'Arvo', 'vw-wedding' ),
        'Alegreya' => __( 'Alegreya', 'vw-wedding' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-wedding' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-wedding' ),
        'Bangers' => __( 'Bangers', 'vw-wedding' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-wedding' ),
        'Bad Script' => __( 'Bad Script', 'vw-wedding' ),
        'Bitter' => __( 'Bitter', 'vw-wedding' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-wedding' ),
        'BenchNine' => __( 'BenchNine', 'vw-wedding' ),
        'Cabin' => __( 'Cabin', 'vw-wedding' ),
        'Cardo' => __( 'Cardo', 'vw-wedding' ),
        'Courgette' => __( 'Courgette', 'vw-wedding' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-wedding' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-wedding' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-wedding' ),
        'Cuprum' => __( 'Cuprum', 'vw-wedding' ),
        'Cookie' => __( 'Cookie', 'vw-wedding' ),
        'Chewy' => __( 'Chewy', 'vw-wedding' ),
        'Days One' => __( 'Days One', 'vw-wedding' ),
        'Dosis' => __( 'Dosis', 'vw-wedding' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-wedding' ),
        'Economica' => __( 'Economica', 'vw-wedding' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-wedding' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-wedding' ),
        'Francois One' => __( 'Francois One', 'vw-wedding' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-wedding' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-wedding' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-wedding' ),
        'Handlee' => __( 'Handlee', 'vw-wedding' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-wedding' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-wedding' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-wedding' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-wedding' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-wedding' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-wedding' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-wedding' ),
        'Kanit' => __( 'Kanit', 'vw-wedding' ),
        'Lobster' => __( 'Lobster', 'vw-wedding' ),
        'Lato' => __( 'Lato', 'vw-wedding' ),
        'Lora' => __( 'Lora', 'vw-wedding' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-wedding' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-wedding' ),
        'Merriweather' => __( 'Merriweather', 'vw-wedding' ),
        'Monda' => __( 'Monda', 'vw-wedding' ),
        'Montserrat' => __( 'Montserrat', 'vw-wedding' ),
        'Muli' => __( 'Muli', 'vw-wedding' ),
        'Marck Script' => __( 'Marck Script', 'vw-wedding' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-wedding' ),
        'Open Sans' => __( 'Open Sans', 'vw-wedding' ),
        'Overpass' => __( 'Overpass', 'vw-wedding' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-wedding' ),
        'Oxygen' => __( 'Oxygen', 'vw-wedding' ),
        'Orbitron' => __( 'Orbitron', 'vw-wedding' ),
        'Patua One' => __( 'Patua One', 'vw-wedding' ),
        'Pacifico' => __( 'Pacifico', 'vw-wedding' ),
        'Padauk' => __( 'Padauk', 'vw-wedding' ),
        'Playball' => __( 'Playball', 'vw-wedding' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-wedding' ),
        'PT Sans' => __( 'PT Sans', 'vw-wedding' ),
        'Philosopher' => __( 'Philosopher', 'vw-wedding' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-wedding' ),
        'Poiret One' => __( 'Poiret One', 'vw-wedding' ),
        'Quicksand' => __( 'Quicksand', 'vw-wedding' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-wedding' ),
        'Raleway' => __( 'Raleway', 'vw-wedding' ),
        'Rubik' => __( 'Rubik', 'vw-wedding' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-wedding' ),
        'Russo One' => __( 'Russo One', 'vw-wedding' ),
        'Righteous' => __( 'Righteous', 'vw-wedding' ),
        'Slabo' => __( 'Slabo', 'vw-wedding' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-wedding' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-wedding'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-wedding' ),
        'Sacramento' => __( 'Sacramento', 'vw-wedding' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-wedding' ),
        'Tangerine' => __( 'Tangerine', 'vw-wedding' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-wedding' ),
        'VT323' => __( 'VT323', 'vw-wedding' ),
        'Varela Round' => __( 'Varela Round', 'vw-wedding' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-wedding' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-wedding' ),
        'Volkhov' => __( 'Volkhov', 'vw-wedding' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-wedding' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-wedding' ),
			'100' => esc_html__( 'Thin',       'vw-wedding' ),
			'300' => esc_html__( 'Light',      'vw-wedding' ),
			'400' => esc_html__( 'Normal',     'vw-wedding' ),
			'500' => esc_html__( 'Medium',     'vw-wedding' ),
			'700' => esc_html__( 'Bold',       'vw-wedding' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-wedding' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-wedding' ),
			'italic'  => esc_html__( 'Italic', 'vw-wedding' ),
			'oblique' => esc_html__( 'Oblique', 'vw-wedding' )
		);
	}
}
