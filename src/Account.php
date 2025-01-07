<?php
namespace Vendor\GameStore;

 class Account {
    private $id;
    private $email;
    private $status; 
    private $Delete_at;

    public function __construct($id, $email, $status, $Delete_at) {
        $this->id = $id;
        $this->email = $email;
        $this->status = $status;
        $this->Delete_at = $Delete_at;
    }
    
    public function renderRow() {
        return "<tr>
                    <td>{$this->email}</td>
                    <td>{$this->status}</td>
                    <td>
                        <form method='POST' style='display: inline;'>
                            <input type='hidden' name='id' value='{$this->id}'>
                            <input type='hidden' name='status' value='" . ($this->status === 'INACTIVE' ? 'ACTIVE' : 'INACTIVE') . "'>
                            <button type='submit' class='btn " . 
                            ($this->status === 'INACTIVE' ? 'btn-danger' : 'btn-success') . " btn-sm'>" . 
                            ($this->status === 'INACTIVE' ? 'Deactivate' : 'Activate') . "</button>
                        </form>
                    </td>
                </tr>";
    }

    public static function getAccounts() {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE deleted_at IS NULL");
        $stmt->execute();
        $accounts = [];
        
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $account) {
            $accounts[] = new Account(
                $account['id'],
                $account['email'],
                $account['status'], 
                $account['deleted_at']
            );
        }
        return $accounts;
    }

    public static function updateStatus($id, $status) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users SET status = ? WHERE id = ?"); 
        return $stmt->execute([$status, $id]);
    }
}


?>