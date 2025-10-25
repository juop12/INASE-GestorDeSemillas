<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\SamplesTable $Samples
 */
class ReportsController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Samples');
    }

    /**
     * Summary method - Summary report with filters
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function summary()
    {
        $query = $this->Samples->find()
            ->contain(['Results']);
        
        // Apply filters if present
        if ($this->request->getQuery('especie')) {
            $query->where(['Samples.especie' => $this->request->getQuery('especie')]);
        }
        
        if ($this->request->getQuery('fecha_desde')) {
            $query->where(['Samples.created >=' => $this->request->getQuery('fecha_desde')]);
        }
        
        if ($this->request->getQuery('fecha_hasta')) {
            $query->where(['Samples.created <=' => $this->request->getQuery('fecha_hasta') . ' 23:59:59']);
        }
        
        $samples = $query->all();
        
        // Get unique species for filter dropdown
        $especies = $this->Samples->find('list', 
            keyField: 'especie',
            valueField: 'especie'
        )
        ->select(['especie'])
        ->distinct(['especie'])
        ->orderBy(['especie' => 'ASC'])
        ->toArray();
        
        // Calculate statistics
        $stats = [
            'total_muestras' => $samples->count(),
            'total_semillas' => 0,
            'promedio_poder_germinativo' => 0,
            'promedio_pureza' => 0,
            'muestras_con_resultados' => 0,
        ];
        
        $totalPoderGerminativo = 0;
        $totalPureza = 0;
        $countResultados = 0;
        
        foreach ($samples as $sample) {
            $stats['total_semillas'] += $sample->cantidad_semillas;
            
            if (!empty($sample->results)) {
                $stats['muestras_con_resultados']++;
                
                foreach ($sample->results as $result) {
                    $totalPoderGerminativo += $result->poder_germinativo;
                    $totalPureza += $result->pureza;
                    $countResultados++;
                }
            }
        }
        
        if ($countResultados > 0) {
            $stats['promedio_poder_germinativo'] = round($totalPoderGerminativo / $countResultados, 2);
            $stats['promedio_pureza'] = round($totalPureza / $countResultados, 2);
        }
        
        $this->set(compact('samples', 'especies', 'stats'));
    }
}
