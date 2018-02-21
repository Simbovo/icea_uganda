<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 01/02/2017
 * Time: 14:41
 */

namespace application\Mappers;


class Transaction
{

    private $trans_type;
    private $trans_date;
    private $member_no;
    private $full_name;
    private $account_no;
    private $portfolio;
    private $mop;
    private $amount;
    private $net_amount;
    private $sysdate;
    private $drawer_payee;
    private $doc_no;

    /**
     * @return mixed
     */
    public function getAccountNo() {
        return $this->account_no;
    }

    /**
     * @param mixed $account_no
     */
    public function setAccountNo($account_no) {
        $this->account_no = $account_no;
    }

    /**
     * @return mixed
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return Transaction
     */
    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocNo() {
        return $this->doc_no;
    }

    /**
     * @param mixed $doc_no
     * @return Transaction
     */
    public function setDocNo($doc_no) {
        $this->doc_no = $doc_no;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDrawerPayee() {
        return $this->drawer_payee;
    }

    /**
     * @param mixed $drawer_payee
     * @return Transaction
     */
    public function setDrawerPayee($drawer_payee) {
        $this->drawer_payee = $drawer_payee;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFullName() {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     * @return Transaction
     */
    public function setFullName($full_name) {
        $this->full_name = $full_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMemberNo() {
        return $this->member_no;
    }

    /**
     * @param mixed $member_no
     * @return Transaction
     */
    public function setMemberNo($member_no) {
        $this->member_no = $member_no;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMop() {
        return $this->mop;
    }

    /**
     * @param mixed $mop
     * @return Transaction
     */
    public function setMop($mop) {
        $this->mop = $mop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNetAmount() {
        return $this->net_amount;
    }

    /**
     * @param mixed $net_amount
     * @return Transaction
     */
    public function setNetAmount($net_amount) {
        $this->net_amount = $net_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPortfolio() {
        return $this->portfolio;
    }

    /**
     * @param mixed $portfolio
     * @return Transaction
     */
    public function setPortfolio($portfolio) {
        $this->portfolio = $portfolio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSysdate() {
        return $this->sysdate;
    }

    /**
     * @param mixed $sysdate
     * @return Transaction
     */
    public function setSysdate($sysdate) {
        $this->sysdate = $sysdate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransDate() {
        return $this->trans_date;
    }

    /**
     * @param mixed $trans_date
     * @return Transaction
     */
    public function setTransDate($trans_date) {
        $this->trans_date = $trans_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransType() {
        return $this->trans_type;
    }

    /**
     * @param mixed $trans_type
     * @return Transaction
     */
    public function setTransType($trans_type) {
        $this->trans_type = $trans_type;
        return $this;
    }





}