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

        $this->Clients->delete($element);

        $this->_response($element);
    }
}
