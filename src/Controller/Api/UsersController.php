<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Users");
    }

    // List Users api
    public function index()
    {
        $this->request->allowMethod(["get"]);

        $users = $this->Users->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "Users list",
            "data" => $users
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Add User api
    public function add()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // insert new User
        $usersObject = $this->Users->newEmptyEntity();

        $usersObject = $this->Users->patchEntity($usersObject, $formData);

        if ($this->Users->save($usersObject)) {
            // success response
            $status = true;
            $message = "User has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create user";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update User
    public function edit()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $userInfo = $this->request->getData();

        // User check
        $user = $this->Users->get($emp_id);

        if (!empty($user)) {
            // Users exists
            $user = $this->Users->patchEntity($user, $userInfo);

            if ($this->Users->save($user)) {
                // success response
                $status = true;
                $message = "User has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update user";
            }
        } else {
            // User not found
            $status = false;
            $message = "User Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete User api
    public function delete()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $user = $this->Users->get($emp_id);

        if (!empty($user)) {
            // User found
            if ($this->Users->delete($user)) {
                // User deleted
                $status = true;
                $message = "User has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete user";
            }
        } else {
            // not found
            $status = false;
            $message = "User doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
