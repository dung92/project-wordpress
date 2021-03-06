<?php

namespace WPDesk\ShopMagic\Placeholder\Helper;

use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\Helper\WordPressFormatHelper;

/**
 * Helps placeholders with a date with formatting.
 *
 * @package WPDesk\ShopMagic\Placeholder\Helper
 */
final class DateFormatHelper {
	public function get_supported_parameters(): array {
		return [
			( new InputTextField() )
				->set_description( sprintf( __( 'Date format according to <a href="%s" target="_blank">PHP date formatting</a>', 'shopmagic-for-woocommerce' ), 'https://www.php.net/manual/en/datetime.format.php' ) )
				->set_label( __( 'Date format', 'shopmagic-for-woocommerce' ) )
				->set_placeholder( get_option( 'date_format', 'Y-m-d' ) )
				->set_name( 'format' ),
			( new InputTextField() )
				->set_description( sprintf( __( 'Can modify the returned datetime. For more information check <a href="%s">PHP datetime relative formats</a>', 'shopmagic-for-woocommerce' ), 'https://www.php.net/manual/en/datetime.formats.relative.php' ) )
				->set_label( __( 'Datetime modification', 'shopmagic-for-woocommerce' ) )
				->set_placeholder( __( 'e.g. +3 months, +2 days, -1 hours', 'shopmagic-for-woocommerce' ) )
				->set_name( 'modify' )
		];
	}

	/**
	 * @param \DateTimeInterface|string $date When using string, use site timezone.
	 * @param array $params
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function format_date( $date, array $params ): string {
		if ( $date === null ) {
			$date = new \DateTime( 'now' );
		}
		if ( is_string( $date ) ) {
			$date = new \DateTime( $date );
		}
		if ( ! empty( $params['modify'] ) ) {
			$modified = ( new \DateTime() )->setTimestamp( $date->getTimestamp() )->modify( $params['modify'] );;
			$date = $modified !== false ? $modified : $date; // modify can return false
		}
		if ( isset( $params['format'] ) && $params['format'] !== null ) {
			return WordPressFormatHelper::custom_format_wp_date( $date, $params['format'] );
		}

		return WordPressFormatHelper::format_wp_date( $date );
	}
}
