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
    }
}
