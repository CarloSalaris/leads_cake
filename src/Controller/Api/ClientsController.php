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

        $elements = $this->getElements('Clients', ['Leads']);

        $this->response($elements);
    }
    public function view($id)
    {
        $this->request->allowMethod(["get"]);

        $element = $this->getElement('Clients', $id, ['contain' => ['Leads']]);

        $this->response($element);
    }
    public function add()
    {
        $this->request->allowMethod(["post"]);

        $element = $this->form('Clients');

        $this->response($element);
    }

    public function edit($id)
    {
        $this->request->allowMethod(["put", "post"]);

        $element = $this->form('Clients', $id);

        $this->response($element);
    }

    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->getElement('Clients', $id);

        $this->Clients->delete($element);

        $this->response($element);
    }
}
