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

        $elements = $this->LeadOffers->find()
        ->contain(['Leads'])
        ->toList();

        $this->set([
            "status" => true,
            "message" => "LeadOffers list",
            "data" => $elements
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    // View LeadOffer
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        // LeadOffer check
        $element = $this->LeadOffers->get($id, [
            'contain' => ['Leads'],
        ]);

        $this->set([
            "status" => true,
            "message" => "Element",
            "data" => $element
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
        $element = $this->LeadOffers->newEmptyEntity();

        $element = $this->LeadOffers->patchEntity($element, $formData);

        if ($this->LeadOffers->save($element)) {
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
    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $formData = $this->request->getData();

        // LeadOffer check
        $element = $this->LeadOffers->get($id);

        if (!empty($element)) {
            // LeadOffers exists
            $element = $this->LeadOffers->patchEntity($element, $formData);

            if ($this->LeadOffers->save($element)) {
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
    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->LeadOffers->get($id);

        if (!empty($element)) {
            // LeadOffer found
            if ($this->LeadOffers->delete($element)) {
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
