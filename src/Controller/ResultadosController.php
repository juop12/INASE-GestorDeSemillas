<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Resultados Controller
 *
 * @property \App\Model\Table\ResultadosTable $Resultados
 */
class ResultadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Resultados->find()
            ->contain(['Muestras']);
        $resultados = $this->paginate($query);

        $this->set(compact('resultados'));
    }

    /**
     * View method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultado = $this->Resultados->get($id, contain: ['Muestras']);
        $this->set(compact('resultado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($muestraId = null)
    {
        $resultado = $this->Resultados->newEmptyEntity();

        if ($this->request->is('post')) {
            $resultado = $this->Resultados->patchEntity($resultado, $this->request->getData());
            // setear el relacionamiento obligatoriamente
            $resultado->muestra_id = (int)$muestraId;

            if ($this->Resultados->save($resultado)) {
                $this->Flash->success(__('Resultado guardado correctamente.'));
                return $this->redirect(['controller' => 'Muestras', 'action' => 'edit', $muestraId]);
            }
            $this->Flash->error(__('No se pudo guardar el resultado. Verifique los datos.'));
        }

        $this->set(compact('resultado', 'muestraId'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultado = $this->Resultados->get($id);
        $muestraId = $resultado->muestra_id;

        if ($this->request->is(['patch','post','put'])) {
            $resultado = $this->Resultados->patchEntity($resultado, $this->request->getData());
            if ($this->Resultados->save($resultado)) {
                $this->Flash->success(__('Resultado actualizado.'));
                return $this->redirect(['controller' => 'Muestras', 'action' => 'edit', $muestraId]);
            }
            $this->Flash->error(__('No se pudo actualizar el resultado.'));
        }

        $this->set(compact('resultado', 'muestraId'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resultado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultado = $this->Resultados->get($id);
        if ($this->Resultados->delete($resultado)) {
            $this->Flash->success(__('The resultado has been deleted.'));
        } else {
            $this->Flash->error(__('The resultado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
