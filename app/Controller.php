<?php

namespace App;

class Controller
{
    public function renderForm(): void
    {
        readfile(__DIR__ . '/pages/register.html');
    }

    public function register()
    {
        [$validated, $errors] = $this->validate($_POST);

        if ($validated) {
            echo json_encode(['status' => 200, 'message' => 'Successfilly registered']);
            return;
        }

        echo json_encode(['status' => 404, 'message' => implode(' ', $errors)]);
    }

    public function notFound(): void
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

    private function validate($form)
    {
        $registeredUsers = [
            [
                'id' => 1,
                'email' => 'admin@example.com',
                'first_name' => 'Admin',
                'last_name' => 'Adminov'
            ],
            [
                'id' => 2,
                'email' => 'test@example.com',
                'first_name' => 'Test',
                'last_name' => 'Testerovich'
            ]
        ];

        $notRegistered = true;
        foreach ($registeredUsers as $user) {
            if ($user['email'] === $form['email']) {
                $notRegistered = false;
                break;
            }
        }

        $validPassword = $form['password'] === $form['password_confirm'];
        $validEmail = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
        $passed = $notRegistered && $validPassword && $validEmail;

        $errors = [
            !$validEmail ? "Email is not valid!" : "",
            !$validPassword ? "Passwords do not match!" : "",
            !$notRegistered ? "Email is already used!" : ""
        ];

        Logger::writeLine([ $passed, $errors]);

        return [$passed, $errors];

    }
}