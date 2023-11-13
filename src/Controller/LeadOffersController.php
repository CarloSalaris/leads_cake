<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LeadOffers Controller
 *
 * @property \App\Model\Table\LeadOffersTable $LeadOffers
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LeadOffersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Leads'],
        ];
        $leadOffers = $this->paginate($this->LeadOffers);

        $this->set(compact('leadOffers'));
    }

    /**
     * View method
     *
     * @param string|null $id Lead Offer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $leadOffer = $this->LeadOffers->get($id, [
            'contain' => ['Leads'],
        ]);

        $this->set(compact('leadOffer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $leadOffer = $this->LeadOffers->newEmptyEntity();
        if ($this->request->is('post')) {
            $leadOffer = $this->LeadOffers->patchEntity($leadOffer, $this->request->getData());
            if ($this->LeadOffers->save($leadOffer)) {
                $this->Flash->success(__('The lead offer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lead offer could not be saved. Please, try again.'));
        }
        $leads = $this->LeadOffers->Leads->find('list', ['limit' => 200])->all();
        $this->set(compact('leadOffer', 'leads'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lead Offer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $leadOffer = $this->LeadOffers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $leadOffer = $this->LeadOffers->patchEntity($leadOffer, $this->request->getData());
            if ($this->LeadOffers->save($leadOffer)) {
                $this->Flash->success(__('The lead offer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lead offer could not be saved. Please, try again.'));
        }
        $leads = $this->LeadOffers->Leads->find('list', ['limit' => 200])->all();
        $this->set(compact('leadOffer', 'leads'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lead Offer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $leadOffer = $this->LeadOffers->get($id);
        if ($this->LeadOffers->delete($leadOffer)) {
            $this->Flash->success(__('The lead offer has been deleted.'));
        } else {
            $this->Flash->error(__('The lead offer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
