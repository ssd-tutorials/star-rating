<?php
class Helper {




	public static function name2Id($class_name = null) {
		switch($class_name) {
			case 'star-1':
			return 1;
			break;
			case 'star-2':
			return 2;
			break;
			case 'star-3':
			return 3;
			break;
			case 'star-4':
			return 4;
			break;
			case 'star-5':
			return 5;
			break;
			default:
			return 0;
		}
	}
	
	
	
	public static function id2Name($id = null) {
		switch($id) {
			case 1:
			return 'rate-1';
			break;
			case 2:
			return 'rate-2';
			break;
			case 3:
			return 'rate-3';
			break;
			case 4:
			return 'rate-4';
			break;
			case 5:
			return 'rate-5';
			break;
			default:
			return null;
		}
	}






}