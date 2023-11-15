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

        $elements = $this->Users->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "Users list",
            "data" => $elements
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // View User
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        // User check
        $element = $this->Users->get($id, [
            'contain' => ['Leads'],
        ]);

        $this->set([
            "status" => true,
            "message" => "Element",
            "data" => $element
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
        $element = $this->Users->newEmptyEntity();

        $element = $this->Users->patchEntity($element, $formData);

        if ($this->Users->save($element)) {
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
    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $formData = $this->request->getData();

        // User check
        $element = $this->Users->get($id);

        if (!empty($element)) {
            // Users exists
            $element = $this->Users->patchEntity($element, $formData);

            if ($this->Users->save($element)) {
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
    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->Users->get($id);

        if (!empty($element)) {
            // User found
            if ($this->Users->delete($element)) {
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
