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

        $elements = $this->getElements(['Leads']);

        $this->response($elements);
    }
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        $element = $this->getElement($id, ['contain' => ['Leads']]);

        $this->response($element);
    }
    public function add()
    {
        $this->request->allowMethod(["post"]);

        $element = $this->form();

        $this->response($element);
    }

    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $element = $this->form($id);

        $this->response($element);
    }

    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->getElement($id);

        $this->LeadOffers->delete($element);

        $this->response($element);
    }

    //REUSABLE METHODS
    protected function getElements($options)
    {
        return $this->LeadOffers
        ->find()
        ->contain($options)
        ->toList();
    }

    protected function getElement($id, $options = []) {
        return $this->LeadOffers->get($id, $options);
    }

    protected function form($id = null) {
        $data = $this->request->getData();
        $element = $id ? $this->getElement($id) : $this->LeadOffers->newEmptyEntity();
        $element = $this->LeadOffers->patchEntity($element, $data);
        return $this->LeadOffers->save($element) ? $element : null;
    }

    protected function response($data){

        $this->set([
            'status' => !empty($data),
            'message' => !empty($data) ? 'Success' : 'Failed',
            'data' => $data
        ]);

        $this->viewBuilder()->setOption('serialize', ['status', 'message', 'data']);
    }

}
