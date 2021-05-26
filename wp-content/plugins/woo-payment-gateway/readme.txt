=== Braintree For WooCommerce ===
Contributors: Payment Plugins
Donate link: 
Tags: braintree, braintree gateway, braintree plugin, braintree payments, payment processing, woocommerce, payment gateway, 3DS, 3D-Secure, 3D Secure, threeDSecure, woocommerce subscriptions, payment gateways, paypal, subscriptions, braintree subscriptions, payment forms, wordpress payments, v.zero, saq a
Requires at least: 3.0.1
Requires PHP: 5.6
Tested up to: 5.7
Stable tag: 3.2.21
Copyright: Payment Plugins
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Accept Credit Cards, PayPal, PayPal Credit, Google Pay, ApplePay, Venmo, and Local Payments like iDEAL all in one plugin for free!

= Official Partner Of Braintree =
Payment Plugins is an official partner of Braintree & PayPal and has worked closely with them to develop this solution.

= Boost conversion by offering product and cart page checkout =
Braintree for WooCommerce is made to supercharge your conversion rate by decreasing payment friction for your customer.
Offer PayPal, Google Pay, Apple Pay on product pages, cart pages, and at the top of your checkout page.

= Features =
- Google Pay
- Apple Pay
- PayPal, PayPal Pay Later, PayPal Credit
- Venmo
- Credit Cards
- 3D Secure 2.0 & 1.0
- iDEAL, P24, SEPA, WeChat, Giropay, & more
- SAQ A PCI Compliant
- Beautifully designed forms
- Create your own custom form
- Integrates with Woocommerce
- Integrates with Woocommerce Subscriptions 2.0.0+
- Offer subscriptions without the WooCommerce Subscription plugin
- Integrations with WooCommerce currency switchers
- Add Custom fees
- Void transactions
- Automatic settlement or authorize transactions
- Issue refunds
- Dynamic descriptors

= Support =
For more information or questions, please email <a href=�mailto:support@paymentplugins.com�>support@paymentplugins.com</a> or read through our detailed <a target="_blank" href="https://docs.paymentplugins.com/wc-braintree/config/#/">documentation</a>.

= Developer Docs = 
Need to customize the plugin? It's easy using our documentation. [Code Examples](https://docs.paymentplugins.com/wc-braintree/config/#/code_examples) && [Developer Docs](https://docs.paymentplugins.com/wc-braintree/api/)

== Frequently Asked Questions ==

