<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Clients");
    }

    // List clients api
    public function index()
    {
        $this->request->allowMethod(["get"]);

        $elements = $this->Clients
        ->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "Elements list",
            "data" => $elements
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // View Client
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        // Client check
        $element = $this->Clients->get($id, [
            'contain' => ['Leads'],
        ]);

        $this->set([
            "status" => true,
            "message" => "Element",
            "data" => $element
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Add Client api
    public function add()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // insert new Client
        $element = $this->Clients->newEmptyEntity();

        $element = $this->Clients->patchEntity($element, $formData);

        if ($this->Clients->save($element)) {
            // success response
            $status = true;
            $message = "Element has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create element";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update Client
    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        /* $emp_id = $this->request->getParam("id"); */

        $formData = $this->request->getData();

        // Client check
        $element = $this->Clients->get($id);

        if (!empty($element)) {
            // Clients exists
            $element = $this->Clients->patchEntity($element, $formData);

            if ($this->Clients->save($element)) {
                // success response
                $status = true;
                $message = "Client has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update Client";
            }
        } else {
            // Client not found
            $status = false;
            $message = "Client Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete Client api
    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        /* $id = $this->request->getParam("id"); */

        $element = $this->Clients->get($id);

        if (!empty($element)) {
            // Client found
            if ($this->Clients->delete($element)) {
                // Client deleted
                $status = true;
                $message = "Client has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete Client";
            }
        } else {
            // not found
            $status = false;
            $message = "Client doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
