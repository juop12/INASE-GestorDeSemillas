<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">Acciones</h4>
            <?= $this->Html->link('Editar Resultado', ['action' => 'edit', $result->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink('Eliminar Resultado', ['action' => 'delete', $result->id], ['confirm' => __('¿Está seguro de eliminar este resultado?'), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Listar Resultados', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Nuevo Resultado', ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Ver Muestra', ['controller' => 'Samples', 'action' => 'view', $result->sample_id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="results view content">
            <h3>Resultado #<?= h($result->id) ?></h3>
            <table>
                <tr>
                    <th>ID</th>
                    <td><?= $this->Number->format($result->id) ?></td>
                </tr>
                <tr>
                    <th>Muestra</th>
                    <td><?= $result->hasValue('sample') ? $this->Html->link($result->sample->codigo_muestra, ['controller' => 'Samples', 'action' => 'view', $result->sample->id]) : '' ?></td>
                </tr>
                <tr>
                    <th>Poder Germinativo (%)</th>
                    <td><?= $this->Number->format($result->poder_germinativo) ?>%</td>
                </tr>
                <tr>
                    <th>Pureza (%)</th>
                    <td><?= $this->Number->format($result->pureza) ?>%</td>
                </tr>
                <tr>
                    <th>Materiales Inertes</th>
                    <td><?= h($result->materiales_inertes) ?></td>
                </tr>
                <tr>
                    <th>Fecha de Creación</th>
                    <td><?= h($result->created->format('d/m/Y H:i:s')) ?></td>
                </tr>
                <tr>
                    <th>Última Modificación</th>
                    <td><?= h($result->modified->format('d/m/Y H:i:s')) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
