<?php

namespace WPDesk\ShopMagic\Automation;

use WPDesk\ShopMagic\Action\ActionFactory2;
use WPDesk\ShopMagic\ActionExecution\ExecutionStrategyFactory;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Filter\FilterFactory2;

/**
 * Can create automation from given id.
 *
 * @package WPDesk\ShopMagic\Automation
 */
final class AutomationFactory {
	/** @var EventFactory2 */
	private $event_factory;

	/** @var ActionFactory2 */
	private $action_factory;

	/** @var FilterFactory2 */
	private $filter_factory;

	/** @var ExecutionStrategyFactory */
	private $execution_factory;

	private $automations = [];

	public function __construct(
		EventFactory2 $event_factory,
		ActionFactory2 $action_factory,
		FilterFactory2 $filter_factory,
		ExecutionStrategyFactory $execution_factory
	) {

		$this->event_factory       = $event_factory;
		$this->action_factory      = $action_factory;
		$this->filter_factory      = $filter_factory;
		$this->execution_factory   = $execution_factory;
	}

	/**
	 * @return Automation[]
	 */
	public function initialize_active_woocommerce_automations(): array {
		$args = array(
			'post_type'      => 'shopmagic_automation',
			'post_status'    => 'publish', // only active automations
			'posts_per_page' => - 1   // all of them
		);

		foreach ( get_posts( $args ) as $automation_post ) {
			if ( ! isset( $this->automations[ $automation_post->ID ] ) ) {
				$this->automations[ $automation_post->ID ] = $this->create_automation( $automation_post->ID );
			}
		}

		return $this->automations;
	}

	/**
	 * @param int $automation_id
	 *
	 * @return Automation
	 */
	public function create_automation( $automation_id ): Automation {
		if ( ! isset( $this->automations[ $automation_id ] ) ) {
			$automation = new Automation(
				(int) $automation_id,
				$this->event_factory,
				$this->filter_factory,
				$this->action_factory,
				$this->execution_factory
			);
			$automation->initialize();

			return $automation;
		}

		return $this->automations[ $automation_id ];
	}
}
