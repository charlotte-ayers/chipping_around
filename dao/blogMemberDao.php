<?php

/**
 * Description of FlightBookingDao
 *
 * @author richard_lovell
 */
class BlogMemberDao {

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

    public function insert(BlogMember $blogMember) {
        //needs changing
        //$now = new DateTime();
        $blogMember->setId(null);
        //$flightBooking->setCreatedOn($now);
        //$flightBooking->setLastModifiedOn($now);
//        $blogPost->setStatus(SimpleBlogPost::PENDING);
        $sql = '
            INSERT INTO blog_member (member_id, username, email, password)
                VALUES (:member_id, :username, :email, :password)';
        return $this->execute($sql, $blogMember);
    }

    /**
     * @return Todo
     * @throws Exception
     */
    private function update(BlogMember $blogMember) {
        //$todo->setLastModifiedOn(new DateTime());
        $sql = '
            UPDATE blog_member SET
                username = :username,
                email = :email,
                password = :password,
            WHERE
                member_id = :member_id';
        return $this->execute($sql, $blogMember);
    }

    public function save(BlogMember $blogMember) {
        if ($blogMember->getId() !== null) {
            $this->update($blogMember);
        } else {
            $this->insert($blogMember);
        }
    }
     public function enter(BlogMember $blogMember) {
    $username = $_POST[ 'username' ];
$password = $_POST[ 'password' ];
$sql = "SELECT username FROM blog_member WHERE username=:username";
     }  
    /**
     * Find {@link Todo} by identifier.
     * @return Todo Todo or <i>null</i> if not found
     */
    public function findById($member_id) {
        $row = $this->query('SELECT * FROM blog_member WHERE member_id = ' . (int) $member_id)->fetch();
        if (!$row) {
            return null;
        }
        $blogMember = new BlogMember();
        BlogMemberMapper::map($blogMember, $row);
        return $blogMember;
    }

    /**
     * Find all {@link FlightBooking}s by search criteria.
     * @return array array of {@link FlightBooking}s
     */
    public function find($username = null) {
        $result = array();
        $sql = 'SELECT username, password'
                . ' FROM blog_member'
                . 'WHERE username = "' . $username . '";';
//                $sql = 'SELECT b.date, b.description, r.restaurant_id, r.name_of_restaurant, r.overall_rating'
//                . ' FROM blog_posts b, blog_restaurant r '
//                . 'WHERE r.restaurant_id = b.restaurant_id AND b.status = "' . $status . '";';
        foreach ($this->query($sql) as $row) {
            $blogMember = new BlogMember();
            BlogMemberMapper::map($blogMember, $row);
            $result[$blogMember->getId()] = $blogMember;
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
    private function execute($sql, BlogMember $blogMember) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($blogMember));
        if (!$blogMember->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('BlogMember with ID "' . $blogMember->getId() . '" does not exist.');
        }
        return $blogMember;
    }

    private function getParams(BlogMember $blogMember) {
        $params = array(
            ':member_id' => $blogMember->getId(),
            ':username' => $blogMember->getUsername(),
            ':email' => $blogMember->getEmail(),
            ':password' => $blogMember->getPassword()
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

}
