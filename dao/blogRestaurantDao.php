<?php

/**
 * Description of FlightBookingDao
 *
 * @author richard_lovell
 */
class BlogRestaurantDao {

    private $db = null;

    public function __destruct() {
        $this->db = null;
    }

    function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig('db');
        try {
            $this->db = new PDO($config['dsn'], $config['username'], $config['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error:' . $ex->getMessage());
        }
        return $this->db;
    }

    public function insert(BlogRestaurant $blogRestaurant) {
        //needs changing
        //$now = new DateTime();
        $blogRestaurant->setId(null);
        //$flightBooking->setCreatedOn($now);
        //$flightBooking->setLastModifiedOn($now);
        $blogRestaurant->setStatus(BlogPost::PENDING);
        $sql = '
                INSERT INTO blog_restaurant (name_of_restaurant, overall_rating)
                VALUES (:name_of_restaurant, :overall_rating)';
        return $this->execute($sql, $blogRestaurant);
    }

    /**
     * @return Todo
     * @throws Exception
     */
        private function update(BlogRestaurant $blogRestaurant) {
        //$todo->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE blog_restaurant SET
                name_of_restaurant = :name_of_restaurant
                overall_rating = :overall_rating
            WHERE
            blog_id = :blog_id';
        return $this->execute($sql, $blogRestaurant);
    }

    public function save(BlogRestaurant $blogRestaurant) {
        if ($blogRestaurant->getId() !== null) {
            $this->update($blogRestaurant);
        } else {
            $this->insert($blogRestaurant);
        }
    }

    /**
     * Find {@link Todo} by identifier.
     * @return Todo Todo or <i>null</i> if not found
     */
    public function findById($id) {
        $row = $this->query('SELECT * FROM blog_posts WHERE blog_id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $blogRestaurant = new BlogRestaurant();
        BlogRestaurantMapper::map($blogRestaurant, $row);
        return $blogRestaurant;
    }

    /**
     * Find all {@link FlightBooking}s by search criteria.
     * @return array array of {@link FlightBooking}s
     */
    public function find($status = null) {
        $result = array();
        $sql = 'SELECT blog_id, date FROM blog_posts WHERE '
                . 'status = "'.$status.'";';
        foreach ($this->query($sql) as $row) {
            $blogPost = new BlogPost();
            BlogPostMapper::map($blogPost, $row);
            $result[$blogPost->getId()] = $blogPost;
        }
        return $result;
    }

    /**
     * @return PDOStatement
     */
    private function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }

    /**
     * @return FlightBooking
     * @throws Exception
     */
    private function execute($sql, BlogRestaurant $blogRestaurant) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($blogRestaurant));
        if (!$blogRestaurant->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('BlogPost with ID "' . $blogRestaurant->getId() . '" does not exist.');
        }
        return $blogRestaurant;
    }

    private function getParams(BlogRestaurant $blogRestaurant) {
        $params = array(
            ':name_of_restaurant' => $blogRestaurant->getNameOfRestaurant(),
            ':overall_rating' => $blogRestaurant->getOverallRating()
        );
//        if ($flightBooking->getId()) {
//            // unset created date, this one is never updated
//            unset($params[':created_on']);
//        }
        return $params;
    }

    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }

    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }
}
