<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Samples Controller
 *
 * @property \App\Model\Table\SamplesTable $Samples
 */
class SamplesController extends AppController
{
    /**
     * Index method - List all samples
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Samples->find()
            ->contain(['Results'])
            ->orderBy(['Samples.created' => 'DESC']);
        
        $samples = $this->paginate($query);

        $this->set(compact('samples'));
    }

    /**
     * View method - View sample details
     *
     * @param string|null $id Sample id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sample = $this->Samples->get($id, contain: ['Results']);

        $this->set(compact('sample'));
    }

    /**
     * Add method - Add new sample
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sample = $this->Samples->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $sample = $this->Samples->patchEntity($sample, $this->request->getData());
            
            if ($this->Samples->save($sample)) {
                $this->Flash->success(__('La muestra ha sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La muestra no pudo ser guardada. Por favor, intente nuevamente.'));
        }
        
        $this->set(compact('sample'));
    }

    /**
     * Edit method - Edit existing sample
     *
     * @param string|null $id Sample id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sample = $this->Samples->get($id, contain: []);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sample = $this->Samples->patchEntity($sample, $this->request->getData());
            
            if ($this->Samples->save($sample)) {
                $this->Flash->success(__('La muestra ha sido actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La muestra no pudo ser actualizada. Por favor, intente nuevamente.'));
        }
        
        $this->set(compact('sample'));
    }

    /**
     * Delete method - Delete sample
     *
     * @param string|null $id Sample id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sample = $this->Samples->get($id);
        
        if ($this->Samples->delete($sample)) {
            $this->Flash->success(__('La muestra ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La muestra no pudo ser eliminada. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
