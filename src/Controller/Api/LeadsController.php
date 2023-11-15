<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Leads Controller
 *
 * @property \App\Model\Table\LeadsTable $Leads
 * @method \App\Model\Entity\Lead[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeadsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Leads");
    }

    // List leads api
    public function index()
    {
        $this->request->allowMethod(["get"]);

        $q = $this->Leads
        ->find()
        ->contain(['Users', 'Clients', 'LeadOffers']);

        if ($this->request->getQuery('notClient')) {
            $q->find('notClient');
        }
        if ($this->request->getQuery('giuridico')) {
            $q->find('giuridico');
        }
        if ($this->request->getQuery('privato')) {
            $q->find('privato');
        }
        $leads = $q->toList();

        $this->set([
            "status" => true,
            "message" => "Leads list",
            "data" => $leads,
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // View Lead
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        // Lead check
        $element = $this->Leads->get($id, [
            'contain' => ['Users', 'Clients', 'LeadOffers'],
        ]);

        $this->set([
            "status" => true,
            "message" => "Element",
            "data" => $element
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Add lead api
    public function add()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // Check if email address is provided
        if (empty($formData['email'])) {
            $status = false;
            throw new \Exception("Email address is required");
        } else {
            // insert new lead
            $element = $this->Leads->newEmptyEntity();

            $element = $this->Leads->patchEntity($element, $formData);

            if ($this->Leads->save($element)) {
                // success response
                $status = true;
                $message = "Element has been created";
            } else {
                // error response
                $status = false;
                $message = "Failed to create element";
            }
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update lead
    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $Info = $this->request->getData();

        /* $id = $this->request->getParam("id"); */

        // lead check
        $element = $this->Leads->get($id);

        if (!empty($element)) {
            // leads exists
            $element = $this->Leads->patchEntity($element, $Info);

            if ($this->Leads->save($element)) {
                // success response
                $status = true;
                $message = "Element has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update element";
            }
        } else {
            // lead not found
            $status = false;
            $message = "Element Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete lead api
    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        /* $emp_id = $this->request->getParam("id"); */

        $element = $this->Leads->get($id);

        if (!empty($element)) {
            // lead found
            if ($this->Leads->delete($element)) {
                // lead deleted
                $status = true;
                $message = "Element has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete element";
            }
        } else {
            // not found
            $status = false;
            $message = "Element doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
