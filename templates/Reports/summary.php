<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sample> $samples
 * @var array $especies
 * @var array $stats
 */
?>
<div class="reports summary content">
    <h3>Reporte Resumen</h3>
    
    <div class="filter-form">
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <fieldset>
            <legend>Filtros</legend>
            <div class="row">
                <div class="column">
                    <?= $this->Form->control('especie', [
                        'options' => $especies,
                        'empty' => 'Todas las especies',
                        'label' => 'Especie',
                        'default' => $this->request->getQuery('especie')
                    ]) ?>
                </div>
                <div class="column">
                    <?= $this->Form->control('fecha_desde', [
                        'type' => 'date',
                        'label' => 'Fecha Desde',
                        'value' => $this->request->getQuery('fecha_desde')
                    ]) ?>
                </div>
                <div class="column">
                    <?= $this->Form->control('fecha_hasta', [
                        'type' => 'date',
                        'label' => 'Fecha Hasta',
                        'value' => $this->request->getQuery('fecha_hasta')
                    ]) ?>
                </div>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Filtrar'), ['class' => 'button']) ?>
        <?= $this->Html->link('Limpiar Filtros', ['action' => 'summary'], ['class' => 'button']) ?>
        <?= $this->Form->end() ?>
    </div>
    
    <div class="statistics">
        <h4>Estadísticas</h4>
        <div class="row">
            <div class="column">
                <div class="stat-box">
                    <h5><?= $this->Number->format($stats['total_muestras']) ?></h5>
                    <p>Total de Muestras</p>
                </div>
            </div>
            <div class="column">
                <div class="stat-box">
                    <h5><?= $this->Number->format($stats['total_semillas']) ?></h5>
                    <p>Total de Semillas</p>
                </div>
            </div>
            <div class="column">
                <div class="stat-box">
                    <h5><?= $this->Number->format($stats['muestras_con_resultados']) ?></h5>
                    <p>Muestras con Resultados</p>
                </div>
            </div>
            <div class="column">
                <div class="stat-box">
                    <h5><?= $this->Number->format($stats['promedio_poder_germinativo']) ?>%</h5>
                    <p>Promedio Poder Germinativo</p>
                </div>
            </div>
            <div class="column">
                <div class="stat-box">
                    <h5><?= $this->Number->format($stats['promedio_pureza']) ?>%</h5>
                    <p>Promedio Pureza</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
        <h4>Detalle de Muestras</h4>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Empresa</th>
                    <th>Especie</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Resultados</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($samples as $sample): ?>
                <tr>
                    <td><?= $this->Html->link($sample->codigo_muestra, ['controller' => 'Samples', 'action' => 'view', $sample->id]) ?></td>
                    <td><?= h($sample->empresa) ?></td>
                    <td><?= h($sample->especie) ?></td>
                    <td><?= $this->Number->format($sample->cantidad_semillas) ?></td>
                    <td><?= h($sample->created->format('d/m/Y')) ?></td>
                    <td>
                        <?php if (!empty($sample->results)): ?>
                            <?php foreach ($sample->results as $result): ?>
                                <div class="result-summary">
                                    PG: <?= $this->Number->format($result->poder_germinativo) ?>% | 
                                    Pureza: <?= $this->Number->format($result->pureza) ?>%
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <em>Sin resultados</em>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if ($samples->count() === 0): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No se encontraron muestras con los filtros aplicados.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
