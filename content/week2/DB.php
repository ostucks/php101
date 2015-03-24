<?php

	class DB {

		/**
		 * @var PDO|null
		 */
		private $instance = null;

		/**
		 * @return null
		 */
		public function __construct() {
			$return	= null;

			// This is a throw-away database.
			$host	= 'chs.co9ebck865py.us-west-2.rds.amazonaws.com';
			$user	= 'chs';
			$pass	= 'chspassword';
			$db		= 'chs';

			try {
				$this->instance = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
			} catch (PDOException $PDOException) {
				# We don't have real logging. Just do something loud.
				echo $PDOException->getMessage();
				die;
			}
		}

		/**
		 * @var		int
		 * @return	array
		 */
		public function getPosts($limit = 10) {
			$limit	= (int) $limit;
			$result	= array ();

			if ($this->instance !== null) {
				$sth = $this->instance->prepare("SELECT * FROM `blogs` LIMIT :limit");

				$sth->bindValue(':limit', $limit, PDO::PARAM_INT);
				
				if ($sth->execute()) {
					$result = $sth->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$result['errorMsg'] = 'An error occurred.';
				}
			}	

			return $result;
		}

		/**
		 * @var		string
		 * @var		string
		 * @return	int
		 */
		public function addPost($title = '', $body = '') {
			$return	= 0;
			$title	= (string) $title;
			$body	= (string) $body;

			if ($this->instance !== null) {
				$sth = $this->instance->prepare("INSERT INTO `blogs` (`title`,`body`,`createdAt`) VALUES (:title,:body,:created_at)");

				$sth->bindValue(':title', $title);
				$sth->bindValue(':body', $body);
				$sth->bindValue(':created_at', time());

				if ($sth->execute()) {
					// This is a database implementation! Careful with PDO fancy driver support.
					$return = (int) $this->instance->lastInsertId();
				}
			}

			return $return;
		}

	}