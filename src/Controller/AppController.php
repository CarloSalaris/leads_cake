<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public $paginate = [
        'limit' => 10,
        'order' => [
            'id' => 'asc'
        ]
    ];

    //CRUD
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


    //REUSABLE METHODS
    protected function _getElements(){

        $t = $this->name;
        return $this->{$t}
        ->find('index')
        ->find('filters')
        ->set($t, $this->paginate($this->$t))
        ->toList();
    }

    protected function _getElement($id){
        $t = $this->{$this->name};
        $tAlias = $t->getTable();
        $tAlias = str_replace('_','', $tAlias);

    return $t
        ->find('full')
        ->where([$tAlias . '.id' => $id])
        ->first();
    }

    protected function _form($id = null) {
        $t = $this->{$this->name};
        $data = $this->request->getData();
        $element = $id ? $this->_getElement($id) : $t->newEmptyEntity();
        $element = $t->patchEntity($element, $data);
        return $t->save($element) ? $element : null;
    }

    protected function _response($data){
        $extractedPagination = $this->_paginationData();

        $this->set([
            'status' => !empty($data),
            'message' => !empty($data) ? 'Success' : 'Failed',
            'data' => $data,
            'pagination' => $extractedPagination,
        ]);

        $this->viewBuilder()->setOption('serialize', ['status', 'message', 'data', 'pagination']);
    }

    protected function _paginationData() {
        $pagination = $this->request->getAttribute('paging');
        /* logd($pagination); */

        if (empty($pagination)) {
            return;
        }
        $pagination = array_values($pagination)[0];


        $paginationResponse = [
            'count' => $pagination['count'],
            'current_page' => $pagination['page'],
            'has_next_page' => $pagination['nextPage'],
            'has_prev_page' => $pagination['prevPage'],
            'limit' => $pagination['limit'],
            'page_count' => $pagination['pageCount'],
        ];

        return $paginationResponse;
    }
}
