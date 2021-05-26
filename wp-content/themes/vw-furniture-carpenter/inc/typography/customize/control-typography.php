<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Furniture_Carpenter_Control_Typography extends WP_Customize_Control {

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
				'color'       => esc_html__( 'Font Color', 'vw-furniture-carpenter' ),
				'family'      => esc_html__( 'Font Family', 'vw-furniture-carpenter' ),
				'size'        => esc_html__( 'Font Size',   'vw-furniture-carpenter' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-furniture-carpenter' ),
				'style'       => esc_html__( 'Font Style',  'vw-furniture-carpenter' ),
				'line_height' => esc_html__( 'Line Height', 'vw-furniture-carpenter' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-furniture-carpenter' ),
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
		wp_enqueue_script( 'vw-furniture-carpenter-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-furniture-carpenter-ctypo-customize-controls' );
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
			'' => __( 'No Fonts', 'vw-furniture-carpenter' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-furniture-carpenter' ),
        'Acme' => __( 'Acme', 'vw-furniture-carpenter' ),
        'Anton' => __( 'Anton', 'vw-furniture-carpenter' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-furniture-carpenter' ),
        'Arimo' => __( 'Arimo', 'vw-furniture-carpenter' ),
        'Arsenal' => __( 'Arsenal', 'vw-furniture-carpenter' ),
        'Arvo' => __( 'Arvo', 'vw-furniture-carpenter' ),
        'Alegreya' => __( 'Alegreya', 'vw-furniture-carpenter' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-furniture-carpenter' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-furniture-carpenter' ),
        'Bangers' => __( 'Bangers', 'vw-furniture-carpenter' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-furniture-carpenter' ),
        'Bad Script' => __( 'Bad Script', 'vw-furniture-carpenter' ),
        'Bitter' => __( 'Bitter', 'vw-furniture-carpenter' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-furniture-carpenter' ),
        'BenchNine' => __( 'BenchNine', 'vw-furniture-carpenter' ),
        'Cabin' => __( 'Cabin', 'vw-furniture-carpenter' ),
        'Cardo' => __( 'Cardo', 'vw-furniture-carpenter' ),
        'Courgette' => __( 'Courgette', 'vw-furniture-carpenter' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-furniture-carpenter' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-furniture-carpenter' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-furniture-carpenter' ),
        'Cuprum' => __( 'Cuprum', 'vw-furniture-carpenter' ),
        'Cookie' => __( 'Cookie', 'vw-furniture-carpenter' ),
        'Chewy' => __( 'Chewy', 'vw-furniture-carpenter' ),
        'Days One' => __( 'Days One', 'vw-furniture-carpenter' ),
        'Dosis' => __( 'Dosis', 'vw-furniture-carpenter' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-furniture-carpenter' ),
        'Economica' => __( 'Economica', 'vw-furniture-carpenter' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-furniture-carpenter' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-furniture-carpenter' ),
        'Francois One' => __( 'Francois One', 'vw-furniture-carpenter' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-furniture-carpenter' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-furniture-carpenter' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-furniture-carpenter' ),
        'Handlee' => __( 'Handlee', 'vw-furniture-carpenter' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-furniture-carpenter' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-furniture-carpenter' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-furniture-carpenter' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-furniture-carpenter' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-furniture-carpenter' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-furniture-carpenter' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-furniture-carpenter' ),
        'Kanit' => __( 'Kanit', 'vw-furniture-carpenter' ),
        'Lobster' => __( 'Lobster', 'vw-furniture-carpenter' ),
        'Lato' => __( 'Lato', 'vw-furniture-carpenter' ),
        'Lora' => __( 'Lora', 'vw-furniture-carpenter' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-furniture-carpenter' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-furniture-carpenter' ),
        'Merriweather' => __( 'Merriweather', 'vw-furniture-carpenter' ),
        'Monda' => __( 'Monda', 'vw-furniture-carpenter' ),
        'Montserrat' => __( 'Montserrat', 'vw-furniture-carpenter' ),
        'Muli' => __( 'Muli', 'vw-furniture-carpenter' ),
        'Marck Script' => __( 'Marck Script', 'vw-furniture-carpenter' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-furniture-carpenter' ),
        'Open Sans' => __( 'Open Sans', 'vw-furniture-carpenter' ),
        'Overpass' => __( 'Overpass', 'vw-furniture-carpenter' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-furniture-carpenter' ),
        'Oxygen' => __( 'Oxygen', 'vw-furniture-carpenter' ),
        'Orbitron' => __( 'Orbitron', 'vw-furniture-carpenter' ),
        'Patua One' => __( 'Patua One', 'vw-furniture-carpenter' ),
        'Pacifico' => __( 'Pacifico', 'vw-furniture-carpenter' ),
        'Padauk' => __( 'Padauk', 'vw-furniture-carpenter' ),
        'Playball' => __( 'Playball', 'vw-furniture-carpenter' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-furniture-carpenter' ),
        'PT Sans' => __( 'PT Sans', 'vw-furniture-carpenter' ),
        'Philosopher' => __( 'Philosopher', 'vw-furniture-carpenter' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-furniture-carpenter' ),
        'Poiret One' => __( 'Poiret One', 'vw-furniture-carpenter' ),
        'Quicksand' => __( 'Quicksand', 'vw-furniture-carpenter' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-furniture-carpenter' ),
        'Raleway' => __( 'Raleway', 'vw-furniture-carpenter' ),
        'Rubik' => __( 'Rubik', 'vw-furniture-carpenter' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-furniture-carpenter' ),
        'Russo One' => __( 'Russo One', 'vw-furniture-carpenter' ),
        'Righteous' => __( 'Righteous', 'vw-furniture-carpenter' ),
        'Slabo' => __( 'Slabo', 'vw-furniture-carpenter' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-furniture-carpenter' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-furniture-carpenter'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-furniture-carpenter' ),
        'Sacramento' => __( 'Sacramento', 'vw-furniture-carpenter' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-furniture-carpenter' ),
        'Tangerine' => __( 'Tangerine', 'vw-furniture-carpenter' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-furniture-carpenter' ),
        'VT323' => __( 'VT323', 'vw-furniture-carpenter' ),
        'Varela Round' => __( 'Varela Round', 'vw-furniture-carpenter' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-furniture-carpenter' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-furniture-carpenter' ),
        'Volkhov' => __( 'Volkhov', 'vw-furniture-carpenter' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-furniture-carpenter' )
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
			'' => esc_html__( 'No Fonts weight', 'vw-furniture-carpenter' ),
			'100' => esc_html__( 'Thin',       'vw-furniture-carpenter' ),
			'300' => esc_html__( 'Light',      'vw-furniture-carpenter' ),
			'400' => esc_html__( 'Normal',     'vw-furniture-carpenter' ),
			'500' => esc_html__( 'Medium',     'vw-furniture-carpenter' ),
			'700' => esc_html__( 'Bold',       'vw-furniture-carpenter' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-furniture-carpenter' ),
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
			'' => esc_html__( 'No Fonts Style', 'vw-furniture-carpenter' ),
			'normal'  => esc_html__( 'Normal', 'vw-furniture-carpenter' ),
			'italic'  => esc_html__( 'Italic', 'vw-furniture-carpenter' ),
			'oblique' => esc_html__( 'Oblique', 'vw-furniture-carpenter' )
		);
	}
}
