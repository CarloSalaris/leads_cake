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

        $this->Clients->delete($element);

        $this->response($element);
    }

    //REUSABLE METHODS
    protected function getElements($options)
    {
        return $this->Clients
        ->find()
        ->contain($options)
        ->toList();
    }

    protected function getElement($id, $options = []) {
        return $this->Clients->get($id, $options);
    }

    protected function form($id = null) {
        $data = $this->request->getData();
        $element = $id ? $this->getElement($id) : $this->Clients->newEmptyEntity();
        $element = $this->Clients->patchEntity($element, $data);
        return $this->Clients->save($element) ? $element : null;
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
