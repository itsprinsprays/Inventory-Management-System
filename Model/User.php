<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function employeeExists($employee_id) {
        $stmt = $this->conn->prepare("SELECT employee_id FROM employee WHERE employee_id = ?");
        $stmt->execute([$employee_id]);
        return $stmt->fetch() !== false;
    }

    public function register($Password, $Role, $Employee_id) {
    if (!$this->employeeExists($Employee_id)) {
        return 'invalid_employee';
    }

    $email = $this->getEmployeeEmail($Employee_id);
    if (!$email) {
        return 'no_email';
    }

    if ($this->usernameExists($email)) {
        return 'already_registered';
    }

    $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

    $stmt = $this->conn->prepare(      // ← was $this->db
        "INSERT INTO user (username, password, role, Employee_id) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$email, $hashedPassword, $Role, $Employee_id]);

    return 'success';
}

private function getEmployeeEmail($Employee_id) {
    $stmt = $this->conn->prepare("SELECT email FROM employee WHERE Employee_id = ?");  // ← was $this->db, "employees"
    $stmt->execute([$Employee_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['email'] ?? null;
}

private function usernameExists($username) {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM user WHERE username = ?");  // ← was $this->db, "users"
    $stmt->execute([$username]);
    return $stmt->fetchColumn() > 0;
}


    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUser() {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  public function updateRole($employee_id, $role) {
    $stmt = $this->conn->prepare("UPDATE user SET role = ? WHERE Employee_id = ?");
    $stmt->execute([$role, $employee_id]);
    return $stmt->rowCount() > 0;
}
}
?>