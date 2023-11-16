<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Users");
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

        $this->Users->delete($element);

        $this->response($element);
    }

    //REUSABLE METHODS
    protected function getElements($options)
    {
        return $this->Users
        ->find()
        ->contain($options)
        ->toList();
    }

    protected function getElement($id, $options = []) {
        return $this->Users->get($id, $options);
    }

    protected function form($id = null) {
        $data = $this->request->getData();
        $element = $id ? $this->getElement($id) : $this->Users->newEmptyEntity();
        $element = $this->Users->patchEntity($element, $data);
        return $this->Users->save($element) ? $element : null;
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
