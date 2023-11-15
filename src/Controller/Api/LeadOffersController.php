<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * LeadOffers Controller
 *
 * @property \App\Model\Table\LeadOffersTable $LeadOffers
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeadOffersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("LeadOffers");
    }

    // List LeadOffers api
    public function index()
    {
        $this->request->allowMethod(["get"]);

        $leadOffers = $this->LeadOffers->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "LeadOffers list",
            "data" => $leadOffers
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // Add LeadOffer api
    public function add()
    {
        $this->request->allowMethod(["post"]);

        // form data
        $formData = $this->request->getData();

        // insert new LeadOffer
        $leadOffersObject = $this->LeadOffers->newEmptyEntity();

        $leadOffersObject = $this->LeadOffers->patchEntity($leadOffersObject, $formData);

        if ($this->LeadOffers->save($leadOffersObject)) {
            // success response
            $status = true;
            $message = "LeadOffer has been created";
        } else {
            // error response
            $status = false;
            $message = "Failed to create leadOffer";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Update LeadOffer
    public function edit()
    {
        $this->request->allowMethod(["put", "post"]);

        $emp_id = $this->request->getParam("id");

        $leadOfferInfo = $this->request->getData();

        // LeadOffer check
        $leadOffer = $this->LeadOffers->get($emp_id);

        if (!empty($leadOffer)) {
            // LeadOffers exists
            $leadOffer = $this->LeadOffers->patchEntity($leadOffer, $leadOfferInfo);

            if ($this->LeadOffers->save($leadOffer)) {
                // success response
                $status = true;
                $message = "LeadOffer has been updated";
            } else {
                // error response
                $status = false;
                $message = "Failed to update leadOffer";
            }
        } else {
            // LeadOffer not found
            $status = false;
            $message = "LeadOffer Not Found";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    // Delete LeadOffer api
    public function delete()
    {
        $this->request->allowMethod(["delete"]);

        $emp_id = $this->request->getParam("id");

        $leadOffer = $this->LeadOffers->get($emp_id);

        if (!empty($leadOffer)) {
            // LeadOffer found
            if ($this->LeadOffers->delete($leadOffer)) {
                // LeadOffer deleted
                $status = true;
                $message = "LeadOffer has been deleted";
            } else {
                // failed to delete
                $status = false;
                $message = "Failed to delete leadOffer";
            }
        } else {
            // not found
            $status = false;
            $message = "LeadOffer doesn't exists";
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

}
