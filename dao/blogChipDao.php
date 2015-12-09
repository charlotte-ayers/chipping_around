<?php

/**
 * Description of FlightBookingDao
 *
 * @author richard_lovell
 */
class BlogChipDao {

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

    public function insert(BlogChip $blogChip) {
        //needs changing
        //$now = new DateTime();
        $blogChip->setId(null);
        //$flightBooking->setCreatedOn($now);
        //$flightBooking->setLastModifiedOn($now);
        $blogChip->setStatus(SimpleBlogPost::PENDING);
        $sql = '
                INSERT INTO blog_chip (chip_colour, chip_crunch, chip_condiments, chip_consistency, chip_cash, chip_charisma)
                VALUES (:chip_colour, :chip_crunch, :chip_condiments, :chip_consistency, :chip_cash, :chip_charisma)';
        return $this->execute($sql, $blogChip);
    }

    /**
     * @return Todo
     * @throws Exception
     */
        private function update(BlogChip $blogChip) {
        //$todo->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE blog_chip SET
                chip_colour = :chip_colour,
                chip_crunch = :chip_crunch,
                chip_condiments = :chip_condiments,
                chip_consistency = :chip_consistency,
                chip_cash = :chip_cash,
                chip_charisma = :chip_charisma
            WHERE
            blog_id = :blog_id';
        return $this->execute($sql, $blogChip);
    }

    public function save(BlogChip $blogChip) {
        if ($blogChip->getId() !== null) {
            $this->update($blogChip);
        } else {
            $this->insert($blogChip);
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
        $blogChip = new BlogChip();
        BlogChipMapper::map($blogChip, $row);
        return $blogChip;
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
            $blogPost = new SimpleBlogPost();
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
    private function execute($sql, BlogChip $blogChip) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($blogChip));
        if (!$blogChip->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('BlogPost with ID "' . $blogChip->getId() . '" does not exist.');
        }
        return $blogChip;
    }

    private function getParams(BlogChip $blogChip) {
        $params = array(
            ':chip_colour' => $blogChip->getChipColour(),
            ':chip_crunch' => $blogChip->getChipCrunch(),
            ':chip_consistency' => $blogChip->getChipConsistency(),
            ':chip_condiments' => $blogChip->getChipCondiments(),
            ':chip_cash' => $blogChip->getChipCash(),
            ':chip_charisma' => $blogChip->getChipCharisma()
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
