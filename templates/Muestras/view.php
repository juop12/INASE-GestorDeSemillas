<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Muestra $muestra
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Muestra'), ['action' => 'edit', $muestra->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Muestra'), ['action' => 'delete', $muestra->id], ['confirm' => __('Are you sure you want to delete # {0}?', $muestra->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Muestras'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Muestra'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="muestras view content">
            <h3><?= h($muestra->codigo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Codigo') ?></th>
                    <td><?= h($muestra->codigo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero Precinto') ?></th>
                    <td><?= h($muestra->numero_precinto) ?></td>
                </tr>
                <tr>
                    <th><?= __('Empresa') ?></th>
                    <td><?= h($muestra->empresa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Especie') ?></th>
                    <td><?= h($muestra->especie) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($muestra->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cantidad Semillas') ?></th>
                    <td><?= $this->Number->format($muestra->cantidad_semillas) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($muestra->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($muestra->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>