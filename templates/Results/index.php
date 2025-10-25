<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Result> $results
 * @var string|null $sampleId
 */
?>
<div class="results index content">
    <h3>Resultados<?= $sampleId ? ' - Muestra #' . h($sampleId) : '' ?></h3>
    <div class="table-actions">
        <?= $this->Html->link('Nuevo Resultado', ['action' => 'add', $sampleId], ['class' => 'button float-right']) ?>
        <?php if ($sampleId): ?>
            <?= $this->Html->link('Ver Muestra', ['controller' => 'Samples', 'action' => 'view', $sampleId], ['class' => 'button float-right']) ?>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('Samples.codigo_muestra', 'Código Muestra') ?></th>
                    <th><?= $this->Paginator->sort('poder_germinativo', 'Poder Germinativo (%)') ?></th>
                    <th><?= $this->Paginator->sort('pureza', 'Pureza (%)') ?></th>
                    <th>Materiales Inertes</th>
                    <th><?= $this->Paginator->sort('created', 'Fecha Creación') ?></th>
                    <th class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= $this->Number->format($result->id) ?></td>
                    <td><?= $result->hasValue('sample') ? $this->Html->link($result->sample->codigo_muestra, ['controller' => 'Samples', 'action' => 'view', $result->sample->id]) : '' ?></td>
                    <td><?= $this->Number->format($result->poder_germinativo) ?>%</td>
                    <td><?= $this->Number->format($result->pureza) ?>%</td>
                    <td><?= h($result->materiales_inertes) ?></td>
                    <td><?= h($result->created->format('d/m/Y H:i')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('Ver', ['action' => 'view', $result->id], ['class' => 'button button-small']) ?>
                        <?= $this->Html->link('Editar', ['action' => 'edit', $result->id], ['class' => 'button button-small']) ?>
                        <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $result->id], ['class' => 'button button-small button-danger', 'confirm' => '¿Está seguro de eliminar este resultado?']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primera')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('última') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de {{count}} total')) ?></p>
    </div>
</div>
