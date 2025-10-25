<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sample> $samples
 */
?>
<div class="samples index content">
    <h3>Muestras</h3>
    <div class="table-actions">
        <?= $this->Html->link('Nueva Muestra', ['action' => 'add'], ['class' => 'button float-right']) ?>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('codigo_muestra', 'Código') ?></th>
                    <th><?= $this->Paginator->sort('numero_precinto', 'Nro. Precinto') ?></th>
                    <th><?= $this->Paginator->sort('empresa', 'Empresa') ?></th>
                    <th><?= $this->Paginator->sort('especie', 'Especie') ?></th>
                    <th><?= $this->Paginator->sort('cantidad_semillas', 'Cantidad') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Fecha Creación') ?></th>
                    <th class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($samples as $sample): ?>
                <tr>
                    <td><?= h($sample->codigo_muestra) ?></td>
                    <td><?= h($sample->numero_precinto) ?></td>
                    <td><?= h($sample->empresa) ?></td>
                    <td><?= h($sample->especie) ?></td>
                    <td><?= $this->Number->format($sample->cantidad_semillas) ?></td>
                    <td><?= h($sample->created->format('d/m/Y H:i')) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('Ver', ['action' => 'view', $sample->id], ['class' => 'button button-small']) ?>
                        <?= $this->Html->link('Editar', ['action' => 'edit', $sample->id], ['class' => 'button button-small']) ?>
                        <?= $this->Html->link('Resultados', ['controller' => 'Results', 'action' => 'index', $sample->id], ['class' => 'button button-small']) ?>
                        <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $sample->id], ['class' => 'button button-small button-danger', 'confirm' => '¿Está seguro de eliminar esta muestra?']) ?>
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
