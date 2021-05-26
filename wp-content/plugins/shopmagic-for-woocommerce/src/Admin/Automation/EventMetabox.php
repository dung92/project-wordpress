<?php

namespace WPDesk\ShopMagic\Admin\Automation;

use Composer\Script\Event;
use ShopMagicVendor\WPDesk\Forms\Form\FormWithFields;
use ShopMagicVendor\WPDesk\Forms\Renderer\JsonNormalizedRenderer;
use ShopMagicVendor\WPDesk\Persistence\Adapter\ArrayContainer;
use WPDesk\ShopMagic\Automation\AutomationPersistence;
use WPDesk\ShopMagic\DataSharing\DataLayer;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Filter\Filter;
use WPDesk\ShopMagic\Filter\FilterFactory2;
use WPDesk\ShopMagic\FormIntegration;
use WPDesk\ShopMagic\Placeholder\Placeholder;
use WPDesk\ShopMagic\Placeholder\PlaceholderFactory2;

final class EventMetabox extends AbstractMetabox {
	const META_KEY_EVENT = '_event_data';

	/** @var EventFactory2 */
	private $event_factory;

	/** @var PlaceholderFactory2 */
	private $placeholder_factory;

	/** @var FormIntegration */
	private $form_integration;

	/** @var FilterFactory2 */
	private $filter_factory;

	function __construct(
			EventFactory2 $event_factory,
			FilterFactory2 $filter_factory,
			PlaceholderFactory2 $placeholder_factory,
			FormIntegration $form_integration
	) {
		$this->event_factory       = $event_factory;
		$this->filter_factory      = $filter_factory;
		$this->placeholder_factory = $placeholder_factory;
		$this->form_integration    = $form_integration;
	}

	public function initialize() {
		$this->add_actions();
		$this->setup();
	}

	/**
	 * Setup metabox.
	 *
	 * @since   1.0.0
	 */
	function setup() {
		add_meta_box( 'shopmagic_event_metabox', __( 'Event', 'shopmagic-for-woocommerce' ), array(
				$this,
				'draw_metabox'
		), 'shopmagic_automation', 'normal' );

	}

	/**
	 * Adds action hooks.
	 *
	 * @since   1.0.0
	 */
	private function add_actions() {
		add_action( 'save_post', array( $this, 'save_event_from_metabox' ) );
		add_action( 'wp_ajax_shopmagic_load_event_params', array( $this, 'render_event_from_post' ) );
	}

	/**
	 * @param Filter[] $filters
	 *
	 * @return array[]
	 */
	private function get_normalized_filter_list( array $filters ) {
		$renderer = new JsonNormalizedRenderer();

		$normalized_filters = [];
		foreach ( $filters as $id => $filter ) {
			/** @var $filter Filter */
			$normalized_filters[] = [
					'id'          => $id,
					'group'       => $this->event_factory->event_group_name( $filter->get_group_slug() ),
					'name'        => $filter->get_name(),
					'description' => $filter->get_description(),
					'fields'      => $renderer->render_fields( $filter, [] )
			];
		}

		return $normalized_filters;
	}

	public function render_event_from_post() {
		$automation_persistence = new AutomationPersistence( (int) $_POST['post'] );

		$event_slug = sanitize_text_field( $_POST['event_slug'] );
		$event      = $this->event_factory->get_event( $event_slug );

		$event_has_changed = $event_slug !== $automation_persistence->get_event_slug();

		$event_form = $this->form_integration->load_form(
				new ArrayContainer( $automation_persistence->get_event_data() ),
				new FormWithFields( $event->get_fields() )
		);

		$data_layer = new DataLayer( $event );

		echo json_encode( array(
						'event_box'        => $this->form_integration->get_renderer()->render_fields(
								$event,
								$event_form->get_data(),
								'event'
						),
						'filters'          => $this->get_normalized_filter_list( $this->filter_factory->get_filter_list_to_handle( $data_layer ) ),
						'existing_filters' => $event_has_changed ? [] : $automation_persistence->get_filters_data(),
						'description'      => $event->get_description(),
						'placeholders'     => $this->get_normalized_placeholder_list( $this->placeholder_factory->get_placeholder_list_to_handle( $data_layer ) )
				)
		);

		wp_die();
	}

