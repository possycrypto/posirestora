<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class OldDummyBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        $password = Hash::make('123456');

        $today = \Carbon::now()->format('Y-m-d H:i:s');
        $yesterday = \Carbon::now()->subDays(2)->format('Y-m-d H:i:s');
        $last_week = \Carbon::now()->subDays(7)->format('Y-m-d H:i:s');
        $last_15th_day = \Carbon::now()->subDays(15)->format('Y-m-d H:i:s');
        $last_month = \Carbon::now()->subDays(30)->format('Y-m-d H:i:s');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $shortcuts = '{"pos":{"express_checkout":"shift+e","pay_n_ckeckout":"shift+p","draft":"shift+d","cancel":"shift+c","edit_discount":"shift+i","edit_order_tax":"shift+t","add_payment_row":"shift+r","finalize_payment":"shift+f","recent_product_quantity":"f2","add_new_product":"f4"}}';

        DB::insert("INSERT INTO business (id, name, currency_id, start_date, tax_number_1, tax_label_1, 
        			tax_number_2, tax_label_2, default_sales_tax, default_profit_percent, owner_id, 
        			time_zone, fy_start_month, accounting_method, default_sales_discount, 
        			sell_price_tax, logo, sku_prefix, keyboard_shortcuts, created_at, updated_at, enable_editing_product_from_purchase) VALUES
					(1, 'Awesome Shop', 2, '2018-01-01', '3412569900', 'GSTIN', NULL, NULL, NULL, 25, 1, 
					'America/Phoenix', 1, 'fifo', '10.00', 'includes', NULL, 'AS', '$shortcuts', 
					'2018-01-04 07:45:19', '2018-01-04 07:47:08', 1)");

        DB::insert("INSERT INTO business_locations (id, business_id, name, 
		/* landmark, */  
		country, state, 
        			city, zip_code, invoice_scheme_id, invoice_layout_id, print_receipt_on_invoice,receipt_printer_type,deleted_at, created_at, updated_at) VALUES
					(1, 1, 'Awesome Shop', 
					/* 'Linking Street', */ 
					'USA', 'Arizona', 'Phoenix', '85001', 1, 1, 1,'browser',
					NULL, '2018-01-04 07:45:20', '2018-01-04 07:45:20')");

        DB::insert("INSERT INTO users (id, surname, first_name, last_name, username, email, 
        			password, language, remember_token, business_id, deleted_at, created_at, 
        			updated_at) VALUES
					(1, 'Mr', 'Admin', NULL, 'admin', 'admin@example.com', 
					'$password', 'en', NULL, 
					1, NULL, '2018-01-04 07:45:19', '2018-01-04 07:45:19'),
					(2, 'Mr', 'Demo', 'Cashier', 'cashier', 'cashier@example.com', 
					'$password' , 'en', 
					NULL, 1, NULL, '2018-01-04 07:50:58', '2018-01-04 07:50:58'),
					(3, 'Mr.', 'Demo', 'Admin', 'demo-admin', 'demoadmin@example.com', '$password', 'en', NULL, 1, NULL, '2018-01-06 12:40:57', '2018-01-06 12:40:57')");

        DB::insert("INSERT INTO brands (id, business_id, name, description, created_by, 
        			created_at, updated_at) VALUES
					(1, 1, 'Levis', NULL, 1, '2018-01-04 02:49:47', '2018-01-04 02:49:47'),
					(2, 1, 'Espirit', NULL, 1, '2018-01-04 02:49:58', '2018-01-04 02:49:58'),
					(3, 1, 'U.S. Polo Assn.', NULL, 1, '2018-01-04 02:50:26', '2018-01-04 02:50:26'),
					(4, 1, 'Nike', NULL, 1, '2018-01-04 02:50:34', '2018-01-04 02:50:34'),
					(5, 1, 'Puma', NULL, 1, '2018-01-04 02:50:40', '2018-01-04 02:50:40'),
					(6, 1, 'Adidas', NULL, 1, '2018-01-04 02:50:46', '2018-01-04 02:50:46'),
					(7, 1, 'Samsung', NULL, 1, '2018-01-06 11:10:14', '2018-01-06 11:10:14'),
					(8, 1, 'Apple', NULL, 1, '2018-01-06 11:10:23', '2018-01-06 11:10:23'),
					(9, 1, 'Acer', NULL, 1, '2018-01-06 11:33:37', '2018-01-06 11:33:37'),
					(10, 1, 'Bowflex', NULL, 1, '2018-01-06 11:45:31', '2018-01-06 11:45:31'),
					(11, 1, 'Oreo', NULL, 1, '2018-01-06 12:05:00', '2018-01-06 12:05:00'),
					(12, 1, 'Sharewood', NULL, 1, '2018-01-06 12:10:52', '2018-01-06 12:10:52'),
					(13, 1, 'Barilla', NULL, 1, '2018-01-06 12:14:59', '2018-01-06 12:14:59'),
					(14, 1, 'Lipton', NULL, 1, '2018-01-06 12:18:12', '2018-01-06 12:18:12')");

        DB::insert("INSERT INTO categories (id, name, business_id, short_code, parent_id, 
        			created_by, created_at, updated_at) VALUES
					(1, 'Men''s', 1, NULL, 0, 1, '2018-01-04 02:36:34', '2018-01-04 02:36:34'),
					(2, 'Women''s', 1, NULL, 0, 1, '2018-01-04 02:36:46', '2018-01-04 02:36:46'),
					(3, 'Accessories', 1, NULL, 0, 1, '2018-01-04 02:37:03', '2018-01-04 02:37:03'),
					(4, 'Jeans', 1, NULL, 1, 1, '2018-01-04 02:37:34', '2018-01-04 02:37:34'),
					(5, 'Shirts', 1, NULL, 1, 1, '2018-01-04 02:38:18', '2018-01-04 02:38:18'),
					(6, 'Belts', 1, NULL, 3, 1, '2018-01-04 02:38:41', '2018-01-04 02:38:41'),
					(8, 'Shoes', 1, NULL, 3, 1, '2018-01-04 02:39:04', '2018-01-04 02:39:04'),
					(10, 'Sandal', 1, NULL, 3, 1, '2018-01-04 02:39:23', '2018-01-04 02:39:23'),
					(11, 'Wallets', 1, NULL, 3, 1, '2018-01-04 04:35:50', '2018-01-04 04:35:50'),
					(12, 'Electronics', 1, NULL, 0, 1, '2018-01-06 10:54:34', '2018-01-06 10:54:34'),
					(13, 'Cell Phones', 1, NULL, 12, 1, '2018-01-06 10:54:57', '2018-01-06 10:54:57'),
					(14, 'Computers', 1, NULL, 12, 1, '2018-01-06 10:55:55', '2018-01-06 10:55:55'),
					(15, 'Sports', 1, NULL, 0, 1, '2018-01-06 10:57:33', '2018-01-06 10:57:33'),
					(16, 'Athletic Clothing', 1, NULL, 15, 1, '2018-01-06 10:58:40', '2018-01-06 10:58:40'),
					(17, 'Exercise & Fitness', 1, NULL, 15, 1, '2018-01-06 10:59:19', '2018-01-06 10:59:19'),
					(18, 'Books', 1, NULL, 0, 1, '2018-01-06 10:59:59', '2018-01-06 10:59:59'),
					(19, 'Autobiography', 1, NULL, 18, 1, '2018-01-06 11:00:16', '2018-01-06 11:00:16'),
					(20, 'Children''s books', 1, NULL, 18, 1, '2018-01-06 11:00:58', '2018-01-06 11:00:58'),
					(21, 'Food & Grocery', 1, NULL, 0, 1, '2018-01-06 11:01:35', '2018-01-06 11:01:35')");

        DB::insert("INSERT INTO contacts (id, business_id, type, supplier_business_name, name, 
        			tax_number, city, state, country, 
					-- landmark, 
					mobile, landline, 
        			alternate_number, pay_term_number, pay_term_type, created_by, is_default, 
        			deleted_at, created_at, updated_at) VALUES
					(1, 1, 'customer', NULL, 'Walk-In Customer', NULL, 'Phoenix', 'Arizona', 'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-01-04 02:15:20', '2018-01-04 02:35:37'),
					(2, 1, 'supplier', 'Alpha Clothings', 'Michael', '4590091535', 'Phoenix', 'Arizona', 
					'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, 15, 'days', 1, 0, NULL, 
					'2018-01-04 02:29:38', '2018-01-04 02:35:10'),
					(3, 1, 'supplier', 'Manhattan Clothing Ltd.', 'Philip', '54869310093', 'Phoenix', 
					'Arizona', 'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, 15, 'days', 1, 0, 
					NULL, '2018-01-04 02:30:55', '2018-01-04 02:44:06'),
					(4, 1, 'customer', NULL, 'Harry', NULL, 'Phoenix', 'Arizona', 'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, NULL, NULL, 1, 0, NULL, '2018-01-04 02:31:40', '2018-01-04 02:35:32'),
					(5, 1, 'supplier', 'Digital Ocean', 'Mike McCubbin', '52965489001', 'Phoenix', 
					'Arizona', 'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, 30, 'days', 1, 0,
					 NULL, '2018-01-06 12:23:22', '2018-01-06 12:23:22'),
					(6, 1, 'supplier', 'Univer Suppliers', 'Jackson Hill', '5459000655', 'Phoenix', 
					'Arizona', 'USA', 
					-- 'Linking Street', 
					'(378) 400-1234', NULL, NULL, 45, 'days', 1, 0, 
					NULL, '2018-01-06 12:25:09', '2018-01-06 12:25:09')");

        DB::insert("INSERT INTO tax_rates (id, business_id, name, amount, is_tax_group, 
        			created_by, created_at, updated_at) VALUES
					(1, 1, 'VAT@10%', 10.00, 0, 1, '2018-01-04 08:10:07', '2018-01-04 08:10:07'),
					(2, 1, 'CGST@10%', 10.00, 0, 1, '2018-01-04 08:10:55', '2018-01-04 08:10:55'),
					(3, 1, 'SGST@8%', 8.00, 0, 1, '2018-01-04 08:11:13', '2018-01-04 08:11:13'),
					(4, 1, 'GST@18%', 18.00, 1, 1, '2018-01-04 08:12:19', '2018-01-04 08:12:19')");

        DB::insert('INSERT INTO group_sub_taxes (group_tax_id, tax_id) VALUES
					(4, 2),
					(4, 3)');

        DB::insert("INSERT INTO invoice_schemes (id, business_id, name, scheme_type, prefix, 
        			start_number, invoice_count, total_digits, is_default, created_at, updated_at) VALUES
					(1, 1, 'Default', 'blank', 'AS', 1, 5, 4, 1, '2018-01-04 07:45:20', 
					'2018-01-04 08:15:16')");

        DB::insert("INSERT INTO invoice_layouts (id, name, header_text, invoice_no_prefix, invoice_heading, sub_heading_line1, sub_heading_line2, sub_heading_line3, sub_heading_line4, sub_heading_line5, invoice_heading_not_paid, invoice_heading_paid, sub_total_label, discount_label, tax_label, total_label, total_due_label, paid_label, show_client_id, client_id_label, date_label, show_time, show_brand, show_sku, show_cat_code, table_product_label, table_qty_label, table_unit_price_label, table_subtotal_label, logo, show_logo, show_business_name, show_location_name, show_landmark, show_city, show_state, show_zip_code, show_country, show_mobile_number, show_alternate_number, show_email, show_tax_1, show_tax_2, show_barcode, show_payments, show_customer, customer_label, highlight_color, footer_text, is_default, business_id, created_at, updated_at) VALUES
        	(1, 'Default', NULL, 'Invoice No.', 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', 'Subtotal', 
        	'Discount', 'Tax', 'Total', 'Total Due', 'Total Paid', 0, NULL, 'Date', 1, 0, 1, 1, 'Product', 
        	'Quantity', 'Unit Price', 'Subtotal', NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 
        	'Customer', '#000000', '', 1, 1, '2018-04-04 05:05:32', '2018-04-04 05:05:32')");

        DB::insert("INSERT INTO units (id, business_id, actual_name, short_name, 
        			allow_decimal, created_by, created_at, updated_at) VALUES
					(1, 1, 'Pieces', 'Pc(s)', 0, 1, '2018-01-04 02:15:20', '2018-01-04 02:15:20'),
					(2, 1, 'Packets', 'packets', 0, 1, '2018-01-06 12:07:01', '2018-01-06 12:08:36'),
					(3, 1, 'Grams', 'g', 1, 1, '2018-01-06 12:10:34', '2018-01-06 12:10:34')");

        DB::insert("INSERT INTO products (id, name, business_id, type, unit_id, brand_id, 
        			category_id, sub_category_id, tax, tax_type, enable_stock, alert_quantity, 
        			sku, barcode_type, created_by, created_at, updated_at) VALUES
					(1, 'Men''s Reverse Fleece Crew', 1, 'single', 1, 1, 1, 5, 1, 'exclusive', 1, 5, 
					'AS0001', 'C128', 1, '2018-01-04 02:59:08', '2018-01-06 11:21:33'),
					(2, 'Levis Men''s Slimmy Fit Jeans', 1, 'variable', 1, 1, 1, 4, 1, 'exclusive', 1, 10, 
					'AS0002', 'C128', 1, '2018-01-04 03:00:35', '2018-01-06 11:21:16'),
					(3, 'Men''s Cozy Hoodie Sweater', 1, 'variable', 1, 2, 1, 5, 1, 'exclusive', 1, 10, 'AS0003', 'C128', 1, '2018-01-04 04:21:52', '2018-01-06 11:20:51'),
					(4, 'Puma Brown Sneaker', 1, 'variable', 1, 5, 3, 8, 1, 'exclusive', 1, 5, 'AS0004', 
					'C128', 1, '2018-01-04 04:24:33', '2018-01-04 04:24:33'),
					(8, 'Nike Fashion Sneaker', 1, 'variable', 1, 4, 3, 8, 1, 'exclusive', 1, 10, 'AS0008',
					'C128', 1, '2018-01-04 04:40:10', '2018-01-04 04:40:10'),
					(9, 'PUMA Men''s Black Sneaker', 1, 'variable', 1, 5, 3, 8, 1, 'exclusive', 1, 10, 
					'AS0009', 'C128', 1, '2018-01-04 04:41:57', '2018-01-04 04:41:57'),
					(10, 'NIKE Men''s Running Shoe', 1, 'variable', 1, 4, 3, 8, 1, 'exclusive', 1, 10, 
					'AS0010', 'C128', 1, '2018-01-04 04:43:02', '2018-01-04 04:43:02'),
					(11, 'U.S. Polo Men''s Leather Belt', 1, 'single', 1, 3, 3, 6, 1, 'exclusive', 1, 15, 
					'AS0011', 'C128', 1, '2018-01-04 04:44:35', '2018-01-04 04:44:35'),
					(12, 'Unisex Brown Leather Wallet', 1, 'single', 1, 1, 3, 11, 1, 'exclusive', 1, 10, 
					'AS0012', 'C128', 1, '2018-01-04 04:45:50', '2018-01-06 11:21:49'),
					(13, 'Men Full sleeve T Shirt', 1, 'variable', 1, 2, 1, 5, 1, 'exclusive', 1, 15, 
					'AS0013', 'C128', 1, '2018-01-04 04:47:59', '2018-01-04 04:47:59'),
					(14, 'Samsung Galaxy S8', 1, 'variable', 1, 7, 12, 13, 1, 'exclusive', 1, 100, 'AS0014', 
					'C128', 1, '2018-01-06 11:12:19', '2018-01-06 11:12:19'),
					(15, 'Apple iPhone 8', 1, 'variable', 1, 8, 12, 13, 1, 'exclusive', 1, 100, 'AS0015', 
					'C128', 1, '2018-01-06 11:19:51', '2018-01-06 11:19:51'),
					(16, 'Samsung Galaxy J7 Pro', 1, 'variable', 1, 7, 12, 13, NULL, 'exclusive', 1, 100, 
					'AS0016', 'C128', 1, '2018-01-06 11:24:48', '2018-01-06 11:24:48'),
					(17, 'Acer Aspire E 15', 1, 'variable', 1, 9, 12, 14, NULL, 'exclusive', 1, 70, 'AS0017', 'C128', 1, '2018-01-06 11:35:01', '2018-01-06 11:35:01'),
					(18, 'Apple MacBook Air', 1, 'variable', 1, 8, 12, 14, NULL, 'exclusive', 1, 30, 'AS0018', 'C128', 1, '2018-01-06 11:37:30', '2018-01-06 11:37:30'),
					(19, 'Cushion Crew Socks', 1, 'single', 1, 4, 15, 16, NULL, 'exclusive', 1, 100, 'AS0019', 'C128', 1, '2018-01-06 11:40:28', '2018-01-06 11:41:01'),
					(20, 'Sports Tights Pants', 1, 'variable', 1, 6, 15, 16, 1, 'exclusive', 1, 60, 'AS0020', 'C128', 1, '2018-01-06 11:43:00', '2018-01-06 11:43:00'),
					(21, 'Pair Of Dumbbells', 1, 'single', 1, 10, 15, 17, NULL, 'exclusive', 1, 45, 'AS0021', 'C128', 1, '2018-01-06 11:46:35', '2018-01-06 11:46:35'),
					(22, 'Diary of a Wimpy Kid', 1, 'single', 1, NULL, 18, 20, 1, 'exclusive', 1, 20, 'AS0022', 'C128', 1, '2018-01-06 11:55:09', '2018-01-06 11:55:09'),
					(23, 'Sneezy the Snowman', 1, 'single', 1, NULL, 18, 20, NULL, 'exclusive', 1, 20, 'AS0023', 'C128', 1, '2018-01-06 11:56:27', '2018-01-06 11:56:27'),
					(24, 'Etched in Sand Autobiography', 1, 'single', 1, NULL, 18, 19, 1, 'exclusive', 1, 30, 'AS0024', 'C128', 1, '2018-01-06 12:01:22', '2018-01-06 12:01:22'),
					(25, 'Five Presidents', 1, 'single', 1, NULL, 18, 19, NULL, 'exclusive', 1, 30, 'AS0025', 'C128', 1, '2018-01-06 12:02:22', '2018-01-06 12:02:22'),
					(26, 'Oreo Cookies', 1, 'single', 2, 11, 21, NULL, NULL, 'exclusive', 1, 500, 'AS0026', 
					'C128', 1, '2018-01-06 12:05:51', '2018-01-06 12:08:55'),
					(27, 'Butter Cookies', 1, 'single', 2, 12, 21, NULL, 1, 'exclusive', 1, 100, 'AS0027', 
					'C128', 1, '2018-01-06 12:13:16', '2018-01-06 12:13:16'),
					(28, 'Barilla Pasta', 1, 'single', 2, 13, 21, NULL, 1, 'exclusive', 1, 50, 'AS0028', 
					'C128', 1, '2018-01-06 12:15:47', '2018-01-06 12:15:47'),
					(29, 'Thin Spaghetti', 1, 'single', 2, 13, 21, NULL, NULL, 'exclusive', 1, 100, 
					'AS0029', 'C128', 1, '2018-01-06 12:16:53', '2018-01-06 12:16:53'),
					(30, 'Lipton Black Tea Bags', 1, 'single', 2, 14, 21, NULL, 1, 'exclusive', 1, 50, 
					'AS0030', 'C128', 1, '2018-01-06 12:18:59', '2018-01-06 12:18:59')");

        DB::insert("INSERT INTO product_variations (id, name, product_id, is_dummy, 
        			created_at, updated_at) VALUES
					(1, 'DUMMY', 1, 1, '2018-01-04 02:59:08', '2018-01-04 02:59:08'),
					(2, 'Waist Size', 2, 0, '2018-01-04 03:00:35', '2018-01-06 10:44:12'),
					(3, 'Size', 3, 0, '2018-01-04 04:21:52', '2018-01-06 10:43:48'),
					(4, 'Size', 4, 0, '2018-01-04 04:24:34', '2018-01-06 10:49:36'),
					(8, 'Size', 8, 0, '2018-01-04 04:40:10', '2018-01-06 10:48:46'),
					(9, 'Size', 9, 0, '2018-01-04 04:41:57', '2018-01-06 10:50:01'),
					(10, 'Size', 10, 0, '2018-01-04 04:43:02', '2018-01-06 10:49:20'),
					(11, 'DUMMY', 11, 1, '2018-01-04 04:44:35', '2018-01-04 04:44:35'),
					(12, 'DUMMY', 12, 1, '2018-01-04 04:45:50', '2018-01-04 04:45:50'),
					(13, 'Size', 13, 0, '2018-01-04 04:47:59', '2018-01-06 10:44:48'),
					(14, 'Color', 14, 0, '2018-01-06 11:12:19', '2018-01-06 11:12:19'),
					(15, 'Internal Memory', 14, 0, '2018-01-06 11:14:14', '2018-01-06 11:14:14'),
					(16, 'Color', 15, 0, '2018-01-06 11:19:51', '2018-01-06 11:19:51'),
					(17, 'Internal Memory', 15, 0, '2018-01-06 11:19:51', '2018-01-06 11:19:51'),
					(18, 'Color', 16, 0, '2018-01-06 11:24:48', '2018-01-06 11:24:48'),
					(19, 'Color', 17, 0, '2018-01-06 11:35:01', '2018-01-06 11:35:01'),
					(20, 'Storage', 18, 0, '2018-01-06 11:37:30', '2018-01-06 11:37:30'),
					(21, 'DUMMY', 19, 1, '2018-01-06 11:40:28', '2018-01-06 11:40:28'),
					(22, 'Color', 20, 0, '2018-01-06 11:43:00', '2018-01-06 11:43:00'),
					(23, 'DUMMY', 21, 1, '2018-01-06 11:46:35', '2018-01-06 11:46:35'),
					(24, 'DUMMY', 22, 1, '2018-01-06 11:55:09', '2018-01-06 11:55:09'),
					(25, 'DUMMY', 23, 1, '2018-01-06 11:56:27', '2018-01-06 11:56:27'),
					(26, 'DUMMY', 24, 1, '2018-01-06 12:01:22', '2018-01-06 12:01:22'),
					(27, 'DUMMY', 25, 1, '2018-01-06 12:02:23', '2018-01-06 12:02:23'),
					(28, 'DUMMY', 26, 1, '2018-01-06 12:05:51', '2018-01-06 12:05:51'),
					(29, 'DUMMY', 27, 1, '2018-01-06 12:13:16', '2018-01-06 12:13:16'),
					(30, 'DUMMY', 28, 1, '2018-01-06 12:15:47', '2018-01-06 12:15:47'),
					(31, 'DUMMY', 29, 1, '2018-01-06 12:16:53', '2018-01-06 12:16:53'),
					(32, 'DUMMY', 30, 1, '2018-01-06 12:18:59', '2018-01-06 12:18:59')");

        DB::insert("INSERT INTO variations (id, name, product_id, sub_sku, product_variation_id, default_purchase_price, dpp_inc_tax, profit_percent, default_sell_price, 
        	sell_price_inc_tax, created_at, updated_at, deleted_at) VALUES
			(1, 'DUMMY', 1, 'AS0001', 1, '130.00', '143.00', '0.00', '130.00', '143.00', '2018-01-04 02:59:08', '2018-01-04 02:59:08', NULL),
			(2, '28', 2, 'AS0002-1', 2, '70.00', '77.00', '0.00', '70.00', '77.00', '2018-01-04 03:00:35', '2018-01-06 11:21:16', NULL),
			(3, '30', 2, 'AS0002-2', 2, '70.00', '77.00', '0.00', '70.00', '77.00', '2018-01-04 03:00:35', '2018-01-06 11:21:16', NULL),
			(4, '32', 2, 'AS0002-3', 2, '70.00', '77.00', '0.00', '70.00', '77.00', '2018-01-04 03:00:35', '2018-01-06 11:21:16', NULL),
			(5, '34', 2, 'AS0002-4', 2, '72.00', '79.20', '0.00', '72.00', '79.20', '2018-01-04 03:00:35', '2018-01-06 11:21:16', NULL),
			(6, '36', 2, 'AS0002-5', 2, '72.00', '79.20', '0.00', '72.00', '79.20', '2018-01-04 03:00:35', '2018-01-06 11:21:16', NULL),
			(7, 'S', 3, 'AS0003-1', 3, '190.00', '209.00', '0.00', '190.00', '209.00', '2018-01-04 04:21:52', '2018-01-06 11:20:51', NULL),
			(8, 'M', 3, 'AS0003-2', 3, '190.00', '209.00', '0.00', '190.00', '209.00', '2018-01-04 04:21:52', '2018-01-06 11:20:51', NULL),
			(9, 'L', 3, 'AS0003-3', 3, '190.00', '209.00', '0.00', '190.00', '209.00', '2018-01-04 04:21:52', '2018-01-06 11:20:51', NULL),
			(10, 'XL', 3, 'AS0003-4', 3, '191.00', '210.10', '0.00', '191.00', '210.10', '2018-01-04 04:21:52', '2018-01-06 11:20:51', NULL),
			(11, '6', 4, 'AS0004-1', 4, '165.00', '181.50', '0.00', '165.00', '181.50', '2018-01-04 04:24:34', '2018-01-06 10:49:36', NULL),
			(12, '7', 4, 'AS0004-2', 4, '165.00', '181.50', '0.00', '165.00', '181.50', '2018-01-04 04:24:34', '2018-01-06 10:49:36', NULL),
			(13, '8', 4, 'AS0004-3', 4, '165.00', '181.50', '0.00', '165.00', '181.50', '2018-01-04 04:24:34', '2018-01-06 10:49:36', NULL),
			(14, '9', 4, 'AS0004-4', 4, '166.00', '182.60', '0.00', '166.00', '182.60', '2018-01-04 04:24:34', '2018-01-06 10:49:36', NULL),
			(27, '6', 8, 'AS0008-1', 8, '110.00', '121.00', '0.00', '110.00', '121.00', '2018-01-04 04:40:10', '2018-01-06 10:48:46', NULL),
			(28, '7', 8, 'AS0008-2', 8, '110.00', '121.00', '0.00', '110.00', '121.00', '2018-01-04 04:40:10', '2018-01-06 10:48:46', NULL),
			(29, '8', 8, 'AS0008-3', 8, '110.00', '121.00', '0.00', '110.00', '121.00', '2018-01-04 04:40:10', '2018-01-06 10:48:46', NULL),
			(30, '9', 8, 'AS0008-4', 8, '110.00', '121.00', '0.00', '110.00', '121.00', '2018-01-04 04:40:10', '2018-01-06 10:48:46', NULL),
			(31, '6', 9, 'AS0009-1', 9, '135.00', '148.50', '0.00', '135.00', '148.50', '2018-01-04 04:41:57', '2018-01-06 10:50:01', NULL),
			(32, '7', 9, 'AS0009-2', 9, '135.00', '148.50', '0.00', '135.00', '148.50', '2018-01-04 04:41:57', '2018-01-06 10:50:01', NULL),
			(33, '8', 9, 'AS0009-3', 9, '135.00', '148.50', '0.00', '135.00', '148.50', '2018-01-04 04:41:57', '2018-01-06 10:50:01', NULL),
			(34, '9', 9, 'AS0009-4', 9, '135.00', '148.50', '0.00', '135.00', '148.50', '2018-01-04 04:41:57', '2018-01-06 10:50:01', NULL),
			(35, '5', 10, 'AS0010-1', 10, '150.00', '165.00', '0.00', '150.00', '165.00', '2018-01-04 04:43:02', '2018-01-06 10:49:20', NULL),
			(36, '6', 10, 'AS0010-2', 10, '150.00', '165.00', '0.00', '150.00', '165.00', '2018-01-04 04:43:02', '2018-01-06 10:49:20', NULL),
			(37, '7', 10, 'AS0010-3', 10, '150.00', '165.00', '0.00', '150.00', '165.00', '2018-01-04 04:43:02', '2018-01-06 10:49:20', NULL),
			(38, '8', 10, 'AS0010-4', 10, '150.00', '165.00', '0.00', '150.00', '165.00', '2018-01-04 04:43:02', '2018-01-06 10:49:20', NULL),
			(39, '9', 10, 'AS0010-5', 10, '150.00', '165.00', '0.00', '150.00', '165.00', '2018-01-04 04:43:02', '2018-01-06 10:49:20', NULL),
			(40, 'DUMMY', 11, 'AS0011', 11, '30.00', '33.00', '0.00', '30.00', '33.00', '2018-01-04 04:44:35', '2018-01-04 04:44:35', NULL),
			(41, 'DUMMY', 12, 'AS0012', 12, '25.00', '27.50', '0.00', '25.00', '27.50', '2018-01-04 04:45:50', '2018-01-04 04:45:50', NULL),
			(42, 'M', 13, 'AS0013-1', 13, '60.00', '66.00', '0.00', '60.00', '66.00', '2018-01-04 04:47:59', '2018-01-06 10:44:48', NULL),
			(43, 'L', 13, 'AS0013-2', 13, '60.00', '66.00', '0.00', '60.00', '66.00', '2018-01-04 04:47:59', '2018-01-06 10:44:48', NULL),
			(44, 'XL', 13, 'AS0013-3', 13, '60.00', '66.00', '0.00', '60.00', '66.00', '2018-01-04 04:47:59', '2018-01-06 10:44:48', NULL),
			(45, 'Gray', 14, 'AS0014-1', 14, '700.00', '770.00', '25.00', '875.00', '962.50', '2018-01-06 11:12:19', '2018-01-06 11:14:14', NULL),
			(46, 'Black', 14, 'AS0014-2', 14, '700.00', '770.00', '25.00', '875.00', '962.50', '2018-01-06 11:12:19', '2018-01-06 11:14:14', NULL),
			(47, '64 GB', 14, 'AS0014-1', 15, '700.00', '770.00', '25.00', '875.00', '962.50', '2018-01-06 11:14:14', '2018-01-06 11:14:14', NULL),
			(48, '128 GB', 14, 'AS0014-2', 15, '800.00', '880.00', '25.00', '1000.00', '1100.00', '2018-01-06 11:14:14', '2018-01-06 11:14:14', NULL),
			(49, 'White', 15, 'AS0015-1', 16, '950.00', '1045.00', '25.00', '1187.50', '1306.25', '2018-01-06 11:19:51', '2018-01-06 11:19:51', NULL),
			(50, 'Gray', 15, 'AS0015-2', 16, '950.00', '1045.00', '25.00', '1187.50', '1306.25', '2018-01-06 11:19:51', '2018-01-06 11:19:51', NULL),
			(51, 'Black', 15, 'AS0015-3', 16, '950.00', '1045.00', '25.00', '1187.50', '1306.25', '2018-01-06 11:19:51', '2018-01-06 11:19:51', NULL),
			(52, '32 GB', 15, 'AS0015-1', 17, '950.00', '1045.00', '25.00', '1187.50', '1306.25', '2018-01-06 11:19:51', '2018-01-06 11:19:51', NULL),
			(53, '64 GB', 15, 'AS0015-2', 17, '1010.00', '1111.00', '25.00', '1262.50', '1388.75', '2018-01-06 11:19:51', '2018-01-06 11:19:51', NULL),
			(54, 'Gold', 16, 'AS0016-1', 18, '350.00', '350.00', '25.00', '437.50', '437.50', '2018-01-06 11:24:48', '2018-01-06 11:24:48', NULL),
			(55, 'White', 16, 'AS0016-2', 18, '350.00', '350.00', '25.00', '437.50', '437.50', '2018-01-06 11:24:48', '2018-01-06 11:24:48', NULL),
			(56, 'Black', 16, 'AS0016-3', 18, '350.00', '350.00', '25.00', '437.50', '437.50', '2018-01-06 11:24:48', '2018-01-06 11:24:48', NULL),
			(57, 'Black', 17, 'AS0017-1', 19, '350.00', '350.00', '25.00', '437.50', '437.50', '2018-01-06 11:35:01', '2018-01-06 11:35:01', NULL),
			(58, 'White', 17, 'AS0017-2', 19, '350.00', '350.00', '25.00', '437.50', '437.50', '2018-01-06 11:35:01', '2018-01-06 11:35:01', NULL),
			(59, '256 GB', 18, 'AS0018-1', 20, '1350.00', '1350.00', '25.00', '1687.50', '1687.50', '2018-01-06 11:37:30', '2018-01-06 11:37:30', NULL),
			(60, '500 GB', 18, 'AS0018-2', 20, '1450.00', '1450.00', '25.00', '1812.50', '1812.50', '2018-01-06 11:37:30', '2018-01-06 11:37:30', NULL),
			(61, 'DUMMY', 19, 'AS0019', 21, '8.00', '8.00', '25.00', '10.00', '10.00', '2018-01-06 11:40:28', '2018-01-06 11:40:28', NULL),
			(62, 'Gray', 20, 'AS0020-1', 22, '25.00', '27.50', '25.00', '31.25', '34.38', '2018-01-06 11:43:00', '2018-01-06 11:43:00', NULL),
			(63, 'Black', 20, 'AS0020-2', 22, '25.00', '27.50', '25.00', '31.25', '34.38', '2018-01-06 11:43:00', '2018-01-06 11:43:00', NULL),
			(64, 'DUMMY', 21, 'AS0021', 23, '10.00', '10.00', '25.00', '12.50', '12.50', '2018-01-06 11:46:35', '2018-01-06 11:46:35', NULL),
			(65, 'DUMMY', 22, 'AS0022', 24, '8.00', '8.80', '25.00', '10.00', '11.00', '2018-01-06 11:55:09', '2018-01-06 11:55:09', NULL),
			(66, 'DUMMY', 23, 'AS0023', 25, '10.00', '10.00', '25.00', '12.50', '12.50', '2018-01-06 11:56:27', '2018-01-06 11:56:27', NULL),
			(67, 'DUMMY', 24, 'AS0024', 26, '8.00', '8.80', '25.00', '10.00', '11.00', '2018-01-06 12:01:22', '2018-01-06 12:01:22', NULL),
			(68, 'DUMMY', 25, 'AS0025', 27, '15.00', '15.00', '25.00', '18.75', '18.75', '2018-01-06 12:02:23', '2018-01-06 12:02:23', NULL),
			(69, 'DUMMY', 26, 'AS0026', 28, '5.00', '5.00', '25.00', '6.25', '6.25', '2018-01-06 12:05:51', '2018-01-06 12:05:51', NULL),
			(70, 'DUMMY', 27, 'AS0027', 29, '20.00', '22.00', '25.00', '25.00', '27.50', '2018-01-06 12:13:16', '2018-01-06 12:13:16', NULL),
			(71, 'DUMMY', 28, 'AS0028', 30, '10.00', '11.00', '25.00', '12.50', '13.75', '2018-01-06 12:15:47', '2018-01-06 12:15:47', NULL),
			(72, 'DUMMY', 29, 'AS0029', 31, '12.00', '12.00', '25.00', '15.00', '15.00', '2018-01-06 12:16:53', '2018-01-06 12:16:53', NULL),
			(73, 'DUMMY', 30, 'AS0030', 32, '40.00', '44.00', '25.00', '50.00', '55.00', '2018-01-06 12:18:59', '2018-01-06 12:18:59', NULL)");

        DB::insert("INSERT INTO variation_templates (id, name, business_id, 
        			created_at, updated_at) VALUES
					(1, 'Size (Tshirts)', 1, '2018-01-04 02:52:13', '2018-01-04 02:52:13'),
					(2, 'Size (Shoes)', 1, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(3, 'Waist Size (Jeans)', 1, '2018-01-04 02:54:34', '2018-01-04 02:54:34'),
					(4, 'Color', 1, '2018-01-06 12:42:52', '2018-01-06 12:42:52')");

        DB::insert("INSERT INTO variation_value_templates (id, name, variation_template_id, 
        			created_at, updated_at) VALUES
					(1, 'S', 1, '2018-01-04 02:52:13', '2018-01-04 02:52:13'),
					(2, 'M', 1, '2018-01-04 02:52:13', '2018-01-04 02:52:13'),
					(3, 'L', 1, '2018-01-04 02:52:13', '2018-01-04 02:52:13'),
					(4, 'XL', 1, '2018-01-04 02:52:13', '2018-01-04 02:52:13'),
					(5, '5', 2, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(6, '6', 2, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(7, '7', 2, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(8, '8', 2, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(9, '9', 2, '2018-01-04 02:53:21', '2018-01-04 02:53:21'),
					(10, '28', 3, '2018-01-04 02:54:34', '2018-01-04 02:54:34'),
					(11, '30', 3, '2018-01-04 02:54:34', '2018-01-04 02:54:34'),
					(12, '32', 3, '2018-01-04 02:54:34', '2018-01-04 02:54:34'),
					(13, '34', 3, '2018-01-04 02:54:35', '2018-01-04 02:54:35'),
					(14, '36', 3, '2018-01-04 02:54:35', '2018-01-04 02:54:35'),
					(16, 'Black', 4, '2018-01-06 12:43:17', '2018-01-06 12:43:17'),
					(17, 'Blue', 4, '2018-01-06 12:43:17', '2018-01-06 12:43:17'),
					(18, 'Brown', 4, '2018-01-06 12:43:17', '2018-01-06 12:43:17'),
					(19, 'Grey', 4, '2018-01-06 12:43:17', '2018-01-06 12:43:17'),
					(20, 'Gold', 4, '2018-01-06 12:43:17', '2018-01-06 12:43:17')");

        DB::insert("INSERT INTO purchase_lines (id, transaction_id, product_id, variation_id, 
        			quantity, purchase_price, purchase_price_inc_tax, item_tax, tax_id, created_at, updated_at) VALUES
					(1, 1, 2, 2, 100, '70.00', '77.00', '7.00', 1, '2018-01-06 12:27:11', 
					'2018-01-06 12:27:11'),
					(2, 1, 2, 3, 150, '70.00', '77.00', '7.00', 1, '2018-01-06 12:27:11', 
					'2018-01-06 12:27:11'),
					(3, 1, 2, 4, 150, '70.00', '77.00', '7.00', 1, '2018-01-06 12:27:11', 
					'2018-01-06 12:27:11'),
					(4, 1, 2, 5, 150, '72.00', '79.20', '7.20', 1, '2018-01-06 12:27:11', 
					'2018-01-06 12:27:11'),
					(5, 1, 2, 6, 100, '72.00', '79.20', '7.20', 1, '2018-01-06 12:27:11', 
					'2018-01-06 12:27:11'),
					(6, 2, 14, 47, 100, '700.00', '770.00', '70.00', 1, '2018-01-06 12:28:10', 
					'2018-01-06 12:28:10'),
					(7, 3, 28, 71, 500, '10.00', '11.00', '1.00', 1, '2018-01-06 12:32:22', 
					'2018-01-06 12:32:22'),
					(8, 4, 21, 64, 200, '10.00', '10.00', '0.00', NULL, '2018-01-06 12:33:12', 
					'2018-01-06 12:33:12'),
					(9, 5, 27, 70, 500, '20.00', '22.00', '2.00', 1, '2018-01-06 12:35:26', 
					'2018-01-06 12:35:26')");

        DB::insert("INSERT INTO transactions (id, business_id, location_id, type, status, payment_status, contact_id, invoice_no, ref_no, transaction_date, total_before_tax, tax_id, tax_amount, discount_type, discount_amount, shipping_details, shipping_charges, additional_notes, staff_note, final_total, created_by, created_at, updated_at) VALUES
					(1, 1, 1, 'purchase', 'received', 'paid', 2, NULL, '35001BCVX', 
					'$last_month', '50600.00', 1, '5060.00', NULL, '0', NULL, '0.00', NULL, NULL, '55660.00', 1, '2018-01-06 12:27:11', '2018-01-06 12:27:11'),
					(2, 1, 1, 'purchase', 'received', 'paid', 5, NULL, '35001BJGN', '$last_15th_day', '77000.00', 1, '7700.00', NULL, '0', NULL, '0.00', NULL, NULL, '84700.00', 1, '2018-01-06 12:28:10', '2018-01-06 12:28:10'),
					(3, 1, 1, 'purchase', 'received', 'partial', 6, NULL, '35001BCVJ', '$last_15th_day', '5500.00', 1, '550.00', NULL, '0', NULL, '0.00', NULL, NULL, '6050.00', 1, '2018-01-06 12:32:22', '2018-01-06 12:32:22'),
					(4, 1, 1, 'purchase', 'received', 'paid', 6, NULL, '35001BCVK', '$last_month', '2000.00', NULL, '0.00', NULL, '0', NULL, '0.00', NULL, NULL, '2000.00', 1, '2018-01-06 12:33:12', '2018-01-06 12:33:12'),
					(5, 1, 1, 'purchase', 'received', 'due', 6, NULL, '35001BCVD', '$last_month', '11000.00', 1, '1100.00', NULL, '0', NULL, '0.00', NULL, NULL, '12100.00', 1, '2018-01-06 12:35:26', '2018-01-06 12:35:26'),
					(6, 1, 1, 'sell', 'final', 'paid', 4, 'AS0001', '', '$today', '770.00', NULL, '0.00', 'percentage', '0', NULL, '0.00', NULL, NULL, '770.00', 1, '2018-01-06 12:36:11', '2018-01-06 12:36:11'),
					(7, 1, 1, 'sell', 'final', 'paid', 1, 'AS0002', '', '$yesterday', '825.00', NULL, '0.00', 'percentage', '0', NULL, '0.00', NULL, NULL, '825.00', 1, '2018-01-06 12:36:31', '2018-01-06 12:36:31'),
					(8, 1, 1, 'sell', 'final', 'paid', 4, 'AS0003', '', '$last_week', '7700.00', NULL, '0.00', 'percentage', '0', NULL, '0.00', NULL, NULL, '7700.00', 1, '2018-01-06 12:37:22', '2018-01-06 12:37:22'),
					(9, 1, 1, 'sell', 'final', 'paid', 1, 'AS0004', '', '$yesterday', '750.00', NULL, '0.00', 'percentage', '0', NULL, '0.00', NULL, NULL, '750.00', 1, '2018-01-06 12:37:45', '2018-01-06 12:37:45'),
					(10, 1, 1, 'sell', 'final', 'paid', 1, 'AS0005', '', '$today', '412.50', NULL, '0.00', 'percentage', '0', NULL, '0.00', NULL, NULL, '412.50', 1, '2018-01-06 12:38:03', '2018-01-06 12:38:03')");

        DB::insert("INSERT INTO transaction_payments (id, transaction_id, amount, method, card_transaction_number, card_number, card_type, card_holder_name, card_month, card_year, card_security, cheque_number, bank_account_number,paid_on, created_by, note, created_at, updated_at) VALUES
					(1, 6, '770.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-09 17:30:35', 1, NULL, '2018-01-06 07:06:11', '2018-01-06 07:06:11'),
					(2, 7, '825.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-09 17:30:35', 1, NULL, '2018-01-06 07:06:31', '2018-01-06 07:06:31'),
					(3, 8, '7700.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-09 17:30:35', 1, NULL, '2018-01-06 07:07:23', '2018-01-06 07:07:23'),
					(4, 9, '750.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-09 17:30:35', 1, NULL, '2018-01-06 07:07:45', '2018-01-06 07:07:45'),
					(5, 10, '412.50', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-09 17:30:35', 1, NULL, '2018-01-06 07:08:03', '2018-01-06 07:08:03'),
					(6, 4, '2000.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-11 17:32:56', 1, 'Cash Payment', '2018-01-11 12:02:56', '2018-01-11 12:02:56'),
					(7, 3, '3000.00', 'bank_transfer', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, '502110000631', '2018-01-11 17:34:10', 1, '3000 Paid Via Bank Transfer', '2018-01-11 12:04:10', '2018-01-11 12:04:10'),
					(8, 2, '84700.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-11 17:34:36', 1, NULL, '2018-01-11 12:04:36', '2018-01-11 12:04:36'),
					(9, 1, '50000.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-11 17:35:04', 1, NULL, '2018-01-11 12:05:04', '2018-01-11 12:05:04'),
					(10, 1, '5660.00', 'cash', NULL, NULL, 'visa', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-11 17:35:17', 1, NULL, '2018-01-11 12:05:17', '2018-01-11 12:05:17')");

        DB::insert("INSERT INTO transaction_sell_lines (id, transaction_id, product_id, variation_id, quantity, unit_price, unit_price_inc_tax, item_tax, tax_id, created_at, updated_at) VALUES
					(1, 6, 2, 3, 10, '70.00', '77.00', '7.00', 1, '2018-01-06 12:36:11', 
					'2018-01-06 12:36:11'),
					(2, 7, 27, 70, 30, '25.00', '27.50', '2.50', 1, '2018-01-06 12:36:31', '2018-01-06 12:36:31'),
					(3, 8, 2, 3, 50, '70.00', '77.00', '7.00', 1, '2018-01-06 12:37:23', '2018-01-06 12:37:23'),
					(4, 8, 2, 2, 50, '70.00', '77.00', '7.00', 1, '2018-01-06 12:37:23', '2018-01-06 12:37:23'),
					(5, 9, 21, 64, 60, '12.50', '12.50', '0.00', NULL, '2018-01-06 12:37:45', '2018-01-06 12:37:45'),
					(6, 10, 28, 71, 30, '12.50', '13.75', '1.25', 1, '2018-01-06 12:38:03', '2018-01-06 12:38:03')");

        DB::insert("INSERT INTO variation_location_details (id, product_id, product_variation_id, variation_id, location_id, qty_available, created_at, updated_at) VALUES
					(1, 2, 2, 2, 1, '50.00', '2018-01-06 12:27:11', '2018-01-06 12:37:23'),
					(2, 2, 2, 3, 1, '90.00', '2018-01-06 12:27:11', '2018-01-06 12:37:23'),
					(3, 2, 2, 4, 1, '150.00', '2018-01-06 12:27:11', '2018-01-06 12:27:11'),
					(4, 2, 2, 5, 1, '150.00', '2018-01-06 12:27:11', '2018-01-06 12:27:11'),
					(5, 2, 2, 6, 1, '100.00', '2018-01-06 12:27:11', '2018-01-06 12:27:11'),
					(6, 14, 15, 47, 1, '100.00', '2018-01-06 12:28:10', '2018-01-06 12:28:10'),
					(7, 28, 30, 71, 1, '470.00', '2018-01-06 12:32:22', '2018-01-06 12:38:03'),
					(8, 21, 23, 64, 1, '140.00', '2018-01-06 12:33:12', '2018-01-06 12:37:45'),
					(9, 27, 29, 70, 1, '470.00', '2018-01-06 12:35:26', '2018-01-06 12:36:32')");

        $admin_role = Role::create(['name' => 'Admin#1',
            'business_id' => 1,
            'guard_name' => 'web',
            'is_default' => 1,
        ]);
        $cashier_role = Role::create(['name' => 'Cashier#1',
            'business_id' => 1,
            'guard_name' => 'web',
            'is_default' => 1,
        ]);

        $cashier_role->syncPermissions(['sell.view', 'sell.create', 'sell.update', 'sell.delete',
            'access_all_locations', 'dashboard.data', ]);

        $admin = User::findOrFail(1);
        $cashier = User::findOrFail(2);
        $demo_user = User::findOrFail(3);

        $admin->assignRole('Admin#1');
        $cashier->assignRole('Cashier#1');
        $demo_user->assignRole('Admin#1');
        Permission::insert(['name' => 'location.1', 'guard_name' => 'web', 'created_at' => \Carbon::now()->toDateTimeString()]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::commit();
    }
}
