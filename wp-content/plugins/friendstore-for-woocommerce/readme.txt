=== FriendStore for WooCommerce ===
Contributors: vietfriendteam
Plugin URI: http://team.vietfriend.info/
Tags: friendstore, woocommerce, shipping, vietnam, checkout, shop, store, ghn, ghtk, giao hang nhanh, giao hang tiet kiem
Requires at least: 4.4.0
Tested up to: 5.4
Stable tag: 2.0.6
Requires PHP: 5.4
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==
Is an extension of WooCommerce that support customizing addresses in Vietnam.

**MAIN FEATURES**

**1. Customize WooCommerce address fields**
Customize WooCommerce address fields everywhere:
▪ Back-end: Store address
▪ Back-end: Your profile
▪ Back-end: Order details
▪ Front-end: Cart page
▪ Front-end: Checkout page
▪ Front-end: My account > Adresses
...

**2. Add new order statuses**
▪ Shipping (wc-shipping)
▪ Shipped (wc-shipped)

**3. Integrating with delivery units (Pro)**
▪ Giao hàng nhanh (GHN express)
▪ Giao hàng tiết kiệm (GHTK express)

**4. Address book (like tiki, sendo, lazada, shopee...)**
▪ Disable address book:
`add_filter('fsw_user_addresses_enabled', '__return_false');`

**5. Calculate shipping fee on product detail (like tiki, sendo, lazada, shopee...)**
▪ Disable calculate shipping:
`add_filter('fsw_product_shipping_calculator_enabled', '__return_false');`
▪ Turn off auto calculate shipping:
`add_filter('fsw_product_shipping_calculator_auto', '__return_false');`

**EXTENSION DEVELOPMENT PLAN**

▪ Integrating Viettel Post unit (ViettelPost express)

**USEFUL LINKS:**

▪ Website (Pro version): [//store.vietfriend.info](https://store.vietfriend.info/?utm_source=wporg&utm_medium=cpc&utm_campaign=friendstore_plugin&utm_content=wporg_demo) *(Account: demo/123456)*
▪ Product information: [//code.vietfriend.info/product/friendstore-for-woocommerce-pro/](https://code.vietfriend.info/product/friendstore-for-woocommerce-pro/?utm_source=wporg&utm_medium=cpc&utm_campaign=friendstore_plugin&utm_content=wporg_product)

== Translations included ==

▪ English (US) (English (US))
▪ Tiếng Việt (Vietnamese)

== Installation ==

**Minimum Requirements**

* WordPress 4.4 or greater
* WooCommerce 3.0 or greater
* PHP version 5.4 or greater
* MySQL version 5.0 or greater

**Uploading in Plugin Dashboard**

*Step 1:* Download **FriendStore for WooCommerce**

*Step 2:* Navigate to the **Dashboard -> Plugins -> Add New**, and then click **Upload Plugin**.

*Step 3:* Click **Install Now** and activate the plugin in the **Plugin dashboard**

**Installing in Plugin Dashboard**

*Step 1:* Navigate to the **Dashboard -> Plugins -> Add New**.

*Step 2:* In the search bar type **FriendStore for WooCommerce**

*Step 3:* Select this plugin and click on **Install Now**

**Using FTP**

*Step 1:* Download **FriendStore for WooCommerce**.

*Step 2:* Extract the plugin code to your computer

*Step 3:* Upload **`friendStore-for-woocommerce`** folder to your WordPress plugins directory **`/wp-content/plugins/`**

*Step 4:* Activate the plugin in the **Plugin dashboard**

The WordPress codex contains [instructions on how to do this here](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

== Frequently Asked Questions ==

= Is this plugin compatible with the latest version of Wordpress and WooCommerce? =

Of course, it is. We are always tried to make regular update so that the plugin can be compatible with the latest version of Wordpress and WooCommerce.

= Can it work well with other Wordpress theme? =

Yes, it can. This plugin can be used with any Wordpress themes.

= What is the number format and currency of Vietnamese? =

In Vietnam, the currency is Vietnamese đồng (₫), the thousand separator is dot (.), the decimal separator is comma (,), the number of decimals should be 0.

== Screenshots ==

1. Notice after setup Plugin
2. Update Store address (pro)
3. Update Shipping settings (pro)
4. Calculate Shipping Cost on Cart page (pro)
5. Select address from Address Book
6. Calculate Shipping Cost on Checkout page (pro)
7. List Shipping addresses in Address Book
8. Add new/Edit Shipping address
9. List shipping address in Profile (wp-admin)

== CHANGELOG ==

= 1.4.2 - 2020-08-19 =
* Updated: Add filter config `fsw_user_addresses_enabled`
* Updated: Add filter config `fsw_product_shipping_calculator_enabled`
* Updated: Add filter config `fsw_product_shipping_calculator_auto`
* Fixed: Fix bugs

= 1.4.1 - 2020-08-04 =
* Fixed: Product Shipping Calculator error in Simple, Grouped, Virtual & External product

= 1.4.0 - 2020-08-03 =
* Updated: Add Product Shipping Calculator (References from Magerips plugin)

= 1.3.0 - 2020-07-28 =
* Updated: Add Customer Address Book (References from WooCommerce plugin)

= 1.2.1 - 2020-07-09 =
* Fixed: Fix error when activate pro version

= 1.2.0 - 2020-03-22 =
* Update: Ajax new version - Select address faster than before

= 1.1.9 - 2019-11-05 =
* Update: Update notice after setup (thank fb:tuongbhn)
* Fixed: Fix select2 district, ward when city selected in Rey (Marius H.) theme (thank fb:tuongbhn)

= 1.1.8 - 2019-11-04 =
* Update: Separate the Lite and Pro versions
* Fixed: Check language Vietnamese with WordPress versions 4.9.12 and earlier

= 1.1.7.1 - 2019-11-01 =
* Fixed: Copy address of user in Order details (when add new, select customer)

= 1.1.7 - 2019-11-01 =
* Update: Copy address of user in Order details

= 1.1.6 - 2019-10-30 =
* Update: Copy billing address in Order details
* Fixed: Fix copy address when edit User (thanks fb:BloggerNguyenPhatLoc)

= 1.1.5 - 2019-10-29 =
* Updated: Escape all string in internationalization functions
* Fixed: Fix copy address in Your Profile (thanks fb:BloggerNguyenPhatLoc)

= 1.1.4 - 2019-10-28 =
* Fixed: Update CSS fix select2 in WooCart theme
* Fixed: Fix text placeholder Select Province/City (thanks fb:neoxone47)

= 1.1.3 - 2019-10-27 =
* Fixed: Remove link setting in Plugin Dashboard (thanks @truongduy)
* Fixed: Format PHP code (Easy to compare with Pro version)

= 1.1.2 - 2019-10-25 =
* Fixed: Change Text Domain

= 1.1.1 - 2019-10-25 =
* Fixed: Select2 in cart
* Fixed: Select2 in addresses my account

= 1.1.0 - 2019-10-25 =
* Updated: Store Address in General Options

= 1.0.0 - 2019-10-24 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
please update the settings at admin area & settings tab before operating your website.
