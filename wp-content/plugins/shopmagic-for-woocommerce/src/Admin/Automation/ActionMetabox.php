<?php

namespace WPDesk\ShopMagic\Admin\Automation;

use ShopMagicVendor\WPDesk\Forms\Form\FormWithFields;
use ShopMagicVendor\WPDesk\Persistence\Adapter\ReferenceArrayContainer;
use ShopMagicVendor\WPDesk\Persistence\PersistentContainer;
use WPDesk\ShopMagic\Action\ActionFactory2;
use WPDesk\ShopMagic\Action\HasCustomAdminHeader;
use WPDesk\ShopMagic\Automation\AutomationPostType;
use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\FormIntegration;

final class ActionMetabox extends AbstractMetabox {
	const POST_KEY_ACTIONS = 'actions';
	const META_KEY_ACTIONS = '_actions';

	/**
	 * @var ActionFactory2
	 */
	private $action_factory;

	/** @var FormIntegration */
	private $form_integration;

	public function __construct( ActionFactory2 $action_factory, FormIntegration $form_integration ) {
		$this->action_factory   = $action_factory;
		$this->form_integration = $form_integration;
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
	private function setup() {
		add_meta_box( 'shopmagic_action_metabox', __( 'Actions', 'shopmagic-for-woocommerce' ), array(
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
		add_action( 'save_post', array( $this, 'save_actions_from_metabox' ) );
		add_action( 'wp_ajax_shopmagic_load_action_params', array( $this, 'render_action_from_post' ) );
	}

	/**
	 * AJAX callback which shows action edit code
	 *
	 * @since   1.0.0
	 */
	public function render_action_from_post() {
		$action_slug = sanitize_text_field( $_POST['action_slug'] );
		$action      = $this->action_factory->get_action( $action_slug );

		$action_id = (int) $_POST['action_id'];

		$actions_data = get_post_meta( (int) $_POST['post'], self::META_KEY_ACTIONS, true );
		if ( empty( $actions_data ) ) {
			$actions_data = [];
		}
		if ( ! isset( $actions_data[ $action_id ] ) || ! is_array( $actions_data[ $action_id ] ) ) {
			$actions_data[ $action_id ] = [];
		}

		$action_form = $this->form_integration->load_form(
				new ReferenceArrayContainer( $actions_data[ $action_id ] ),
				new FormWithFields( $action->get_fields() )
		);

		if ( $action_form->is_valid() ) {
			$name_prefix = self::POST_KEY_ACTIONS . '[' . $action_id . ']';

			echo json_encode( array(
							'action_box'   => $this->form_integration->get_renderer()->render_fields(
									$action,
									$action_form->get_data(),
									$name_prefix
							),
							'data_domains' => $action->get_required_data_domains(),
					)
			);
		}

		wp_die();
	}

	/**
	 * Post save processor
	 *
	 * @param string $post_id
	 *
	 * @since   1.0.0
	 */
	public function save_actions_from_metabox( $post_id ) {
		if ( current_user_can( 'manage_options' ) && isset( $_POST['post_type'] ) && $_POST['post_type'] === AutomationPostType::TYPE &&
		     isset( $_POST[ self::POST_KEY_ACTIONS ] ) && is_array( $_POST[ self::POST_KEY_ACTIONS ] )
		) {
			// if auto saving skip saving our meta box data
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( ! wp_verify_nonce( plugin_basename( SHOPMAGIC_BASE_FILE ), 'shopmagic_action_meta_box' ) ) {
				// TODO: this is not working?
			}

			$meta = [];
			foreach ( $_POST[ self::POST_KEY_ACTIONS ] as $key => $action_data ) {
				if ( is_numeric( $key ) ) {
					if ( ! isset( $meta[ $key ] ) || ! is_array( $meta[ $key ] ) ) {
						$meta[ $key ] = [];
					}
					$this->save_action( $action_data, new ReferenceArrayContainer( $meta[ $key ] ) );
					$meta[ $key ] = apply_filters( 'shopmagic_settings_save', $meta[ $key ], $action_data, null );
				}
			}
			update_post_meta( $post_id, self::META_KEY_ACTIONS, $meta );
		}
	}

	private function save_action( $action_post_data, PersistentContainer $container ) {
		$action_slug = sanitize_text_field( $action_post_data['_action'] );
		$action      = $this->action_factory->get_action( $action_slug );

		$action_form = new FormWithFields( $action->get_fields() );
		$action_form->add_field(
				( new InputTextField() )
						->set_name( '_action_title' )
		);
		$action_form->handle_request( $action_post_data );
		if ( $action_form->is_submitted() && $action_form->is_valid() ) {
			$this->form_integration->persists_form( $container, $action_form );
			$container->set( '_action', $action_slug );
		}
	}

	/**
	 * Display metabox in admin side
	 *
	 * @param \WP_Post $post
	 *
	 * @since   1.0.0
	 */
	function draw_metabox( $post ) {
		$available_actions = $this->action_factory->get_action_list();
		wp_nonce_field( plugin_basename( SHOPMAGIC_BASE_FILE ), 'shopmagic_action_meta_box' );


		?>

		<div class="sm-actions-wrap">
			<div class="postbox action-form-table" id="action-area-stub">
				<button type="button" class="handlediv button-link" aria-expanded="false"><span
							class="screen-reader-text"><?php _e( 'Toggle panel: Action',
								'shopmagic-for-woocommerce' ); ?></span><span
							class="toggle-indicator" aria-hidden="true"></span></button>

				<div class="error-icon"><span class="dashicons dashicons-warning"></span>
					<div class="error-icon-tooltip"><?php _e( 'Network connection error',
								'shopmagic-for-woocommerce' ); ?></div>
				</div>
				<div class="spinner"></div>

				<h2 class="hndle ui-sortable-handle">
                    <span class="action_wrap"><?php _e( 'Action #', 'shopmagic-for-woocommerce' ); ?><span
								class="action_number">0</span>:</span>

					<select class="action_main_select" name="_action_stub" id="_action_stub">
						<option value=""><?php _e( 'Select...', 'shopmagic-for-woocommerce' ); ?></option>

						<?php
						foreach ( $available_actions as $slug => $display_action ) {
							echo '<option value="' . $slug . '">' . $display_action->get_name() . '</option>';
						}
						?>
					</select>

					<span class="action_title" id="_action_title_stub"></span>
				</h2>

				<div class="inside">
					<table class="shopmagic-table">
						<tr class="shopmagic-field">
							<td class="shopmagic-label">
								<label for="action_title_stub"
									   id="action_title_label_stub"><?php _e( 'Description',
											'shopmagic-for-woocommerce' ); ?></label>

								<p class="content"><?php _e( 'Description for your reference',
											'shopmagic-for-woocommerce' ); ?></p>
							</td>

							<td class="shopmagic-input">
								<input type="text" name="action_title_stub" id="action_title_stub">
							</td>
						</tr>

						<tr>
							<td id="action-settings-area_occ" class="config-area" colspan="2">
								<?php
								/**
								 * @ignore Only for delayed actions plugin.
								 */
								do_action( 'shopmagic_automation_action_settings', 'occ',
										array() ); // 'occ' like key ?>
							</td>
						</tr>

						<tr>
							<td class="config-area" colspan="2">
								<table id="action-config-area-stub"></table>
							</td>
						</tr>

						<tr>
							<td class="shopmagic-action-footer" colspan="2">
								<button class="remove-action button button-large" onclick="removeAction(this)"
										type="button"><?php _e( 'Remove Action',
											'shopmagic-for-woocommerce' ); ?></button>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<?php
			// For each stored action we create action area. This is duplicate for template code above.
			// Maybe better is make template file for this area and load it via some kind of templating script
			$actions_data         = get_post_meta( $post->ID, self::META_KEY_ACTIONS, true );
			$nextActionIndex = 0;
			if ( is_array( $actions_data ) ) {
				foreach ( $actions_data as $key => $single_action_data ) {
					$action = $this->action_factory->get_action($single_action_data['_action']);
					?>
					<div class="postbox action-form-table closed" id="action-area-<?php echo $key; ?>">
						<button type="button" class="handlediv button-link" aria-expanded="false"><span
									class="screen-reader-text">Toggle panel: Action</span><span class="toggle-indicator"
																								aria-hidden="true"></span>
						</button>

						<div class="error-icon"><span class="dashicons dashicons-warning"></span>
							<div class="error-icon-tooltip"><?php _e( 'Network connection error',
										'shopmagic-for-woocommerce' ); ?></div>
						</div>
						<div class="spinner"></div>

						<h2 class="hndle ui-sortable-handle">
                            <span class="action_wrap"><?php _e( 'Action #', 'shopmagic-for-woocommerce' ); ?><span
										class="action_number"><?php echo $key + 1; ?></span>:</span>

							<select class="action_main_select tips" name="actions[<?php echo $key; ?>][_action]"
									id="_actions_<?php echo $key; ?>_action"
									data-tip="<?php _e( 'In order to change action, remove the old one and a new one.',
											'shopmagic-for-woocommerce' ); ?>"
									disabled>
								<option value=""><?php _e( 'Select...', 'shopmagic-for-woocommerce' ); ?></option>
								<?php foreach ( $available_actions as $slug => $display_action ) { ?>
									<option
											value="<?php echo $slug; ?>" <?php selected( $slug,
											$single_action_data['_action'] ); ?>><?php echo $display_action->get_name(); ?></option>
								<?php } ?>
							</select>

							<input type="hidden" name="actions[<?php echo $key; ?>][_action]"
								   value="<?php echo $single_action_data['_action']; ?>">

							<span class="action_title"
								  id="_action_title_<?php echo $key; ?>"><?php echo $single_action_data['_action_title']; ?></span>

							<?php if ($action instanceof HasCustomAdminHeader): ?>
								<?php
									echo $action->render_header( $key ); ?>
							<?php endif; ?>
						</h2>

						<div class="inside">
							<table class="shopmagic-table">
								<tr class="shopmagic-field">
									<td class="shopmagic-label">
										<label for="action_title_input_<?php echo $key; ?>"><?php _e( 'Description',
													'shopmagic-for-woocommerce' ); ?></label>

										<p class="content"><?php _e( 'Description for your reference',
													'shopmagic-for-woocommerce' ); ?></p>
									</td>

									<td class="shopmagic-input">
										<input type="text" class="action_title_input"
											   name="actions[<?php echo $key; ?>][_action_title]"
											   id="action_title_input_<?php echo $key; ?>"
											   value="<?php echo $single_action_data['_action_title']; ?>">
									</td>
								</tr>

								<tr>
									<td id="action-settings-area_<?php echo $key; ?>" class="config-area"
										colspan="2">
										<?php
										$notice_name    = 'action-delay';
										$time_dismissed = get_user_meta( get_current_user_id(), 'shopmagic_ignore_notice_' . $notice_name, true );
										$show_after     = $time_dismissed ? $time_dismissed + MONTH_IN_SECONDS : ''; // Will show again after 1 month
										$url            = get_locale() === 'pl_PL' ? 'https://wpde.sk/sm-action-delay-pl' : 'https://wpde.sk/sm-action-delay';
											if ( ! is_plugin_active( 'shopmagic-delayed-actions/shopmagic-delayed-actions.php' ) && time() > $show_after ): ?>
											<table id="sm_id_<?php echo $key; ?>" class="shopmagic-table">
												<tbody>
												<tr class="shopmagic-field">
													<td class="shopmagic-label">
														<label for="action_delay_checkbox_<?php echo $key; ?>"><?php _e( 'Delay', 'shopmagic-for-woocommerce' ); ?></label>
													</td>
													<td class="shopmagic-input"><section class="notice notice-info is-dismissible" data-notice-name="<?php echo $notice_name; ?>"><p><strong><?php printf( __( 'Did you know that you can delay emails by minutes, hours, days or even weeks? %sCheck out our Delayed Actions add-on &rarr;%s', 'shopmagic-for-woocommerce' ), '<a target="_blank" href="' . $url . '">', '</a>' ); ?></strong></p></section></td>
												</tr>
												</tbody>
											</table>
										<?php endif; ?>
										<?php
										/**
										 * @ignore Only for delayed actions plugin.
										 */
										do_action( 'shopmagic_automation_action_settings', $key, $single_action_data ); ?>
									</td>
								</tr>

								<tr>
									<td class="config-area" colspan="2">
										<table id="action-config-area-<?php echo $key; ?>"></table>
									</td>
								</tr>

								<tr>
									<td class="shopmagic-action-footer" colspan="2">
										<button class="button button-large" onclick="removeAction(this)"
												type="button"><?php _e( 'Remove Action',
													'shopmagic-for-woocommerce' ); ?></button>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<?php
				}
				$nextActionIndex = count( $actions_data );

			}
			// store global javascript variable to use in admin-side JS when we add new action
			?>
			<script>
				var nextActionIndex = <?php echo $nextActionIndex; ?>;
			</script>

			<div class="shopmagic-tfoot">
				<div class="shopmagic-fr">
					<button id="add-new-action" class="button button-primary button-large" onclick="addNewAction()"
							type="button"><?php _e( '+ New Action', 'shopmagic-for-woocommerce' ); ?></button>
				</div>
			</div>
		</div>
		<?php

	}
}
