<?php

namespace WPDesk\ShopMagic\Action\Builtin\OptinList;

use WPDesk\ShopMagic\Exception\CannotModifyList;


final class DeleteFromListAction extends AbstractListAction {
	public function get_name(): string {
		return __( 'Delete E-mail from List', 'shopmagic-for-woocommerce' );
	}

	protected function do_list_action( string $email, int $list_id, string $list_name ): bool {
		if ( $this->is_not_subscribed_to_list( $email, $list_id ) ) {
			throw new CannotModifyList(
				sprintf(
					__( 'Could not delete customer email %s from list: %s, because it was not subscribed to it.', 'shopmagic-for-woocommerce' ),
					$email,
					$list_name
				)
			);
		}

		$this->get_opt_repo()->opt_out( $email, $list_id );

		$this->logger->info(
			sprintf(
				__( 'Customer email %s successfully deleted from list: %s.', 'shopmagic-for-woocommerce' ),
				$email,
				$list_name
			)
		);

		return true;
	}

	private function is_not_subscribed_to_list( string $email, int $list_id ): bool {
		$optins_info = $this->get_opt_repo()->find_by_email( $email );

		return $optins_info->is_opted_out( $list_id );
	}
}
