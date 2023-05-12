<?php

	class Conexao
	{
		private static $db;
					
		private function __construct(){}

		public static function getInstancia()
		{
			if(empty(self::$db))
			{
				//criar a conexÃ£o
				$parametros = "mysql:host=localhost;dbname=pethouse;charset=utf8mb4";
				try
				{
					self::$db = new PDO($parametros, "root", "");
				}
				catch(PDOException $e)
				{
					echo $e->getCode();
					echo $e->getMessage();
					//echo "Problema na conexÃ£o";
					die();
				}
			}//fim do if

			return self::$db;

		}//fim getInstancia
	}
?>