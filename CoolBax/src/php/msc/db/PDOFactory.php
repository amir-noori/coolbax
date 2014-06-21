<?php
	error_reporting(E_PARSE);

	class PDOFactory 
	{
		public static function getPDO( $strDSN, $strUser, $strPass, $arParms) 
		{
			$strKey = md5(serialize(array( $strDSN, $strUser, $strPass, $arParms)));
			if (!($GLOBALS["PDOS"][$strKey] instanceof PDO))
			{
				$GLOBALS["PDOS"][$strKey] = new PDO( $strDSN, $strUser, $strPass, $arParms);
			};
			return( $GLOBALS["PDOS"][$strKey]);
		}
	}
?>