<?php

class Config{
    private static $data = null;
    
    private static function getData(){
        if(self::$data !== null){
            return self::$data;
        }
        self::$data = parse_ini_file('../config/config.ini',true);
        return self::$data;
    }
    
     /**
     * @return array
     * @throws Exception
     */
    public static function getConfig($section = null) {
        if ($section === null) {
            return self::getData();
        }
        $data = self::getData();
        if (!array_key_exists($section, $data)) {
            throw new Exception('Unknown config section: ' . $section);
        }
        return $data[$section];
    }
}
////include the member class, pass in the database connection
//include('classes/memberDao.php');
//include('classes/phpmailer/mail.php');
//$member = new Member($db);