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

        $this->Users->delete($element);

        $this->_response($element);
    }

}
