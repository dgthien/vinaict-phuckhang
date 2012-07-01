<?php

	class Purchase_order_model extends CI_Model {

		protected $__tbname = 'purchase_order';
		protected $__dbconf = 'default';

		var $id;	//bigint(20) unsigned	Primary Key	Auto Increment	NOT NULL
		var $id_customer;	//int(11)			NOT NULL
		var $order_date;	//date			NULL
		var $amount;	//float			NULL
		var $is_deleted = 0;	//tinyint(1)			NOT NULL
		var $status;	//tinyint(2)			NULL
		var $description;	//text			NULL
		var $shipping_address;	//varchar(250)			NOT NULL
		var $billing_address;	//varchar(250)			NOT NULL
		var $shipping_date;	//date			NULL
		var $payment_date;	//date			NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $modification_date;	//datetime			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE, 'auto_increment' => TRUE),
			'id_customer' => array('type' => 'int', 'null' => FALSE),
			'order_date' => array('type' => 'date', 'null' => TRUE),
			'amount' => array('type' => 'float', 'null' => TRUE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'status' => array('type' => 'tinyint', 'null' => TRUE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'shipping_address' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'billing_address' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'shipping_date' => array('type' => 'date', 'null' => TRUE),
			'payment_date' => array('type' => 'date', 'null' => TRUE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'customer', 'foreign_key' => 'id_customer')
		);
	}
