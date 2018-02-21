<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class feeds_MembersModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='feeds_MembersModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='members';
	const SQL_INSERT='INSERT INTO `members` (`member_no`,`title`,`firstname`,`surname`,`lastname`,`othernames`,`allnames`,`post_address`,`reg_date`,`tel_no`,`phys_address`,`town`,`street`,`hse_no`,`country`,`sms_ntfy`,`smsqry_accept`,`gsm_no`,`e_mail`,`id_no`,`pin_no`,`signature`,`picture`,`terminationdate`,`dob`,`age`,`gender`,`employer`,`maritalstatus`,`retage`,`uname`,`comp`,`company_no`,`companyname`,`amt`,`contributiontype`,`comments`,`exptretyr`,`employmentdate`,`salary`,`occupation`,`payrolid`,`previousbenefits`,`employed`,`datejoinedp`,`memtype`,`confirmed`,`confirmeddate`,`confirmedby`,`signature1`,`picture1`,`taxexempt`,`resident`,`statementtype`,`previousmember`,`staff`,`howdiduknow`,`otherknow`,`verified`,`verifymanid`,`verifymanager`,`idpass`,`fundssource`,`othersource`,`webpass`,`refferal`,`branchid`,`branchname`,`suspense_member`,`agent`,`edit_user`,`edit_date`,`deleted`,`deleteddate`,`deletereason`,`deletedby`,`exemptcertexpirydate`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `members` (`member_no`,`title`,`firstname`,`surname`,`lastname`,`othernames`,`allnames`,`post_address`,`reg_date`,`tel_no`,`phys_address`,`town`,`street`,`hse_no`,`country`,`sms_ntfy`,`smsqry_accept`,`gsm_no`,`e_mail`,`id_no`,`pin_no`,`signature`,`picture`,`terminationdate`,`dob`,`age`,`gender`,`employer`,`maritalstatus`,`retage`,`uname`,`comp`,`company_no`,`companyname`,`amt`,`contributiontype`,`comments`,`exptretyr`,`employmentdate`,`salary`,`occupation`,`payrolid`,`previousbenefits`,`employed`,`datejoinedp`,`memtype`,`confirmed`,`confirmeddate`,`confirmedby`,`signature1`,`picture1`,`taxexempt`,`resident`,`statementtype`,`previousmember`,`staff`,`howdiduknow`,`otherknow`,`verified`,`verifymanid`,`verifymanager`,`idpass`,`fundssource`,`othersource`,`webpass`,`refferal`,`branchid`,`branchname`,`suspense_member`,`agent`,`edit_user`,`edit_date`,`deleted`,`deleteddate`,`deletereason`,`deletedby`,`exemptcertexpirydate`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `members` SET `member_no`=?,`title`=?,`firstname`=?,`surname`=?,`lastname`=?,`othernames`=?,`allnames`=?,`post_address`=?,`reg_date`=?,`tel_no`=?,`phys_address`=?,`town`=?,`street`=?,`hse_no`=?,`country`=?,`sms_ntfy`=?,`smsqry_accept`=?,`gsm_no`=?,`e_mail`=?,`id_no`=?,`pin_no`=?,`signature`=?,`picture`=?,`terminationdate`=?,`dob`=?,`age`=?,`gender`=?,`employer`=?,`maritalstatus`=?,`retage`=?,`uname`=?,`comp`=?,`company_no`=?,`companyname`=?,`amt`=?,`contributiontype`=?,`comments`=?,`exptretyr`=?,`employmentdate`=?,`salary`=?,`occupation`=?,`payrolid`=?,`previousbenefits`=?,`employed`=?,`datejoinedp`=?,`memtype`=?,`confirmed`=?,`confirmeddate`=?,`confirmedby`=?,`signature1`=?,`picture1`=?,`taxexempt`=?,`resident`=?,`statementtype`=?,`previousmember`=?,`staff`=?,`howdiduknow`=?,`otherknow`=?,`verified`=?,`verifymanid`=?,`verifymanager`=?,`idpass`=?,`fundssource`=?,`othersource`=?,`webpass`=?,`refferal`=?,`branchid`=?,`branchname`=?,`suspense_member`=?,`agent`=?,`edit_user`=?,`edit_date`=?,`deleted`=?,`deleteddate`=?,`deletereason`=?,`deletedby`=?,`exemptcertexpirydate`=? WHERE `member_no`=?';
	const SQL_SELECT_PK='SELECT * FROM `members` WHERE `member_no`=?';
	const SQL_DELETE_PK='DELETE FROM `members` WHERE `member_no`=?';
	const FIELD_MEMBER_NO=-1360004367;
	const FIELD_TITLE=1512235331;
	const FIELD_FIRSTNAME=1726531238;
	const FIELD_SURNAME=1013465350;
	const FIELD_LASTNAME=1502226262;
	const FIELD_OTHERNAMES=1961434669;
	const FIELD_ALLNAMES=477466492;
	const FIELD_POST_ADDRESS=-860033526;
	const FIELD_REG_DATE=-2034007634;
	const FIELD_TEL_NO=-369289510;
	const FIELD_PHYS_ADDRESS=-537902468;
	const FIELD_TOWN=464429639;
	const FIELD_STREET=-383881608;
	const FIELD_HSE_NO=-700118565;
	const FIELD_COUNTRY=-470677567;
	const FIELD_SMS_NTFY=-1437236876;
	const FIELD_SMSQRY_ACCEPT=1508412083;
	const FIELD_GSM_NO=-728509388;
	const FIELD_E_MAIL=-804236346;
	const FIELD_ID_NO=1501907536;
	const FIELD_PIN_NO=-480052448;
	const FIELD_SIGNATURE=-1628640733;
	const FIELD_PICTURE=-2006250199;
	const FIELD_TERMINATIONDATE=888793565;
	const FIELD_DOB=1400439522;
	const FIELD_AGE=1400436394;
	const FIELD_GENDER=-741404362;
	const FIELD_EMPLOYER=-140624912;
	const FIELD_MARITALSTATUS=1779838417;
	const FIELD_RETAGE=-426307789;
	const FIELD_UNAME=1513289579;
	const FIELD_COMP=463922884;
	const FIELD_COMPANY_NO=1282696376;
	const FIELD_COMPANYNAME=1109316403;
	const FIELD_AMT=1400436595;
	const FIELD_CONTRIBUTIONTYPE=288029567;
	const FIELD_COMMENTS=-1936510167;
	const FIELD_EXPTRETYR=-2137105074;
	const FIELD_EMPLOYMENTDATE=1111267087;
	const FIELD_SALARY=-401610689;
	const FIELD_OCCUPATION=-549239488;
	const FIELD_PAYROLID=53501111;
	const FIELD_PREVIOUSBENEFITS=-1933638936;
	const FIELD_EMPLOYED=-140624926;
	const FIELD_DATEJOINEDP=-283314812;
	const FIELD_MEMTYPE=-479071558;
	const FIELD_CONFIRMED=788632778;
	const FIELD_CONFIRMEDDATE=-144371848;
	const FIELD_CONFIRMEDBY=1961858721;
	const FIELD_SIGNATURE1=1051744878;
	const FIELD_PICTURE1=-2064213976;
	const FIELD_TAXEXEMPT=1767076021;
	const FIELD_RESIDENT=-1681218939;
	const FIELD_STATEMENTTYPE=-485487340;
	const FIELD_PREVIOUSMEMBER=-1202206266;
	const FIELD_STAFF=1511621067;
	const FIELD_HOWDIDUKNOW=-1399036324;
	const FIELD_OTHERKNOW=-352446714;
	const FIELD_VERIFIED=966489085;
	const FIELD_VERIFYMANID=-318946873;
	const FIELD_VERIFYMANAGER=-1565499137;
	const FIELD_IDPASS=-685012447;
	const FIELD_FUNDSSOURCE=812306068;
	const FIELD_OTHERSOURCE=831258070;
	const FIELD_WEBPASS=-204270192;
	const FIELD_REFFERAL=-2056126592;
	const FIELD_BRANCHID=-1359501454;
	const FIELD_BRANCHNAME=-810689758;
	const FIELD_SUSPENSE_MEMBER=-323242454;
	const FIELD_AGENT=1494614512;
	const FIELD_EDIT_USER=-273236405;
	const FIELD_EDIT_DATE=-273759698;
	const FIELD_DELETED=121954372;
	const FIELD_DELETEDDATE=499256818;
	const FIELD_DELETEREASON=-1301176732;
	const FIELD_DELETEDBY=1234037659;
	const FIELD_EXEMPTCERTEXPIRYDATE=-257044519;
	private static $PRIMARY_KEYS=array(self::FIELD_MEMBER_NO);
	private static $AUTOINCREMENT_FIELDS=array();
	private static $FIELD_NAMES=array(
		self::FIELD_MEMBER_NO=>'member_no',
		self::FIELD_TITLE=>'title',
		self::FIELD_FIRSTNAME=>'firstname',
		self::FIELD_SURNAME=>'surname',
		self::FIELD_LASTNAME=>'lastname',
		self::FIELD_OTHERNAMES=>'othernames',
		self::FIELD_ALLNAMES=>'allnames',
		self::FIELD_POST_ADDRESS=>'post_address',
		self::FIELD_REG_DATE=>'reg_date',
		self::FIELD_TEL_NO=>'tel_no',
		self::FIELD_PHYS_ADDRESS=>'phys_address',
		self::FIELD_TOWN=>'town',
		self::FIELD_STREET=>'street',
		self::FIELD_HSE_NO=>'hse_no',
		self::FIELD_COUNTRY=>'country',
		self::FIELD_SMS_NTFY=>'sms_ntfy',
		self::FIELD_SMSQRY_ACCEPT=>'smsqry_accept',
		self::FIELD_GSM_NO=>'gsm_no',
		self::FIELD_E_MAIL=>'e_mail',
		self::FIELD_ID_NO=>'id_no',
		self::FIELD_PIN_NO=>'pin_no',
		self::FIELD_SIGNATURE=>'signature',
		self::FIELD_PICTURE=>'picture',
		self::FIELD_TERMINATIONDATE=>'terminationdate',
		self::FIELD_DOB=>'dob',
		self::FIELD_AGE=>'age',
		self::FIELD_GENDER=>'gender',
		self::FIELD_EMPLOYER=>'employer',
		self::FIELD_MARITALSTATUS=>'maritalstatus',
		self::FIELD_RETAGE=>'retage',
		self::FIELD_UNAME=>'uname',
		self::FIELD_COMP=>'comp',
		self::FIELD_COMPANY_NO=>'company_no',
		self::FIELD_COMPANYNAME=>'companyname',
		self::FIELD_AMT=>'amt',
		self::FIELD_CONTRIBUTIONTYPE=>'contributiontype',
		self::FIELD_COMMENTS=>'comments',
		self::FIELD_EXPTRETYR=>'exptretyr',
		self::FIELD_EMPLOYMENTDATE=>'employmentdate',
		self::FIELD_SALARY=>'salary',
		self::FIELD_OCCUPATION=>'occupation',
		self::FIELD_PAYROLID=>'payrolid',
		self::FIELD_PREVIOUSBENEFITS=>'previousbenefits',
		self::FIELD_EMPLOYED=>'employed',
		self::FIELD_DATEJOINEDP=>'datejoinedp',
		self::FIELD_MEMTYPE=>'memtype',
		self::FIELD_CONFIRMED=>'confirmed',
		self::FIELD_CONFIRMEDDATE=>'confirmeddate',
		self::FIELD_CONFIRMEDBY=>'confirmedby',
		self::FIELD_SIGNATURE1=>'signature1',
		self::FIELD_PICTURE1=>'picture1',
		self::FIELD_TAXEXEMPT=>'taxexempt',
		self::FIELD_RESIDENT=>'resident',
		self::FIELD_STATEMENTTYPE=>'statementtype',
		self::FIELD_PREVIOUSMEMBER=>'previousmember',
		self::FIELD_STAFF=>'staff',
		self::FIELD_HOWDIDUKNOW=>'howdiduknow',
		self::FIELD_OTHERKNOW=>'otherknow',
		self::FIELD_VERIFIED=>'verified',
		self::FIELD_VERIFYMANID=>'verifymanid',
		self::FIELD_VERIFYMANAGER=>'verifymanager',
		self::FIELD_IDPASS=>'idpass',
		self::FIELD_FUNDSSOURCE=>'fundssource',
		self::FIELD_OTHERSOURCE=>'othersource',
		self::FIELD_WEBPASS=>'webpass',
		self::FIELD_REFFERAL=>'refferal',
		self::FIELD_BRANCHID=>'branchid',
		self::FIELD_BRANCHNAME=>'branchname',
		self::FIELD_SUSPENSE_MEMBER=>'suspense_member',
		self::FIELD_AGENT=>'agent',
		self::FIELD_EDIT_USER=>'edit_user',
		self::FIELD_EDIT_DATE=>'edit_date',
		self::FIELD_DELETED=>'deleted',
		self::FIELD_DELETEDDATE=>'deleteddate',
		self::FIELD_DELETEREASON=>'deletereason',
		self::FIELD_DELETEDBY=>'deletedby',
		self::FIELD_EXEMPTCERTEXPIRYDATE=>'exemptcertexpirydate');
	private static $PROPERTY_NAMES=array(
		self::FIELD_MEMBER_NO=>'memberNo',
		self::FIELD_TITLE=>'title',
		self::FIELD_FIRSTNAME=>'firstname',
		self::FIELD_SURNAME=>'surname',
		self::FIELD_LASTNAME=>'lastname',
		self::FIELD_OTHERNAMES=>'othernames',
		self::FIELD_ALLNAMES=>'allnames',
		self::FIELD_POST_ADDRESS=>'postAddress',
		self::FIELD_REG_DATE=>'regDate',
		self::FIELD_TEL_NO=>'telNo',
		self::FIELD_PHYS_ADDRESS=>'physAddress',
		self::FIELD_TOWN=>'town',
		self::FIELD_STREET=>'street',
		self::FIELD_HSE_NO=>'hseNo',
		self::FIELD_COUNTRY=>'country',
		self::FIELD_SMS_NTFY=>'smsNtfy',
		self::FIELD_SMSQRY_ACCEPT=>'smsqryAccept',
		self::FIELD_GSM_NO=>'gsmNo',
		self::FIELD_E_MAIL=>'eMail',
		self::FIELD_ID_NO=>'idNo',
		self::FIELD_PIN_NO=>'pinNo',
		self::FIELD_SIGNATURE=>'signature',
		self::FIELD_PICTURE=>'picture',
		self::FIELD_TERMINATIONDATE=>'terminationdate',
		self::FIELD_DOB=>'dob',
		self::FIELD_AGE=>'age',
		self::FIELD_GENDER=>'gender',
		self::FIELD_EMPLOYER=>'employer',
		self::FIELD_MARITALSTATUS=>'maritalstatus',
		self::FIELD_RETAGE=>'retage',
		self::FIELD_UNAME=>'uname',
		self::FIELD_COMP=>'comp',
		self::FIELD_COMPANY_NO=>'companyNo',
		self::FIELD_COMPANYNAME=>'companyname',
		self::FIELD_AMT=>'amt',
		self::FIELD_CONTRIBUTIONTYPE=>'contributiontype',
		self::FIELD_COMMENTS=>'comments',
		self::FIELD_EXPTRETYR=>'exptretyr',
		self::FIELD_EMPLOYMENTDATE=>'employmentdate',
		self::FIELD_SALARY=>'salary',
		self::FIELD_OCCUPATION=>'occupation',
		self::FIELD_PAYROLID=>'payrolid',
		self::FIELD_PREVIOUSBENEFITS=>'previousbenefits',
		self::FIELD_EMPLOYED=>'employed',
		self::FIELD_DATEJOINEDP=>'datejoinedp',
		self::FIELD_MEMTYPE=>'memtype',
		self::FIELD_CONFIRMED=>'confirmed',
		self::FIELD_CONFIRMEDDATE=>'confirmeddate',
		self::FIELD_CONFIRMEDBY=>'confirmedby',
		self::FIELD_SIGNATURE1=>'signature1',
		self::FIELD_PICTURE1=>'picture1',
		self::FIELD_TAXEXEMPT=>'taxexempt',
		self::FIELD_RESIDENT=>'resident',
		self::FIELD_STATEMENTTYPE=>'statementtype',
		self::FIELD_PREVIOUSMEMBER=>'previousmember',
		self::FIELD_STAFF=>'staff',
		self::FIELD_HOWDIDUKNOW=>'howdiduknow',
		self::FIELD_OTHERKNOW=>'otherknow',
		self::FIELD_VERIFIED=>'verified',
		self::FIELD_VERIFYMANID=>'verifymanid',
		self::FIELD_VERIFYMANAGER=>'verifymanager',
		self::FIELD_IDPASS=>'idpass',
		self::FIELD_FUNDSSOURCE=>'fundssource',
		self::FIELD_OTHERSOURCE=>'othersource',
		self::FIELD_WEBPASS=>'webpass',
		self::FIELD_REFFERAL=>'refferal',
		self::FIELD_BRANCHID=>'branchid',
		self::FIELD_BRANCHNAME=>'branchname',
		self::FIELD_SUSPENSE_MEMBER=>'suspenseMember',
		self::FIELD_AGENT=>'agent',
		self::FIELD_EDIT_USER=>'editUser',
		self::FIELD_EDIT_DATE=>'editDate',
		self::FIELD_DELETED=>'deleted',
		self::FIELD_DELETEDDATE=>'deleteddate',
		self::FIELD_DELETEREASON=>'deletereason',
		self::FIELD_DELETEDBY=>'deletedby',
		self::FIELD_EXEMPTCERTEXPIRYDATE=>'exemptcertexpirydate');
	private static $PROPERTY_TYPES=array(
		self::FIELD_MEMBER_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TITLE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FIRSTNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SURNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LASTNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OTHERNAMES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ALLNAMES=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_POST_ADDRESS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_REG_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TEL_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PHYS_ADDRESS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TOWN=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STREET=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_HSE_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COUNTRY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMS_NTFY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SMSQRY_ACCEPT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_GSM_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_E_MAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_ID_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PIN_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SIGNATURE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PICTURE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TERMINATIONDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DOB=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AGE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_GENDER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMPLOYER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MARITALSTATUS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RETAGE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_UNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COMP=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COMPANY_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COMPANYNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_AMT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CONTRIBUTIONTYPE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_COMMENTS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EXPTRETYR=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMPLOYMENTDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SALARY=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_OCCUPATION=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PAYROLID=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PREVIOUSBENEFITS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_EMPLOYED=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_DATEJOINEDP=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_MEMTYPE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONFIRMED=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_CONFIRMEDDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CONFIRMEDBY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SIGNATURE1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PICTURE1=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TAXEXEMPT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_RESIDENT=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_STATEMENTTYPE=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_PREVIOUSMEMBER=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_STAFF=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_HOWDIDUKNOW=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_OTHERKNOW=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_VERIFIED=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_VERIFYMANID=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_VERIFYMANAGER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_IDPASS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_FUNDSSOURCE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OTHERSOURCE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WEBPASS=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_REFFERAL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_BRANCHID=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_BRANCHNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SUSPENSE_MEMBER=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_AGENT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EDIT_USER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EDIT_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DELETED=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_DELETEDDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DELETEREASON=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DELETEDBY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EXEMPTCERTEXPIRYDATE=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_MEMBER_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,9,0,true),
		self::FIELD_TITLE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,8,0,true),
		self::FIELD_FIRSTNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_SURNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_LASTNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,true),
		self::FIELD_OTHERNAMES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_ALLNAMES=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,300,0,true),
		self::FIELD_POST_ADDRESS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_REG_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_TEL_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_PHYS_ADDRESS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_TOWN=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,true),
		self::FIELD_STREET=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_HSE_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_COUNTRY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,true),
		self::FIELD_SMS_NTFY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,1,0,true),
		self::FIELD_SMSQRY_ACCEPT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,1,0,true),
		self::FIELD_GSM_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_E_MAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,1000,0,true),
		self::FIELD_ID_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_PIN_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,15,0,true),
		self::FIELD_SIGNATURE=>array(Db2PhpEntity::JDBC_TYPE_BINARY,2147483647,0,true),
		self::FIELD_PICTURE=>array(Db2PhpEntity::JDBC_TYPE_BINARY,2147483647,0,true),
		self::FIELD_TERMINATIONDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_DOB=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_AGE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_GENDER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,6,0,true),
		self::FIELD_EMPLOYER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,true),
		self::FIELD_MARITALSTATUS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,15,0,true),
		self::FIELD_RETAGE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_UNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_COMP=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_COMPANY_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,9,0,true),
		self::FIELD_COMPANYNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_AMT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CONTRIBUTIONTYPE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_COMMENTS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_EXPTRETYR=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_EMPLOYMENTDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_SALARY=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_OCCUPATION=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_PAYROLID=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true),
		self::FIELD_PREVIOUSBENEFITS=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_EMPLOYED=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_DATEJOINEDP=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_MEMTYPE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,15,0,true),
		self::FIELD_CONFIRMED=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_CONFIRMEDDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_CONFIRMEDBY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,40,0,true),
		self::FIELD_SIGNATURE1=>array(Db2PhpEntity::JDBC_TYPE_BINARY,2147483647,0,true),
		self::FIELD_PICTURE1=>array(Db2PhpEntity::JDBC_TYPE_BINARY,2147483647,0,true),
		self::FIELD_TAXEXEMPT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_RESIDENT=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_STATEMENTTYPE=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_PREVIOUSMEMBER=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_STAFF=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_HOWDIDUKNOW=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_OTHERKNOW=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_VERIFIED=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_VERIFYMANID=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_VERIFYMANAGER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,70,0,true),
		self::FIELD_IDPASS=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_FUNDSSOURCE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_OTHERSOURCE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_WEBPASS=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_REFFERAL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_BRANCHID=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_BRANCHNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_SUSPENSE_MEMBER=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,131089,0,true),
		self::FIELD_AGENT=>array(Db2PhpEntity::JDBC_TYPE_CHAR,30,0,true),
		self::FIELD_EDIT_USER=>array(Db2PhpEntity::JDBC_TYPE_CHAR,80,0,true),
		self::FIELD_EDIT_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_DELETED=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_DELETEDDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_DELETEREASON=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_DELETEDBY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,50,0,true),
		self::FIELD_EXEMPTCERTEXPIRYDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_MEMBER_NO=>null,
		self::FIELD_TITLE=>null,
		self::FIELD_FIRSTNAME=>null,
		self::FIELD_SURNAME=>null,
		self::FIELD_LASTNAME=>null,
		self::FIELD_OTHERNAMES=>null,
		self::FIELD_ALLNAMES=>null,
		self::FIELD_POST_ADDRESS=>null,
		self::FIELD_REG_DATE=>null,
		self::FIELD_TEL_NO=>null,
		self::FIELD_PHYS_ADDRESS=>null,
		self::FIELD_TOWN=>null,
		self::FIELD_STREET=>null,
		self::FIELD_HSE_NO=>null,
		self::FIELD_COUNTRY=>null,
		self::FIELD_SMS_NTFY=>null,
		self::FIELD_SMSQRY_ACCEPT=>null,
		self::FIELD_GSM_NO=>null,
		self::FIELD_E_MAIL=>null,
		self::FIELD_ID_NO=>null,
		self::FIELD_PIN_NO=>null,
		self::FIELD_SIGNATURE=>null,
		self::FIELD_PICTURE=>null,
		self::FIELD_TERMINATIONDATE=>null,
		self::FIELD_DOB=>null,
		self::FIELD_AGE=>null,
		self::FIELD_GENDER=>null,
		self::FIELD_EMPLOYER=>null,
		self::FIELD_MARITALSTATUS=>null,
		self::FIELD_RETAGE=>null,
		self::FIELD_UNAME=>null,
		self::FIELD_COMP=>null,
		self::FIELD_COMPANY_NO=>null,
		self::FIELD_COMPANYNAME=>null,
		self::FIELD_AMT=>null,
		self::FIELD_CONTRIBUTIONTYPE=>null,
		self::FIELD_COMMENTS=>null,
		self::FIELD_EXPTRETYR=>null,
		self::FIELD_EMPLOYMENTDATE=>null,
		self::FIELD_SALARY=>null,
		self::FIELD_OCCUPATION=>null,
		self::FIELD_PAYROLID=>null,
		self::FIELD_PREVIOUSBENEFITS=>null,
		self::FIELD_EMPLOYED=>null,
		self::FIELD_DATEJOINEDP=>null,
		self::FIELD_MEMTYPE=>null,
		self::FIELD_CONFIRMED=>null,
		self::FIELD_CONFIRMEDDATE=>null,
		self::FIELD_CONFIRMEDBY=>null,
		self::FIELD_SIGNATURE1=>null,
		self::FIELD_PICTURE1=>null,
		self::FIELD_TAXEXEMPT=>null,
		self::FIELD_RESIDENT=>null,
		self::FIELD_STATEMENTTYPE=>null,
		self::FIELD_PREVIOUSMEMBER=>null,
		self::FIELD_STAFF=>null,
		self::FIELD_HOWDIDUKNOW=>null,
		self::FIELD_OTHERKNOW=>null,
		self::FIELD_VERIFIED=>null,
		self::FIELD_VERIFYMANID=>null,
		self::FIELD_VERIFYMANAGER=>null,
		self::FIELD_IDPASS=>null,
		self::FIELD_FUNDSSOURCE=>null,
		self::FIELD_OTHERSOURCE=>null,
		self::FIELD_WEBPASS=>null,
		self::FIELD_REFFERAL=>null,
		self::FIELD_BRANCHID=>null,
		self::FIELD_BRANCHNAME=>null,
		self::FIELD_SUSPENSE_MEMBER=>null,
		self::FIELD_AGENT=>null,
		self::FIELD_EDIT_USER=>null,
		self::FIELD_EDIT_DATE=>null,
		self::FIELD_DELETED=>null,
		self::FIELD_DELETEDDATE=>null,
		self::FIELD_DELETEREASON=>null,
		self::FIELD_DELETEDBY=>null,
		self::FIELD_EXEMPTCERTEXPIRYDATE=>null);
	private $memberNo;
	private $title;
	private $firstname;
	private $surname;
	private $lastname;
	private $othernames;
	private $allnames;
	private $postAddress;
	private $regDate;
	private $telNo;
	private $physAddress;
	private $town;
	private $street;
	private $hseNo;
	private $country;
	private $smsNtfy;
	private $smsqryAccept;
	private $gsmNo;
	private $eMail;
	private $idNo;
	private $pinNo;
	private $signature;
	private $picture;
	private $terminationdate;
	private $dob;
	private $age;
	private $gender;
	private $employer;
	private $maritalstatus;
	private $retage;
	private $uname;
	private $comp;
	private $companyNo;
	private $companyname;
	private $amt;
	private $contributiontype;
	private $comments;
	private $exptretyr;
	private $employmentdate;
	private $salary;
	private $occupation;
	private $payrolid;
	private $previousbenefits;
	private $employed;
	private $datejoinedp;
	private $memtype;
	private $confirmed;
	private $confirmeddate;
	private $confirmedby;
	private $signature1;
	private $picture1;
	private $taxexempt;
	private $resident;
	private $statementtype;
	private $previousmember;
	private $staff;
	private $howdiduknow;
	private $otherknow;
	private $verified;
	private $verifymanid;
	private $verifymanager;
	private $idpass;
	private $fundssource;
	private $othersource;
	private $webpass;
	private $refferal;
	private $branchid;
	private $branchname;
	private $suspenseMember;
	private $agent;
	private $editUser;
	private $editDate;
	private $deleted;
	private $deleteddate;
	private $deletereason;
	private $deletedby;
	private $exemptcertexpirydate;

	/**
	 * set value for member_no 
	 *
	 * type:varchar,size:9,default:null,nullable
	 *
	 * @param mixed $memberNo
	 * @return feeds_MembersModel
	 */
	public function &setMemberNo($memberNo) {
		$this->notifyChanged(self::FIELD_MEMBER_NO,$this->memberNo,$memberNo);
		$this->memberNo=$memberNo;
		return $this;
	}

	/**
	 * get value for member_no 
	 *
	 * type:varchar,size:9,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMemberNo() {
		return $this->memberNo;
	}

	/**
	 * set value for title 
	 *
	 * type:varchar,size:8,default:null,nullable
	 *
	 * @param mixed $title
	 * @return feeds_MembersModel
	 */
	public function &setTitle($title) {
		$this->notifyChanged(self::FIELD_TITLE,$this->title,$title);
		$this->title=$title;
		return $this;
	}

	/**
	 * get value for title 
	 *
	 * type:varchar,size:8,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * set value for firstname 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $firstname
	 * @return feeds_MembersModel
	 */
	public function &setFirstname($firstname) {
		$this->notifyChanged(self::FIELD_FIRSTNAME,$this->firstname,$firstname);
		$this->firstname=$firstname;
		return $this;
	}

	/**
	 * get value for firstname 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * set value for surname 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $surname
	 * @return feeds_MembersModel
	 */
	public function &setSurname($surname) {
		$this->notifyChanged(self::FIELD_SURNAME,$this->surname,$surname);
		$this->surname=$surname;
		return $this;
	}

	/**
	 * get value for surname 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * set value for lastname 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @param mixed $lastname
	 * @return feeds_MembersModel
	 */
	public function &setLastname($lastname) {
		$this->notifyChanged(self::FIELD_LASTNAME,$this->lastname,$lastname);
		$this->lastname=$lastname;
		return $this;
	}

	/**
	 * get value for lastname 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * set value for othernames 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $othernames
	 * @return feeds_MembersModel
	 */
	public function &setOthernames($othernames) {
		$this->notifyChanged(self::FIELD_OTHERNAMES,$this->othernames,$othernames);
		$this->othernames=$othernames;
		return $this;
	}

	/**
	 * get value for othernames 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOthernames() {
		return $this->othernames;
	}

	/**
	 * set value for allnames 
	 *
	 * type:varchar,size:300,default:null,nullable
	 *
	 * @param mixed $allnames
	 * @return feeds_MembersModel
	 */
	public function &setAllnames($allnames) {
		$this->notifyChanged(self::FIELD_ALLNAMES,$this->allnames,$allnames);
		$this->allnames=$allnames;
		return $this;
	}

	/**
	 * get value for allnames 
	 *
	 * type:varchar,size:300,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAllnames() {
		return $this->allnames;
	}

	/**
	 * set value for post_address 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $postAddress
	 * @return feeds_MembersModel
	 */
	public function &setPostAddress($postAddress) {
		$this->notifyChanged(self::FIELD_POST_ADDRESS,$this->postAddress,$postAddress);
		$this->postAddress=$postAddress;
		return $this;
	}

	/**
	 * get value for post_address 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPostAddress() {
		return $this->postAddress;
	}

	/**
	 * set value for reg_date 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $regDate
	 * @return feeds_MembersModel
	 */
	public function &setRegDate($regDate) {
		$this->notifyChanged(self::FIELD_REG_DATE,$this->regDate,$regDate);
		$this->regDate=$regDate;
		return $this;
	}

	/**
	 * get value for reg_date 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRegDate() {
		return $this->regDate;
	}

	/**
	 * set value for tel_no 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $telNo
	 * @return feeds_MembersModel
	 */
	public function &setTelNo($telNo) {
		$this->notifyChanged(self::FIELD_TEL_NO,$this->telNo,$telNo);
		$this->telNo=$telNo;
		return $this;
	}

	/**
	 * get value for tel_no 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTelNo() {
		return $this->telNo;
	}

	/**
	 * set value for phys_address 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $physAddress
	 * @return feeds_MembersModel
	 */
	public function &setPhysAddress($physAddress) {
		$this->notifyChanged(self::FIELD_PHYS_ADDRESS,$this->physAddress,$physAddress);
		$this->physAddress=$physAddress;
		return $this;
	}

	/**
	 * get value for phys_address 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPhysAddress() {
		return $this->physAddress;
	}

	/**
	 * set value for town 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @param mixed $town
	 * @return feeds_MembersModel
	 */
	public function &setTown($town) {
		$this->notifyChanged(self::FIELD_TOWN,$this->town,$town);
		$this->town=$town;
		return $this;
	}

	/**
	 * get value for town 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTown() {
		return $this->town;
	}

	/**
	 * set value for street 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $street
	 * @return feeds_MembersModel
	 */
	public function &setStreet($street) {
		$this->notifyChanged(self::FIELD_STREET,$this->street,$street);
		$this->street=$street;
		return $this;
	}

	/**
	 * get value for street 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * set value for hse_no 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $hseNo
	 * @return feeds_MembersModel
	 */
	public function &setHseNo($hseNo) {
		$this->notifyChanged(self::FIELD_HSE_NO,$this->hseNo,$hseNo);
		$this->hseNo=$hseNo;
		return $this;
	}

	/**
	 * get value for hse_no 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHseNo() {
		return $this->hseNo;
	}

	/**
	 * set value for country 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @param mixed $country
	 * @return feeds_MembersModel
	 */
	public function &setCountry($country) {
		$this->notifyChanged(self::FIELD_COUNTRY,$this->country,$country);
		$this->country=$country;
		return $this;
	}

	/**
	 * get value for country 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * set value for sms_ntfy 
	 *
	 * type:varchar,size:1,default:null,nullable
	 *
	 * @param mixed $smsNtfy
	 * @return feeds_MembersModel
	 */
	public function &setSmsNtfy($smsNtfy) {
		$this->notifyChanged(self::FIELD_SMS_NTFY,$this->smsNtfy,$smsNtfy);
		$this->smsNtfy=$smsNtfy;
		return $this;
	}

	/**
	 * get value for sms_ntfy 
	 *
	 * type:varchar,size:1,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmsNtfy() {
		return $this->smsNtfy;
	}

	/**
	 * set value for smsqry_accept 
	 *
	 * type:varchar,size:1,default:null,nullable
	 *
	 * @param mixed $smsqryAccept
	 * @return feeds_MembersModel
	 */
	public function &setSmsqryAccept($smsqryAccept) {
		$this->notifyChanged(self::FIELD_SMSQRY_ACCEPT,$this->smsqryAccept,$smsqryAccept);
		$this->smsqryAccept=$smsqryAccept;
		return $this;
	}

	/**
	 * get value for smsqry_accept 
	 *
	 * type:varchar,size:1,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSmsqryAccept() {
		return $this->smsqryAccept;
	}

	/**
	 * set value for gsm_no 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $gsmNo
	 * @return feeds_MembersModel
	 */
	public function &setGsmNo($gsmNo) {
		$this->notifyChanged(self::FIELD_GSM_NO,$this->gsmNo,$gsmNo);
		$this->gsmNo=$gsmNo;
		return $this;
	}

	/**
	 * get value for gsm_no 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getGsmNo() {
		return $this->gsmNo;
	}

	/**
	 * set value for e_mail 
	 *
	 * type:varchar,size:1000,default:null,nullable
	 *
	 * @param mixed $eMail
	 * @return feeds_MembersModel
	 */
	public function &setEMail($eMail) {
		$this->notifyChanged(self::FIELD_E_MAIL,$this->eMail,$eMail);
		$this->eMail=$eMail;
		return $this;
	}

	/**
	 * get value for e_mail 
	 *
	 * type:varchar,size:1000,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEMail() {
		return $this->eMail;
	}

	/**
	 * set value for id_no 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @param mixed $idNo
	 * @return feeds_MembersModel
	 */
	public function &setIdNo($idNo) {
		$this->notifyChanged(self::FIELD_ID_NO,$this->idNo,$idNo);
		$this->idNo=$idNo;
		return $this;
	}

	/**
	 * get value for id_no 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getIdNo() {
		return $this->idNo;
	}

	/**
	 * set value for pin_no 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @param mixed $pinNo
	 * @return feeds_MembersModel
	 */
	public function &setPinNo($pinNo) {
		$this->notifyChanged(self::FIELD_PIN_NO,$this->pinNo,$pinNo);
		$this->pinNo=$pinNo;
		return $this;
	}

	/**
	 * get value for pin_no 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPinNo() {
		return $this->pinNo;
	}

	/**
	 * set value for signature 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @param mixed $signature
	 * @return feeds_MembersModel
	 */
	public function &setSignature($signature) {
		$this->notifyChanged(self::FIELD_SIGNATURE,$this->signature,$signature);
		$this->signature=$signature;
		return $this;
	}

	/**
	 * get value for signature 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSignature() {
		return $this->signature;
	}

	/**
	 * set value for picture 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @param mixed $picture
	 * @return feeds_MembersModel
	 */
	public function &setPicture($picture) {
		$this->notifyChanged(self::FIELD_PICTURE,$this->picture,$picture);
		$this->picture=$picture;
		return $this;
	}

	/**
	 * get value for picture 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPicture() {
		return $this->picture;
	}

	/**
	 * set value for terminationdate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $terminationdate
	 * @return feeds_MembersModel
	 */
	public function &setTerminationdate($terminationdate) {
		$this->notifyChanged(self::FIELD_TERMINATIONDATE,$this->terminationdate,$terminationdate);
		$this->terminationdate=$terminationdate;
		return $this;
	}

	/**
	 * get value for terminationdate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTerminationdate() {
		return $this->terminationdate;
	}

	/**
	 * set value for dob 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $dob
	 * @return feeds_MembersModel
	 */
	public function &setDob($dob) {
		$this->notifyChanged(self::FIELD_DOB,$this->dob,$dob);
		$this->dob=$dob;
		return $this;
	}

	/**
	 * get value for dob 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDob() {
		return $this->dob;
	}

	/**
	 * set value for age 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $age
	 * @return feeds_MembersModel
	 */
	public function &setAge($age) {
		$this->notifyChanged(self::FIELD_AGE,$this->age,$age);
		$this->age=$age;
		return $this;
	}

	/**
	 * get value for age 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAge() {
		return $this->age;
	}

	/**
	 * set value for gender 
	 *
	 * type:varchar,size:6,default:null,nullable
	 *
	 * @param mixed $gender
	 * @return feeds_MembersModel
	 */
	public function &setGender($gender) {
		$this->notifyChanged(self::FIELD_GENDER,$this->gender,$gender);
		$this->gender=$gender;
		return $this;
	}

	/**
	 * get value for gender 
	 *
	 * type:varchar,size:6,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * set value for employer 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @param mixed $employer
	 * @return feeds_MembersModel
	 */
	public function &setEmployer($employer) {
		$this->notifyChanged(self::FIELD_EMPLOYER,$this->employer,$employer);
		$this->employer=$employer;
		return $this;
	}

	/**
	 * get value for employer 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmployer() {
		return $this->employer;
	}

	/**
	 * set value for maritalstatus 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @param mixed $maritalstatus
	 * @return feeds_MembersModel
	 */
	public function &setMaritalstatus($maritalstatus) {
		$this->notifyChanged(self::FIELD_MARITALSTATUS,$this->maritalstatus,$maritalstatus);
		$this->maritalstatus=$maritalstatus;
		return $this;
	}

	/**
	 * get value for maritalstatus 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMaritalstatus() {
		return $this->maritalstatus;
	}

	/**
	 * set value for retage 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $retage
	 * @return feeds_MembersModel
	 */
	public function &setRetage($retage) {
		$this->notifyChanged(self::FIELD_RETAGE,$this->retage,$retage);
		$this->retage=$retage;
		return $this;
	}

	/**
	 * get value for retage 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRetage() {
		return $this->retage;
	}

	/**
	 * set value for uname 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $uname
	 * @return feeds_MembersModel
	 */
	public function &setUname($uname) {
		$this->notifyChanged(self::FIELD_UNAME,$this->uname,$uname);
		$this->uname=$uname;
		return $this;
	}

	/**
	 * get value for uname 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUname() {
		return $this->uname;
	}

	/**
	 * set value for comp 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $comp
	 * @return feeds_MembersModel
	 */
	public function &setComp($comp) {
		$this->notifyChanged(self::FIELD_COMP,$this->comp,$comp);
		$this->comp=$comp;
		return $this;
	}

	/**
	 * get value for comp 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getComp() {
		return $this->comp;
	}

	/**
	 * set value for company_no 
	 *
	 * type:varchar,size:9,default:null,nullable
	 *
	 * @param mixed $companyNo
	 * @return feeds_MembersModel
	 */
	public function &setCompanyNo($companyNo) {
		$this->notifyChanged(self::FIELD_COMPANY_NO,$this->companyNo,$companyNo);
		$this->companyNo=$companyNo;
		return $this;
	}

	/**
	 * get value for company_no 
	 *
	 * type:varchar,size:9,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCompanyNo() {
		return $this->companyNo;
	}

	/**
	 * set value for companyname 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $companyname
	 * @return feeds_MembersModel
	 */
	public function &setCompanyname($companyname) {
		$this->notifyChanged(self::FIELD_COMPANYNAME,$this->companyname,$companyname);
		$this->companyname=$companyname;
		return $this;
	}

	/**
	 * get value for companyname 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCompanyname() {
		return $this->companyname;
	}

	/**
	 * set value for amt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $amt
	 * @return feeds_MembersModel
	 */
	public function &setAmt($amt) {
		$this->notifyChanged(self::FIELD_AMT,$this->amt,$amt);
		$this->amt=$amt;
		return $this;
	}

	/**
	 * get value for amt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAmt() {
		return $this->amt;
	}

	/**
	 * set value for contributiontype 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $contributiontype
	 * @return feeds_MembersModel
	 */
	public function &setContributiontype($contributiontype) {
		$this->notifyChanged(self::FIELD_CONTRIBUTIONTYPE,$this->contributiontype,$contributiontype);
		$this->contributiontype=$contributiontype;
		return $this;
	}

	/**
	 * get value for contributiontype 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getContributiontype() {
		return $this->contributiontype;
	}

	/**
	 * set value for comments 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $comments
	 * @return feeds_MembersModel
	 */
	public function &setComments($comments) {
		$this->notifyChanged(self::FIELD_COMMENTS,$this->comments,$comments);
		$this->comments=$comments;
		return $this;
	}

	/**
	 * get value for comments 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * set value for exptretyr 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $exptretyr
	 * @return feeds_MembersModel
	 */
	public function &setExptretyr($exptretyr) {
		$this->notifyChanged(self::FIELD_EXPTRETYR,$this->exptretyr,$exptretyr);
		$this->exptretyr=$exptretyr;
		return $this;
	}

	/**
	 * get value for exptretyr 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExptretyr() {
		return $this->exptretyr;
	}

	/**
	 * set value for employmentdate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $employmentdate
	 * @return feeds_MembersModel
	 */
	public function &setEmploymentdate($employmentdate) {
		$this->notifyChanged(self::FIELD_EMPLOYMENTDATE,$this->employmentdate,$employmentdate);
		$this->employmentdate=$employmentdate;
		return $this;
	}

	/**
	 * get value for employmentdate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmploymentdate() {
		return $this->employmentdate;
	}

	/**
	 * set value for salary 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $salary
	 * @return feeds_MembersModel
	 */
	public function &setSalary($salary) {
		$this->notifyChanged(self::FIELD_SALARY,$this->salary,$salary);
		$this->salary=$salary;
		return $this;
	}

	/**
	 * get value for salary 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSalary() {
		return $this->salary;
	}

	/**
	 * set value for occupation 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $occupation
	 * @return feeds_MembersModel
	 */
	public function &setOccupation($occupation) {
		$this->notifyChanged(self::FIELD_OCCUPATION,$this->occupation,$occupation);
		$this->occupation=$occupation;
		return $this;
	}

	/**
	 * get value for occupation 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOccupation() {
		return $this->occupation;
	}

	/**
	 * set value for payrolid 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @param mixed $payrolid
	 * @return feeds_MembersModel
	 */
	public function &setPayrolid($payrolid) {
		$this->notifyChanged(self::FIELD_PAYROLID,$this->payrolid,$payrolid);
		$this->payrolid=$payrolid;
		return $this;
	}

	/**
	 * get value for payrolid 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPayrolid() {
		return $this->payrolid;
	}

	/**
	 * set value for previousbenefits 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $previousbenefits
	 * @return feeds_MembersModel
	 */
	public function &setPreviousbenefits($previousbenefits) {
		$this->notifyChanged(self::FIELD_PREVIOUSBENEFITS,$this->previousbenefits,$previousbenefits);
		$this->previousbenefits=$previousbenefits;
		return $this;
	}

	/**
	 * get value for previousbenefits 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPreviousbenefits() {
		return $this->previousbenefits;
	}

	/**
	 * set value for employed 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $employed
	 * @return feeds_MembersModel
	 */
	public function &setEmployed($employed) {
		$this->notifyChanged(self::FIELD_EMPLOYED,$this->employed,$employed);
		$this->employed=$employed;
		return $this;
	}

	/**
	 * get value for employed 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmployed() {
		return $this->employed;
	}

	/**
	 * set value for datejoinedp 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $datejoinedp
	 * @return feeds_MembersModel
	 */
	public function &setDatejoinedp($datejoinedp) {
		$this->notifyChanged(self::FIELD_DATEJOINEDP,$this->datejoinedp,$datejoinedp);
		$this->datejoinedp=$datejoinedp;
		return $this;
	}

	/**
	 * get value for datejoinedp 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDatejoinedp() {
		return $this->datejoinedp;
	}

	/**
	 * set value for memtype 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @param mixed $memtype
	 * @return feeds_MembersModel
	 */
	public function &setMemtype($memtype) {
		$this->notifyChanged(self::FIELD_MEMTYPE,$this->memtype,$memtype);
		$this->memtype=$memtype;
		return $this;
	}

	/**
	 * get value for memtype 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMemtype() {
		return $this->memtype;
	}

	/**
	 * set value for confirmed 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $confirmed
	 * @return feeds_MembersModel
	 */
	public function &setConfirmed($confirmed) {
		$this->notifyChanged(self::FIELD_CONFIRMED,$this->confirmed,$confirmed);
		$this->confirmed=$confirmed;
		return $this;
	}

	/**
	 * get value for confirmed 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getConfirmed() {
		return $this->confirmed;
	}

	/**
	 * set value for confirmeddate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $confirmeddate
	 * @return feeds_MembersModel
	 */
	public function &setConfirmeddate($confirmeddate) {
		$this->notifyChanged(self::FIELD_CONFIRMEDDATE,$this->confirmeddate,$confirmeddate);
		$this->confirmeddate=$confirmeddate;
		return $this;
	}

	/**
	 * get value for confirmeddate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getConfirmeddate() {
		return $this->confirmeddate;
	}

	/**
	 * set value for confirmedby 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @param mixed $confirmedby
	 * @return feeds_MembersModel
	 */
	public function &setConfirmedby($confirmedby) {
		$this->notifyChanged(self::FIELD_CONFIRMEDBY,$this->confirmedby,$confirmedby);
		$this->confirmedby=$confirmedby;
		return $this;
	}

	/**
	 * get value for confirmedby 
	 *
	 * type:varchar,size:40,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getConfirmedby() {
		return $this->confirmedby;
	}

	/**
	 * set value for signature1 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @param mixed $signature1
	 * @return feeds_MembersModel
	 */
	public function &setSignature1($signature1) {
		$this->notifyChanged(self::FIELD_SIGNATURE1,$this->signature1,$signature1);
		$this->signature1=$signature1;
		return $this;
	}

	/**
	 * get value for signature1 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSignature1() {
		return $this->signature1;
	}

	/**
	 * set value for picture1 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @param mixed $picture1
	 * @return feeds_MembersModel
	 */
	public function &setPicture1($picture1) {
		$this->notifyChanged(self::FIELD_PICTURE1,$this->picture1,$picture1);
		$this->picture1=$picture1;
		return $this;
	}

	/**
	 * get value for picture1 
	 *
	 * type:bytea,size:2147483647,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPicture1() {
		return $this->picture1;
	}

	/**
	 * set value for taxexempt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $taxexempt
	 * @return feeds_MembersModel
	 */
	public function &setTaxexempt($taxexempt) {
		$this->notifyChanged(self::FIELD_TAXEXEMPT,$this->taxexempt,$taxexempt);
		$this->taxexempt=$taxexempt;
		return $this;
	}

	/**
	 * get value for taxexempt 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTaxexempt() {
		return $this->taxexempt;
	}

	/**
	 * set value for resident 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $resident
	 * @return feeds_MembersModel
	 */
	public function &setResident($resident) {
		$this->notifyChanged(self::FIELD_RESIDENT,$this->resident,$resident);
		$this->resident=$resident;
		return $this;
	}

	/**
	 * get value for resident 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getResident() {
		return $this->resident;
	}

	/**
	 * set value for statementtype 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $statementtype
	 * @return feeds_MembersModel
	 */
	public function &setStatementtype($statementtype) {
		$this->notifyChanged(self::FIELD_STATEMENTTYPE,$this->statementtype,$statementtype);
		$this->statementtype=$statementtype;
		return $this;
	}

	/**
	 * get value for statementtype 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStatementtype() {
		return $this->statementtype;
	}

	/**
	 * set value for previousmember 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $previousmember
	 * @return feeds_MembersModel
	 */
	public function &setPreviousmember($previousmember) {
		$this->notifyChanged(self::FIELD_PREVIOUSMEMBER,$this->previousmember,$previousmember);
		$this->previousmember=$previousmember;
		return $this;
	}

	/**
	 * get value for previousmember 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPreviousmember() {
		return $this->previousmember;
	}

	/**
	 * set value for staff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $staff
	 * @return feeds_MembersModel
	 */
	public function &setStaff($staff) {
		$this->notifyChanged(self::FIELD_STAFF,$this->staff,$staff);
		$this->staff=$staff;
		return $this;
	}

	/**
	 * get value for staff 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStaff() {
		return $this->staff;
	}

	/**
	 * set value for howdiduknow 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $howdiduknow
	 * @return feeds_MembersModel
	 */
	public function &setHowdiduknow($howdiduknow) {
		$this->notifyChanged(self::FIELD_HOWDIDUKNOW,$this->howdiduknow,$howdiduknow);
		$this->howdiduknow=$howdiduknow;
		return $this;
	}

	/**
	 * get value for howdiduknow 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getHowdiduknow() {
		return $this->howdiduknow;
	}

	/**
	 * set value for otherknow 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $otherknow
	 * @return feeds_MembersModel
	 */
	public function &setOtherknow($otherknow) {
		$this->notifyChanged(self::FIELD_OTHERKNOW,$this->otherknow,$otherknow);
		$this->otherknow=$otherknow;
		return $this;
	}

	/**
	 * get value for otherknow 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOtherknow() {
		return $this->otherknow;
	}

	/**
	 * set value for verified 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $verified
	 * @return feeds_MembersModel
	 */
	public function &setVerified($verified) {
		$this->notifyChanged(self::FIELD_VERIFIED,$this->verified,$verified);
		$this->verified=$verified;
		return $this;
	}

	/**
	 * get value for verified 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVerified() {
		return $this->verified;
	}

	/**
	 * set value for verifymanid 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $verifymanid
	 * @return feeds_MembersModel
	 */
	public function &setVerifymanid($verifymanid) {
		$this->notifyChanged(self::FIELD_VERIFYMANID,$this->verifymanid,$verifymanid);
		$this->verifymanid=$verifymanid;
		return $this;
	}

	/**
	 * get value for verifymanid 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVerifymanid() {
		return $this->verifymanid;
	}

	/**
	 * set value for verifymanager 
	 *
	 * type:varchar,size:70,default:null,nullable
	 *
	 * @param mixed $verifymanager
	 * @return feeds_MembersModel
	 */
	public function &setVerifymanager($verifymanager) {
		$this->notifyChanged(self::FIELD_VERIFYMANAGER,$this->verifymanager,$verifymanager);
		$this->verifymanager=$verifymanager;
		return $this;
	}

	/**
	 * get value for verifymanager 
	 *
	 * type:varchar,size:70,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getVerifymanager() {
		return $this->verifymanager;
	}

	/**
	 * set value for idpass 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $idpass
	 * @return feeds_MembersModel
	 */
	public function &setIdpass($idpass) {
		$this->notifyChanged(self::FIELD_IDPASS,$this->idpass,$idpass);
		$this->idpass=$idpass;
		return $this;
	}

	/**
	 * get value for idpass 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getIdpass() {
		return $this->idpass;
	}

	/**
	 * set value for fundssource 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $fundssource
	 * @return feeds_MembersModel
	 */
	public function &setFundssource($fundssource) {
		$this->notifyChanged(self::FIELD_FUNDSSOURCE,$this->fundssource,$fundssource);
		$this->fundssource=$fundssource;
		return $this;
	}

	/**
	 * get value for fundssource 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFundssource() {
		return $this->fundssource;
	}

	/**
	 * set value for othersource 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $othersource
	 * @return feeds_MembersModel
	 */
	public function &setOthersource($othersource) {
		$this->notifyChanged(self::FIELD_OTHERSOURCE,$this->othersource,$othersource);
		$this->othersource=$othersource;
		return $this;
	}

	/**
	 * get value for othersource 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOthersource() {
		return $this->othersource;
	}

	/**
	 * set value for webpass 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $webpass
	 * @return feeds_MembersModel
	 */
	public function &setWebpass($webpass) {
		$this->notifyChanged(self::FIELD_WEBPASS,$this->webpass,$webpass);
		$this->webpass=$webpass;
		return $this;
	}

	/**
	 * get value for webpass 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getWebpass() {
		return $this->webpass;
	}

	/**
	 * set value for refferal 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @param mixed $refferal
	 * @return feeds_MembersModel
	 */
	public function &setRefferal($refferal) {
		$this->notifyChanged(self::FIELD_REFFERAL,$this->refferal,$refferal);
		$this->refferal=$refferal;
		return $this;
	}

	/**
	 * get value for refferal 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRefferal() {
		return $this->refferal;
	}

	/**
	 * set value for branchid 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $branchid
	 * @return feeds_MembersModel
	 */
	public function &setBranchid($branchid) {
		$this->notifyChanged(self::FIELD_BRANCHID,$this->branchid,$branchid);
		$this->branchid=$branchid;
		return $this;
	}

	/**
	 * get value for branchid 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBranchid() {
		return $this->branchid;
	}

	/**
	 * set value for branchname 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $branchname
	 * @return feeds_MembersModel
	 */
	public function &setBranchname($branchname) {
		$this->notifyChanged(self::FIELD_BRANCHNAME,$this->branchname,$branchname);
		$this->branchname=$branchname;
		return $this;
	}

	/**
	 * get value for branchname 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getBranchname() {
		return $this->branchname;
	}

	/**
	 * set value for suspense_member 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @param mixed $suspenseMember
	 * @return feeds_MembersModel
	 */
	public function &setSuspenseMember($suspenseMember) {
		$this->notifyChanged(self::FIELD_SUSPENSE_MEMBER,$this->suspenseMember,$suspenseMember);
		$this->suspenseMember=$suspenseMember;
		return $this;
	}

	/**
	 * get value for suspense_member 
	 *
	 * type:numeric,size:131089,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSuspenseMember() {
		return $this->suspenseMember;
	}

	/**
	 * set value for agent 
	 *
	 * type:bpchar,size:30,default:null,nullable
	 *
	 * @param mixed $agent
	 * @return feeds_MembersModel
	 */
	public function &setAgent($agent) {
		$this->notifyChanged(self::FIELD_AGENT,$this->agent,$agent);
		$this->agent=$agent;
		return $this;
	}

	/**
	 * get value for agent 
	 *
	 * type:bpchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getAgent() {
		return $this->agent;
	}

	/**
	 * set value for edit_user 
	 *
	 * type:bpchar,size:80,default:null,nullable
	 *
	 * @param mixed $editUser
	 * @return feeds_MembersModel
	 */
	public function &setEditUser($editUser) {
		$this->notifyChanged(self::FIELD_EDIT_USER,$this->editUser,$editUser);
		$this->editUser=$editUser;
		return $this;
	}

	/**
	 * get value for edit_user 
	 *
	 * type:bpchar,size:80,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEditUser() {
		return $this->editUser;
	}

	/**
	 * set value for edit_date 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $editDate
	 * @return feeds_MembersModel
	 */
	public function &setEditDate($editDate) {
		$this->notifyChanged(self::FIELD_EDIT_DATE,$this->editDate,$editDate);
		$this->editDate=$editDate;
		return $this;
	}

	/**
	 * get value for edit_date 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEditDate() {
		return $this->editDate;
	}

	/**
	 * set value for deleted 
	 *
	 * type:int4,size:10,default:null,nullable
	 *
	 * @param mixed $deleted
	 * @return feeds_MembersModel
	 */
	public function &setDeleted($deleted) {
		$this->notifyChanged(self::FIELD_DELETED,$this->deleted,$deleted);
		$this->deleted=$deleted;
		return $this;
	}

	/**
	 * get value for deleted 
	 *
	 * type:int4,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDeleted() {
		return $this->deleted;
	}

	/**
	 * set value for deleteddate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $deleteddate
	 * @return feeds_MembersModel
	 */
	public function &setDeleteddate($deleteddate) {
		$this->notifyChanged(self::FIELD_DELETEDDATE,$this->deleteddate,$deleteddate);
		$this->deleteddate=$deleteddate;
		return $this;
	}

	/**
	 * get value for deleteddate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDeleteddate() {
		return $this->deleteddate;
	}

	/**
	 * set value for deletereason 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $deletereason
	 * @return feeds_MembersModel
	 */
	public function &setDeletereason($deletereason) {
		$this->notifyChanged(self::FIELD_DELETEREASON,$this->deletereason,$deletereason);
		$this->deletereason=$deletereason;
		return $this;
	}

	/**
	 * get value for deletereason 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDeletereason() {
		return $this->deletereason;
	}

	/**
	 * set value for deletedby 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @param mixed $deletedby
	 * @return feeds_MembersModel
	 */
	public function &setDeletedby($deletedby) {
		$this->notifyChanged(self::FIELD_DELETEDBY,$this->deletedby,$deletedby);
		$this->deletedby=$deletedby;
		return $this;
	}

	/**
	 * get value for deletedby 
	 *
	 * type:varchar,size:50,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDeletedby() {
		return $this->deletedby;
	}

	/**
	 * set value for exemptcertexpirydate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @param mixed $exemptcertexpirydate
	 * @return feeds_MembersModel
	 */
	public function &setExemptcertexpirydate($exemptcertexpirydate) {
		$this->notifyChanged(self::FIELD_EXEMPTCERTEXPIRYDATE,$this->exemptcertexpirydate,$exemptcertexpirydate);
		$this->exemptcertexpirydate=$exemptcertexpirydate;
		return $this;
	}

	/**
	 * get value for exemptcertexpirydate 
	 *
	 * type:timestamp,size:29,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getExemptcertexpirydate() {
		return $this->exemptcertexpirydate;
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
			self::FIELD_MEMBER_NO=>$this->getMemberNo(),
			self::FIELD_TITLE=>$this->getTitle(),
			self::FIELD_FIRSTNAME=>$this->getFirstname(),
			self::FIELD_SURNAME=>$this->getSurname(),
			self::FIELD_LASTNAME=>$this->getLastname(),
			self::FIELD_OTHERNAMES=>$this->getOthernames(),
			self::FIELD_ALLNAMES=>$this->getAllnames(),
			self::FIELD_POST_ADDRESS=>$this->getPostAddress(),
			self::FIELD_REG_DATE=>$this->getRegDate(),
			self::FIELD_TEL_NO=>$this->getTelNo(),
			self::FIELD_PHYS_ADDRESS=>$this->getPhysAddress(),
			self::FIELD_TOWN=>$this->getTown(),
			self::FIELD_STREET=>$this->getStreet(),
			self::FIELD_HSE_NO=>$this->getHseNo(),
			self::FIELD_COUNTRY=>$this->getCountry(),
			self::FIELD_SMS_NTFY=>$this->getSmsNtfy(),
			self::FIELD_SMSQRY_ACCEPT=>$this->getSmsqryAccept(),
			self::FIELD_GSM_NO=>$this->getGsmNo(),
			self::FIELD_E_MAIL=>$this->getEMail(),
			self::FIELD_ID_NO=>$this->getIdNo(),
			self::FIELD_PIN_NO=>$this->getPinNo(),
			self::FIELD_SIGNATURE=>$this->getSignature(),
			self::FIELD_PICTURE=>$this->getPicture(),
			self::FIELD_TERMINATIONDATE=>$this->getTerminationdate(),
			self::FIELD_DOB=>$this->getDob(),
			self::FIELD_AGE=>$this->getAge(),
			self::FIELD_GENDER=>$this->getGender(),
			self::FIELD_EMPLOYER=>$this->getEmployer(),
			self::FIELD_MARITALSTATUS=>$this->getMaritalstatus(),
			self::FIELD_RETAGE=>$this->getRetage(),
			self::FIELD_UNAME=>$this->getUname(),
			self::FIELD_COMP=>$this->getComp(),
			self::FIELD_COMPANY_NO=>$this->getCompanyNo(),
			self::FIELD_COMPANYNAME=>$this->getCompanyname(),
			self::FIELD_AMT=>$this->getAmt(),
			self::FIELD_CONTRIBUTIONTYPE=>$this->getContributiontype(),
			self::FIELD_COMMENTS=>$this->getComments(),
			self::FIELD_EXPTRETYR=>$this->getExptretyr(),
			self::FIELD_EMPLOYMENTDATE=>$this->getEmploymentdate(),
			self::FIELD_SALARY=>$this->getSalary(),
			self::FIELD_OCCUPATION=>$this->getOccupation(),
			self::FIELD_PAYROLID=>$this->getPayrolid(),
			self::FIELD_PREVIOUSBENEFITS=>$this->getPreviousbenefits(),
			self::FIELD_EMPLOYED=>$this->getEmployed(),
			self::FIELD_DATEJOINEDP=>$this->getDatejoinedp(),
			self::FIELD_MEMTYPE=>$this->getMemtype(),
			self::FIELD_CONFIRMED=>$this->getConfirmed(),
			self::FIELD_CONFIRMEDDATE=>$this->getConfirmeddate(),
			self::FIELD_CONFIRMEDBY=>$this->getConfirmedby(),
			self::FIELD_SIGNATURE1=>$this->getSignature1(),
			self::FIELD_PICTURE1=>$this->getPicture1(),
			self::FIELD_TAXEXEMPT=>$this->getTaxexempt(),
			self::FIELD_RESIDENT=>$this->getResident(),
			self::FIELD_STATEMENTTYPE=>$this->getStatementtype(),
			self::FIELD_PREVIOUSMEMBER=>$this->getPreviousmember(),
			self::FIELD_STAFF=>$this->getStaff(),
			self::FIELD_HOWDIDUKNOW=>$this->getHowdiduknow(),
			self::FIELD_OTHERKNOW=>$this->getOtherknow(),
			self::FIELD_VERIFIED=>$this->getVerified(),
			self::FIELD_VERIFYMANID=>$this->getVerifymanid(),
			self::FIELD_VERIFYMANAGER=>$this->getVerifymanager(),
			self::FIELD_IDPASS=>$this->getIdpass(),
			self::FIELD_FUNDSSOURCE=>$this->getFundssource(),
			self::FIELD_OTHERSOURCE=>$this->getOthersource(),
			self::FIELD_WEBPASS=>$this->getWebpass(),
			self::FIELD_REFFERAL=>$this->getRefferal(),
			self::FIELD_BRANCHID=>$this->getBranchid(),
			self::FIELD_BRANCHNAME=>$this->getBranchname(),
			self::FIELD_SUSPENSE_MEMBER=>$this->getSuspenseMember(),
			self::FIELD_AGENT=>$this->getAgent(),
			self::FIELD_EDIT_USER=>$this->getEditUser(),
			self::FIELD_EDIT_DATE=>$this->getEditDate(),
			self::FIELD_DELETED=>$this->getDeleted(),
			self::FIELD_DELETEDDATE=>$this->getDeleteddate(),
			self::FIELD_DELETEREASON=>$this->getDeletereason(),
			self::FIELD_DELETEDBY=>$this->getDeletedby(),
			self::FIELD_EXEMPTCERTEXPIRYDATE=>$this->getExemptcertexpirydate());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_MEMBER_NO=>$this->getMemberNo());
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
	 * Match by attributes of passed example instance and return matched rows as an array of feeds_MembersModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param feeds_MembersModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return feeds_MembersModel[]
	 */
	public static function findByExample(PDO $db,feeds_MembersModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of feeds_MembersModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return feeds_MembersModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `members`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of feeds_MembersModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return feeds_MembersModel[]
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
	 * returns the result as an array of feeds_MembersModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return feeds_MembersModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new feeds_MembersModel();
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
	 * Execute select query and return matched rows as an array of feeds_MembersModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return feeds_MembersModel[]
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
		$sql='DELETE FROM `members`'
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
		$this->setMemberNo($result['member_no']);
		$this->setTitle($result['title']);
		$this->setFirstname($result['firstname']);
		$this->setSurname($result['surname']);
		$this->setLastname($result['lastname']);
		$this->setOthernames($result['othernames']);
		$this->setAllnames($result['allnames']);
		$this->setPostAddress($result['post_address']);
		$this->setRegDate($result['reg_date']);
		$this->setTelNo($result['tel_no']);
		$this->setPhysAddress($result['phys_address']);
		$this->setTown($result['town']);
		$this->setStreet($result['street']);
		$this->setHseNo($result['hse_no']);
		$this->setCountry($result['country']);
		$this->setSmsNtfy($result['sms_ntfy']);
		$this->setSmsqryAccept($result['smsqry_accept']);
		$this->setGsmNo($result['gsm_no']);
		$this->setEMail($result['e_mail']);
		$this->setIdNo($result['id_no']);
		$this->setPinNo($result['pin_no']);
		$this->setSignature($result['signature']);
		$this->setPicture($result['picture']);
		$this->setTerminationdate($result['terminationdate']);
		$this->setDob($result['dob']);
		$this->setAge($result['age']);
		$this->setGender($result['gender']);
		$this->setEmployer($result['employer']);
		$this->setMaritalstatus($result['maritalstatus']);
		$this->setRetage($result['retage']);
		$this->setUname($result['uname']);
		$this->setComp($result['comp']);
		$this->setCompanyNo($result['company_no']);
		$this->setCompanyname($result['companyname']);
		$this->setAmt($result['amt']);
		$this->setContributiontype($result['contributiontype']);
		$this->setComments($result['comments']);
		$this->setExptretyr($result['exptretyr']);
		$this->setEmploymentdate($result['employmentdate']);
		$this->setSalary($result['salary']);
		$this->setOccupation($result['occupation']);
		$this->setPayrolid($result['payrolid']);
		$this->setPreviousbenefits($result['previousbenefits']);
		$this->setEmployed($result['employed']);
		$this->setDatejoinedp($result['datejoinedp']);
		$this->setMemtype($result['memtype']);
		$this->setConfirmed($result['confirmed']);
		$this->setConfirmeddate($result['confirmeddate']);
		$this->setConfirmedby($result['confirmedby']);
		$this->setSignature1($result['signature1']);
		$this->setPicture1($result['picture1']);
		$this->setTaxexempt($result['taxexempt']);
		$this->setResident($result['resident']);
		$this->setStatementtype($result['statementtype']);
		$this->setPreviousmember($result['previousmember']);
		$this->setStaff($result['staff']);
		$this->setHowdiduknow($result['howdiduknow']);
		$this->setOtherknow($result['otherknow']);
		$this->setVerified($result['verified']);
		$this->setVerifymanid($result['verifymanid']);
		$this->setVerifymanager($result['verifymanager']);
		$this->setIdpass($result['idpass']);
		$this->setFundssource($result['fundssource']);
		$this->setOthersource($result['othersource']);
		$this->setWebpass($result['webpass']);
		$this->setRefferal($result['refferal']);
		$this->setBranchid($result['branchid']);
		$this->setBranchname($result['branchname']);
		$this->setSuspenseMember($result['suspense_member']);
		$this->setAgent($result['agent']);
		$this->setEditUser($result['edit_user']);
		$this->setEditDate($result['edit_date']);
		$this->setDeleted($result['deleted']);
		$this->setDeleteddate($result['deleteddate']);
		$this->setDeletereason($result['deletereason']);
		$this->setDeletedby($result['deletedby']);
		$this->setExemptcertexpirydate($result['exemptcertexpirydate']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return feeds_MembersModel
	 */
	public static function findById(PDO $db,$memberNo) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$memberNo);
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
		$o=new feeds_MembersModel();
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
		$stmt->bindValue(1,$this->getMemberNo());
		$stmt->bindValue(2,$this->getTitle());
		$stmt->bindValue(3,$this->getFirstname());
		$stmt->bindValue(4,$this->getSurname());
		$stmt->bindValue(5,$this->getLastname());
		$stmt->bindValue(6,$this->getOthernames());
		$stmt->bindValue(7,$this->getAllnames());
		$stmt->bindValue(8,$this->getPostAddress());
		$stmt->bindValue(9,$this->getRegDate());
		$stmt->bindValue(10,$this->getTelNo());
		$stmt->bindValue(11,$this->getPhysAddress());
		$stmt->bindValue(12,$this->getTown());
		$stmt->bindValue(13,$this->getStreet());
		$stmt->bindValue(14,$this->getHseNo());
		$stmt->bindValue(15,$this->getCountry());
		$stmt->bindValue(16,$this->getSmsNtfy());
		$stmt->bindValue(17,$this->getSmsqryAccept());
		$stmt->bindValue(18,$this->getGsmNo());
		$stmt->bindValue(19,$this->getEMail());
		$stmt->bindValue(20,$this->getIdNo());
		$stmt->bindValue(21,$this->getPinNo());
		$stmt->bindValue(22,$this->getSignature());
		$stmt->bindValue(23,$this->getPicture());
		$stmt->bindValue(24,$this->getTerminationdate());
		$stmt->bindValue(25,$this->getDob());
		$stmt->bindValue(26,$this->getAge());
		$stmt->bindValue(27,$this->getGender());
		$stmt->bindValue(28,$this->getEmployer());
		$stmt->bindValue(29,$this->getMaritalstatus());
		$stmt->bindValue(30,$this->getRetage());
		$stmt->bindValue(31,$this->getUname());
		$stmt->bindValue(32,$this->getComp());
		$stmt->bindValue(33,$this->getCompanyNo());
		$stmt->bindValue(34,$this->getCompanyname());
		$stmt->bindValue(35,$this->getAmt());
		$stmt->bindValue(36,$this->getContributiontype());
		$stmt->bindValue(37,$this->getComments());
		$stmt->bindValue(38,$this->getExptretyr());
		$stmt->bindValue(39,$this->getEmploymentdate());
		$stmt->bindValue(40,$this->getSalary());
		$stmt->bindValue(41,$this->getOccupation());
		$stmt->bindValue(42,$this->getPayrolid());
		$stmt->bindValue(43,$this->getPreviousbenefits());
		$stmt->bindValue(44,$this->getEmployed());
		$stmt->bindValue(45,$this->getDatejoinedp());
		$stmt->bindValue(46,$this->getMemtype());
		$stmt->bindValue(47,$this->getConfirmed());
		$stmt->bindValue(48,$this->getConfirmeddate());
		$stmt->bindValue(49,$this->getConfirmedby());
		$stmt->bindValue(50,$this->getSignature1());
		$stmt->bindValue(51,$this->getPicture1());
		$stmt->bindValue(52,$this->getTaxexempt());
		$stmt->bindValue(53,$this->getResident());
		$stmt->bindValue(54,$this->getStatementtype());
		$stmt->bindValue(55,$this->getPreviousmember());
		$stmt->bindValue(56,$this->getStaff());
		$stmt->bindValue(57,$this->getHowdiduknow());
		$stmt->bindValue(58,$this->getOtherknow());
		$stmt->bindValue(59,$this->getVerified());
		$stmt->bindValue(60,$this->getVerifymanid());
		$stmt->bindValue(61,$this->getVerifymanager());
		$stmt->bindValue(62,$this->getIdpass());
		$stmt->bindValue(63,$this->getFundssource());
		$stmt->bindValue(64,$this->getOthersource());
		$stmt->bindValue(65,$this->getWebpass());
		$stmt->bindValue(66,$this->getRefferal());
		$stmt->bindValue(67,$this->getBranchid());
		$stmt->bindValue(68,$this->getBranchname());
		$stmt->bindValue(69,$this->getSuspenseMember());
		$stmt->bindValue(70,$this->getAgent());
		$stmt->bindValue(71,$this->getEditUser());
		$stmt->bindValue(72,$this->getEditDate());
		$stmt->bindValue(73,$this->getDeleted());
		$stmt->bindValue(74,$this->getDeleteddate());
		$stmt->bindValue(75,$this->getDeletereason());
		$stmt->bindValue(76,$this->getDeletedby());
		$stmt->bindValue(77,$this->getExemptcertexpirydate());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_INSERT);
		$this->bindValues($stmt);
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
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(78,$this->getMemberNo());
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
		$stmt->bindValue(1,$this->getMemberNo());
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
		return self::hashToDomDocument($this->toHash(), 'feeds_MembersModel');
	}

	/**
	 * get single feeds_MembersModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return feeds_MembersModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new feeds_MembersModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of feeds_MembersModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return feeds_MembersModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('feeds_MembersModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>