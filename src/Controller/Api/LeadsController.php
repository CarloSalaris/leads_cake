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

    public function index()
    {
        $this->request->allowMethod(["get"]);

        $elements = $this->getElements(['Users', 'Clients', 'LeadOffers']);

        $this->response($elements);
    }

    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        $element = $this->getElement($id, ['contain' => ['Users', 'Clients', 'LeadOffers']]);

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

        $this->Leads->delete($element);

        $this->response($element);
    }

    //REUSABLE METHODS
    protected function getElements($options)
    {
        $q = $this->Leads
        ->find()
        ->contain($options);

        if ($this->request->getQuery('notClient')) {
            $q->find('notClient');
        }
        if ($this->request->getQuery('giuridico')) {
            $q->find('giuridico');
        }
        if ($this->request->getQuery('privato')) {
            $q->find('privato');
        }
        return $q->toList();
    }

    protected function getElement($id, $options = []) {
        return $this->Leads->get($id, $options);
    }

    protected function form($id = null) {
        $data = $this->request->getData();
        $element = $id ? $this->getElement($id) : $this->Leads->newEmptyEntity();
        $element = $this->Leads->patchEntity($element, $data);
        return $this->Leads->save($element) ? $element : null;
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
