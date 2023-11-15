<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $clients
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

        $clients = $this->Clients->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "Clients list",
            "data" => $clients
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
        $clientsObject = $this->Clients->newEmptyEntity();

        $clientsObject = $this->Clients->patchEntity($clientsObject, $formData);

        if ($this->Clients->save($clientsObject)) {
            // success response
            $status = true;
            $message = "Client has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create Client";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update Client
    public function edit()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $clientInfo = $this->request->getData();

        // Client check
        $client = $this->Clients->get($emp_id);

        if (!empty($client)) {
            // Clients exists
            $client = $this->Clients->patchEntity($client, $clientInfo);

            if ($this->Clients->save($client)) {
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
    public function delete()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $client = $this->Clients->get($emp_id);

        if (!empty($client)) {
            // Client found
            if ($this->Clients->delete($client)) {
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
