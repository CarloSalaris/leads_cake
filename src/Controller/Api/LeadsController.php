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
    }

    /* protected function _getElements(){
        $all = parent::_getElements();
        faccio cose con $all
    } */
}