	/**
	 * Post save processor
	 *
	 * @param string $post_id
	 *
	 * @since   1.0.0
	 */
	function save_event_from_metabox( $post_id ) {
		if ( current_user_can( 'manage_options' ) && isset( $_POST['post_type'] ) && $_POST['post_type'] === 'shopmagic_automation' && isset( $_POST['_event'] ) ) {

			// if auto saving skip saving our meta box data
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( ! wp_verify_nonce( plugin_basename( SHOPMAGIC_BASE_FILE ), 'shopmagic_event_meta_box' ) ) {
				// TODO: this is not working?
			}

			$event_slug = sanitize_text_field( $_POST['_event'] );
			$event      = $this->event_factory->get_event( $event_slug );

			$event_form = new FormWithFields( $event->get_fields() );
			$event_form->handle_request( isset( $_POST['event'] ) ? $_POST['event'] : [] );
			if ( $event_form->is_submitted() && $event_form->is_valid() ) {
				$container = new ArrayContainer( [] );
				$this->form_integration->persists_form( $container, $event_form );

				update_post_meta( $post_id, '_event', $event_slug );
				update_post_meta( $post_id, self::META_KEY_EVENT, $container->get_array() );
			}
		}
	}


	/**
	 * @param \WPDesk\ShopMagic\Placeholder\Placeholder[] $placeholders
	 *
	 * @return array[]
	 */
	private function get_normalized_placeholder_list( array $list ) {
		return array_values( array_map( function ( $item ) {
			/** @var Placeholder $item */
			return [
					'placeholder' => "{{ {$item->get_slug()} }}",
					'title'       => $item->get_description(),
					'dialog_slug' => $item->get_slug()
			];
		}, $list ) );
	}

	/**
	 * Display metabox in admin side
	 *
	 * @param \WP_Post $post
	 *
	 * @since   1.0.0
	 */
	function draw_metabox( $post ) {
		// initialize available events
		$events = $this->event_factory->get_event_list();
		wp_nonce_field( plugin_basename( SHOPMAGIC_BASE_FILE ), 'shopmagic_event_meta_box' );
		$event_slug = get_post_meta( $post->ID, '_event', true );
		?>
		<div id="_shopmagic_edit_page"></div>
		<table class="shopmagic-table">
			<tbody>
			<tr class="shopmagic-field">
				<td class="shopmagic-label">
					<label for="_event"><?php _e( 'Event', 'shopmagic-for-woocommerce' ); ?></label>

					<div id="event-desc-area">
						<p class="content"></p>

						<span class="tips"
							  data-tip="<?php _e( 'If you\'re not receiving emails, click here to read our troubleshooting guide &rarr;',
									  'shopmagic-for-woocommerce' ); ?>"><a
									href="https://docs.shopmagic.app/article/156-why-arent-my-email-automations-being-sent"
									target="_blank"><?php _e( ' Automations not working?',
										'shopmagic-for-woocommerce' ); ?></a></span>
					</div>
				</td>

				<td class="shopmagic-input">
					<select name="_event" id="_event" title="<?php _e( 'Event', 'shopmagic-for-woocommerce' ); ?>">

						<option
								value="" <?php selected( '', $event_slug ); ?>><?php _e( 'Select...',
									'shopmagic-for-woocommerce' ); ?></option>
						<?php

						// order all events by group
						uasort( $events,
								/**
								 * compares events by groups object
								 *
								 * @param \WPDesk\ShopMagic\Event\Event $a
								 * @param \WPDesk\ShopMagic\Event\Event $b
								 *
								 * @return int compare result
								 */
								function ( $a, $b ) {
									return strcmp( $a->get_group_slug(), $b->get_group_slug() );
								} );

						$prevGroup = '';
						foreach ( $events as $slug => $event ) {
							if ( $prevGroup != $event->get_group_slug() ) { // group was changed
								if ( $prevGroup != '' ) {
									echo '</optgroup>';
								}

								echo '<optgroup label="' . $this->event_factory->event_group_name( $event->get_group_slug() ) . '">';

								$prevGroup = $event->get_group_slug();
							}

							echo '<option value="' . $slug . '" ' . selected( $slug, $event_slug,
											false ) . '>' . $event->get_name() . '</option>';
						}
						?>
						</optgroup>
					</select>

					<div class="error-icon">
						<span class="dashicons dashicons-warning"></span>

						<div class="error-icon-tooltip">Network connection error</div>
					</div>

					<div class="spinner"></div>

				</td>
			</tr>

			<table id="event-config-area" class="shopmagic-table"></table>
			</tbody>
		</table>
		<?php
	}
}
