<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-11 00:57:18 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 00:58:25 --> 404 Page Not Found: Uploaderphp/index
ERROR - 2019-11-11 01:09:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 01:09:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 01:10:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 01:10:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 01:38:03 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 01:38:04 --> 404 Page Not Found: Blog-left-sidebarhtml/index
ERROR - 2019-11-11 01:38:47 --> 404 Page Not Found: Tphp/index
ERROR - 2019-11-11 02:18:24 --> 404 Page Not Found: Uphp/index
ERROR - 2019-11-11 02:57:59 --> 404 Page Not Found: Vphp/index
ERROR - 2019-11-11 03:23:09 --> 404 Page Not Found: Blog-detail-audiohtml/index
ERROR - 2019-11-11 03:37:45 --> 404 Page Not Found: Wphp/index
ERROR - 2019-11-11 03:53:47 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 04:17:32 --> 404 Page Not Found: Xphp/index
ERROR - 2019-11-11 04:37:40 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 04:57:25 --> 404 Page Not Found: Yphp/index
ERROR - 2019-11-11 05:37:30 --> 404 Page Not Found: Zphp/index
ERROR - 2019-11-11 05:38:59 --> 404 Page Not Found: Blog-detail-carouselhtml/index
ERROR - 2019-11-11 06:17:15 --> 404 Page Not Found: Xxphp/index
ERROR - 2019-11-11 06:57:48 --> 404 Page Not Found: Imgphp/index
ERROR - 2019-11-11 06:58:45 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 07:18:08 --> 404 Page Not Found: Blog-detail-left-sidebarhtml/index
ERROR - 2019-11-11 07:38:04 --> 404 Page Not Found: Images/s.php
ERROR - 2019-11-11 08:07:28 --> 404 Page Not Found: 404html/index
ERROR - 2019-11-11 08:18:21 --> 404 Page Not Found: Images/img.php
ERROR - 2019-11-11 09:31:38 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 09:32:23 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`id` as `restaurant_id`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`, count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
FROM `kitchens`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:35:08 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`id` as `restaurant_id`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`, count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
FROM `kitchens`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:35:32 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 09:39:16 --> 404 Page Not Found: Test/assets
ERROR - 2019-11-11 09:39:16 --> 404 Page Not Found: Test/assets
ERROR - 2019-11-11 09:39:26 --> 404 Page Not Found: Test/populer_this_month
ERROR - 2019-11-11 09:40:11 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 09:40:53 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`id` as `restaurant_id`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`, count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
FROM `kitchens`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:41:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORM' at line 2 - Invalid query: SELECT count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:41:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORM' at line 2 - Invalid query: SELECT count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 206
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 207
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 249
ERROR - 2019-11-11 09:42:22 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 250
ERROR - 2019-11-11 09:42:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 206
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 207
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 249
ERROR - 2019-11-11 09:42:24 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 250
ERROR - 2019-11-11 09:42:43 --> Query error: Unknown column 'total_orders' in 'order clause' - Invalid query: SELECT `orders`.`id`, `orders`.`restaurant_id`
FROM `orders`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:43:11 --> Query error: Unknown column 'total_orders' in 'order clause' - Invalid query: SELECT `orders`.`id`, `orders`.`restaurant_id`, count(orders.restaurant_id) as total_restaurant_orders
FROM `orders`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 206
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 207
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: res_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 249
ERROR - 2019-11-11 09:48:47 --> Severity: Notice --> Undefined index: address /home/ns5v7fqd4oor/public_html/application/views/home/index.php 250
ERROR - 2019-11-11 09:59:35 --> Query error: Unknown column 'sales_res' in 'order clause' - Invalid query: SELECT `orders`.`id`, `orders`.`restaurant_id`, count(orders.restaurant_id) AS restaurant_count
FROM `orders`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `orders`.`restaurant_id`
ORDER BY `sales_res` DESC
 LIMIT 3
ERROR - 2019-11-11 10:13:11 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `orders`.`id`, `orders`.`restaurant_id`, `order_items`.`food_menu_id`, count(order_items.food_menu_id) AS food_menu_id_count, `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`
FROM `order_items`
LEFT JOIN `orders` ON `orders`.`id` = `order_items`.`order_id`
LEFT JOIN `kitchens` ON `kitchens`.`id` = `orders`.`restaurant_id`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `order_items`.`food_menu_id`
ORDER BY `food_menu_id_count` DESC
 LIMIT 5
ERROR - 2019-11-11 10:13:56 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `orders`.`id`, `orders`.`restaurant_id`, `order_items`.`food_menu_id`, count(order_items.food_menu_id) AS food_menu_id_count, `foodmenu`.`menu_name`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`
FROM `order_items`
LEFT JOIN `orders` ON `orders`.`id` = `order_items`.`order_id`
LEFT JOIN `kitchens` ON `kitchens`.`id` = `orders`.`restaurant_id`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `order_items`.`food_menu_id`
ORDER BY `food_menu_id_count` DESC
 LIMIT 5
