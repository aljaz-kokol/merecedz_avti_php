<?php
class AuthController extends Controller {
    public function showLogin($error = null) {
        $this->view('auth/login', ['error' => $error]);
    }

    public function login() {
        if (isset($_POST['username'], $_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = NrsDatabase::loginUser($username, $password);
            if ($result === true) {
                $this->redirect('/');
            } else {
                $this->showLogin($result);
            }
        }
        $this->showLogin("Please fill in the form");
    }

    public function register($error = null) {
        $this->view('auth/register', ['error' => $error]);
    }

    public function store() {
        $result = NrsDatabase::registerUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['c_password']);
        if ($result === true) {
            $this->redirect('/');
        } else {
            $this->register($result);
        }
    }

    public function signOut() {
        session_destroy();
        unset($_SESSION['username']);
        $this->redirect('/');
    }
}