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

    /* protected function _getElements(){
        $all = parent::_getElements();
        faccio cose con $all
    } */
    public function index()
    {
        $this->request->allowMethod(["get"]);

        $all = $this->_getElements();

        $this->_response($all);
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

        /** @var \App\Model\Entity\Lead $element */
        $element = $this->_form($id);
        echo($element->ragione_sociale);

        $this->_response($element);
    }

    public function delete($id)
    {
        $this->request->allowMethod(["delete"]);

        $element = $this->_getElement($id);

        $this->Leads->delete($element);

        $this->_response($element);
    }

}
