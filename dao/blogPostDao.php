<?php

/**
 * Description of FlightBookingDao
 *
 * @author richard_lovell
 */
class BlogPostDao {

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

    public function insert(BlogPost $blogPost) {
        //needs changing
        //$now = new DateTime();
        $blogPost->setId(null);
        //$flightBooking->setCreatedOn($now);
        //$flightBooking->setLastModifiedOn($now);
        $blogPost->setStatus(BlogPost::PENDING);
        $sql = '
            INSERT INTO blog_posts (blog_id, status, date, content, description, created_by, modified_by)
                VALUES (:blog_id, :status, :date, :content, :description, :created_by, :modified_by)';
        return $this->execute($sql, $blogPost);
    }

    /**
     * @return Todo
     * @throws Exception
     */
    private function update(BlogPost $blogPost) {
        //$todo->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE blog_posts SET
                status = :status,
                date = :date,
                content = :content
                description = :description
                created_by = :created_by
                modified_by = :modified_by
            WHERE
                blog_id = :blog_id';
        return $this->execute($sql, $blogPost);
    }

    public function save(BlogPost $blogPost) {
        if ($blogPost->getId() !== null) {
            $this->update($blogPost);
        } else {
            $this->insert($blogPost);
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
        $blogPost = new BlogPost();
        BlogPostMapper::map($blogPost, $row);
        return $blogPost;
    }

    /**
     * Find all {@link FlightBooking}s by search criteria.
     * @return array array of {@link FlightBooking}s
     */
    public function find($status = null) {
        $result = array();
        $sql = 'SELECT b.date, b.description, b.created_by, r.restaurant_id, r.name_of_restaurant, r.overall_rating, m.username'
                . ' FROM blog_posts b, blog_restaurant r, blog_member m '
                . 'WHERE r.restaurant_id = b.restaurant_id AND m.username = b.created_by AND b.status = "' . $status . '";';
//                $sql = 'SELECT b.date, b.description, r.restaurant_id, r.name_of_restaurant, r.overall_rating'
//                . ' FROM blog_posts b, blog_restaurant r '
//                . 'WHERE r.restaurant_id = b.restaurant_id AND b.status = "' . $status . '";';
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
    private function execute($sql, BlogPost $blogPost) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($blogPost));
        if (!$blogPost->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('BlogPost with ID "' . $blogPost->getId() . '" does not exist.');
        }
        return $blogPost;
    }

    private function getParams(BlogPost $blogPost) {
        $params = array(
            ':blog_id' => $blogPost->getId(),
            ':status' => $blogPost->getStatus(),
            ':date' => self::formatDateTime($blogPost->getDate()),
            ':content' => $blogPost->getContent(),
            ':description' => $blogPost->getDescription(), 
            ':created_by' => $blogPost->getCreatedBy(),
            ':modified_by' => $blogPost->getModifiedBy()
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
