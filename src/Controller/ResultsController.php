<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 */
class ResultsController extends AppController
{
    /**
     * Index method - List results for a specific sample
     *
     * @param string|null $sampleId Sample id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($sampleId = null)
    {
        if ($sampleId) {
            $query = $this->Results->find()
                ->contain(['Samples'])
                ->where(['Results.sample_id' => $sampleId])
                ->orderBy(['Results.created' => 'DESC']);
        } else {
            $query = $this->Results->find()
                ->contain(['Samples'])
                ->orderBy(['Results.created' => 'DESC']);
        }
        
        $results = $this->paginate($query);

        $this->set(compact('results', 'sampleId'));
    }

    /**
     * View method - View result details
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $result = $this->Results->get($id, contain: ['Samples']);

        $this->set(compact('result'));
    }

    /**
     * Add method - Add new result
     *
     * @param string|null $sampleId Sample id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($sampleId = null)
    {
        $result = $this->Results->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            
            if ($this->Results->save($result)) {
                $this->Flash->success(__('El resultado ha sido guardado.'));

                return $this->redirect(['action' => 'index', $result->sample_id]);
            }
            $this->Flash->error(__('El resultado no pudo ser guardado. Por favor, intente nuevamente.'));
        } else if ($sampleId) {
            $result->sample_id = $sampleId;
        }
        
        $samples = $this->Results->Samples->find('list', 
            keyField: 'id',
            valueField: 'codigo_muestra'
        )->toArray();
        
        $this->set(compact('result', 'samples'));
    }

    /**
     * Edit method - Edit existing result
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $result = $this->Results->get($id, contain: []);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            
            if ($this->Results->save($result)) {
                $this->Flash->success(__('El resultado ha sido actualizado.'));

                return $this->redirect(['action' => 'index', $result->sample_id]);
            }
            $this->Flash->error(__('El resultado no pudo ser actualizado. Por favor, intente nuevamente.'));
        }
        
        $samples = $this->Results->Samples->find('list',
            keyField: 'id',
            valueField: 'codigo_muestra'
        )->toArray();
        
        $this->set(compact('result', 'samples'));
    }

    /**
     * Delete method - Delete result
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        $sampleId = $result->sample_id;
        
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('El resultado ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El resultado no pudo ser eliminado. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index', $sampleId]);
    }
}