= Do you have an documentation? =
Yes, we have [Configuration docs](https://docs.paymentplugins.com/wc-braintree/config/#/) and [Developer docs](https://docs.paymentplugins.com/wc-braintree/api/)

= How do I test the plugin? = 
To test the plugin, all you have to do is create a [Braintree Sandbox](https://www.braintreepayments.com/sandbox) account and [Configure the plugin](https://docs.paymentplugins.com/wc-braintree/config/#/braintree_api).

= Does your plugin support mulit-currency shops? = 
Yes, our plugin supports shops that sell in multiple currencies. It's easy to setup! [Read more here](https://docs.paymentplugins.com/wc-braintree/config/#/braintree_advanced?id=merchant-accounts)

= Does your plugin support 3DS 2.0? = 
Yes, this plugin supports 3DS 2.0.

= Why is my card processing as 3DS 1.0? = 
Some card providers have not switched over to 3DS 2.0 yet so Braintree processes the transaction as 3DS 1.0. This isn't anything to be alarmed
about and is expected behavior.

== Screenshots ==
1. Product page showing one click checkout with PayPal, Google Pay, and Apple Pay
2. Cart page showing one click checkout
3. Checkout page showing Google Pay selected
4. Credit card form which has been filled out
5. PayPal popup for selecting shipping method
6. Customize which payment options are available on the product page
7. Settings page
8. Mini cart one click checkout

== Changelog ==
= 3.2.21 =
* Updated - PayPal popup shipping options now show tax included if that setting is enabled in WC Tax Settings
* Updated - Braintree JS version 3.76.3
* Updated - WC tested up to: 5.3
= 3.2.20 =
* Fixed - PayPal Error "Invalid or missing payment token fields" triggered by WC validation when paying failed renewal order on checkout page.
* Updated - Braintree JS version 3.76.1
= 3.2.19 =
* Added - Shortcode wc_braintree_payment_buttons so payment buttons can be rendered anywhere on product and cart page.
* Added -  Permissions check manage_woocommerce for Braintree Settings panel on product edit page
* Added - PayPal populate shipping_phone on checkout page if it exists and PayPal provided phone number
* Added - PayPal msg support for GBP currency
* Updated - Braintree JS version 3.76.0
* Updated - Braintree Dropin version 1.27.0
* Updated - Braintree PHP SDK 5.5.0
* Updated - WC Tested up to 5.1
* Updated - AVS error code messaging.
= 3.2.18 =
* Added - New GPay rounded corner icon
* Added - Guest users can now process Pre-Order products.
* Updated - WooCommerce Subscriptions payment method saved when failed renewal order paid for.
* Updated - Braintree JS version 3.72.0
* Updated - Braintree Dropin version 1.26.0
* Updated - replaced use of get_user_meta with get_user_option for customer ID's. This ensures better support for multisite.
* Updated - PayPal: if shipping required and shipping address not changed in PayPal pop-up, auto-submit checkout form.
* Updated - WC tested up to 5.0
= 3.2.17 =
* Added - WC tested up to 4.9.0
* Added - GPay 3DS option. This will allow merchants to determine if they want GPay to go through 3DS instead of it being automatically determined based on merchant account.
* Updated - Braintree JS version 3.71.0
* Updated - Braintree Dropin version 1.25.0
* Updated - Improved Pay Later messaging on product page.
* Updated - Bootstrap and Dropin form save card label moved inline
* Updated - Braintree subscriptions created after payment processed instead of before.
* Fixed - GPay express button using default styling
* Fixed - Payment buttons on product pages when variable product has multiple variations
= 3.2.16 =
* Added - 3DS integration with GPay (https://developers.braintreepayments.com/guides/3d-secure/client-side/javascript/v3#using-3d-secure-with-google-pay)
* Added - Link to GPay test cards group which when signed up for will populate GPay wallet with test cards automatically.
* Fixed - PayPal DOMException "Failed to execute 'removeChild' on 'Node'" introduced in version 5.0.132 (https://github.com/paypal/paypal-checkout-components/blob/master/CHANGELOG.md#50132-2020-12-17)
= 3.2.15 =
* Added - Display Apple Pay button even if customer's Apple Wallet requires setup.
* Fixed - options.createBillingAgreement update for error "Incomplete PayPal account information"
* Fixed - Webhook notification object in request
* Updated - Display link to checkout page if required fields on product or cart page are missing during one click checkout
* Updated - Styling on PayPal shipping option modal for subscription product pages

= 3.2.14 =
* Updated - WC tested to 4.8
* Fixed - b is not defined on certain browsers when Dropin form enabled.
= 3.2.13 =
* Updated - Tested WP 5.6
* Updated - Tested PHP8
* Added - GPay 3D 2.0 merchantInfo properties (countryCode and merchantName)
* Added - Order button text for local payment gateways
* Added - wc_braintree_payment_token_formats filter
* Fixed - Only show Pay in 4 messaging if Pay in 4 button enabled
* Updated - Commented out terms and conditions on cart page (cart/cart-fields.php template) based on merchant feedback.
= 3.2.12 =
* Fixed - Global product section for PayLater button
* Added - Color option for PayLater messaging, global and for individual products
* Added - Promise poly-fill for IE
* Updated - Don't request billing address in Apple Pay, GPay, if customer has already filled out billing fields on checkout page
= 3.2.11 =
* Updated - Braintree JS version 3.69.0
* Updated - WC tested to 4.7.0
* Updated - Removed html in PayPal elements that's no longer needed
* Updated - Don't enqueue scripts on order received page
* Fixed - Remove checkout page overlay if local payment pop-up is closed by customer
* Added - Apple Pay payment method display option. Example: Visa ending in 1111
* Added - New filter wc_braintree_save_order_meta that is triggered when saving order meta after a transaction is processed.
* Added - If province/state long name used in GPay wallet, convert to short name for shipping method calculation. Example: Santa Cruz de Tenerife = TF
= 3.2.10 =
* Added - Transaction url in order details page
* Added - Improved support for WPML
* Added - Improved support for WooCommerce Price Based on Currency
* Added - Additional checks for gateway data on checkout page
* Added - Support for RTL languages
* Added - WC tested to 4.6+
= 3.2.9 =
* Fixed - PayPal error "doesn't ship to this location. Please use a different address" error when price inclusive of tax enabled and cart requires shipping
* Fixed - One time use coupon conflict with local payment methods
* Updated - Braintree JS version to 3.68.0
= 3.2.8 =
* Added - Shipping options in PayPal pop-up for one-click checkout.
* Added - Buy Now Pay Later payment option (formerly PayPal credit)
* Added - Autofocus to credit card forms so cursor automatically goes to next field once input is entered.
* Updated - Bootstrap and card shape form now use combined exp day and month
* Updated - Braintree JS version to 3.67.0
* Updated - Braintree Dropin version to 1.24.0
* Updated - Don't show Pay Later messaging if cart total is zero
* Updated - Improved mini-cart integration
* Updated - Improved compatibility with elementor
* Updated - Improved checkout page required fields messaging
* Updated - Hide Pay Later messaging options on Admin Edit Product pages if subscriptions are active (Regulations for Pay Later messaging dictate this)
= 3.2.7 =
* Updated - GPay & Apple Pay on Checkout page - only request shipping address and methods in the wallet if the customer has not filled out their shipping address
* Added - Ability to control button design for PayPal, GPay, and Apple Pay on product pages
* Added - PayPal credit (Pay Later) messaging options added
* Added - More options for PayPal credit. Can now select if it should be rendered on product, cart, and checkout page.
* Added - Additional Apple Pay button types (Checkout with, Subscribe)
* Fixed - GPay requiring shipping on virtual variable product
= 3.2.6 =
* Updated - Only include local payment methods in wp_localize when gateway is enabled
* Updated - Braintree JS version to 3.65.0
* Updated - Show discount amount as negative in Apple Pay and GPay
* Updated - WC tested to 4.5.0
* Fixed - JS error when cart/checkout page combined using Elementor
* Fixed - Edit product page gateway settings styling issue with slider
= 3.2.5 =
* Added - Mini-cart support for Apple Pay, GPay, PayPal
* Updated - Replaced custom form json with styles interface to make editing custom forms even easier
* Updated - Braintree JS version to 3.64.2
* Updated - WC tested to 4.4.1
* Updated - Removed select2 dependency
* Updated - Fee's api uses cart content total which accounts for discounts
* Updated - Apple Pay now recognizes state name and converts to abbreviation. E.g Texas to TX
* Updated - checkout/cc-checkout.php renamed to checkout/credit-card.php
* Fixed - WP 5.5 REST route permission_callback notice
= 3.2.4 =
* Updated - Braintree JS version to 3.64.1
* Updated - PayPal Smartbutton SDK version
* Updated - Transaction line items validations
* Added - Apple Pay default shipping method
* Added - PayPal button height option
* Added - WC tested up to 4.3.1
* Fixed - Apple Pay cart fee undefined notice
= 3.2.3 =
* Updated - Braintree JS version to 3.63.0
* Updated - Dropin version to 1.23.0
* Updated - Added additional logic to transaction line items.
* Updated - Performance improvements to fee API
= 3.2.2 =
* Added - Unit amount check for coupons and fees to prevent $0 amounts.
* Added - Option to disable line items
* Added - Line item name length validation for fees and coupons
* Added - Apple Pay address make country code and state upper case
= 3.2.1 = 
* Updated - WC tested to 4.3.0
* Updated - Braintree Subscription Product sign-up fee now part of product price
* Updated - Braintree Subscription coupon logic
* Updated - Reverted Braintree JS version to 3.62.1
* Added - Line items to PayPal transactions
* Added - Fee and coupon line items to all transactions
* Fixed - PayPal error on checkout page related to subscriptions
= 3.2.0 = 
* Fixed - PayPal window crashing on checkout page when updating billing fields
* Fixed -  Subscription JS script not loading on admin product page
* Updated - Braintree JS version to 3.62.2
* Updated - CSS for payment methods that don't require expanded payment box
= 3.1.10 = 
* Updated - WC tested to 4.2.0
* Updated - API connection test UI
* Added - Product payment buttons can be configured per product
* Added - Checkout form does not auto-submit if PayPal button on top of checkout page clicked and a shipping method needs to be selected
* Added - Local payment options on Order Pay page
* Added - Local payment support for manual subscriptions
* Fixed - Save PayPal payment method for Pre-Orders
* Fixed - WP 5.4.2 namespace deprecation message
= 3.1.9 = 
* Updated - WC tested to 4.1.0
* Updated - Braintree JS version to 3.62.1
* Added  - PayPal transaction ID to order meta.
* Fixed - Check for PayPal button container before attaching button.
= 3.1.8 = 
* Updated - Braintree JS version to 3.62.0
* Updated - GPay documentation and new link to GPay Business Console
* Added - Vat tax inclusion on Apple Pay and GPay wallets
* Fixed - Terms text disappearing on cart during update if only PayPal active
= 3.1.7 = 
* Updated - WC 4.0.1
* Updated - WP 5.4
* Fixed - Apple Pay and Google Pay rounding when provided amounts exceed 2 decimals.
* Added - Saved payment methods translatable string "No matches found".
= 3.1.6 = 
* Updated - WC 4.0.0 support
= 3.1.5 = 
* Updated = WC 3.9.3 support
* Updated - Braintree JS version to 3.59.0
* Updated - Dropin version to 1.22.1
* Fixed - CC form not showing on checkout page if customer has 100% coupon when page loads then selects shipping method that causes order total to be greater than zero.
= 3.1.4 = 
* Added - Plugin automatically converts data from PayPal Powered By Braintree to this plugin's format. This ensures smooth transition and no interruption to recurring payments, pre-orders, etc.
* Added - Save credit card option added to Admin Pay Order.
* Added - Discount line items added to payment sheets.
* Fixed - Admins can add multiple products to subscription on Admin Subscription page.
= 3.1.3 = 
* Updated - cart buttons positioning
* Updated - wpml-config.xml file added
* Added - WC 3.9.1 support
= 3.1.2 = 
* Updated - Braintree JS version to 3.57.0
* Updated - Braintree PHP SDK to 4.6.0
* Updated - WC 3.9 support
= 3.1.1 = 
* Updated - Braintree JS to 3.56.0
* Fixed - Place order button not re-appearing when PayPal clicked then local method.
= 3.1.0 = 
* Added - WC 3.8.1
* Added - Pop-ups message for local payments when browser blocks pop-up.
* Added - Hook added after subscription payment method update.
= 3.0.9 =
* Updated - Braintree JS to 3.55.0
* Added - Gateway description option
* Added - Merchants can now add the Apple domain association file using the plugin
* Fixed - Used for variation option not showing in WC 3.7+ when Braintree variable subscription selected
= 3.0.8 =
* Updated - Braintree JS to 3.54.2
* Updated - Improved local payments logic.
* Updated - Google Pay paymentDatacallbacks updated
* Added - Kount status logic
= 3.0.7 = 
* Updated - Always return instance of token in WC_Braintree_Payment_Gateway::get_token() even if token doesn't exist. This prevents exceptions when data doesn't exist in tokens table.
* Added - WC Pre-Order check to see if order contains a pre-order. Previously only checked if a pre-order required tokenization.
* Added - Polyfill for old browsers (IE11 etc) that don't support Promises.
= 3.0.6 = 
* Updated - Braintree JS to 3.53.0
* Added - action in add_payment_method function so plugins can alter behavior before payment method save.
* Fixed - Dropin form message "please fill out payment form" that happens occasionally on checkout page load.
* Fixed - Truncate item description to less than 127 characters when adding line items to transaction.
* Fixed - Error that appears when 3DS enabled and cart total is zero due to subscription with a trial period.
* Added - PayPal addressOverride logic so returning customers will see their address in PayPal popup.
* Added - Pre Order support for payments on a product that occur in the future.
= 3.0.5 = 
* Updated - Braintree JS 3.52.1
* Updated - update-3.0.4.php file directory list check added. Some merchant sites don't have permissions setup properly so check for directory before update.
* Updated - Check for existance of shipping fields when verifying 3DS so undefined values aren't returned.
* Updated - Shop manager permission added to order actions like void, capture, view transaction popup.
* Fixed - Place Order button not re-appearing if credit card gateway not selected first.
= 3.0.4 = 
* Updated - Braintree JS 3.52.0
* Updated - Braintree vault ID check added to add_payment_method function.
* Updated - Address null check added to add_payment_method function
* Updated - Plugin text domain changed to woo-payment-gateway. Update attemps to change all translations that use braintree-payments to woo-payment-gateway.
* Added - Browser locale detection added for PayPal smartbutton
* Updated - PayPal will show customer shipping address in pop-up if already entered.
= 3.0.3 = 
* Added - Order pay line items in Google and Apple Pay payment sheets.
* Fixed - Spelling errors corrected
* Fixed - PayPal popup error on order pay page
* Fixed - Apple Pay invalid state validation for countries without states
* Updated - Updated subscription functionality so billing frequency always returns a number to prevent DateInterval exceptions when subscriptions haven't been configured 100%.
= 3.0.2 = 
* Fixed - Error caused by fees script when fees are enabled.
* Updated - If dynamic pricing is not enabled for Google Pay, the customer is directed to the checkout page and prompted to review their order. All billing and shipping fields are pre-populated.
* Updated - JS script version to 3.51.0.
* Added - EPS, Bancontact, Giropay, SEPA, WeChat, MyBank, Sofort
= 3.0.1 = 
* Added - PayPal to product page
* Added - Google Pay to product and cart page
* Added - Google Pay dynamic price (shows line items in payment sheet)
* Added - iDEAL, P24
* Updated - Subscription functionality
* Updated - All JS scripts
* Updates - Client token API for improved speed
* Removed - Donation functionality removed. To continue to use donations, download version 2.6.65 and do not upgrade.
= 2.6.65 = 
* Updated - Script version to 3.50.0
* Updated - Non ASCII chars replaced for 3DS 2.0
= 2.6.64 = 
* Fixed - Apple Pay variable product conflict resolved.
* Updated - Script version to 3.48.0
* Added - 3.0.0 Release candidate notice
* Added - PayPal locale in button render function