<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sample $sample
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">Acciones</h4>
            <?= $this->Html->link('Editar Muestra', ['action' => 'edit', $sample->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink('Eliminar Muestra', ['action' => 'delete', $sample->id], ['confirm' => __('¿Está seguro de eliminar esta muestra?'), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Listar Muestras', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Nueva Muestra', ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link('Agregar Resultado', ['controller' => 'Results', 'action' => 'add', $sample->id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="samples view content">
            <h3><?= h($sample->codigo_muestra) ?></h3>
            <table>
                <tr>
                    <th>Código de Muestra</th>
                    <td><?= h($sample->codigo_muestra) ?></td>
                </tr>
                <tr>
                    <th>Número de Precinto</th>
                    <td><?= h($sample->numero_precinto) ?></td>
                </tr>
                <tr>
                    <th>Empresa</th>
                    <td><?= h($sample->empresa) ?></td>
                </tr>
                <tr>
                    <th>Especie</th>
                    <td><?= h($sample->especie) ?></td>
                </tr>
                <tr>
                    <th>Cantidad de Semillas</th>
                    <td><?= $this->Number->format($sample->cantidad_semillas) ?></td>
                </tr>
                <tr>
                    <th>Fecha de Creación</th>
                    <td><?= h($sample->created->format('d/m/Y H:i:s')) ?></td>
                </tr>
                <tr>
                    <th>Última Modificación</th>
                    <td><?= h($sample->modified->format('d/m/Y H:i:s')) ?></td>
                </tr>
            </table>
            
            <div class="related">
                <h4>Resultados Asociados</h4>
                <?php if (!empty($sample->results)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Poder Germinativo (%)</th>
                            <th>Pureza (%)</th>
                            <th>Materiales Inertes</th>
                            <th>Fecha de Creación</th>
                            <th class="actions">Acciones</th>
                        </tr>
                        <?php foreach ($sample->results as $result) : ?>
                        <tr>
                            <td><?= h($result->id) ?></td>
                            <td><?= $this->Number->format($result->poder_germinativo) ?>%</td>
                            <td><?= $this->Number->format($result->pureza) ?>%</td>
                            <td><?= h($result->materiales_inertes) ?></td>
                            <td><?= h($result->created->format('d/m/Y H:i')) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('Ver', ['controller' => 'Results', 'action' => 'view', $result->id], ['class' => 'button button-small']) ?>
                                <?= $this->Html->link('Editar', ['controller' => 'Results', 'action' => 'edit', $result->id], ['class' => 'button button-small']) ?>
                                <?= $this->Form->postLink('Eliminar', ['controller' => 'Results', 'action' => 'delete', $result->id], ['class' => 'button button-small button-danger', 'confirm' => '¿Eliminar este resultado?']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else : ?>
                <p>No hay resultados asociados a esta muestra.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
