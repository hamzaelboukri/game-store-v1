<?php
namespace Vendor\GameStore;


class Account {
    private $id;
    private $email;
    private $STATUSE;
    private $Delete_at;

    public function __construct($id , $email , $STATUSE , $Delete_at) {
        $this->id = $id; 
        $this->email = $email;
        $this->STATUSE = $STATUSE;
        $this->Delete_at = $Delete_at;

    }

    public function getteid(){
          
    return $this->$id;
         
    }   

     public function  geteEmail(){
   return $this-> $email;

    }

    public function getteSatutse(){
return $this-> $STATUSE;

    }


    public function getteDateDelet(){
        return $this-> $Delete_at;
}



public function __destruct()
{
    echo "account object is destroyed\n";
}

public function renderRow() {
    $STATUSEButton = $this->STATUSE === 'ACTIVE' ? 
        "<button class='btn-deactivate' onclick='updateSTATUSE($this->id, \"desective\")'>Deactivate</button>" :
        "<button class='btn-activate' onclick='updateSTATUSE($this->id, \"ACTIVE\")'>Activate</button>";

    return "<tr>
                <td>$this->email</td>
               
                <td>$this->STATUSE</td>
                <td>
                    $STATUSEButton

                    
                    <a href='/accounts/edit.php?id=$this->id'>Edit</a>
                    <a href='/accounts/delete.php?id=$this->id'>Delete</a>
                </td>
            </tr>";
            var_dump($STATUSEButton);
}


public static function getAccounts() {
    try {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE deleted_at IS NULL");
        $stmt->execute();
        $accounts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $accountObjects = [];
        foreach ($accounts as $account) {
            $accountObjects[] = new Account(
                $account['id'],
                $account['email'],
                $account['STATUSE'],
                $account['deleted_at']
            );
        }
        
        return $accountObjects;
    } catch (\PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}

}