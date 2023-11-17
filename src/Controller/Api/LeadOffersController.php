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

    public function index()
    {
        $this->request->allowMethod(["get"]);

        $elements = $this->_getElements();

        $this->_response($elements);
    }
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        $element = $this->_getElement($id);

        $this->_response($element);
    }
    public function add()
    {
        $this->request->allowMethod(["post"]);

        $element = $this->_form();

        $this->_response($element);
    }

    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $element = $this->_form($id);

        $this->_response($element);
    }

    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->_getElement($id);

        $this->LeadOffers->delete($element);

        $this->_response($element);
    }
}
