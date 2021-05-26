<?php

namespace WPDesk\ShopMagic\Action\Builtin\OptinList;

use WPDesk\ShopMagic\Exception\CannotModifyList;


final class AddToListAction extends AbstractListAction {
	public function get_name(): string {
		return __( 'Add E-mail to List', 'shopmagic-for-woocommerce' );
	}

	protected function do_list_action( string $email, int $list_id, string $list_name ): bool {
		if ( $this->is_subscribed_to_list( $email, $list_id ) ) {
			throw new CannotModifyList(
				sprintf(
					__( 'Customer email %s is already subscribed to this list: %s.', 'shopmagic-for-woocommerce' ),
					$email,
					$list_name
				)
			);
		}

		$this->get_opt_repo()->opt_in( $email, $list_id );

		$this->logger->info(
			sprintf(
				__( 'Customer email %s successfully added to list: %s.', 'shopmagic-for-woocommerce' ),
				$email,
				$list_name
			)
		);

		return true;
	}

	private function is_subscribed_to_list( string $email, int $list_id ): bool {
		$optins_info = $this->get_opt_repo()->find_by_email( $email );

		return $optins_info->is_opted_in( $list_id );
	}
}
