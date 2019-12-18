<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-11-10 00:01:44 --> 404 Page Not Found: my_account/ForgetPassword/price-table.html
ERROR - 2019-11-10 00:14:39 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-10 00:37:10 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 00:37:11 --> 404 Page Not Found: Search-foundhtml/index
ERROR - 2019-11-10 00:43:47 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 00:44:25 --> Query error: Lost connection to MySQL server during query - Invalid query: SELECT `foodmenu`.`menu_name`, `foodmenu`.`short_code`, `foodmenu`.`order_type`, `foodmenu`.`menu_logo`, `foodmenu`.`price`, `foodmenu`.`reduced_price`, `foodmenu`.`long_description`, `kitchens`.`id` as `restaurant_id`, `kitchens`.`res_name`, `kitchens`.`res_alias`, `kitchens`.`images` as `kitchen_image`, `kitchens`.`address`, `kitchens`.`approx_cost`, `kitchens`.`pure_veg`, `kitchens`.`approx_delivery_time`, `kitchens`.`service_type`, count(orders.id) as total_orders, count(orders.restaurant_id) as total_restaurant_orders
FROM `kitchens`
LEFT JOIN `foodmenu` ON `foodmenu`.`restaurant_id` = `kitchens`.`id`
LEFT JOIN `orders` ON `orders`.`restaurant_id` = `kitchens`.`id`
WHERE DATE_FORMAT(orders.created_date,"%Y-%m") = '2019-11'
GROUP BY `kitchens`.`id`
ORDER BY `total_orders` DESC
 LIMIT 3
ERROR - 2019-11-10 00:47:31 --> 404 Page Not Found: my_account/ForgetPassword/index.html
ERROR - 2019-11-10 05:42:03 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 05:46:19 --> 404 Page Not Found: my_account/ForgetPassword/blog-detail.html
ERROR - 2019-11-10 05:53:55 --> 404 Page Not Found: Blog-detail-right-sidebarhtml/index
ERROR - 2019-11-10 06:25:55 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 06:25:58 --> 404 Page Not Found: Galleryhtml/index
ERROR - 2019-11-10 10:37:31 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 10:38:55 --> 404 Page Not Found: Sphp/index
ERROR - 2019-11-10 11:18:54 --> 404 Page Not Found: Shellphp/index
ERROR - 2019-11-10 11:58:27 --> 404 Page Not Found: Bphp/index
ERROR - 2019-11-10 12:38:01 --> 404 Page Not Found: Cphp/index
ERROR - 2019-11-10 13:17:16 --> 404 Page Not Found: Dphp/index
ERROR - 2019-11-10 13:33:17 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 13:37:07 --> 404 Page Not Found: my_account/ForgetPassword/gallery-detail.html
ERROR - 2019-11-10 13:57:06 --> 404 Page Not Found: Ephp/index
ERROR - 2019-11-10 14:28:20 --> 404 Page Not Found: About-ushtml/index
ERROR - 2019-11-10 14:37:09 --> 404 Page Not Found: Fphp/index
ERROR - 2019-11-10 14:57:51 --> 404 Page Not Found: Faviconico/index
ERROR - 2019-11-10 15:17:20 --> 404 Page Not Found: Gphp/index
ERROR - 2019-11-10 15:57:14 --> 404 Page Not Found: Hphp/index
ERROR - 2019-11-10 16:37:12 --> 404 Page Not Found: Iphp/index
ERROR - 2019-11-10 16:44:46 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 16:44:48 --> 404 Page Not Found: Robotstxt/index
ERROR - 2019-11-10 17:16:20 --> 404 Page Not Found: Jphp/index
ERROR - 2019-11-10 17:55:40 --> 404 Page Not Found: Kphp/index
ERROR - 2019-11-10 18:35:16 --> 404 Page Not Found: Lphp/index
ERROR - 2019-11-10 19:14:59 --> 404 Page Not Found: Mphp/index
ERROR - 2019-11-10 19:54:53 --> 404 Page Not Found: Nphp/index
ERROR - 2019-11-10 22:50:36 --> 404 Page Not Found: Upphp/index
