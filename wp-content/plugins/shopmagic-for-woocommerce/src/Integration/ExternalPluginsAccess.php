<?php

namespace WPDesk\ShopMagic\Integration;

use Psr\Log\LoggerInterface;
use WPDesk\ShopMagic\AutomationOutcome\OutcomeInformationRepository;
use WPDesk\ShopMagic\Customer\CustomerFactory;
use WPDesk\ShopMagic\Customer\CustomerProvider;
use WPDesk\ShopMagic\Guest\GuestFactory;

/**
 * Class that grants access to some internal classes and info about ShopMagic to external plugins.
 *
 * @package WPDesk\ShopMagic\Integration
 */
class ExternalPluginsAccess {
	/** @var string */
	private $version;

	/** @var GuestFactory */
	private $guest_factory;

	/** @var CustomerFactory */
	private $customer_factory;

	/** @var CustomerProvider */
	private $customer_provider;

	private $outcome_information;

	/** @var LoggerInterface */
	private $logger;


	public function __construct( string $version, GuestFactory $guest_factory, CustomerFactory $customer_factory, CustomerProvider $customer_provider, LoggerInterface $logger, OutcomeInformationRepository $outcome_information ) {
		$this->version             = $version;
		$this->guest_factory       = $guest_factory;
		$this->customer_factory    = $customer_factory;
		$this->customer_provider   = $customer_provider;
		$this->logger              = $logger;
		$this->outcome_information = $outcome_information;
	}

	public function get_customer_factory(): CustomerFactory {
		return $this->customer_factory;
	}

	public function get_version(): string {
		return $this->version;
	}

	public function get_logger(): LoggerInterface {
		return $this->logger;
	}

	public function get_customer_provider(): CustomerProvider {
		return $this->customer_provider;
	}

	public function get_guest_factory(): GuestFactory {
		return $this->guest_factory;
	}

	public function get_outcome_information(): OutcomeInformationRepository {
		return $this->outcome_information;
	}
}