ERROR - 2019-11-11 10:17:43 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 10:22:33 --> Query error: Unknown column 'foodmenu.food_menu_id' in 'field list' - Invalid query: SELECT `foodmenu`.`food_menu_id`, `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`
FROM `foodmenu`
WHERE `foodmenu`.`food_menu_id` = '637'
ERROR - 2019-11-11 10:23:02 --> Query error: Unknown column 'foodmenu.food_menu_id' in 'field list' - Invalid query: SELECT `foodmenu`.`food_menu_id`, `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`
FROM `foodmenu`
WHERE `foodmenu`.`food_menu_id` = '637'
ERROR - 2019-11-11 10:24:49 --> Severity: Notice --> Undefined index: food_menu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 195
ERROR - 2019-11-11 10:24:49 --> Query error: Unknown column 'foodmenu.food_menu_id' in 'field list' - Invalid query: SELECT `foodmenu`.`food_menu_id`, `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`
FROM `foodmenu`
WHERE `foodmenu`.`food_menu_id` IS NULL
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 211
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 212
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 242
ERROR - 2019-11-11 10:27:37 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 243
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 215
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 216
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 215
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 216
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 215
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 216
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 215
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 216
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 215
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 216
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 246
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 247
ERROR - 2019-11-11 10:28:27 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 246
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 247
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 246
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 247
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 246
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 247
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 246
ERROR - 2019-11-11 10:28:28 --> Severity: Notice --> Undefined index: menu_name /home/ns5v7fqd4oor/public_html/application/views/home/index.php 247
ERROR - 2019-11-11 10:30:23 --> Query error: Unknown column 'foodmenu.food_menu_id' in 'field list' - Invalid query: SELECT `foodmenu`.`food_menu_id`, `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`
FROM `foodmenu`
WHERE `foodmenu`.`food_menu_id` = '637'
ERROR - 2019-11-11 10:35:32 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 10:40:00 --> Query error: Unknown column 'favorite_food.foodmenu_id' in 'on clause' - Invalid query: SELECT `orders`.`id` as `order_id`, `order_items`.`food_menu_id`, count(order_items.food_menu_id) AS food_menu_id_count, `orders`.`restaurant_id`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`
FROM `order_items`
LEFT JOIN `orders` ON `orders`.`id` = `order_items`.`order_id`
LEFT JOIN `kitchens` ON `kitchens`.`id` = `order_items`.`food_menu_id`
LEFT JOIN `foodmenu` ON `foodmenu`.`foodmenu_id` = `favorite_food`.`foodmenu_id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `order_items`.`food_menu_id`
ORDER BY `food_menu_id_count` DESC
 LIMIT 5
