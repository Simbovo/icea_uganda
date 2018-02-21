<?php

/**
 * 
 *
 * @version 1.105
 * @package entity
 */
class feeds_FeedbacksModel extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='feeds_FeedbacksModel';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='feedbacks';
	const SQL_INSERT='INSERT INTO `feedbacks` (`id`,`member_no`,`category`,`subject`,`response_date`,`submission_date`,`response`,`description`,`responded_to`,`responded_by`,`responcedate`,`responce`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `feedbacks` (`member_no`,`category`,`subject`,`response_date`,`submission_date`,`response`,`description`,`responded_to`,`responded_by`,`responcedate`,`responce`) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `feedbacks` SET `id`=?,`member_no`=?,`category`=?,`subject`=?,`response_date`=?,`submission_date`=?,`response`=?,`description`=?,`responded_to`=?,`responded_by`=?,`responcedate`=?,`responce`=? WHERE `id`=?';
	const SQL_SELECT_PK='SELECT * FROM `feedbacks` WHERE `id`=?';
	const SQL_DELETE_PK='DELETE FROM `feedbacks` WHERE `id`=?';
	const FIELD_ID=-1724931717;
	const FIELD_MEMBER_NO=-162305754;
	const FIELD_CATEGORY=-1383495330;
	const FIELD_SUBJECT=-1914143540;
	const FIELD_RESPONSE_DATE=496239756;
	const FIELD_SUBMISSION_DATE=-646110111;
	const FIELD_RESPONSE=-1774329695;
	const FIELD_DESCRIPTION=-170468452;
	const FIELD_RESPONDED_TO=1942019846;
	const FIELD_RESPONDED_BY=1942019298;
	const FIELD_RESPONCEDATE=1913392607;
	const FIELD_RESPONCE=-1774330191;
	private static $PRIMARY_KEYS=array(self::FIELD_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_MEMBER_NO=>'member_no',
		self::FIELD_CATEGORY=>'category',
		self::FIELD_SUBJECT=>'subject',
		self::FIELD_RESPONSE_DATE=>'response_date',
		self::FIELD_SUBMISSION_DATE=>'submission_date',
		self::FIELD_RESPONSE=>'response',
		self::FIELD_DESCRIPTION=>'description',
		self::FIELD_RESPONDED_TO=>'responded_to',
		self::FIELD_RESPONDED_BY=>'responded_by',
		self::FIELD_RESPONCEDATE=>'responcedate',
		self::FIELD_RESPONCE=>'responce');
	private static $PROPERTY_NAMES=array(
		self::FIELD_ID=>'id',
		self::FIELD_MEMBER_NO=>'memberNo',
		self::FIELD_CATEGORY=>'category',
		self::FIELD_SUBJECT=>'subject',
		self::FIELD_RESPONSE_DATE=>'responseDate',
		self::FIELD_SUBMISSION_DATE=>'submissionDate',
		self::FIELD_RESPONSE=>'response',
		self::FIELD_DESCRIPTION=>'description',
		self::FIELD_RESPONDED_TO=>'respondedTo',
		self::FIELD_RESPONDED_BY=>'respondedBy',
		self::FIELD_RESPONCEDATE=>'responcedate',
		self::FIELD_RESPONCE=>'responce');
	private static $PROPERTY_TYPES=array(
		self::FIELD_ID=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_MEMBER_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CATEGORY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SUBJECT=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RESPONSE_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SUBMISSION_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RESPONSE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_DESCRIPTION=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RESPONDED_TO=>Db2PhpEntity::PHP_TYPE_FLOAT,
		self::FIELD_RESPONDED_BY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RESPONCEDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_RESPONCE=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_ID=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,10,0,false),
		self::FIELD_MEMBER_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,10,0,true),
		self::FIELD_CATEGORY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,20,0,true),
		self::FIELD_SUBJECT=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,100,0,true),
		self::FIELD_RESPONSE_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_SUBMISSION_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,29,6,true),
		self::FIELD_RESPONSE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true),
		self::FIELD_DESCRIPTION=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,500,0,true),
		self::FIELD_RESPONDED_TO=>array(Db2PhpEntity::JDBC_TYPE_NUMERIC,10,0,true),
		self::FIELD_RESPONDED_BY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,30,0,true),
		self::FIELD_RESPONCEDATE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,15,0,true),
		self::FIELD_RESPONCE=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,200,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_ID=>null,
		self::FIELD_MEMBER_NO=>null,
		self::FIELD_CATEGORY=>null,
		self::FIELD_SUBJECT=>null,
		self::FIELD_RESPONSE_DATE=>'now()',
		self::FIELD_SUBMISSION_DATE=>'now()',
		self::FIELD_RESPONSE=>null,
		self::FIELD_DESCRIPTION=>null,
		self::FIELD_RESPONDED_TO=>null,
		self::FIELD_RESPONDED_BY=>null,
		self::FIELD_RESPONCEDATE=>null,
		self::FIELD_RESPONCE=>null);
	private $id;
	private $memberNo;
	private $category;
	private $subject;
	private $responseDate;
	private $submissionDate;
	private $response;
	private $description;
	private $respondedTo;
	private $respondedBy;
	private $responcedate;
	private $responce;

	/**
	 * set value for id 
	 *
	 * type:numeric,size:10,default:nextval('unitmaster.feedbacks_id_seq'::regclass),primary,autoincrement
	 *
	 * @param mixed $id
	 * @return feeds_FeedbacksModel
	 */
	public function &setId($id) {
		$this->notifyChanged(self::FIELD_ID,$this->id,$id);
		$this->id=$id;
		return $this;
	}

	/**
	 * get value for id 
	 *
	 * type:numeric,size:10,default:nextval('unitmaster.feedbacks_id_seq'::regclass),primary,autoincrement
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * set value for member_no 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @param mixed $memberNo
	 * @return feeds_FeedbacksModel
	 */
	public function &setMemberNo($memberNo) {
		$this->notifyChanged(self::FIELD_MEMBER_NO,$this->memberNo,$memberNo);
		$this->memberNo=$memberNo;
		return $this;
	}

	/**
	 * get value for member_no 
	 *
	 * type:varchar,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getMemberNo() {
		return $this->memberNo;
	}

	/**
	 * set value for category 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @param mixed $category
	 * @return feeds_FeedbacksModel
	 */
	public function &setCategory($category) {
		$this->notifyChanged(self::FIELD_CATEGORY,$this->category,$category);
		$this->category=$category;
		return $this;
	}

	/**
	 * get value for category 
	 *
	 * type:varchar,size:20,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * set value for subject 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @param mixed $subject
	 * @return feeds_FeedbacksModel
	 */
	public function &setSubject($subject) {
		$this->notifyChanged(self::FIELD_SUBJECT,$this->subject,$subject);
		$this->subject=$subject;
		return $this;
	}

	/**
	 * get value for subject 
	 *
	 * type:varchar,size:100,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * set value for response_date 
	 *
	 * type:timestamp,size:29,default:now(),nullable
	 *
	 * @param mixed $responseDate
	 * @return feeds_FeedbacksModel
	 */
	public function &setResponseDate($responseDate) {
		$this->notifyChanged(self::FIELD_RESPONSE_DATE,$this->responseDate,$responseDate);
		$this->responseDate=$responseDate;
		return $this;
	}

	/**
	 * get value for response_date 
	 *
	 * type:timestamp,size:29,default:now(),nullable
	 *
	 * @return mixed
	 */
	public function getResponseDate() {
		return $this->responseDate;
	}

	/**
	 * set value for submission_date 
	 *
	 * type:timestamp,size:29,default:now(),nullable
	 *
	 * @param mixed $submissionDate
	 * @return feeds_FeedbacksModel
	 */
	public function &setSubmissionDate($submissionDate) {
		$this->notifyChanged(self::FIELD_SUBMISSION_DATE,$this->submissionDate,$submissionDate);
		$this->submissionDate=$submissionDate;
		return $this;
	}

	/**
	 * get value for submission_date 
	 *
	 * type:timestamp,size:29,default:now(),nullable
	 *
	 * @return mixed
	 */
	public function getSubmissionDate() {
		return $this->submissionDate;
	}

	/**
	 * set value for response 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $response
	 * @return feeds_FeedbacksModel
	 */
	public function &setResponse($response) {
		$this->notifyChanged(self::FIELD_RESPONSE,$this->response,$response);
		$this->response=$response;
		return $this;
	}

	/**
	 * get value for response 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * set value for description 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @param mixed $description
	 * @return feeds_FeedbacksModel
	 */
	public function &setDescription($description) {
		$this->notifyChanged(self::FIELD_DESCRIPTION,$this->description,$description);
		$this->description=$description;
		return $this;
	}

	/**
	 * get value for description 
	 *
	 * type:varchar,size:500,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * set value for responded_to 
	 *
	 * type:numeric,size:10,default:null,nullable
	 *
	 * @param mixed $respondedTo
	 * @return feeds_FeedbacksModel
	 */
	public function &setRespondedTo($respondedTo) {
		$this->notifyChanged(self::FIELD_RESPONDED_TO,$this->respondedTo,$respondedTo);
		$this->respondedTo=$respondedTo;
		return $this;
	}

	/**
	 * get value for responded_to 
	 *
	 * type:numeric,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRespondedTo() {
		return $this->respondedTo;
	}

	/**
	 * set value for responded_by 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @param mixed $respondedBy
	 * @return feeds_FeedbacksModel
	 */
	public function &setRespondedBy($respondedBy) {
		$this->notifyChanged(self::FIELD_RESPONDED_BY,$this->respondedBy,$respondedBy);
		$this->respondedBy=$respondedBy;
		return $this;
	}

	/**
	 * get value for responded_by 
	 *
	 * type:varchar,size:30,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRespondedBy() {
		return $this->respondedBy;
	}

	/**
	 * set value for responcedate 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @param mixed $responcedate
	 * @return feeds_FeedbacksModel
	 */
	public function &setResponcedate($responcedate) {
		$this->notifyChanged(self::FIELD_RESPONCEDATE,$this->responcedate,$responcedate);
		$this->responcedate=$responcedate;
		return $this;
	}

	/**
	 * get value for responcedate 
	 *
	 * type:varchar,size:15,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getResponcedate() {
		return $this->responcedate;
	}

	/**
	 * set value for responce 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @param mixed $responce
	 * @return feeds_FeedbacksModel
	 */
	public function &setResponce($responce) {
		$this->notifyChanged(self::FIELD_RESPONCE,$this->responce,$responce);
		$this->responce=$responce;
		return $this;
	}

	/**
	 * get value for responce 
	 *
	 * type:varchar,size:200,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getResponce() {
		return $this->responce;
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
			self::FIELD_ID=>$this->getId(),
			self::FIELD_MEMBER_NO=>$this->getMemberNo(),
			self::FIELD_CATEGORY=>$this->getCategory(),
			self::FIELD_SUBJECT=>$this->getSubject(),
			self::FIELD_RESPONSE_DATE=>$this->getResponseDate(),
			self::FIELD_SUBMISSION_DATE=>$this->getSubmissionDate(),
			self::FIELD_RESPONSE=>$this->getResponse(),
			self::FIELD_DESCRIPTION=>$this->getDescription(),
			self::FIELD_RESPONDED_TO=>$this->getRespondedTo(),
			self::FIELD_RESPONDED_BY=>$this->getRespondedBy(),
			self::FIELD_RESPONCEDATE=>$this->getResponcedate(),
			self::FIELD_RESPONCE=>$this->getResponce());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_ID=>$this->getId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of feeds_FeedbacksModel instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param feeds_FeedbacksModel $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return feeds_FeedbacksModel[]
	 */
	public static function findByExample(PDO $db,feeds_FeedbacksModel $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of feeds_FeedbacksModel instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return feeds_FeedbacksModel[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `feedbacks`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of feeds_FeedbacksModel instances
	 *
	 * @param PDOStatement $stmt
	 * @return feeds_FeedbacksModel[]
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
	 * returns the result as an array of feeds_FeedbacksModel instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return feeds_FeedbacksModel[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new feeds_FeedbacksModel();
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
	 * Execute select query and return matched rows as an array of feeds_FeedbacksModel instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return feeds_FeedbacksModel[]
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
		$sql='DELETE FROM `feedbacks`'
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
		$this->setId($result['id']);
		$this->setMemberNo($result['member_no']);
		$this->setCategory($result['category']);
		$this->setSubject($result['subject']);
		$this->setResponseDate($result['response_date']);
		$this->setSubmissionDate($result['submission_date']);
		$this->setResponse($result['response']);
		$this->setDescription($result['description']);
		$this->setRespondedTo($result['responded_to']);
		$this->setRespondedBy($result['responded_by']);
		$this->setResponcedate($result['responcedate']);
		$this->setResponce($result['responce']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return feeds_FeedbacksModel
	 */
	public static function findById(PDO $db,$id) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$id);
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
		$o=new feeds_FeedbacksModel();
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
		$stmt->bindValue(1,$this->getId());
		$stmt->bindValue(2,$this->getMemberNo());
		$stmt->bindValue(3,$this->getCategory());
		$stmt->bindValue(4,$this->getSubject());
		$stmt->bindValue(5,$this->getResponseDate());
		$stmt->bindValue(6,$this->getSubmissionDate());
		$stmt->bindValue(7,$this->getResponse());
		$stmt->bindValue(8,$this->getDescription());
		$stmt->bindValue(9,$this->getRespondedTo());
		$stmt->bindValue(10,$this->getRespondedBy());
		$stmt->bindValue(11,$this->getResponcedate());
		$stmt->bindValue(12,$this->getResponce());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getMemberNo());
			$stmt->bindValue(2,$this->getCategory());
			$stmt->bindValue(3,$this->getSubject());
			$stmt->bindValue(4,$this->getResponseDate());
			$stmt->bindValue(5,$this->getSubmissionDate());
			$stmt->bindValue(6,$this->getResponse());
			$stmt->bindValue(7,$this->getDescription());
			$stmt->bindValue(8,$this->getRespondedTo());
			$stmt->bindValue(9,$this->getRespondedBy());
			$stmt->bindValue(10,$this->getResponcedate());
			$stmt->bindValue(11,$this->getResponce());
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
			$this->setId($lastInsertId);
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
		$stmt->bindValue(13,$this->getId());
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
		$stmt->bindValue(1,$this->getId());
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
		return self::hashToDomDocument($this->toHash(), 'feeds_FeedbacksModel');
	}

	/**
	 * get single feeds_FeedbacksModel instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return feeds_FeedbacksModel
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new feeds_FeedbacksModel();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of feeds_FeedbacksModel from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return feeds_FeedbacksModel[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('feeds_FeedbacksModel') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>