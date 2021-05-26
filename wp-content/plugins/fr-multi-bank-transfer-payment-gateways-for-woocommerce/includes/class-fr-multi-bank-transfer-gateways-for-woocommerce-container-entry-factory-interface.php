<?php
/**
 * Fr_Multi_Bank_Transfer_Gateways_For_Woocommerce_Container_Entry_Factory_Interface interface.
 *
 * @package Fr_Multi_Bank_Transfer_Gateways_For_Woocommerce
 */

defined( 'ABSPATH' ) || die;

/**
 * Container entry factory interface.
 *
 * @since 1.1.0
 * @author Fahri Rusliyadi <fahri.rusliyadi@gmail.com>
 */
interface Fr_Multi_Bank_Transfer_Gateways_For_Woocommerce_Container_Entry_Factory_Interface {
	/**
	 * Create an entry.
	 *
	 * @since 1.1.0
	 * @param Fr_Multi_Bank_Transfer_Gateways_For_Woocommerce_Container $container Dependency injection container.
	 * @return mixed
	 */
	public function create( Fr_Multi_Bank_Transfer_Gateways_For_Woocommerce_Container $container );
}
