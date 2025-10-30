<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Muestra> $muestras
 */
?>
<div class="muestras index content">
    <?= $this->Html->link(__('New Muestra'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Muestras') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('codigo') ?></th>
                    <th><?= $this->Paginator->sort('numero_precinto') ?></th>
                    <th><?= $this->Paginator->sort('empresa') ?></th>
                    <th><?= $this->Paginator->sort('especie') ?></th>
                    <th><?= $this->Paginator->sort('cantidad_semillas') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($muestras as $muestra): ?>
                <tr>
                    <td><?= $this->Number->format($muestra->id) ?></td>
                    <td><?= h($muestra->codigo) ?></td>
                    <td><?= h($muestra->numero_precinto) ?></td>
                    <td><?= h($muestra->empresa) ?></td>
                    <td><?= h($muestra->especie) ?></td>
                    <td><?= $this->Number->format($muestra->cantidad_semillas) ?></td>
                    <td><?= h($muestra->created_at) ?></td>
                    <td><?= h($muestra->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $muestra->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $muestra->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $muestra->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $muestra->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>