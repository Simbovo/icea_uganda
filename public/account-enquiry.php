	<?php

	require('../app/Loader.php');

	use application\model\DbConnection;

	$dbh = DbConnection::getInstance();
	$input_data = file_get_contents('php//input');
	if(!is_null($input_data)){
		//decode the data
		$data = json_decode($input_data);
		die(var_dump($data));

		$member_no = $_POST['member_no'];


		
		$DateQry = "SELECT Max(NAV_DATE) as maxdate FROM NAVS  WHERE CONFIRMD IS NOT NULL";

		try{
			$sth = $dbh->dbConn->prepare($DateQry);
			$sth->execute();

			$res = $sth->fetch(PDO::FETCH_OBJ);

			$max_date = date('Y-m-d' , strtotime($res->maxdate));
			if(!is_null($max_date)){
				$QryStr = "SELECT NAVS.NAV_DATE,  MEMBERS.MEMBER_NO, MEMBERS.ALLNAMES, TRANS.ACCOUNT_NO, TRANS.PORTFOLIO, case when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=1) then (select sum(a.netAMOUNT) from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO  and a.CONFIRMED is not null and a.REVERSED is null and a.DELETED is null and cast(a.TRANS_DATE as date)<=:max) when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=null) then (select sum(a.netAMOUNT) from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO and a.CONFIRMED is not null and a.REVERSED is null and a.DELETED is null and cast(a.TRANS_DATE as date)<= :max) when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=0) then (select sum(a.netAMOUNT) from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO and a.trans_type<>'INTEREST' and a.CONFIRMED is not null and a.REVERSED is null and a.DELETED is null and cast(a.TRANS_date as date)<=:max) when (SECURITIES.FUNDTYPE<>'Rate Fee') then ((Sum(CAST(CAST(TRANS.NOOFSHARES AS FLOAT) AS DECIMAL(17,2))) * NAVS.AMOUNT)) else sum(TRANS.NETAMOUNT) end as p_amt, 	sum(TRANS.NETAMOUNT) as netamt, sum(cast(cast(TRANS.NOOFSHARES as float) as decimal(17,2))) as mktvalue, CAST(NAVS.AMOUNT AS DECIMAL(17,2)),NAVS.ADM_FEE, NAVS.P_PRICE FROM TRANS INNER JOIN ACCOUNTS ON TRANS.ACCOUNT_NO = ACCOUNTS.ACCOUNT_NO INNER JOIN NAVS ON ACCOUNTS.SECURITY_CODE = NAVS.SECURITY_CODE INNER JOIN MEMBERS ON MEMBERS.MEMBER_NO = TRANS.MEMBER_NO INNER JOIN SECURITIES ON ACCOUNTS.SECURITY_CODE = SECURITIES.SECURITY_CODE where cast(NAVS.nav_date as date)=:max and MEMBERS.CONFIRMED is not null and MEMBERS.CONFIRMED is not null and TRANS.CONFIRMED is not null and TRANS.REVERSED is null and TRANS.DELETED is null and NAVS.CONFIRMD IS NOT NULL and cast(TRANS.TRANS_date as date)<=:max and accounts.member_no = :member_no group by NAVS.NAV_DATE, MEMBERS.MEMBER_NO, trans.account_no, trans.portfolio, securities.fundtype,securities.sec_type, navs.amount, navs.adm_fee, navs.p_price";
				
			try{
					$stmt = $dbh->dbConn->prepare($QryStr);
					$stmt->bindParam(':max', $max_date);
					$stmt->bindParam(':member_no', $member_no);

					$result = $stmt->fetchAll(PDO::FETCH_OBJ);

					echo json_encode($result);

				}catch(PDOException $ex){
					echo 'PDO Exception inner query: ' ,$ex->getMessage();
				}

			}else{
				echo "No date found";
			}
			
			
		}catch(PDOException $ex){
			echo 'PDO Exception: ' , $ex->getMessage();
		}
	}



