<?php

class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($data) {
        if(!isset($data['username']) || !isset($data['password'])) {
            return json_encode(['success' => false, 'message' => 'Username and password are required.']);
        }

        $user = $this->userModel->login($data['username'], $data['password']);
        if($user) {
            return json_encode(['success' => true, 'user' => $user]);
        } else {
            return json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
    }
}

?>
