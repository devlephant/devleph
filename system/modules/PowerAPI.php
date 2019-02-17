<?php

	/*
	
		PowerAPI class by Devel Snake for Devel Studio 3
	
	*/

	abstract class PowerAPI{
		
		// Возвращает класс для работы с питанием
		private static function API(){
		
			static $COM;
			
			if(!isset($COM)){
				
				$COM = new COM('winmgmts://localhost/root/CIMV2');
				
			}
			
			$WMI = $COM->ExecQuery("Select * from Win32_Battery");
				
			foreach($WMI as $API){
					
				return $API;
					
			}
		
		}
		
		// Статус подключения питания
		public static function GetACStatus(){
			
			if(self::API()->BatteryStatus == 2){
				return true;
			}else{
				return false;
			}
		
		}
		
		// Проценты заряда батареи
		public static function GetCharge(){
			
			return self::API()->EstimatedChargeRemaining;
		
		}
	
	}
?>