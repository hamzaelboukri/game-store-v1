<?php
namespace account;

use Vendor\GameStore\Database;

class Account {
    private $email;
    private $STATUSE;
    private $Delete_at;

    public function __construct() {
        $this->email = $email;
        $this->STATUSE = $STATUSE;
        $this->STATUSE = $Delete_at;

    }









    public function aficher() {
        try {
            $db = Database::getConnection();
            $sql = "SELECT email, STATUSE FROM users";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            
            $accounts = $stmt->fetchAll();//2D array
            
            $data = [];
            foreach ($accounts as $account) {
                // Store each account's data in array
                $data[] = [
                    'email' => $account['email'],
                    'STATUSE' => $account['STATUSE']
                ];
            }
            
            return $data;

        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}