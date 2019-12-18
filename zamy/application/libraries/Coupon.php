<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon {
	
	public function __construct( $data = '' ) {
		parent::__construct( $data );
		
		if ( $data instanceof Coupon ) {
			$this->set_id( absint( $data->get_id() ) );
		}
		
    } 
	
}