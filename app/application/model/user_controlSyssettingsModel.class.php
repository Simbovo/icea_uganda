<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class user_controlSyssettingsModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='user_controlSyssettingsModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='syssettings';
	const SQL_INSERT='INSERT INTO `syssettings` (`transno`,`daysdiff`,`xval`,`yval`,`sender`,`port`,`host`,`user_id`,`passwrd`,`email`,`image`,`printer`,`bouncefee`,`verinfo`,`duration`,`smsurl`,`smsusername`,`smspassword`,`smssenderid`,`smstrainmsg`,`mngmtfee`,`switchcharges`,`traillingfee`,`switch_fee`,`withholdingres`,`withholdingnonres`,`pernavrate`,`mngmtfeenav`,`membership`,`membershipmode`,`chargemembership`,`printfee`,`switchfee`,`transferfee`,`switchmaxperiod`,`transfermaxperiod`,`jointmax`,`withholdingrate`,`withholdingamt`,`passlength`,`passduration`,`allowreuse`,`workflowuse`,`statementinfo`,`withfee`,`withmaxperiod`,`certfee`,`certreplacementfee`,`chqreqfee`,`domantperiod`,`domantpurchase`,`domantwithdrawal`,`amlmaxchange`,`birthdaymsg`,`exitfee`,`usemanfee`,`sendviadb`,`usegrossamt`,`dividendsgross`,`trailfeeunitized`,`switchhighonly`,`transferhighonly`,`paydiffadminfee`,`compoundundistributedint`,`agentfeefromcompany`,`agentrate_rateprod`,`initiatoremail`,`receiptingonly`,`vatrate`,`execiserate`,`dividendrate`,`basecurrency`,`perpage`,`cutoff`,`agentminimum`,`emailclosing`,`emailsignedfor`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `syssettings` (`daysdiff`,`xval`,`yval`,`sender`,`port`,`host`,`user_id`,`passwrd`,`email`,`image`,`printer`,`bouncefee`,`verinfo`,`duration`,`smsurl`,`smsusername`,`smspassword`,`smssenderid`,`smstrainmsg`,`mngmtfee`,`switchcharges`,`traillingfee`,`switch_fee`,`withholdingres`,`withholdingnonres`,`pernavrate`,`mngmtfeenav`,`membership`,`membershipmode`,`chargemembership`,`printfee`,`switchfee`,`transferfee`,`switchmaxperiod`,`transfermaxperiod`,`jointmax`,`withholdingrate`,`withholdingamt`,`passlength`,`passduration`,`allowreuse`,`workflowuse`,`statementinfo`,`withfee`,`withmaxperiod`,`certfee`,`certreplacementfee`,`chqreqfee`,`domantperiod`,`domantpurchase`,`domantwithdrawal`,`amlmaxchange`,`birthdaymsg`,`exitfee`,`usemanfee`,`sendviadb`,`usegrossamt`,`dividendsgross`,`trailfeeunitized`,`switchhighonly`,`transferhighonly`,`paydiffadminfee`,`compoundundistributedint`,`agentfeefromcompany`,`agentrate_rateprod`,`initiatoremail`,`receiptingonly`,`vatrate`,`execiserate`,`dividendrate`,`basecurrency`,`perpage`,`cutoff`,`agentminimum`,`emailclosing`,`emailsignedfor`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `syssettings` SET `transno`=?,`daysdiff`=?,`xval`=?,`yval`=?,`sender`=?,`port`=?,`host`=?,`user_id`=?,`passwrd`=?,`email`=?,`image`=?,`printer`=?,`bouncefee`=?,`verinfo`=?,`duration`=?,`smsurl`=?,`smsusername`=?,`smspassword`=?,`smssenderid`=?,`smstrainmsg`=?,`mngmtfee`=?,`switchcharges`=?,`traillingfee`=?,`switch_fee`=?,`withholdingres`=?,`withholdingnonres`=?,`pernavrate`=?,`mngmtfeenav`=?,`membership`=?,`membershipmode`=?,`chargemembership`=?,`printfee`=?,`switchfee`=?,`transferfee`=?,`switchmaxperiod`=?,`transfermaxperiod`=?,`jointmax`=?,`withholdingrate`=?,`withholdingamt`=?,`passlength`=?,`passduration`=?,`allowreuse`=?,`workflowuse`=?,`statementinfo`=?,`withfee`=?,`withmaxperiod`=?,`certfee`=?,`certreplacementfee`=?,`chqreqfee`=?,`domantperiod`=?,`domantpurchase`=?,`domantwithdrawal`=?,`amlmaxchange`=?,`birthdaymsg`=?,`exitfee`=?,`usemanfee`=?,`sendviadb`=?,`usegrossamt`=?,`dividendsgross`=?,`trailfeeunitized`=?,`switchhighonly`=?,`transferhighonly`=?,`paydiffadminfee`=?,`compoundundistributedint`=?,`agentfeefromcompany`=?,`agentrate_rateprod`=?,`initiatoremail`=?,`receiptingonly`=?,`vatrate`=?,`execiserate`=?,`dividendrate`=?,`basecurrency`=?,`perpage`=?,`cutoff`=?,`agentminimum`=?,`emailclosing`=?,`emailsignedfor`=? WHERE `transno`=?';
	const SQL_SELECT_PK='SELECT * FROM `syssettings` WHERE `transno`=?';
	const SQL_DELETE_PK='DELETE FROM `syssettings` WHERE `transno`=?';
	const FIELD_TRANSNO=772437099;
	const FIELD_DAYSDIFF=-1155843302;
	const FIELD_XVAL=489317607;
	const FIELD_YVAL=489347398;
	const FIELD_SENDER=1924322291;
	const FIELD_PORT=489073087;
	const FIELD_HOST=488834790;
	const FIELD_USER_ID=1692363793;
	const FIELD_PASSWRD=1047470394;
	const FIELD_EMAIL=-2028838370;
	const FIELD_IMAGE=-2025144355;
	const FIELD_PRINTER=1524778524;
	const FIELD_BOUNCEFEE=1373810048;
	const FIELD_VERINFO=-2104155949;
	const FIELD_DURATION=-802189358;
	const FIELD_SMSURL=1931876148;
	const FIELD_SMSUSERNAME=1547340337;
	const FIELD_SMSPASSWORD=-1264927754;
	const FIELD_SMSSENDERID=-1233948821;
	const FIELD_SMSTRAINMSG=-1205790252;
	const FIELD_MNGMTFEE=-223198313;
	const FIELD_SWITCHCHARGES=-1893912819;
	const FIELD_TRAILLINGFEE=-2035605944;
	const FIELD_SWITCH_FEE=611672761;
	const FIELD_WITHHOLDINGRES=-556944383;
	const FIELD_WITHHOLDINGNONRES=-576767054;
	const FIELD_PERNAVRATE=1102224260;
	const FIELD_MNGMTFEENAV=-691459540;
	const FIELD_MEMBERSHIP=-381603180;
	const FIELD_MEMBERSHIPMODE=699466295;
	const FIELD_CHARGEMEMBERSHIP=-941883960;
	const FIELD_PRINTFEE=23494647;
	const FIELD_SWITCHFEE=-118809260;
	const FIELD_TRANSFERFEE=1939207357;
	const FIELD_SWITCHMAXPERIOD=-314507405;
	const FIELD_TRANSFERMAXPERIOD=1318904860;
	const FIELD_JOINTMAX=-210969896;
	const FIELD_WITHHOLDINGRATE=-85410401;
	const FIELD_WITHHOLDINGAMT=-556960471;
	const FIELD_PASSLENGTH=1926576373;
	const FIELD_PASSDURATION=675546083;
	const FIELD_ALLOWREUSE=-365964407;
	const FIELD_WORKFLOWUSE=1365970538;
	const FIELD_STATEMENTINFO=1977791263;
	const FIELD_WITHFEE=-1100326142;
	const FIELD_WITHMAXPERIOD=672842401;
	const FIELD_CERTFEE=-1786536732;
	const FIELD_CERTREPLACEMENTFEE=-605834218;
	const FIELD_CHQREQFEE=1113258838;
	const FIELD_DOMANTPERIOD=-1600332124;
	const FIELD_DOMANTPURCHASE=988528932;
	const FIELD_DOMANTWITHDRAWAL=-1138574312;
	const FIELD_AMLMAXCHANGE=-708341870;
	const FIELD_BIRTHDAYMSG=1664845030;
	const FIELD_EXITFEE=524112810;
	const FIELD_USEMANFEE=-1572144715;
	const FIELD_SENDVIADB=-1722567674;
	const FIELD_USEGROSSAMT=1374201997;
	const FIELD_DIVIDENDSGROSS=71483934;
	const FIELD_TRAILFEEUNITIZED=-1135378158;
	const FIELD_SWITCHHIGHONLY=-1702315200;
	const FIELD_TRANSFERHIGHONLY=-818340489;
	const FIELD_PAYDIFFADMINFEE=1136335238;
	const FIELD_COMPOUNDUNDISTRIBUTEDINT=989496110;
	const FIELD_AGENTFEEFROMCOMPANY=-412493932;
	const FIELD_AGENTRATE_RATEPROD=-579372401;
	const FIELD_INITIATOREMAIL=1068149387;
	const FIELD_RECEIPTINGONLY=1379021076;
	const FIELD_VATRATE=2078397835;
	const FIELD_EXECISERATE=1400737580;
	const FIELD_DIVIDENDRATE=808976525;
	const FIELD_BASECURRENCY=970361120;
	const FIELD_PERPAGE=1160952622;
	const FIELD_CUTOFF=1481221547;
	const FIELD_AGENTMINIMUM=-1189822297;
	const FIELD_EMAILCLOSING=1407515863;
	const FIELD_EMAILSIGNEDFOR=1262852047;
	private static $PRIMARY_KEYS=array(self::FIELD_TRANSNO);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_TRANSNO);
	private static $FIELD_NAMES=array(
		self::FIELD_TRANSNO=>'transno',
		self::FIELD_DAYSDIFF=>'daysdiff',
		self::FIELD_XVAL=>'xval',
		self::FIELD_YVAL=>'yval',
		self::FIELD_SENDER=>'sender',
		self::FIELD_PORT=>'port',
		self::FIELD_HOST=>'host',
		self::FIELD_USER_ID=>'user_id',
		self::FIELD_PASSWRD=>'passwrd',
		self::FIELD_EMAIL=>'email',
		self::FIELD_IMAGE=>'image',
		self::FIELD_PRINTER=>'printer',
		self::FIELD_BOUNCEFEE=>'bouncefee',
		self::FIELD_VERINFO=>'verinfo',
		self::FIELD_DURATION=>'duration',
		self::FIELD_SMSURL=>'smsurl',
		self::FIELD_SMSUSERNAME=>'smsusername',
		self::FIELD_SMSPASSWORD=>'smspassword',
		self::FIELD_SMSSENDERID=>'smssenderid',
		self::FIELD_SMSTRAINMSG=>'smstrainmsg',
		self::FIELD_MNGMTFEE=>'mngmtfee',
		self::FIELD_SWITCHCHARGES=>'switchcharges',
		self::FIELD_TRAILLINGFEE=>'traillingfee',
		self::FIELD_SWITCH_FEE=>'switch_fee',
		self::FIELD_WITHHOLDINGRES=>'withholdingres',
		self::FIELD_WITHHOLDINGNONRES=>'withholdingnonres',
		self::FIELD_PERNAVRATE=>'pernavrate',
		self::FIELD_MNGMTFEENAV=>'mngmtfeenav',
		self::FIELD_MEMBERSHIP=>'membership',
		self::FIELD_MEMBERSHIPMODE=>'membershipmode',
		self::FIELD_CHARGEMEMBERSHIP=>'chargemembership',
		self::FIELD_PRINTFEE=>'printfee',
		self::FIELD_SWITCHFEE=>'switchfee',
		self::FIELD_TRANSFERFEE=>'transferfee',
		self::FIELD_SWITCHMAXPERIOD=>'switchmaxperiod',
		self::FIELD_TRANSFERMAXPERIOD=>'transfermaxperiod',
		self::FIELD_JOINTMAX=>'jointmax',
		self::FIELD_WITHHOLDINGRATE=>'withholdingrate',
		self::FIELD_WITHHOLDINGAMT=>'withholdingamt',
		self::FIELD_PASSLENGTH=>'passlength',
		self::FIELD_PASSDURATION=>'passduration',
		self::FIELD_ALLOWREUSE=>'allowreuse',
		self::FIELD_WORKFLOWUSE=>'workflowuse',
		self::FIELD_STATEMENTINFO=>'statementinfo',
		self::FIELD_WITHFEE=>'withfee',
		self::FIELD_WITHMAXPERIOD=>'withmaxperiod',
		self::FIELD_CERTFEE=>'certfee',
		self::FIELD_CERTREPLACEMENTFEE=>'certreplacementfee',
		self::FIELD_CHQREQFEE=>'chqreqfee',
		self::FIELD_DOMANTPERIOD=>'domantperiod',
		self::FIELD_DOMANTPURCHASE=>'domantpurchase',
		self::FIELD_DOMANTWITHDRAWAL=>'domantwithdrawal',
		self::FIELD_AMLMAXCHANGE=>'amlmaxchange',
		self::FIELD_BIRTHDAYMSG=>'birthdaymsg',
		self::FIELD_EXITFEE=>'exitfee',
		self::FIELD_USEMANFEE=>'usemanfee',
		self::FIELD_SENDVIADB=>'sendviadb',
		self::FIELD_USEGROSSAMT=>'usegrossamt',
		self::FIELD_DIVIDENDSGROSS=>'dividendsgross',
		self::FIELD_TRAILFEEUNITIZED=>'trailfeeunitized',
		self::FIELD_SWITCHHIGHONLY=>'switchhighonly',
		self::FIELD_TRANSFERHIGHONLY=>'transferhighonly',
		self::FIELD_PAYDIFFADMINFEE=>'paydiffadminfee',
		self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>'compoundundistributedint',
		self::FIELD_AGENTFEEFROMCOMPANY=>'agentfeefromcompany',
		self::FIELD_AGENTRATE_RATEPROD=>'agentrate_rateprod',
		self::FIELD_INITIATOREMAIL=>'initiatoremail',
		self::FIELD_RECEIPTINGONLY=>'receiptingonly',
		self::FIELD_VATRATE=>'vatrate',
		self::FIELD_EXECISERATE=>'execiserate',
		self::FIELD_DIVIDENDRATE=>'dividendrate',
		self::FIELD_BASECURRENCY=>'basecurrency',
		self::FIELD_PERPAGE=>'perpage',
		self::FIELD_CUTOFF=>'cutoff',
		self::FIELD_AGENTMINIMUM=>'agentminimum',
		self::FIELD_EMAILCLOSING=>'emailclosing',
		self::FIELD_EMAILSIGNEDFOR=>'emailsignedfor');
	private static $PROPERTY_NAMES=array(
		self::FIELD_TRANSNO=>'transno',
		self::FIELD_DAYSDIFF=>'daysdiff',
		self::FIELD_XVAL=>'xval',
		self::FIELD_YVAL=>'yval',
		self::FIELD_SENDER=>'sender',
		self::FIELD_PORT=>'port',
		self::FIELD_HOST=>'host',
		self::FIELD_USER_ID=>'userId',
		self::FIELD_PASSWRD=>'passwrd',
		self::FIELD_EMAIL=>'email',
		self::FIELD_IMAGE=>'image',
		self::FIELD_PRINTER=>'printer',
		self::FIELD_BOUNCEFEE=>'bouncefee',
		self::FIELD_VERINFO=>'verinfo',
		self::FIELD_DURATION=>'duration',
		self::FIELD_SMSURL=>'smsurl',
		self::FIELD_SMSUSERNAME=>'smsusername',
		self::FIELD_SMSPASSWORD=>'smspassword',
		self::FIELD_SMSSENDERID=>'smssenderid',
		self::FIELD_SMSTRAINMSG=>'smstrainmsg',
		self::FIELD_MNGMTFEE=>'mngmtfee',
		self::FIELD_SWITCHCHARGES=>'switchcharges',
		self::FIELD_TRAILLINGFEE=>'traillingfee',
		self::FIELD_SWITCH_FEE=>'switchFee',
		self::FIELD_WITHHOLDINGRES=>'withholdingres',
		self::FIELD_WITHHOLDINGNONRES=>'withholdingnonres',
		self::FIELD_PERNAVRATE=>'pernavrate',
		self::FIELD_MNGMTFEENAV=>'mngmtfeenav',
		self::FIELD_MEMBERSHIP=>'membership',
		self::FIELD_MEMBERSHIPMODE=>'membershipmode',
		self::FIELD_CHARGEMEMBERSHIP=>'chargemembership',
		self::FIELD_PRINTFEE=>'printfee',
		self::FIELD_SWITCHFEE=>'switchfee',
		self::FIELD_TRANSFERFEE=>'transferfee',
		self::FIELD_SWITCHMAXPERIOD=>'switchmaxperiod',
		self::FIELD_TRANSFERMAXPERIOD=>'transfermaxperiod',
		self::FIELD_JOINTMAX=>'jointmax',
		self::FIELD_WITHHOLDINGRATE=>'withholdingrate',
		self::FIELD_WITHHOLDINGAMT=>'withholdingamt',
		self::FIELD_PASSLENGTH=>'passlength',
		self::FIELD_PASSDURATION=>'passduration',
		self::FIELD_ALLOWREUSE=>'allowreuse',
		self::FIELD_WORKFLOWUSE=>'workflowuse',
		self::FIELD_STATEMENTINFO=>'statementinfo',
		self::FIELD_WITHFEE=>'withfee',
		self::FIELD_WITHMAXPERIOD=>'withmaxperiod',
		self::FIELD_CERTFEE=>'certfee',
		self::FIELD_CERTREPLACEMENTFEE=>'certreplacementfee',
		self::FIELD_CHQREQFEE=>'chqreqfee',
		self::FIELD_DOMANTPERIOD=>'domantperiod',
		self::FIELD_DOMANTPURCHASE=>'domantpurchase',
		self::FIELD_DOMANTWITHDRAWAL=>'domantwithdrawal',
		self::FIELD_AMLMAXCHANGE=>'amlmaxchange',
		self::FIELD_BIRTHDAYMSG=>'birthdaymsg',
		self::FIELD_EXITFEE=>'exitfee',
		self::FIELD_USEMANFEE=>'usemanfee',
		self::FIELD_SENDVIADB=>'sendviadb',
		self::FIELD_USEGROSSAMT=>'usegrossamt',
		self::FIELD_DIVIDENDSGROSS=>'dividendsgross',
		self::FIELD_TRAILFEEUNITIZED=>'trailfeeunitized',
		self::FIELD_SWITCHHIGHONLY=>'switchhighonly',
		self::FIELD_TRANSFERHIGHONLY=>'transferhighonly',
		self::FIELD_PAYDIFFADMINFEE=>'paydiffadminfee',
		self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>'compoundundistributedint',
		self::FIELD_AGENTFEEFROMCOMPANY=>'agentfeefromcompany',
		self::FIELD_AGENTRATE_RATEPROD=>'agentrateRateprod',
		self::FIELD_INITIATOREMAIL=>'initiatoremail',
		self::FIELD_RECEIPTINGONLY=>'receiptingonly',
		self::FIELD_VATRATE=>'vatrate',
		self::FIELD_EXECISERATE=>'execiserate',
		self::FIELD_DIVIDENDRATE=>'dividendrate',
		self::FIELD_BASECURRENCY=>'basecurrency',
		self::FIELD_PERPAGE=>'perpage',
		self::FIELD_CUTOFF=>'cutoff',
		self::FIELD_AGENTMINIMUM=>'agentminimum',
		self::FIELD_EMAILCLOSING=>'emailclosing',
		self::FIELD_EMAILSIGNEDFOR=>'emailsignedfor');
	private static $PROPERTY_TYPES=array(
		self::FIELD_TRANSNO=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DAYSDIFF=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_XVAL=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_YVAL=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SENDER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PORT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_HOST=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_USER_ID=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PASSWRD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IMAGE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PRINTER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BOUNCEFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_VERINFO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DURATION=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SMSURL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMSUSERNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMSPASSWORD=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMSSENDERID=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMSTRAINMSG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MNGMTFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SWITCHCHARGES=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_TRAILLINGFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SWITCH_FEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WITHHOLDINGRES=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WITHHOLDINGNONRES=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PERNAVRATE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_MNGMTFEENAV=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_MEMBERSHIP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_MEMBERSHIPMODE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CHARGEMEMBERSHIP=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PRINTFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SWITCHFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_TRANSFERFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SWITCHMAXPERIOD=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_TRANSFERMAXPERIOD=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_JOINTMAX=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WITHHOLDINGRATE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WITHHOLDINGAMT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PASSLENGTH=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PASSDURATION=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_ALLOWREUSE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WORKFLOWUSE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_STATEMENTINFO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WITHFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_WITHMAXPERIOD=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CERTFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CERTREPLACEMENTFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CHQREQFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DOMANTPERIOD=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DOMANTPURCHASE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DOMANTWITHDRAWAL=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_AMLMAXCHANGE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_BIRTHDAYMSG=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EXITFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_USEMANFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SENDVIADB=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_USEGROSSAMT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DIVIDENDSGROSS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_TRAILFEEUNITIZED=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_SWITCHHIGHONLY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_TRANSFERHIGHONLY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PAYDIFFADMINFEE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_AGENTFEEFROMCOMPANY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_AGENTRATE_RATEPROD=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_INITIATOREMAIL=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_RECEIPTINGONLY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_VATRATE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_EXECISERATE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DIVIDENDRATE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_BASECURRENCY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PERPAGE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CUTOFF=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_AGENTMINIMUM=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_EMAILCLOSING=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAILSIGNEDFOR=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_TRANSNO=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,false),
		self::FIELD_DAYSDIFF=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_XVAL=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_YVAL=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SENDER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_PORT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_HOST=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,90,0,true),
		self::FIELD_USER_ID=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,true),
		self::FIELD_PASSWRD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,true),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_IMAGE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,150,0,true),
		self::FIELD_PRINTER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,75,0,true),
		self::FIELD_BOUNCEFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_VERINFO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true),
		self::FIELD_DURATION=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SMSURL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SMSUSERNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_SMSPASSWORD=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_SMSSENDERID=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_SMSTRAINMSG=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_MNGMTFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SWITCHCHARGES=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_TRAILLINGFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SWITCH_FEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WITHHOLDINGRES=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WITHHOLDINGNONRES=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PERNAVRATE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_MNGMTFEENAV=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_MEMBERSHIP=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_MEMBERSHIPMODE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CHARGEMEMBERSHIP=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PRINTFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SWITCHFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_TRANSFERFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SWITCHMAXPERIOD=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_TRANSFERMAXPERIOD=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_JOINTMAX=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WITHHOLDINGRATE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WITHHOLDINGAMT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PASSLENGTH=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PASSDURATION=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_ALLOWREUSE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WORKFLOWUSE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_STATEMENTINFO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,500,0,true),
		self::FIELD_WITHFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_WITHMAXPERIOD=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CERTFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CERTREPLACEMENTFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CHQREQFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DOMANTPERIOD=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DOMANTPURCHASE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DOMANTWITHDRAWAL=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_AMLMAXCHANGE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_BIRTHDAYMSG=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,500,0,true),
		self::FIELD_EXITFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_USEMANFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SENDVIADB=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_USEGROSSAMT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DIVIDENDSGROSS=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_TRAILFEEUNITIZED=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_SWITCHHIGHONLY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_TRANSFERHIGHONLY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PAYDIFFADMINFEE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_AGENTFEEFROMCOMPANY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_AGENTRATE_RATEPROD=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_INITIATOREMAIL=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_RECEIPTINGONLY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_VATRATE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_EXECISERATE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DIVIDENDRATE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_BASECURRENCY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PERPAGE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CUTOFF=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_AGENTMINIMUM=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_EMAILCLOSING=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_EMAILSIGNEDFOR=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_TRANSNO=>null,
		self::FIELD_DAYSDIFF=>null,
		self::FIELD_XVAL=>null,
		self::FIELD_YVAL=>null,
		self::FIELD_SENDER=>null,
		self::FIELD_PORT=>null,
		self::FIELD_HOST=>null,
		self::FIELD_USER_ID=>null,
		self::FIELD_PASSWRD=>null,
		self::FIELD_EMAIL=>null,
		self::FIELD_IMAGE=>null,
		self::FIELD_PRINTER=>null,
		self::FIELD_BOUNCEFEE=>null,
		self::FIELD_VERINFO=>null,
		self::FIELD_DURATION=>null,
		self::FIELD_SMSURL=>null,
		self::FIELD_SMSUSERNAME=>null,
		self::FIELD_SMSPASSWORD=>null,
		self::FIELD_SMSSENDERID=>null,
		self::FIELD_SMSTRAINMSG=>null,
		self::FIELD_MNGMTFEE=>null,
		self::FIELD_SWITCHCHARGES=>null,
		self::FIELD_TRAILLINGFEE=>null,
		self::FIELD_SWITCH_FEE=>null,
		self::FIELD_WITHHOLDINGRES=>null,
		self::FIELD_WITHHOLDINGNONRES=>null,
		self::FIELD_PERNAVRATE=>null,
		self::FIELD_MNGMTFEENAV=>null,
		self::FIELD_MEMBERSHIP=>null,
		self::FIELD_MEMBERSHIPMODE=>null,
		self::FIELD_CHARGEMEMBERSHIP=>null,
		self::FIELD_PRINTFEE=>null,
		self::FIELD_SWITCHFEE=>null,
		self::FIELD_TRANSFERFEE=>null,
		self::FIELD_SWITCHMAXPERIOD=>null,
		self::FIELD_TRANSFERMAXPERIOD=>null,
		self::FIELD_JOINTMAX=>null,
		self::FIELD_WITHHOLDINGRATE=>null,
		self::FIELD_WITHHOLDINGAMT=>null,
		self::FIELD_PASSLENGTH=>null,
		self::FIELD_PASSDURATION=>null,
		self::FIELD_ALLOWREUSE=>null,
		self::FIELD_WORKFLOWUSE=>null,
		self::FIELD_STATEMENTINFO=>null,
		self::FIELD_WITHFEE=>null,
		self::FIELD_WITHMAXPERIOD=>null,
		self::FIELD_CERTFEE=>null,
		self::FIELD_CERTREPLACEMENTFEE=>null,
		self::FIELD_CHQREQFEE=>null,
		self::FIELD_DOMANTPERIOD=>null,
		self::FIELD_DOMANTPURCHASE=>null,
		self::FIELD_DOMANTWITHDRAWAL=>null,
		self::FIELD_AMLMAXCHANGE=>null,
		self::FIELD_BIRTHDAYMSG=>null,
		self::FIELD_EXITFEE=>null,
		self::FIELD_USEMANFEE=>null,
		self::FIELD_SENDVIADB=>null,
		self::FIELD_USEGROSSAMT=>null,
		self::FIELD_DIVIDENDSGROSS=>null,
		self::FIELD_TRAILFEEUNITIZED=>null,
		self::FIELD_SWITCHHIGHONLY=>null,
		self::FIELD_TRANSFERHIGHONLY=>null,
		self::FIELD_PAYDIFFADMINFEE=>null,
		self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>null,
		self::FIELD_AGENTFEEFROMCOMPANY=>null,
		self::FIELD_AGENTRATE_RATEPROD=>null,
		self::FIELD_INITIATOREMAIL=>null,
		self::FIELD_RECEIPTINGONLY=>null,
		self::FIELD_VATRATE=>null,
		self::FIELD_EXECISERATE=>null,
		self::FIELD_DIVIDENDRATE=>null,
		self::FIELD_BASECURRENCY=>null,
		self::FIELD_PERPAGE=>null,
		self::FIELD_CUTOFF=>null,
		self::FIELD_AGENTMINIMUM=>null,
		self::FIELD_EMAILCLOSING=>null,
		self::FIELD_EMAILSIGNEDFOR=>null);
	private $transno;
	private $daysdiff;
	private $xval;
	private $yval;
	private $sender;
	private $port;
	private $host;
	private $userId;
	private $passwrd;
	private $email;
	private $image;
	private $printer;
	private $bouncefee;
	private $verinfo;
	private $duration;
	private $smsurl;
	private $smsusername;
	private $smspassword;
	private $smssenderid;
	private $smstrainmsg;
	private $mngmtfee;
	private $switchcharges;
	private $traillingfee;
	private $switchFee;
	private $withholdingres;
	private $withholdingnonres;
	private $pernavrate;
	private $mngmtfeenav;
	private $membership;
	private $membershipmode;
	private $chargemembership;
	private $printfee;
	private $switchfee;
	private $transferfee;
	private $switchmaxperiod;
	private $transfermaxperiod;
	private $jointmax;
	private $withholdingrate;
	private $withholdingamt;
	private $passlength;
	private $passduration;
	private $allowreuse;
	private $workflowuse;
	private $statementinfo;
	private $withfee;
	private $withmaxperiod;
	private $certfee;
	private $certreplacementfee;
	private $chqreqfee;
	private $domantperiod;
	private $domantpurchase;
	private $domantwithdrawal;
	private $amlmaxchange;
	private $birthdaymsg;
	private $exitfee;
	private $usemanfee;
	private $sendviadb;
	private $usegrossamt;
	private $dividendsgross;
	private $trailfeeunitized;
	private $switchhighonly;
	private $transferhighonly;
	private $paydiffadminfee;
	private $compoundundistributedint;
	private $agentfeefromcompany;
	private $agentrateRateprod;
	private $initiatoremail;
	private $receiptingonly;
	private $vatrate;
	private $execiserate;
	private $dividendrate;
	private $basecurrency;
	private $perpage;
	private $cutoff;
	private $agentminimum;
	private $emailclosing;
	private $emailsignedfor;

	/**
	 * set value for transno 
	 *
	 * type:numeric,size:131089,default:nextval('unitmaster.syssettings_transno_seq'::regclass),primary,autoincrement
	 *
	 * @param mixed $transno
	 * @return user_controlSyssettingsModel
	 */
	public function &setTransno($transno) {
		$this->notifyChanged(self::FIELD_TRANSNO,$this->transno,$transno);
		$this->transno=$transno;
		return $this;
	}

	/**
	 * get value for transno 
	 *
	 * type:numeric,size:131089,default:nextval('unitmaster.syssettings_transno_seq'::regclass),primary,autoincrement
	 *
	 * @return mixed
	 */
	public function getTransno() {
		return $this->transno;
	}

	/**
	 * set value for daysdiff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $daysdiff
	 * @return user_controlSyssettingsModel
	 */
	public function &setDaysdiff($daysdiff) {
		$this->notifyChanged(self::FIELD_DAYSDIFF,$this->daysdiff,$daysdiff);
		$this->daysdiff=$daysdiff;
		return $this;
	}

	/**
	 * get value for daysdiff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDaysdiff() {
		return $this->daysdiff;
	}

	/**
	 * set value for xval 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $xval
	 * @return user_controlSyssettingsModel
	 */
	public function &setXval($xval) {
		$this->notifyChanged(self::FIELD_XVAL,$this->xval,$xval);
		$this->xval=$xval;
		return $this;
	}

	/**
	 * get value for xval 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getXval() {
		return $this->xval;
	}

	/**
	 * set value for yval 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $yval
	 * @return user_controlSyssettingsModel
	 */
	public function &setYval($yval) {
		$this->notifyChanged(self::FIELD_YVAL,$this->yval,$yval);
		$this->yval=$yval;
		return $this;
	}

	/**
	 * get value for yval 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getYval() {
		return $this->yval;
	}

	/**
	 * set value for sender 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $sender
	 * @return user_controlSyssettingsModel
	 */
	public function &setSender($sender) {
		$this->notifyChanged(self::FIELD_SENDER,$this->sender,$sender);
		$this->sender=$sender;
		return $this;
	}

	/**
	 * get value for sender 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSender() {
		return $this->sender;
	}

	/**
	 * set value for port 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $port
	 * @return user_controlSyssettingsModel
	 */
	public function &setPort($port) {
		$this->notifyChanged(self::FIELD_PORT,$this->port,$port);
		$this->port=$port;
		return $this;
	}

	/**
	 * get value for port 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPort() {
		return $this->port;
	}

	/**
	 * set value for host 
	 *
	 * type:varchar,size:90,default:null,nullable
	 *
	 * @param mixed $host
	 * @return user_controlSyssettingsModel
	 */
	public function &setHost($host) {
		$this->notifyChanged(self::FIELD_HOST,$this->host,$host);
		$this->host=$host;
		return $this;
	}

	/**
	 * get value for host 
	 *
	 * type:varchar,size:90,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHost() {
		return $this->host;
	}

	/**
	 * set value for user_id 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @param mixed $userId
	 * @return user_controlSyssettingsModel
	 */
	public function &setUserId($userId) {
		$this->notifyChanged(self::FIELD_USER_ID,$this->userId,$userId);
		$this->userId=$userId;
		return $this;
	}

	/**
	 * get value for user_id 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * set value for passwrd 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @param mixed $passwrd
	 * @return user_controlSyssettingsModel
	 */
	public function &setPasswrd($passwrd) {
		$this->notifyChanged(self::FIELD_PASSWRD,$this->passwrd,$passwrd);
		$this->passwrd=$passwrd;
		return $this;
	}

	/**
	 * get value for passwrd 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPasswrd() {
		return $this->passwrd;
	}

	/**
	 * set value for email 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $email
	 * @return user_controlSyssettingsModel
	 */
	public function &setEmail($email) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->email,$email);
		$this->email=$email;
		return $this;
	}

	/**
	 * get value for email 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * set value for image 
	 *
	 * type:varchar,size:150,default:null,nullable
	 *
	 * @param mixed $image
	 * @return user_controlSyssettingsModel
	 */
	public function &setImage($image) {
		$this->notifyChanged(self::FIELD_IMAGE,$this->image,$image);
		$this->image=$image;
		return $this;
	}

	/**
	 * get value for image 
	 *
	 * type:varchar,size:150,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * set value for printer 
	 *
	 * type:varchar,size:75,default:null,nullable
	 *
	 * @param mixed $printer
	 * @return user_controlSyssettingsModel
	 */
	public function &setPrinter($printer) {
		$this->notifyChanged(self::FIELD_PRINTER,$this->printer,$printer);
		$this->printer=$printer;
		return $this;
	}

	/**
	 * get value for printer 
	 *
	 * type:varchar,size:75,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPrinter() {
		return $this->printer;
	}

	/**
	 * set value for bouncefee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $bouncefee
	 * @return user_controlSyssettingsModel
	 */
	public function &setBouncefee($bouncefee) {
		$this->notifyChanged(self::FIELD_BOUNCEFEE,$this->bouncefee,$bouncefee);
		$this->bouncefee=$bouncefee;
		return $this;
	}

	/**
	 * get value for bouncefee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBouncefee() {
		return $this->bouncefee;
	}

	/**
	 * set value for verinfo 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @param mixed $verinfo
	 * @return user_controlSyssettingsModel
	 */
	public function &setVerinfo($verinfo) {
		$this->notifyChanged(self::FIELD_VERINFO,$this->verinfo,$verinfo);
		$this->verinfo=$verinfo;
		return $this;
	}

	/**
	 * get value for verinfo 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVerinfo() {
		return $this->verinfo;
	}

	/**
	 * set value for duration 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $duration
	 * @return user_controlSyssettingsModel
	 */
	public function &setDuration($duration) {
		$this->notifyChanged(self::FIELD_DURATION,$this->duration,$duration);
		$this->duration=$duration;
		return $this;
	}

	/**
	 * get value for duration 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * set value for smsurl 
	 *
	 * type:varchar,size:255,default:null,nullable
	 *
	 * @param mixed $smsurl
	 * @return user_controlSyssettingsModel
	 */
	public function &setSmsurl($smsurl) {
		$this->notifyChanged(self::FIELD_SMSURL,$this->smsurl,$smsurl);
		$this->smsurl=$smsurl;
		return $this;
	}

	/**
	 * get value for smsurl 
	 *
	 * type:varchar,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmsurl() {
		return $this->smsurl;
	}

	/**
	 * set value for smsusername 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $smsusername
	 * @return user_controlSyssettingsModel
	 */
	public function &setSmsusername($smsusername) {
		$this->notifyChanged(self::FIELD_SMSUSERNAME,$this->smsusername,$smsusername);
		$this->smsusername=$smsusername;
		return $this;
	}

	/**
	 * get value for smsusername 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmsusername() {
		return $this->smsusername;
	}

	/**
	 * set value for smspassword 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $smspassword
	 * @return user_controlSyssettingsModel
	 */
	public function &setSmspassword($smspassword) {
		$this->notifyChanged(self::FIELD_SMSPASSWORD,$this->smspassword,$smspassword);
		$this->smspassword=$smspassword;
		return $this;
	}

	/**
	 * get value for smspassword 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmspassword() {
		return $this->smspassword;
	}

	/**
	 * set value for smssenderid 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $smssenderid
	 * @return user_controlSyssettingsModel
	 */
	public function &setSmssenderid($smssenderid) {
		$this->notifyChanged(self::FIELD_SMSSENDERID,$this->smssenderid,$smssenderid);
		$this->smssenderid=$smssenderid;
		return $this;
	}

	/**
	 * get value for smssenderid 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmssenderid() {
		return $this->smssenderid;
	}

	/**
	 * set value for smstrainmsg 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @param mixed $smstrainmsg
	 * @return user_controlSyssettingsModel
	 */
	public function &setSmstrainmsg($smstrainmsg) {
		$this->notifyChanged(self::FIELD_SMSTRAINMSG,$this->smstrainmsg,$smstrainmsg);
		$this->smstrainmsg=$smstrainmsg;
		return $this;
	}

	/**
	 * get value for smstrainmsg 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmstrainmsg() {
		return $this->smstrainmsg;
	}

	/**
	 * set value for mngmtfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $mngmtfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setMngmtfee($mngmtfee) {
		$this->notifyChanged(self::FIELD_MNGMTFEE,$this->mngmtfee,$mngmtfee);
		$this->mngmtfee=$mngmtfee;
		return $this;
	}

	/**
	 * get value for mngmtfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMngmtfee() {
		return $this->mngmtfee;
	}

	/**
	 * set value for switchcharges 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $switchcharges
	 * @return user_controlSyssettingsModel
	 */
	public function &setSwitchcharges($switchcharges) {
		$this->notifyChanged(self::FIELD_SWITCHCHARGES,$this->switchcharges,$switchcharges);
		$this->switchcharges=$switchcharges;
		return $this;
	}

	/**
	 * get value for switchcharges 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSwitchcharges() {
		return $this->switchcharges;
	}

	/**
	 * set value for traillingfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $traillingfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setTraillingfee($traillingfee) {
		$this->notifyChanged(self::FIELD_TRAILLINGFEE,$this->traillingfee,$traillingfee);
		$this->traillingfee=$traillingfee;
		return $this;
	}

	/**
	 * get value for traillingfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTraillingfee() {
		return $this->traillingfee;
	}

	/**
	 * set value for switch_fee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $switchFee
	 * @return user_controlSyssettingsModel
	 */
	public function &setSwitchFee($switchFee) {
		$this->notifyChanged(self::FIELD_SWITCH_FEE,$this->switchFee,$switchFee);
		$this->switchFee=$switchFee;
		return $this;
	}

	/**
	 * get value for switch_fee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSwitchFee() {
		return $this->switchFee;
	}

	/**
	 * set value for withholdingres 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withholdingres
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithholdingres($withholdingres) {
		$this->notifyChanged(self::FIELD_WITHHOLDINGRES,$this->withholdingres,$withholdingres);
		$this->withholdingres=$withholdingres;
		return $this;
	}

	/**
	 * get value for withholdingres 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithholdingres() {
		return $this->withholdingres;
	}

	/**
	 * set value for withholdingnonres 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withholdingnonres
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithholdingnonres($withholdingnonres) {
		$this->notifyChanged(self::FIELD_WITHHOLDINGNONRES,$this->withholdingnonres,$withholdingnonres);
		$this->withholdingnonres=$withholdingnonres;
		return $this;
	}

	/**
	 * get value for withholdingnonres 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithholdingnonres() {
		return $this->withholdingnonres;
	}

	/**
	 * set value for pernavrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $pernavrate
	 * @return user_controlSyssettingsModel
	 */
	public function &setPernavrate($pernavrate) {
		$this->notifyChanged(self::FIELD_PERNAVRATE,$this->pernavrate,$pernavrate);
		$this->pernavrate=$pernavrate;
		return $this;
	}

	/**
	 * get value for pernavrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPernavrate() {
		return $this->pernavrate;
	}

	/**
	 * set value for mngmtfeenav 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $mngmtfeenav
	 * @return user_controlSyssettingsModel
	 */
	public function &setMngmtfeenav($mngmtfeenav) {
		$this->notifyChanged(self::FIELD_MNGMTFEENAV,$this->mngmtfeenav,$mngmtfeenav);
		$this->mngmtfeenav=$mngmtfeenav;
		return $this;
	}

	/**
	 * get value for mngmtfeenav 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMngmtfeenav() {
		return $this->mngmtfeenav;
	}

	/**
	 * set value for membership 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $membership
	 * @return user_controlSyssettingsModel
	 */
	public function &setMembership($membership) {
		$this->notifyChanged(self::FIELD_MEMBERSHIP,$this->membership,$membership);
		$this->membership=$membership;
		return $this;
	}

	/**
	 * get value for membership 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMembership() {
		return $this->membership;
	}

	/**
	 * set value for membershipmode 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $membershipmode
	 * @return user_controlSyssettingsModel
	 */
	public function &setMembershipmode($membershipmode) {
		$this->notifyChanged(self::FIELD_MEMBERSHIPMODE,$this->membershipmode,$membershipmode);
		$this->membershipmode=$membershipmode;
		return $this;
	}

	/**
	 * get value for membershipmode 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMembershipmode() {
		return $this->membershipmode;
	}

	/**
	 * set value for chargemembership 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $chargemembership
	 * @return user_controlSyssettingsModel
	 */
	public function &setChargemembership($chargemembership) {
		$this->notifyChanged(self::FIELD_CHARGEMEMBERSHIP,$this->chargemembership,$chargemembership);
		$this->chargemembership=$chargemembership;
		return $this;
	}

	/**
	 * get value for chargemembership 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getChargemembership() {
		return $this->chargemembership;
	}

	/**
	 * set value for printfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $printfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setPrintfee($printfee) {
		$this->notifyChanged(self::FIELD_PRINTFEE,$this->printfee,$printfee);
		$this->printfee=$printfee;
		return $this;
	}

	/**
	 * get value for printfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPrintfee() {
		return $this->printfee;
	}

	/**
	 * set value for switchfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $switchfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setSwitchfee($switchfee) {
		$this->notifyChanged(self::FIELD_SWITCHFEE,$this->switchfee,$switchfee);
		$this->switchfee=$switchfee;
		return $this;
	}

	/**
	 * get value for switchfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSwitchfee() {
		return $this->switchfee;
	}

	/**
	 * set value for transferfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $transferfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setTransferfee($transferfee) {
		$this->notifyChanged(self::FIELD_TRANSFERFEE,$this->transferfee,$transferfee);
		$this->transferfee=$transferfee;
		return $this;
	}

	/**
	 * get value for transferfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransferfee() {
		return $this->transferfee;
	}

	/**
	 * set value for switchmaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $switchmaxperiod
	 * @return user_controlSyssettingsModel
	 */
	public function &setSwitchmaxperiod($switchmaxperiod) {
		$this->notifyChanged(self::FIELD_SWITCHMAXPERIOD,$this->switchmaxperiod,$switchmaxperiod);
		$this->switchmaxperiod=$switchmaxperiod;
		return $this;
	}

	/**
	 * get value for switchmaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSwitchmaxperiod() {
		return $this->switchmaxperiod;
	}

	/**
	 * set value for transfermaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $transfermaxperiod
	 * @return user_controlSyssettingsModel
	 */
	public function &setTransfermaxperiod($transfermaxperiod) {
		$this->notifyChanged(self::FIELD_TRANSFERMAXPERIOD,$this->transfermaxperiod,$transfermaxperiod);
		$this->transfermaxperiod=$transfermaxperiod;
		return $this;
	}

	/**
	 * get value for transfermaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransfermaxperiod() {
		return $this->transfermaxperiod;
	}

	/**
	 * set value for jointmax 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $jointmax
	 * @return user_controlSyssettingsModel
	 */
	public function &setJointmax($jointmax) {
		$this->notifyChanged(self::FIELD_JOINTMAX,$this->jointmax,$jointmax);
		$this->jointmax=$jointmax;
		return $this;
	}

	/**
	 * get value for jointmax 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getJointmax() {
		return $this->jointmax;
	}

	/**
	 * set value for withholdingrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withholdingrate
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithholdingrate($withholdingrate) {
		$this->notifyChanged(self::FIELD_WITHHOLDINGRATE,$this->withholdingrate,$withholdingrate);
		$this->withholdingrate=$withholdingrate;
		return $this;
	}

	/**
	 * get value for withholdingrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithholdingrate() {
		return $this->withholdingrate;
	}

	/**
	 * set value for withholdingamt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withholdingamt
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithholdingamt($withholdingamt) {
		$this->notifyChanged(self::FIELD_WITHHOLDINGAMT,$this->withholdingamt,$withholdingamt);
		$this->withholdingamt=$withholdingamt;
		return $this;
	}

	/**
	 * get value for withholdingamt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithholdingamt() {
		return $this->withholdingamt;
	}

	/**
	 * set value for passlength 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $passlength
	 * @return user_controlSyssettingsModel
	 */
	public function &setPasslength($passlength) {
		$this->notifyChanged(self::FIELD_PASSLENGTH,$this->passlength,$passlength);
		$this->passlength=$passlength;
		return $this;
	}

	/**
	 * get value for passlength 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPasslength() {
		return $this->passlength;
	}

	/**
	 * set value for passduration 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $passduration
	 * @return user_controlSyssettingsModel
	 */
	public function &setPassduration($passduration) {
		$this->notifyChanged(self::FIELD_PASSDURATION,$this->passduration,$passduration);
		$this->passduration=$passduration;
		return $this;
	}

	/**
	 * get value for passduration 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPassduration() {
		return $this->passduration;
	}

	/**
	 * set value for allowreuse 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $allowreuse
	 * @return user_controlSyssettingsModel
	 */
	public function &setAllowreuse($allowreuse) {
		$this->notifyChanged(self::FIELD_ALLOWREUSE,$this->allowreuse,$allowreuse);
		$this->allowreuse=$allowreuse;
		return $this;
	}

	/**
	 * get value for allowreuse 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAllowreuse() {
		return $this->allowreuse;
	}

	/**
	 * set value for workflowuse 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $workflowuse
	 * @return user_controlSyssettingsModel
	 */
	public function &setWorkflowuse($workflowuse) {
		$this->notifyChanged(self::FIELD_WORKFLOWUSE,$this->workflowuse,$workflowuse);
		$this->workflowuse=$workflowuse;
		return $this;
	}

	/**
	 * get value for workflowuse 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWorkflowuse() {
		return $this->workflowuse;
	}

	/**
	 * set value for statementinfo 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @param mixed $statementinfo
	 * @return user_controlSyssettingsModel
	 */
	public function &setStatementinfo($statementinfo) {
		$this->notifyChanged(self::FIELD_STATEMENTINFO,$this->statementinfo,$statementinfo);
		$this->statementinfo=$statementinfo;
		return $this;
	}

	/**
	 * get value for statementinfo 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStatementinfo() {
		return $this->statementinfo;
	}

	/**
	 * set value for withfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithfee($withfee) {
		$this->notifyChanged(self::FIELD_WITHFEE,$this->withfee,$withfee);
		$this->withfee=$withfee;
		return $this;
	}

	/**
	 * get value for withfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithfee() {
		return $this->withfee;
	}

	/**
	 * set value for withmaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $withmaxperiod
	 * @return user_controlSyssettingsModel
	 */
	public function &setWithmaxperiod($withmaxperiod) {
		$this->notifyChanged(self::FIELD_WITHMAXPERIOD,$this->withmaxperiod,$withmaxperiod);
		$this->withmaxperiod=$withmaxperiod;
		return $this;
	}

	/**
	 * get value for withmaxperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWithmaxperiod() {
		return $this->withmaxperiod;
	}

	/**
	 * set value for certfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $certfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setCertfee($certfee) {
		$this->notifyChanged(self::FIELD_CERTFEE,$this->certfee,$certfee);
		$this->certfee=$certfee;
		return $this;
	}

	/**
	 * get value for certfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCertfee() {
		return $this->certfee;
	}

	/**
	 * set value for certreplacementfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $certreplacementfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setCertreplacementfee($certreplacementfee) {
		$this->notifyChanged(self::FIELD_CERTREPLACEMENTFEE,$this->certreplacementfee,$certreplacementfee);
		$this->certreplacementfee=$certreplacementfee;
		return $this;
	}

	/**
	 * get value for certreplacementfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCertreplacementfee() {
		return $this->certreplacementfee;
	}

	/**
	 * set value for chqreqfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $chqreqfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setChqreqfee($chqreqfee) {
		$this->notifyChanged(self::FIELD_CHQREQFEE,$this->chqreqfee,$chqreqfee);
		$this->chqreqfee=$chqreqfee;
		return $this;
	}

	/**
	 * get value for chqreqfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getChqreqfee() {
		return $this->chqreqfee;
	}

	/**
	 * set value for domantperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $domantperiod
	 * @return user_controlSyssettingsModel
	 */
	public function &setDomantperiod($domantperiod) {
		$this->notifyChanged(self::FIELD_DOMANTPERIOD,$this->domantperiod,$domantperiod);
		$this->domantperiod=$domantperiod;
		return $this;
	}

	/**
	 * get value for domantperiod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDomantperiod() {
		return $this->domantperiod;
	}

	/**
	 * set value for domantpurchase 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $domantpurchase
	 * @return user_controlSyssettingsModel
	 */
	public function &setDomantpurchase($domantpurchase) {
		$this->notifyChanged(self::FIELD_DOMANTPURCHASE,$this->domantpurchase,$domantpurchase);
		$this->domantpurchase=$domantpurchase;
		return $this;
	}

	/**
	 * get value for domantpurchase 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDomantpurchase() {
		return $this->domantpurchase;
	}

	/**
	 * set value for domantwithdrawal 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $domantwithdrawal
	 * @return user_controlSyssettingsModel
	 */
	public function &setDomantwithdrawal($domantwithdrawal) {
		$this->notifyChanged(self::FIELD_DOMANTWITHDRAWAL,$this->domantwithdrawal,$domantwithdrawal);
		$this->domantwithdrawal=$domantwithdrawal;
		return $this;
	}

	/**
	 * get value for domantwithdrawal 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDomantwithdrawal() {
		return $this->domantwithdrawal;
	}

	/**
	 * set value for amlmaxchange 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $amlmaxchange
	 * @return user_controlSyssettingsModel
	 */
	public function &setAmlmaxchange($amlmaxchange) {
		$this->notifyChanged(self::FIELD_AMLMAXCHANGE,$this->amlmaxchange,$amlmaxchange);
		$this->amlmaxchange=$amlmaxchange;
		return $this;
	}

	/**
	 * get value for amlmaxchange 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAmlmaxchange() {
		return $this->amlmaxchange;
	}

	/**
	 * set value for birthdaymsg 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @param mixed $birthdaymsg
	 * @return user_controlSyssettingsModel
	 */
	public function &setBirthdaymsg($birthdaymsg) {
		$this->notifyChanged(self::FIELD_BIRTHDAYMSG,$this->birthdaymsg,$birthdaymsg);
		$this->birthdaymsg=$birthdaymsg;
		return $this;
	}

	/**
	 * get value for birthdaymsg 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBirthdaymsg() {
		return $this->birthdaymsg;
	}

	/**
	 * set value for exitfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $exitfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setExitfee($exitfee) {
		$this->notifyChanged(self::FIELD_EXITFEE,$this->exitfee,$exitfee);
		$this->exitfee=$exitfee;
		return $this;
	}

	/**
	 * get value for exitfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExitfee() {
		return $this->exitfee;
	}

	/**
	 * set value for usemanfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $usemanfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setUsemanfee($usemanfee) {
		$this->notifyChanged(self::FIELD_USEMANFEE,$this->usemanfee,$usemanfee);
		$this->usemanfee=$usemanfee;
		return $this;
	}

	/**
	 * get value for usemanfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUsemanfee() {
		return $this->usemanfee;
	}

	/**
	 * set value for sendviadb 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $sendviadb
	 * @return user_controlSyssettingsModel
	 */
	public function &setSendviadb($sendviadb) {
		$this->notifyChanged(self::FIELD_SENDVIADB,$this->sendviadb,$sendviadb);
		$this->sendviadb=$sendviadb;
		return $this;
	}

	/**
	 * get value for sendviadb 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSendviadb() {
		return $this->sendviadb;
	}

	/**
	 * set value for usegrossamt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $usegrossamt
	 * @return user_controlSyssettingsModel
	 */
	public function &setUsegrossamt($usegrossamt) {
		$this->notifyChanged(self::FIELD_USEGROSSAMT,$this->usegrossamt,$usegrossamt);
		$this->usegrossamt=$usegrossamt;
		return $this;
	}

	/**
	 * get value for usegrossamt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUsegrossamt() {
		return $this->usegrossamt;
	}

	/**
	 * set value for dividendsgross 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $dividendsgross
	 * @return user_controlSyssettingsModel
	 */
	public function &setDividendsgross($dividendsgross) {
		$this->notifyChanged(self::FIELD_DIVIDENDSGROSS,$this->dividendsgross,$dividendsgross);
		$this->dividendsgross=$dividendsgross;
		return $this;
	}

	/**
	 * get value for dividendsgross 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDividendsgross() {
		return $this->dividendsgross;
	}

	/**
	 * set value for trailfeeunitized 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $trailfeeunitized
	 * @return user_controlSyssettingsModel
	 */
	public function &setTrailfeeunitized($trailfeeunitized) {
		$this->notifyChanged(self::FIELD_TRAILFEEUNITIZED,$this->trailfeeunitized,$trailfeeunitized);
		$this->trailfeeunitized=$trailfeeunitized;
		return $this;
	}

	/**
	 * get value for trailfeeunitized 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTrailfeeunitized() {
		return $this->trailfeeunitized;
	}

	/**
	 * set value for switchhighonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $switchhighonly
	 * @return user_controlSyssettingsModel
	 */
	public function &setSwitchhighonly($switchhighonly) {
		$this->notifyChanged(self::FIELD_SWITCHHIGHONLY,$this->switchhighonly,$switchhighonly);
		$this->switchhighonly=$switchhighonly;
		return $this;
	}

	/**
	 * get value for switchhighonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSwitchhighonly() {
		return $this->switchhighonly;
	}

	/**
	 * set value for transferhighonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $transferhighonly
	 * @return user_controlSyssettingsModel
	 */
	public function &setTransferhighonly($transferhighonly) {
		$this->notifyChanged(self::FIELD_TRANSFERHIGHONLY,$this->transferhighonly,$transferhighonly);
		$this->transferhighonly=$transferhighonly;
		return $this;
	}

	/**
	 * get value for transferhighonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransferhighonly() {
		return $this->transferhighonly;
	}

	/**
	 * set value for paydiffadminfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $paydiffadminfee
	 * @return user_controlSyssettingsModel
	 */
	public function &setPaydiffadminfee($paydiffadminfee) {
		$this->notifyChanged(self::FIELD_PAYDIFFADMINFEE,$this->paydiffadminfee,$paydiffadminfee);
		$this->paydiffadminfee=$paydiffadminfee;
		return $this;
	}

	/**
	 * get value for paydiffadminfee 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPaydiffadminfee() {
		return $this->paydiffadminfee;
	}

	/**
	 * set value for compoundundistributedint 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $compoundundistributedint
	 * @return user_controlSyssettingsModel
	 */
	public function &setCompoundundistributedint($compoundundistributedint) {
		$this->notifyChanged(self::FIELD_COMPOUNDUNDISTRIBUTEDINT,$this->compoundundistributedint,$compoundundistributedint);
		$this->compoundundistributedint=$compoundundistributedint;
		return $this;
	}

	/**
	 * get value for compoundundistributedint 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCompoundundistributedint() {
		return $this->compoundundistributedint;
	}

	/**
	 * set value for agentfeefromcompany 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $agentfeefromcompany
	 * @return user_controlSyssettingsModel
	 */
	public function &setAgentfeefromcompany($agentfeefromcompany) {
		$this->notifyChanged(self::FIELD_AGENTFEEFROMCOMPANY,$this->agentfeefromcompany,$agentfeefromcompany);
		$this->agentfeefromcompany=$agentfeefromcompany;
		return $this;
	}

	/**
	 * get value for agentfeefromcompany 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAgentfeefromcompany() {
		return $this->agentfeefromcompany;
	}

	/**
	 * set value for agentrate_rateprod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $agentrateRateprod
	 * @return user_controlSyssettingsModel
	 */
	public function &setAgentrateRateprod($agentrateRateprod) {
		$this->notifyChanged(self::FIELD_AGENTRATE_RATEPROD,$this->agentrateRateprod,$agentrateRateprod);
		$this->agentrateRateprod=$agentrateRateprod;
		return $this;
	}

	/**
	 * get value for agentrate_rateprod 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAgentrateRateprod() {
		return $this->agentrateRateprod;
	}

	/**
	 * set value for initiatoremail 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $initiatoremail
	 * @return user_controlSyssettingsModel
	 */
	public function &setInitiatoremail($initiatoremail) {
		$this->notifyChanged(self::FIELD_INITIATOREMAIL,$this->initiatoremail,$initiatoremail);
		$this->initiatoremail=$initiatoremail;
		return $this;
	}

	/**
	 * get value for initiatoremail 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getInitiatoremail() {
		return $this->initiatoremail;
	}

	/**
	 * set value for receiptingonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $receiptingonly
	 * @return user_controlSyssettingsModel
	 */
	public function &setReceiptingonly($receiptingonly) {
		$this->notifyChanged(self::FIELD_RECEIPTINGONLY,$this->receiptingonly,$receiptingonly);
		$this->receiptingonly=$receiptingonly;
		return $this;
	}

	/**
	 * get value for receiptingonly 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getReceiptingonly() {
		return $this->receiptingonly;
	}

	/**
	 * set value for vatrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $vatrate
	 * @return user_controlSyssettingsModel
	 */
	public function &setVatrate($vatrate) {
		$this->notifyChanged(self::FIELD_VATRATE,$this->vatrate,$vatrate);
		$this->vatrate=$vatrate;
		return $this;
	}

	/**
	 * get value for vatrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVatrate() {
		return $this->vatrate;
	}

	/**
	 * set value for execiserate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $execiserate
	 * @return user_controlSyssettingsModel
	 */
	public function &setExeciserate($execiserate) {
		$this->notifyChanged(self::FIELD_EXECISERATE,$this->execiserate,$execiserate);
		$this->execiserate=$execiserate;
		return $this;
	}

	/**
	 * get value for execiserate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExeciserate() {
		return $this->execiserate;
	}

	/**
	 * set value for dividendrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $dividendrate
	 * @return user_controlSyssettingsModel
	 */
	public function &setDividendrate($dividendrate) {
		$this->notifyChanged(self::FIELD_DIVIDENDRATE,$this->dividendrate,$dividendrate);
		$this->dividendrate=$dividendrate;
		return $this;
	}

	/**
	 * get value for dividendrate 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDividendrate() {
		return $this->dividendrate;
	}

	/**
	 * set value for basecurrency 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $basecurrency
	 * @return user_controlSyssettingsModel
	 */
	public function &setBasecurrency($basecurrency) {
		$this->notifyChanged(self::FIELD_BASECURRENCY,$this->basecurrency,$basecurrency);
		$this->basecurrency=$basecurrency;
		return $this;
	}

	/**
	 * get value for basecurrency 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBasecurrency() {
		return $this->basecurrency;
	}

	/**
	 * set value for perpage 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $perpage
	 * @return user_controlSyssettingsModel
	 */
	public function &setPerpage($perpage) {
		$this->notifyChanged(self::FIELD_PERPAGE,$this->perpage,$perpage);
		$this->perpage=$perpage;
		return $this;
	}

	/**
	 * get value for perpage 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPerpage() {
		return $this->perpage;
	}

	/**
	 * set value for cutoff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $cutoff
	 * @return user_controlSyssettingsModel
	 */
	public function &setCutoff($cutoff) {
		$this->notifyChanged(self::FIELD_CUTOFF,$this->cutoff,$cutoff);
		$this->cutoff=$cutoff;
		return $this;
	}

	/**
	 * get value for cutoff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCutoff() {
		return $this->cutoff;
	}

	/**
	 * set value for agentminimum 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $agentminimum
	 * @return user_controlSyssettingsModel
	 */
	public function &setAgentminimum($agentminimum) {
		$this->notifyChanged(self::FIELD_AGENTMINIMUM,$this->agentminimum,$agentminimum);
		$this->agentminimum=$agentminimum;
		return $this;
	}

	/**
	 * get value for agentminimum 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAgentminimum() {
		return $this->agentminimum;
	}

	/**
	 * set value for emailclosing 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $emailclosing
	 * @return user_controlSyssettingsModel
	 */
	public function &setEmailclosing($emailclosing) {
		$this->notifyChanged(self::FIELD_EMAILCLOSING,$this->emailclosing,$emailclosing);
		$this->emailclosing=$emailclosing;
		return $this;
	}

	/**
	 * get value for emailclosing 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmailclosing() {
		return $this->emailclosing;
	}

	/**
	 * set value for emailsignedfor 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $emailsignedfor
	 * @return user_controlSyssettingsModel
	 */
	public function &setEmailsignedfor($emailsignedfor) {
		$this->notifyChanged(self::FIELD_EMAILSIGNEDFOR,$this->emailsignedfor,$emailsignedfor);
		$this->emailsignedfor=$emailsignedfor;
		return $this;
	}

	/**
	 * get value for emailsignedfor 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmailsignedfor() {
		return $this->emailsignedfor;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	/**
	 * return hash with the field name as index and the field value as value.
	 *
	 * @return array
	 */
	public function toHash() {
		$array=$this->toArray();
		$hash=array();
		foreach ($array as $fieldId=>$value) {
			$hash[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		return $hash;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			self::FIELD_TRANSNO=>$this->getTransno(),
			self::FIELD_DAYSDIFF=>$this->getDaysdiff(),
			self::FIELD_XVAL=>$this->getXval(),
			self::FIELD_YVAL=>$this->getYval(),
			self::FIELD_SENDER=>$this->getSender(),
			self::FIELD_PORT=>$this->getPort(),
			self::FIELD_HOST=>$this->getHost(),
			self::FIELD_USER_ID=>$this->getUserId(),
			self::FIELD_PASSWRD=>$this->getPasswrd(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_IMAGE=>$this->getImage(),
			self::FIELD_PRINTER=>$this->getPrinter(),
			self::FIELD_BOUNCEFEE=>$this->getBouncefee(),
			self::FIELD_VERINFO=>$this->getVerinfo(),
			self::FIELD_DURATION=>$this->getDuration(),
			self::FIELD_SMSURL=>$this->getSmsurl(),
			self::FIELD_SMSUSERNAME=>$this->getSmsusername(),
			self::FIELD_SMSPASSWORD=>$this->getSmspassword(),
			self::FIELD_SMSSENDERID=>$this->getSmssenderid(),
			self::FIELD_SMSTRAINMSG=>$this->getSmstrainmsg(),
			self::FIELD_MNGMTFEE=>$this->getMngmtfee(),
			self::FIELD_SWITCHCHARGES=>$this->getSwitchcharges(),
			self::FIELD_TRAILLINGFEE=>$this->getTraillingfee(),
			self::FIELD_SWITCH_FEE=>$this->getSwitchFee(),
			self::FIELD_WITHHOLDINGRES=>$this->getWithholdingres(),
			self::FIELD_WITHHOLDINGNONRES=>$this->getWithholdingnonres(),
			self::FIELD_PERNAVRATE=>$this->getPernavrate(),
			self::FIELD_MNGMTFEENAV=>$this->getMngmtfeenav(),
			self::FIELD_MEMBERSHIP=>$this->getMembership(),
			self::FIELD_MEMBERSHIPMODE=>$this->getMembershipmode(),
			self::FIELD_CHARGEMEMBERSHIP=>$this->getChargemembership(),
			self::FIELD_PRINTFEE=>$this->getPrintfee(),
			self::FIELD_SWITCHFEE=>$this->getSwitchfee(),
			self::FIELD_TRANSFERFEE=>$this->getTransferfee(),
			self::FIELD_SWITCHMAXPERIOD=>$this->getSwitchmaxperiod(),
			self::FIELD_TRANSFERMAXPERIOD=>$this->getTransfermaxperiod(),
			self::FIELD_JOINTMAX=>$this->getJointmax(),
			self::FIELD_WITHHOLDINGRATE=>$this->getWithholdingrate(),
			self::FIELD_WITHHOLDINGAMT=>$this->getWithholdingamt(),
			self::FIELD_PASSLENGTH=>$this->getPasslength(),
			self::FIELD_PASSDURATION=>$this->getPassduration(),
			self::FIELD_ALLOWREUSE=>$this->getAllowreuse(),
			self::FIELD_WORKFLOWUSE=>$this->getWorkflowuse(),
			self::FIELD_STATEMENTINFO=>$this->getStatementinfo(),
			self::FIELD_WITHFEE=>$this->getWithfee(),
			self::FIELD_WITHMAXPERIOD=>$this->getWithmaxperiod(),
			self::FIELD_CERTFEE=>$this->getCertfee(),
			self::FIELD_CERTREPLACEMENTFEE=>$this->getCertreplacementfee(),
			self::FIELD_CHQREQFEE=>$this->getChqreqfee(),
			self::FIELD_DOMANTPERIOD=>$this->getDomantperiod(),
			self::FIELD_DOMANTPURCHASE=>$this->getDomantpurchase(),
			self::FIELD_DOMANTWITHDRAWAL=>$this->getDomantwithdrawal(),
			self::FIELD_AMLMAXCHANGE=>$this->getAmlmaxchange(),
			self::FIELD_BIRTHDAYMSG=>$this->getBirthdaymsg(),
			self::FIELD_EXITFEE=>$this->getExitfee(),
			self::FIELD_USEMANFEE=>$this->getUsemanfee(),
			self::FIELD_SENDVIADB=>$this->getSendviadb(),
			self::FIELD_USEGROSSAMT=>$this->getUsegrossamt(),
			self::FIELD_DIVIDENDSGROSS=>$this->getDividendsgross(),
			self::FIELD_TRAILFEEUNITIZED=>$this->getTrailfeeunitized(),
			self::FIELD_SWITCHHIGHONLY=>$this->getSwitchhighonly(),
			self::FIELD_TRANSFERHIGHONLY=>$this->getTransferhighonly(),
			self::FIELD_PAYDIFFADMINFEE=>$this->getPaydiffadminfee(),
			self::FIELD_COMPOUNDUNDISTRIBUTEDINT=>$this->getCompoundundistributedint(),
			self::FIELD_AGENTFEEFROMCOMPANY=>$this->getAgentfeefromcompany(),
			self::FIELD_AGENTRATE_RATEPROD=>$this->getAgentrateRateprod(),
			self::FIELD_INITIATOREMAIL=>$this->getInitiatoremail(),
			self::FIELD_RECEIPTINGONLY=>$this->getReceiptingonly(),
			self::FIELD_VATRATE=>$this->getVatrate(),
			self::FIELD_EXECISERATE=>$this->getExeciserate(),
			self::FIELD_DIVIDENDRATE=>$this->getDividendrate(),
			self::FIELD_BASECURRENCY=>$this->getBasecurrency(),
			self::FIELD_PERPAGE=>$this->getPerpage(),
			self::FIELD_CUTOFF=>$this->getCutoff(),
			self::FIELD_AGENTMINIMUM=>$this->getAgentminimum(),
			self::FIELD_EMAILCLOSING=>$this->getEmailclosing(),
			self::FIELD_EMAILSIGNEDFOR=>$this->getEmailsignedfor());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_TRANSNO=>$this->getTransno());
	}

	/**
	 * cached statements
	 *
	 * @var array<string,array<string,PDOStatement>>
	 */
	private static $stmts=array();
	private static $cacheStatements=true;
	
	/**
	 * prepare passed string as statement or return cached if enabled and available
	 *
	 * @param PDO $db
	 * @param string $statement
	 * @return PDOStatement
	 */
	protected static function prepareStatement(PDO $db, $statement) {
		if(self::isCacheStatements()) {
			if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
				$dbInstanceId=spl_object_hash($db);
				if (null===self::$stmts[$statement][$dbInstanceId]) {
					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
				}
				return self::$stmts[$statement][$dbInstanceId];
			}
		}
		return $db->prepare($statement);
	}

	/**
	 * Enable statement cache
	 *
	 * @param bool $cache
	 */
	public static function setCacheStatements($cache) {
		self::$cacheStatements=true==$cache;
	}

	/**
	 * Check if statement cache is enabled
	 *
	 * @return bool
	 */
	public static function isCacheStatements() {
		return self::$cacheStatements;
	}

	/**
	 * Query by Example.
	 *
	 * Match by attributes of passed example instance and return matched rows as an array of user_controlSyssettingsModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param user_controlSyssettingsModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return user_controlSyssettingsModel[]
	 */
	public static function findByExample(PDO $db,user_controlSyssettingsModel $example, $and=true, $sort=null) {
		$exampleValues=$example->toArray();
		$filter=array();
		foreach ($exampleValues as $fieldId=>$value) {
			if (null!==$value) {
				$filter[$fieldId]=$value;
			}
		}
		return self::findByFilter($db, $filter, $and, $sort);
	}

	/**
	 * Query by filter.
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * Will return matched rows as an array of user_controlSyssettingsModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return user_controlSyssettingsModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `syssettings`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of user_controlSyssettingsModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return user_controlSyssettingsModel[]
	 */
	public static function fromStatement(PDOStatement $stmt) {
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * returns the result as an array of user_controlSyssettingsModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return user_controlSyssettingsModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new user_controlSyssettingsModel();
			$o->assignByHash($result);
			$o->notifyPristine();
			$resultInstances[]=$o;
		}
		$stmt->closeCursor();
		return $resultInstances;
	}

	/**
	 * Get sql WHERE part from filter.
	 *
	 * @param array $filter
	 * @param bool $and
	 * @param bool $fullyQualifiedNames true if field names should be qualified by table name
	 * @param bool $prependWhere true if WHERE should be prepended to conditions
	 * @return string
	 */
	public static function buildSqlWhere($filter, $and, $fullyQualifiedNames=true, $prependWhere=false) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
	}

	/**
	 * get sql ORDER BY part from DSCs
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */
	protected static function buildSqlOrderBy($sort) {
		return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
	}

	/**
	 * bind values from filter to statement
	 *
	 * @param PDOStatement $stmt
	 * @param DFCInterface $filter
	 */
	public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
		$filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
	}

	/**
	 * Execute select query and return matched rows as an array of user_controlSyssettingsModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return user_controlSyssettingsModel[]
	 */
	public static function findBySql(PDO $db, $sql) {
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * Delete rows matching the filter
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * @param PDO $db
	 * @param array $filter
	 * @param bool $and
	 * @return mixed
	 */
	public static function deleteByFilter(PDO $db, $filter, $and=true) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		if (0==count($filter)) {
			throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
		}
		$sql='DELETE FROM `syssettings`'
		. self::buildSqlWhere($filter, $and, false, true);
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Assign values from array with the field id as index and the value as value
	 *
	 * @param array $array
	 */
	public function assignByArray($array) {
		$result=array();
		foreach ($array as $fieldId=>$value) {
			$result[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		$this->assignByHash($result);
	}

	/**
	 * Assign values from hash where the indexes match the tables field names
	 *
	 * @param array $result
	 */
	public function assignByHash($result) {
		$this->setTransno($result['transno']);
		$this->setDaysdiff($result['daysdiff']);
		$this->setXval($result['xval']);
		$this->setYval($result['yval']);
		$this->setSender($result['sender']);
		$this->setPort($result['port']);
		$this->setHost($result['host']);
		$this->setUserId($result['user_id']);
		$this->setPasswrd($result['passwrd']);
		$this->setEmail($result['email']);
		$this->setImage($result['image']);
		$this->setPrinter($result['printer']);
		$this->setBouncefee($result['bouncefee']);
		$this->setVerinfo($result['verinfo']);
		$this->setDuration($result['duration']);
		$this->setSmsurl($result['smsurl']);
		$this->setSmsusername($result['smsusername']);
		$this->setSmspassword($result['smspassword']);
		$this->setSmssenderid($result['smssenderid']);
		$this->setSmstrainmsg($result['smstrainmsg']);
		$this->setMngmtfee($result['mngmtfee']);
		$this->setSwitchcharges($result['switchcharges']);
		$this->setTraillingfee($result['traillingfee']);
		$this->setSwitchFee($result['switch_fee']);
		$this->setWithholdingres($result['withholdingres']);
		$this->setWithholdingnonres($result['withholdingnonres']);
		$this->setPernavrate($result['pernavrate']);
		$this->setMngmtfeenav($result['mngmtfeenav']);
		$this->setMembership($result['membership']);
		$this->setMembershipmode($result['membershipmode']);
		$this->setChargemembership($result['chargemembership']);
		$this->setPrintfee($result['printfee']);
		$this->setSwitchfee($result['switchfee']);
		$this->setTransferfee($result['transferfee']);
		$this->setSwitchmaxperiod($result['switchmaxperiod']);
		$this->setTransfermaxperiod($result['transfermaxperiod']);
		$this->setJointmax($result['jointmax']);
		$this->setWithholdingrate($result['withholdingrate']);
		$this->setWithholdingamt($result['withholdingamt']);
		$this->setPasslength($result['passlength']);
		$this->setPassduration($result['passduration']);
		$this->setAllowreuse($result['allowreuse']);
		$this->setWorkflowuse($result['workflowuse']);
		$this->setStatementinfo($result['statementinfo']);
		$this->setWithfee($result['withfee']);
		$this->setWithmaxperiod($result['withmaxperiod']);
		$this->setCertfee($result['certfee']);
		$this->setCertreplacementfee($result['certreplacementfee']);
		$this->setChqreqfee($result['chqreqfee']);
		$this->setDomantperiod($result['domantperiod']);
		$this->setDomantpurchase($result['domantpurchase']);
		$this->setDomantwithdrawal($result['domantwithdrawal']);
		$this->setAmlmaxchange($result['amlmaxchange']);
		$this->setBirthdaymsg($result['birthdaymsg']);
		$this->setExitfee($result['exitfee']);
		$this->setUsemanfee($result['usemanfee']);
		$this->setSendviadb($result['sendviadb']);
		$this->setUsegrossamt($result['usegrossamt']);
		$this->setDividendsgross($result['dividendsgross']);
		$this->setTrailfeeunitized($result['trailfeeunitized']);
		$this->setSwitchhighonly($result['switchhighonly']);
		$this->setTransferhighonly($result['transferhighonly']);
		$this->setPaydiffadminfee($result['paydiffadminfee']);
		$this->setCompoundundistributedint($result['compoundundistributedint']);
		$this->setAgentfeefromcompany($result['agentfeefromcompany']);
		$this->setAgentrateRateprod($result['agentrate_rateprod']);
		$this->setInitiatoremail($result['initiatoremail']);
		$this->setReceiptingonly($result['receiptingonly']);
		$this->setVatrate($result['vatrate']);
		$this->setExeciserate($result['execiserate']);
		$this->setDividendrate($result['dividendrate']);
		$this->setBasecurrency($result['basecurrency']);
		$this->setPerpage($result['perpage']);
		$this->setCutoff($result['cutoff']);
		$this->setAgentminimum($result['agentminimum']);
		$this->setEmailclosing($result['emailclosing']);
		$this->setEmailsignedfor($result['emailsignedfor']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return user_controlSyssettingsModel
	 */
	public static function findById(PDO $db,$transno) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$transno);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		if(!$result) {
			return null;
		}
		$o=new user_controlSyssettingsModel();
		$o->assignByHash($result);
		$o->notifyPristine();
		return $o;
	}

	/**
	 * Bind all values to statement
	 *
	 * @param PDOStatement $stmt
	 */
	protected function bindValues(PDOStatement &$stmt) {
		$stmt->bindValue(1,$this->getTransno());
		$stmt->bindValue(2,$this->getDaysdiff());
		$stmt->bindValue(3,$this->getXval());
		$stmt->bindValue(4,$this->getYval());
		$stmt->bindValue(5,$this->getSender());
		$stmt->bindValue(6,$this->getPort());
		$stmt->bindValue(7,$this->getHost());
		$stmt->bindValue(8,$this->getUserId());
		$stmt->bindValue(9,$this->getPasswrd());
		$stmt->bindValue(10,$this->getEmail());
		$stmt->bindValue(11,$this->getImage());
		$stmt->bindValue(12,$this->getPrinter());
		$stmt->bindValue(13,$this->getBouncefee());
		$stmt->bindValue(14,$this->getVerinfo());
		$stmt->bindValue(15,$this->getDuration());
		$stmt->bindValue(16,$this->getSmsurl());
		$stmt->bindValue(17,$this->getSmsusername());
		$stmt->bindValue(18,$this->getSmspassword());
		$stmt->bindValue(19,$this->getSmssenderid());
		$stmt->bindValue(20,$this->getSmstrainmsg());
		$stmt->bindValue(21,$this->getMngmtfee());
		$stmt->bindValue(22,$this->getSwitchcharges());
		$stmt->bindValue(23,$this->getTraillingfee());
		$stmt->bindValue(24,$this->getSwitchFee());
		$stmt->bindValue(25,$this->getWithholdingres());
		$stmt->bindValue(26,$this->getWithholdingnonres());
		$stmt->bindValue(27,$this->getPernavrate());
		$stmt->bindValue(28,$this->getMngmtfeenav());
		$stmt->bindValue(29,$this->getMembership());
		$stmt->bindValue(30,$this->getMembershipmode());
		$stmt->bindValue(31,$this->getChargemembership());
		$stmt->bindValue(32,$this->getPrintfee());
		$stmt->bindValue(33,$this->getSwitchfee());
		$stmt->bindValue(34,$this->getTransferfee());
		$stmt->bindValue(35,$this->getSwitchmaxperiod());
		$stmt->bindValue(36,$this->getTransfermaxperiod());
		$stmt->bindValue(37,$this->getJointmax());
		$stmt->bindValue(38,$this->getWithholdingrate());
		$stmt->bindValue(39,$this->getWithholdingamt());
		$stmt->bindValue(40,$this->getPasslength());
		$stmt->bindValue(41,$this->getPassduration());
		$stmt->bindValue(42,$this->getAllowreuse());
		$stmt->bindValue(43,$this->getWorkflowuse());
		$stmt->bindValue(44,$this->getStatementinfo());
		$stmt->bindValue(45,$this->getWithfee());
		$stmt->bindValue(46,$this->getWithmaxperiod());
		$stmt->bindValue(47,$this->getCertfee());
		$stmt->bindValue(48,$this->getCertreplacementfee());
		$stmt->bindValue(49,$this->getChqreqfee());
		$stmt->bindValue(50,$this->getDomantperiod());
		$stmt->bindValue(51,$this->getDomantpurchase());
		$stmt->bindValue(52,$this->getDomantwithdrawal());
		$stmt->bindValue(53,$this->getAmlmaxchange());
		$stmt->bindValue(54,$this->getBirthdaymsg());
		$stmt->bindValue(55,$this->getExitfee());
		$stmt->bindValue(56,$this->getUsemanfee());
		$stmt->bindValue(57,$this->getSendviadb());
		$stmt->bindValue(58,$this->getUsegrossamt());
		$stmt->bindValue(59,$this->getDividendsgross());
		$stmt->bindValue(60,$this->getTrailfeeunitized());
		$stmt->bindValue(61,$this->getSwitchhighonly());
		$stmt->bindValue(62,$this->getTransferhighonly());
		$stmt->bindValue(63,$this->getPaydiffadminfee());
		$stmt->bindValue(64,$this->getCompoundundistributedint());
		$stmt->bindValue(65,$this->getAgentfeefromcompany());
		$stmt->bindValue(66,$this->getAgentrateRateprod());
		$stmt->bindValue(67,$this->getInitiatoremail());
		$stmt->bindValue(68,$this->getReceiptingonly());
		$stmt->bindValue(69,$this->getVatrate());
		$stmt->bindValue(70,$this->getExeciserate());
		$stmt->bindValue(71,$this->getDividendrate());
		$stmt->bindValue(72,$this->getBasecurrency());
		$stmt->bindValue(73,$this->getPerpage());
		$stmt->bindValue(74,$this->getCutoff());
		$stmt->bindValue(75,$this->getAgentminimum());
		$stmt->bindValue(76,$this->getEmailclosing());
		$stmt->bindValue(77,$this->getEmailsignedfor());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getTransno()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getDaysdiff());
			$stmt->bindValue(2,$this->getXval());
			$stmt->bindValue(3,$this->getYval());
			$stmt->bindValue(4,$this->getSender());
			$stmt->bindValue(5,$this->getPort());
			$stmt->bindValue(6,$this->getHost());
			$stmt->bindValue(7,$this->getUserId());
			$stmt->bindValue(8,$this->getPasswrd());
			$stmt->bindValue(9,$this->getEmail());
			$stmt->bindValue(10,$this->getImage());
			$stmt->bindValue(11,$this->getPrinter());
			$stmt->bindValue(12,$this->getBouncefee());
			$stmt->bindValue(13,$this->getVerinfo());
			$stmt->bindValue(14,$this->getDuration());
			$stmt->bindValue(15,$this->getSmsurl());
			$stmt->bindValue(16,$this->getSmsusername());
			$stmt->bindValue(17,$this->getSmspassword());
			$stmt->bindValue(18,$this->getSmssenderid());
			$stmt->bindValue(19,$this->getSmstrainmsg());
			$stmt->bindValue(20,$this->getMngmtfee());
			$stmt->bindValue(21,$this->getSwitchcharges());
			$stmt->bindValue(22,$this->getTraillingfee());
			$stmt->bindValue(23,$this->getSwitchFee());
			$stmt->bindValue(24,$this->getWithholdingres());
			$stmt->bindValue(25,$this->getWithholdingnonres());
			$stmt->bindValue(26,$this->getPernavrate());
			$stmt->bindValue(27,$this->getMngmtfeenav());
			$stmt->bindValue(28,$this->getMembership());
			$stmt->bindValue(29,$this->getMembershipmode());
			$stmt->bindValue(30,$this->getChargemembership());
			$stmt->bindValue(31,$this->getPrintfee());
			$stmt->bindValue(32,$this->getSwitchfee());
			$stmt->bindValue(33,$this->getTransferfee());
			$stmt->bindValue(34,$this->getSwitchmaxperiod());
			$stmt->bindValue(35,$this->getTransfermaxperiod());
			$stmt->bindValue(36,$this->getJointmax());
			$stmt->bindValue(37,$this->getWithholdingrate());
			$stmt->bindValue(38,$this->getWithholdingamt());
			$stmt->bindValue(39,$this->getPasslength());
			$stmt->bindValue(40,$this->getPassduration());
			$stmt->bindValue(41,$this->getAllowreuse());
			$stmt->bindValue(42,$this->getWorkflowuse());
			$stmt->bindValue(43,$this->getStatementinfo());
			$stmt->bindValue(44,$this->getWithfee());
			$stmt->bindValue(45,$this->getWithmaxperiod());
			$stmt->bindValue(46,$this->getCertfee());
			$stmt->bindValue(47,$this->getCertreplacementfee());
			$stmt->bindValue(48,$this->getChqreqfee());
			$stmt->bindValue(49,$this->getDomantperiod());
			$stmt->bindValue(50,$this->getDomantpurchase());
			$stmt->bindValue(51,$this->getDomantwithdrawal());
			$stmt->bindValue(52,$this->getAmlmaxchange());
			$stmt->bindValue(53,$this->getBirthdaymsg());
			$stmt->bindValue(54,$this->getExitfee());
			$stmt->bindValue(55,$this->getUsemanfee());
			$stmt->bindValue(56,$this->getSendviadb());
			$stmt->bindValue(57,$this->getUsegrossamt());
			$stmt->bindValue(58,$this->getDividendsgross());
			$stmt->bindValue(59,$this->getTrailfeeunitized());
			$stmt->bindValue(60,$this->getSwitchhighonly());
			$stmt->bindValue(61,$this->getTransferhighonly());
			$stmt->bindValue(62,$this->getPaydiffadminfee());
			$stmt->bindValue(63,$this->getCompoundundistributedint());
			$stmt->bindValue(64,$this->getAgentfeefromcompany());
			$stmt->bindValue(65,$this->getAgentrateRateprod());
			$stmt->bindValue(66,$this->getInitiatoremail());
			$stmt->bindValue(67,$this->getReceiptingonly());
			$stmt->bindValue(68,$this->getVatrate());
			$stmt->bindValue(69,$this->getExeciserate());
			$stmt->bindValue(70,$this->getDividendrate());
			$stmt->bindValue(71,$this->getBasecurrency());
			$stmt->bindValue(72,$this->getPerpage());
			$stmt->bindValue(73,$this->getCutoff());
			$stmt->bindValue(74,$this->getAgentminimum());
			$stmt->bindValue(75,$this->getEmailclosing());
			$stmt->bindValue(76,$this->getEmailsignedfor());
		} else {
			$stmt=self::prepareStatement($db,self::SQL_INSERT);
			$this->bindValues($stmt);
		}
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$lastInsertId=$db->lastInsertId();
		if (false!==$lastInsertId) {
			$this->setTransno($lastInsertId);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(78,$this->getTransno());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Delete this instance from the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function deleteFromDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_DELETE_PK);
		$stmt->bindValue(1,$this->getTransno());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'user_controlSyssettingsModel');
	}

	/**
	 * get single user_controlSyssettingsModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return user_controlSyssettingsModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new user_controlSyssettingsModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of user_controlSyssettingsModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return user_controlSyssettingsModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('user_controlSyssettingsModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>