<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Lead Controller
 *
 */
class LeadsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Leads");
    }

    // List leads api
    public function listLeads()
    {
        $this->request->allowMethod(["get"]);

        $leads = $this->Leads->find()
        ->contain(['Clients', 'LeadOffers'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "Leads list",
            "data" => $leads
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Add lead api
    public function addLead()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // Check if email address is provided
        if (empty($formData['email'])) {
            $status = false;
            $message = "Email address is required";
        } else {
            // Check if email address already exists
            $existingLead = $this->Leads->findByEmail($formData['email'])->first();

            if (!empty($existingLead)) {
                // already exists
                $status = false;
                $message = "Email address already exists";
            } else {
                // insert new lead
                $leadsObject = $this->Leads->newEmptyEntity();

                $leadsObject = $this->Leads->patchEntity($leadsObject, $formData);

                if ($this->Leads->save($leadsObject)) {
                    // success response
                    $status = true;
                    $message = "Lead has been created";
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to create lead";
                }
            }
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update lead
    public function updateLead()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $leadInfo = $this->request->getData();

        // lead check
        $lead = $this->Leads->get($emp_id);

        if (!empty($lead)) {
            // leads exists
            $lead = $this->Leads->patchEntity($lead, $leadInfo);

            if ($this->Leads->save($lead)) {
                // success response
                $status = true;
                $message = "Lead has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update lead";
            }
        } else {
            // lead not found
            $status = false;
            $message = "Lead Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete lead api
    public function deleteLead()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $lead = $this->Leads->get($emp_id);

        if (!empty($lead)) {
            // lead found
            if ($this->Leads->delete($lead)) {
                // lead deleted
                $status = true;
                $message = "Lead has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete lead";
            }
        } else {
            // not found
            $status = false;
            $message = "Lead doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
