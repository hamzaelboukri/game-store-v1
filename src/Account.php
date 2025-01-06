<?php
namespace Vendor\GameStore;

class Account {
    private $id;
    private $email;
    private $STATUSE;
    private $Delete_at;

    public function __construct($id, $email, $STATUSE, $Delete_at) {
        $this->id = $id;
        $this->email = $email;
        $this->STATUSE = $STATUSE;
        $this->Delete_at = $Delete_at;
    }

    public function updateStatus($newStatus) {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE users SET STATUSE = ? WHERE id = ?");
            return $stmt->execute([$newStatus, $this->id]);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function renderRow() {
        return "<tr>
            <td>{$this->email}</td>
            <td>{$this->STATUSE}</td>
            <td>
                <form method='POST' style='display: inline;'>
                    <input type='hidden' name='account_id' value='{$this->id}'>
                    <input type='hidden' name='new_status' value='" . 
                    ($this->STATUSE === 'ACTIVE' ? 'desective' : 'ACTIVE') . "'>
                    <button type='submit' class='" . 
                    ($this->STATUSE === 'ACTIVE' ? 'deactivate-btn' : 'activate-btn') . "'>
                    " . ($this->STATUSE === 'ACTIVE' ? 'Deactivate' : 'Activate') . "
                    </button>
                </form>
            </td>
        </tr>";
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

    public static function handleStatusUpdate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['account_id']) && isset($_POST['new_status'])) {
            $account = self::getAccountById($_POST['account_id']);
            if ($account) {
                return $account->updateStatus($_POST['new_status']);
            }
        }
        return false;
    }

    private static function getAccountById($id) {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT * FROM users WHERE id = ? AND deleted_at IS NULL");
            $stmt->execute([$id]);
            $account = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            return $account ? new Account(
                $account['id'],
                $account['email'],
                $account['STATUSE'],
                $account['deleted_at']
            ) : null;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }
}