ERROR - 2019-11-11 10:47:40 --> Severity: error --> Exception: Call to undefined function check_complementary_zamy() /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 482
ERROR - 2019-11-11 10:53:04 --> Severity: error --> Exception: Call to undefined function check_complementary_zamy() /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 482
ERROR - 2019-11-11 10:55:01 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:55:02 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:55:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 10:55:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 10:56:15 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 10:56:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 192
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 10:56:41 --> Severity: Notice --> Undefined index: foodmenu_id /home/ns5v7fqd4oor/public_html/application/views/home/index.php 231
ERROR - 2019-11-11 11:04:48 --> Severity: error --> Exception: Call to undefined function populer_this_month_food_slider() /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 46
ERROR - 2019-11-11 11:07:24 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 11:07:28 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:07:32 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 11:07:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 11:08:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 11:08:38 --> Severity: error --> Exception: /home/ns5v7fqd4oor/public_html/application/models/api/Api_model.php exists, but doesn't declare class Api_model /home/ns5v7fqd4oor/public_html/system/core/Loader.php 336
ERROR - 2019-11-11 11:08:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 11:11:07 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:19:30 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:22:08 --> Severity: error --> Exception: /home/ns5v7fqd4oor/public_html/application/models/api/Api_model.php exists, but doesn't declare class Api_model /home/ns5v7fqd4oor/public_html/system/core/Loader.php 336
ERROR - 2019-11-11 11:27:11 --> Query error: Unknown column 'case' in 'field list' - Invalid query: SELECT `kitchens`.`id`, `kitchens`.`res_name`, `kitchens`.`type`, `kitchens`.`email`, `kitchens`.`images`, `kitchens`.`logo`, `kitchens`.`address`, `kitchens`.`area`, `kitchens`.`landmark`, `kitchens`.`zipcode`, `kitchens`.`country`, `kitchens`.`state`, `kitchens`.`city`, `kitchens`.`approx_delivery_time`, `kitchens`.`currency_format`, `kitchens`.`service_type`, `case` `when`, count(orders.id) as total_orders
FROM `kitchens`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 5, 10
ERROR - 2019-11-11 11:27:20 --> Query error: Unknown column 'case' in 'field list' - Invalid query: SELECT `kitchens`.`id`, `kitchens`.`res_name`, `kitchens`.`type`, `kitchens`.`email`, `kitchens`.`images`, `kitchens`.`logo`, `kitchens`.`address`, `kitchens`.`area`, `kitchens`.`landmark`, `kitchens`.`zipcode`, `kitchens`.`country`, `kitchens`.`state`, `kitchens`.`city`, `kitchens`.`approx_delivery_time`, `kitchens`.`currency_format`, `kitchens`.`service_type`, `case` `when`, count(orders.id) as total_orders
FROM `kitchens`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 5, 10
ERROR - 2019-11-11 11:27:24 --> Query error: Unknown column 'case' in 'field list' - Invalid query: SELECT `kitchens`.`id`, `kitchens`.`res_name`, `kitchens`.`type`, `kitchens`.`email`, `kitchens`.`images`, `kitchens`.`logo`, `kitchens`.`address`, `kitchens`.`area`, `kitchens`.`landmark`, `kitchens`.`zipcode`, `kitchens`.`country`, `kitchens`.`state`, `kitchens`.`city`, `kitchens`.`approx_delivery_time`, `kitchens`.`currency_format`, `kitchens`.`service_type`, `case` `when`, count(orders.id) as total_orders
FROM `kitchens`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 5, 10
ERROR - 2019-11-11 11:28:42 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:39:43 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:40:19 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:40:57 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:41:42 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:41:42 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:42:53 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:43:09 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 523
ERROR - 2019-11-11 11:43:10 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:44:08 --> Severity: error --> Exception: Using $this when not in object context /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 526
ERROR - 2019-11-11 11:49:12 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 11:49:14 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 11:50:18 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 11:57:38 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 11:58:41 --> 404 Page Not Found: Php/index
ERROR - 2019-11-11 12:05:19 --> Severity: error --> Exception: [] operator not supported for strings /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:05:35 --> Severity: error --> Exception: [] operator not supported for strings /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:06:10 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:06:10 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:06:10 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 373
ERROR - 2019-11-11 12:06:56 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:06:56 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:06:56 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 373
ERROR - 2019-11-11 12:07:53 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:07:53 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 370
ERROR - 2019-11-11 12:07:53 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 373
ERROR - 2019-11-11 12:08:13 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 372
ERROR - 2019-11-11 12:08:13 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 372
ERROR - 2019-11-11 12:08:13 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 376
ERROR - 2019-11-11 12:08:13 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 376
ERROR - 2019-11-11 12:08:14 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 376
ERROR - 2019-11-11 12:08:14 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 376
ERROR - 2019-11-11 12:08:14 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:09:05 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:09:05 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:09:05 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:09:05 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:09:05 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:09:05 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:09:05 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:371) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:10:16 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:10:16 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:10:16 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:10:16 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:10:16 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:10:16 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:10:16 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:371) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:10:35 --> 404 Page Not Found: api/Api/top_restaurant_list
ERROR - 2019-11-11 12:10:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:373) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:11:26 --> Severity: error --> Exception: [] operator not supported for strings /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:11:26 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:373) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:11:39 --> Severity: error --> Exception: [] operator not supported for strings /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:11:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:373) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:12:01 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:12:01 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:12:01 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:01 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:01 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:01 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:373) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:12:07 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:12:07 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 377
ERROR - 2019-11-11 12:12:07 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:07 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:08 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:08 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:12:08 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:373) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:12:52 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:12:52 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:12:52 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:12:52 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:12:52 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:12:52 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 379
ERROR - 2019-11-11 12:12:52 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:14:54 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:14:54 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:14:54 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:14:54 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:14:54 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:14:54 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:14:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:16:24 --> Severity: Warning --> Illegal string offset 'id' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:16:24 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 375
ERROR - 2019-11-11 12:16:24 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:16:24 --> Severity: Notice --> Uninitialized string offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:16:24 --> Severity: Warning --> Illegal string offset 'images' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:16:24 --> Severity: Notice --> Undefined index: images /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 381
ERROR - 2019-11-11 12:16:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:17:49 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:380) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:18:48 --> Severity: error --> Exception: syntax error, unexpected end of file /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 896
ERROR - 2019-11-11 12:28:57 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 12:36:08 --> Severity: Notice --> Undefined variable: populer_this_month_food /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:36:08 --> Severity: error --> Exception: Function name must be a string /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:36:11 --> Severity: Notice --> Undefined variable: populer_this_month_food /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:36:11 --> Severity: error --> Exception: Function name must be a string /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:36:22 --> Severity: Notice --> Undefined variable: populer_this_month_food /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:36:22 --> Severity: error --> Exception: Function name must be a string /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 47
ERROR - 2019-11-11 12:37:01 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:37:01 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:37:01 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:37:01 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:37:56 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:37:56 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:37:56 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:37:56 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:63) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:38:05 --> 404 Page Not Found: api/Api/order_detail
ERROR - 2019-11-11 12:38:11 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:38:11 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:38:11 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:40:47 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:40:47 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:40:47 --> Severity: Notice --> Undefined index: price /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 66
ERROR - 2019-11-11 12:41:07 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 101
ERROR - 2019-11-11 12:41:13 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 101
ERROR - 2019-11-11 12:41:28 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 101
ERROR - 2019-11-11 12:41:29 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 101
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:41:42 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:41:42 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:42:59 --> 404 Page Not Found: api/Api/shipping_area
ERROR - 2019-11-11 12:42:59 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:42:59 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 60
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 61
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 62
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 63
ERROR - 2019-11-11 12:43:00 --> Severity: Notice --> Undefined index:  /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 64
ERROR - 2019-11-11 12:43:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 12:48:55 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 12:50:54 --> Severity: error --> Exception: syntax error, unexpected ''o' (T_ENCAPSED_AND_WHITESPACE), expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 906
ERROR - 2019-11-11 12:51:22 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 12:52:28 --> Severity: error --> Exception: Call to undefined function get_top_restaurant() /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 23
ERROR - 2019-11-11 13:02:28 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 13:03:09 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:03:11 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:14:16 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:14:16 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:20:20 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:27 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 13:20:38 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:38 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:44 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:44 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:53 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:20:53 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:21:04 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:21:04 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:21:32 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:21:34 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ']' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1865
ERROR - 2019-11-11 13:25:16 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:25:17 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:25:34 --> Severity: error --> Exception: Call to undefined function get_delivery_boy_latlong() /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1489
ERROR - 2019-11-11 13:25:52 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:25:52 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:27:12 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:27:13 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:33:19 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:34:00 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:34:22 --> 404 Page Not Found: Home/save_location
ERROR - 2019-11-11 13:34:48 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:35:09 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:36:44 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 13:36:58 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:37:12 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:37:26 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:38:06 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:39:26 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 13:39:27 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 13:39:36 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 13:41:15 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:42:42 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:51:07 --> Severity: Notice --> Undefined offset: 0 /home/ns5v7fqd4oor/public_html/application/controllers/my_account/Favorite_res.php 39
ERROR - 2019-11-11 13:51:09 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:51:35 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 13:54:00 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:20:00 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:28:51 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:32:19 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:33:04 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 14:33:05 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:34:24 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 14:47:29 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 608
ERROR - 2019-11-11 14:47:30 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 608
ERROR - 2019-11-11 14:47:48 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 608
ERROR - 2019-11-11 14:47:50 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 608
ERROR - 2019-11-11 14:47:56 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:01 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:16 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:18 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:19 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:26 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:27 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:48:42 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:10 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:19 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:22 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:22 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:23 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:26 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:27 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:30 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:33 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:36 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:39 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:40 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:43 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:46 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:46 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:46 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:49 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:52 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:53 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:53 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:49:53 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:00 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:00 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:00 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:05 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:23 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:31 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:31 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:31 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:40 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:40 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:42 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:50:51 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:51:30 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:53:05 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:53:09 --> 404 Page Not Found: Blog-detail-videohtml/index
ERROR - 2019-11-11 14:53:37 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:55:38 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:55:56 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:55:56 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:56:22 --> Severity: error --> Exception: Call to undefined function get_bottom_featured_restaurant() /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 14:56:22 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:56:27 --> Severity: error --> Exception: syntax error, unexpected ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 607
ERROR - 2019-11-11 14:57:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 14:57:47 --> Severity: error --> Exception: /home/ns5v7fqd4oor/public_html/application/models/api/Api_model.php exists, but doesn't declare class Api_model /home/ns5v7fqd4oor/public_html/system/core/Loader.php 336
ERROR - 2019-11-11 14:58:40 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 14:58:40 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 14:58:40 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 14:58:42 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 14:58:42 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 14:58:42 --> Severity: Warning --> preg_replace(): Delimiter must not be alphanumeric or backslash /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1852
ERROR - 2019-11-11 15:07:35 --> 404 Page Not Found: Restaurant-detailhtml/index
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:31 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Array to string conversion /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Notice --> Undefined variable: Array /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 1856
ERROR - 2019-11-11 15:08:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:27:06 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 15:29:32 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 15:30:01 --> 404 Page Not Found: Blog-detailhtml/index
ERROR - 2019-11-11 15:30:08 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:09 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:10 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:30:17 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:01 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:23 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:23 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:23 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:24 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 15:31:31 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:45 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:45 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:31:45 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:02 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:02 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:03 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:05 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:05 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:15 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:15 --> Severity: error --> Exception: syntax error, unexpected '$data' (T_VARIABLE) /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 47
ERROR - 2019-11-11 15:32:18 --> Severity: error --> Exception: syntax error, unexpected '$data' (T_VARIABLE) /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 47
ERROR - 2019-11-11 15:32:20 --> Severity: error --> Exception: syntax error, unexpected '$data' (T_VARIABLE) /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 47
ERROR - 2019-11-11 15:32:37 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:48 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:32:55 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:33:13 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:34:00 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:34:00 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:34:00 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:34:00 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:34:16 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:24 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:25 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:29 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:29 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:29 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:35 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:35 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:37 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:35:38 --> Severity: error --> Exception: syntax error, unexpected ')', expecting '{' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 606
ERROR - 2019-11-11 15:36:21 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 15:39:29 --> Query error: Not unique table/alias: 'fav_restaurants' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
LEFT JOIN `fav_restaurants` ON `fav_restaurants`.`restaurant_id` = `kitchens`.`id`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 15:40:40 --> Query error: Not unique table/alias: 'fav_restaurants' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
RIGHT JOIN `fav_restaurants` ON `fav_restaurants`.`restaurant_id` = `kitchens`.`id`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 15:42:55 --> Query error: Not unique table/alias: 'fav_restaurants' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
RIGHT JOIN `fav_restaurants` ON `fav_restaurants`.`restaurant_id` = `kitchens`.`id`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 15:42:58 --> Query error: Not unique table/alias: 'fav_restaurants' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
RIGHT JOIN `fav_restaurants` ON `fav_restaurants`.`restaurant_id` = `kitchens`.`id`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 15:45:16 --> Query error: Not unique table/alias: 'fav_restaurants' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
RIGHT JOIN `fav_restaurants` ON `fav_restaurants`.`restaurant_id` = `kitchens`.`id`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 15:47:50 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:90) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:49:22 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:90) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:49:37 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:90) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:49:42 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:90) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 15:59:24 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 16:00:44 --> Query error: Unknown column 'kitchens.id' in 'where clause' - Invalid query: SELECT count(fav_restaurants.id) as total_fav_res
FROM `fav_restaurants`
WHERE `kitchens`.`id` = '3'
ERROR - 2019-11-11 16:01:47 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 566
ERROR - 2019-11-11 16:01:47 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 566
ERROR - 2019-11-11 16:01:47 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 566
ERROR - 2019-11-11 16:07:40 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 16:08:02 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 16:08:02 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 16:12:13 --> 404 Page Not Found: my_account/ForgetPassword/assets
ERROR - 2019-11-11 16:21:18 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 16:24:34 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:25:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:25:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:26:24 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:28:31 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 16:28:33 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 16:28:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:28:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:29:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:29:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:29:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:29:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:30:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:30:07 --> 404 Page Not Found: Fonts/fontawesome-webfont.woff
ERROR - 2019-11-11 16:30:07 --> 404 Page Not Found: Fonts/fontawesome-webfont.ttf
ERROR - 2019-11-11 16:30:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:30:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:30:29 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:530) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 16:32:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:32:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:32:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:34:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:35:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:36:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:36:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:36:45 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 16:36:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:36:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:36:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:06 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:37:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:40:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:40:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:42:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:42:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:06 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:25 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:49:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:02 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:50:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:51:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:52:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:53:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:54:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:06 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:25 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:55:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:56:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:56:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:56:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 16:56:02 --> 404 Page Not Found: Home/index
ERROR - 2019-11-11 17:02:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:02:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:02 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:06 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:25 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:44 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:03:59 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:02 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:02 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:06 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:09 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:25 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:39 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:42 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:47 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:51 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:04:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:05 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:27 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:29 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:30 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:34 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:36 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:05:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:11 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:12 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:13 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:14 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:17 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:19 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:21 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:06:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:07:18 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 534
ERROR - 2019-11-11 17:07:32 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 534
ERROR - 2019-11-11 17:07:39 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 534
ERROR - 2019-11-11 17:07:39 --> Severity: error --> Exception: syntax error, unexpected '}' /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 534
ERROR - 2019-11-11 17:10:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:536) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:13:12 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:536) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:14:10 --> 404 Page Not Found: api/Api/restaurant_category_menu
ERROR - 2019-11-11 17:14:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:16:41 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:19:06 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:14 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:15 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:15 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ns5v7fqd4oor/public_html/application/models/Common_model.php 73
ERROR - 2019-11-11 17:19:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/system/core/Exceptions.php:271) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:19:59 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:20:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:20:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:31 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:33 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:35 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:40 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:52 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:20:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:07 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:23 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:21:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:00 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:02 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:08 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:22 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:32 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:45 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:46 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:48 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:22:49 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:53 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:54 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:56 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:22:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:15 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:24 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:37 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:50 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:55 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:23:58 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:10 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:16 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:18 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:28 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:38 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:41 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:43 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:24:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:25:01 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:25:03 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:25:04 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:25:10 --> 404 Page Not Found: Home/index
ERROR - 2019-11-11 17:25:45 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:26:16 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:27:01 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:27:57 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 45
ERROR - 2019-11-11 17:27:58 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:28:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:30:02 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:30:25 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:30:25 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) /home/ns5v7fqd4oor/public_html/application/views/home/index.php 623
ERROR - 2019-11-11 17:31:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php:533) /home/ns5v7fqd4oor/public_html/system/core/Common.php 570
ERROR - 2019-11-11 17:31:27 --> Severity: Notice --> Undefined index: menu /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 981
ERROR - 2019-11-11 17:31:32 --> Severity: Notice --> Undefined index: menu /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 981
ERROR - 2019-11-11 17:33:08 --> Severity: Notice --> Undefined variable: menu_data /home/ns5v7fqd4oor/public_html/application/controllers/api/Api.php 982
ERROR - 2019-11-11 17:47:08 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 17:47:52 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 18:03:36 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:03:36 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:03:36 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ';' /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:23 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:23 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:23 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:49 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:50 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:07:50 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:08:00 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:08:40 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:08:40 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:04 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:05 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:06 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:07 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:11 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:19 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:52 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:09:55 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:04 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:07 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:11 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:27 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:43 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:10:47 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:11:29 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:11:50 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:11:52 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:11:52 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:11:52 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/helpers/common_helper.php 662
ERROR - 2019-11-11 18:12:02 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:12:09 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:12:18 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:13:07 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:13:17 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:14:42 --> Severity: Compile Error --> Cannot use [] for reading /home/ns5v7fqd4oor/public_html/application/views/home/index.php 193
ERROR - 2019-11-11 18:15:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' ",") REGEXP ",(2|18),"' at line 6 - Invalid query: SELECT `foodmenu_id`, `cat_id`, `menu_name`, `menu_logo`, `choice`, `long_description`, `price`, `reduced_price`, `container_charges`, `minimum_preparation_time`
FROM `foodmenu`
WHERE `restaurant_id` = '9'
AND `cat_id` = '50'
AND `menu_available` = 1
AND CONCAT(",", choice != , ",") REGEXP ",(2|18),"
ERROR - 2019-11-11 18:17:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ' ",") REGEXP ",(2|18),"' at line 6 - Invalid query: SELECT `foodmenu_id`, `cat_id`, `menu_name`, `menu_logo`, `choice`, `long_description`, `price`, `reduced_price`, `container_charges`, `minimum_preparation_time`
FROM `foodmenu`
WHERE `restaurant_id` = '9'
AND `cat_id` = '50'
AND `menu_available` = 1
AND CONCAT(",", choice != , ",") REGEXP ",(2|18),"
ERROR - 2019-11-11 18:20:04 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:20:55 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:22:13 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:22:16 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:23:02 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:30 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:31 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:33 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:35 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:37 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:24:41 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:25:03 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:25:11 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 305
ERROR - 2019-11-11 18:26:53 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 309
ERROR - 2019-11-11 18:27:35 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 309
ERROR - 2019-11-11 18:28:25 --> Severity: error --> Exception: syntax error, unexpected '}', expecting end of file /home/ns5v7fqd4oor/public_html/application/views/home/index.php 309
ERROR - 2019-11-11 18:31:11 --> 404 Page Not Found: api/Api/restaurant_category_menu
ERROR - 2019-11-11 18:35:39 --> Severity: Notice --> Undefined variable: var_price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 255
ERROR - 2019-11-11 18:35:39 --> Severity: Notice --> Undefined variable: var_price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 255
ERROR - 2019-11-11 18:38:45 --> Severity: Notice --> Undefined variable: var_price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 255
ERROR - 2019-11-11 18:38:45 --> Severity: Notice --> Undefined variable: var_price /home/ns5v7fqd4oor/public_html/application/views/home/index.php 255
ERROR - 2019-11-11 18:54:09 --> Severity: error --> Exception: syntax error, unexpected ')' /home/ns5v7fqd4oor/public_html/application/views/home/index.php 334
ERROR - 2019-11-11 18:54:14 --> Severity: error --> Exception: syntax error, unexpected ')' /home/ns5v7fqd4oor/public_html/application/views/home/index.php 334
ERROR - 2019-11-11 18:57:56 --> Severity: error --> Exception: syntax error, unexpected ')' /home/ns5v7fqd4oor/public_html/application/views/home/index.php 334
ERROR - 2019-11-11 18:58:09 --> Severity: error --> Exception: syntax error, unexpected ')' /home/ns5v7fqd4oor/public_html/application/views/home/index.php 334
ERROR - 2019-11-11 19:05:46 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 19:06:21 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 19:08:53 --> 404 Page Not Found: Assets/image
ERROR - 2019-11-11 19:11:29 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 19:12:38 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 19:16:39 --> Severity: error --> Exception: Call to undefined function get_bottom_featured_restaurant() /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 46
ERROR - 2019-11-11 19:16:59 --> Severity: error --> Exception: Call to undefined function get_bottom_featured_restaurant() /home/ns5v7fqd4oor/public_html/application/controllers/Home.php 46
ERROR - 2019-11-11 19:20:31 --> Severity: Notice --> Undefined variable: kitchens /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 931
ERROR - 2019-11-11 19:25:13 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 657
ERROR - 2019-11-11 19:25:13 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 657
ERROR - 2019-11-11 19:25:13 --> Severity: Notice --> Undefined index: total_fav_res /home/ns5v7fqd4oor/public_html/application/views/home/index.php 657
ERROR - 2019-11-11 19:28:09 --> Severity: Notice --> Undefined variable: kitchens /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 931
ERROR - 2019-11-11 19:28:13 --> Severity: Notice --> Undefined variable: kitchens /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 931
ERROR - 2019-11-11 19:30:50 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 19:31:20 --> Severity: Notice --> Undefined variable: kitchens /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 931
ERROR - 2019-11-11 19:32:31 --> Severity: Notice --> Undefined variable: kitchens /home/ns5v7fqd4oor/public_html/application/controllers/api/Cart_api.php 931
ERROR - 2019-11-11 19:36:26 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 19:37:20 --> Severity: Notice --> Undefined index: id /home/ns5v7fqd4oor/public_html/application/controllers/Restaurants.php 64
ERROR - 2019-11-11 19:40:13 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-11 19:49:02 --> 404 Page Not Found: Assets/css
ERROR - 2019-11-11 20:22:41 --> 404 Page Not Found: Blog-right-sidebarhtml/index
ERROR - 2019-11-11 23:36:05 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-11 23:36:06 --> 404 Page Not Found: Robotstxt/index
