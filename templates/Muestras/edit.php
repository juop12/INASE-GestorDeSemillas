<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Muestra $muestra
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <ul>
                <li><?= $this->Form->postLink(
                    __('Eliminar'),
                    ['action' => 'delete', $muestra->id],
                    ['confirm' => __('¿Seguro que deseas eliminar la muestra #{0}?', $muestra->id), 'class' => 'side-nav-item']
                ) ?></li>
                <li><?= $this->Html->link(__('Volver al listado'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                </li>
            </ul>
        </div>
    </aside>

    <div class="column column-80">
        <div class="muestras form content">

            <h2>Editar Muestra</h2>

            <?= $this->Flash->render() ?>

            <?= $this->Form->create($muestra) ?>
            <fieldset>
                <legend><?= __('Datos de la muestra') ?></legend>

                <?= $this->Form->control('numero_precinto', ['label' => 'Número de Precinto']) ?>
                <?= $this->Form->control('empresa', ['label' => 'Empresa']) ?>
                <?= $this->Form->control('especie', ['label' => 'Especie']) ?>
                <?= $this->Form->control('cantidad_semillas', ['label' => 'Cantidad de Semillas']) ?>

                <?= $this->Form->hidden('codigo') ?>
                <?= $this->Form->hidden('created_at') ?>
                <?= $this->Form->hidden('updated_at') ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar cambios')) ?>
            <?= $this->Form->end() ?>

            <hr>

            <h3>Agregar Resultados Asociados</h3>

            <?php if (!empty($muestra->resultado)): ?>
                <!-- Si ya tiene resultado, mostramos el formulario para editar -->
                <?= $this->Form->create($muestra->resultado, [
                    'url' => ['controller' => 'Resultados', 'action' => 'edit', $muestra->resultado->id],
                    'class' => 'resultado-form'
                ]) ?>
                <?= $this->Form->control('poder_germinativo', ['label' => 'Poder Germinativo (%)']) ?>
                <?= $this->Form->control('pureza', ['label' => 'Pureza (%)']) ?>
                <?= $this->Form->control('materiales_inertes', ['label' => 'Materiales Inertes', 'type' => 'textarea']) ?>
                <?= $this->Form->button(__('Actualizar resultados')) ?>
                <?= $this->Form->end() ?>
            <?php else: ?>
                <!-- Si no tiene resultado, mostramos formulario para crear -->
                <?= $this->Form->create(null, [
                    'url' => ['controller' => 'Resultados', 'action' => 'add', $muestra->id],
                    'class' => 'resultado-form'
                ]) ?>
                <?= $this->Form->control('poder_germinativo', ['label' => 'Poder Germinativo (%)']) ?>
                <?= $this->Form->control('pureza', ['label' => 'Pureza (%)']) ?>
                <?= $this->Form->control('materiales_inertes', ['label' => 'Materiales Inertes', 'type' => 'textarea']) ?>
                <?= $this->Form->button(__('Agregar resultados')) ?>
                <?= $this->Form->end() ?>
            <?php endif; ?>
        </div>
    </div>