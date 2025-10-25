<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 * @var array $samples
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading">Acciones</h4>
            <?= $this->Form->postLink(
                'Eliminar',
                ['action' => 'delete', $result->id],
                ['confirm' => __('¿Está seguro de eliminar este resultado?'), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link('Listar Resultados', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="results form content">
            <?= $this->Form->create($result) ?>
            <fieldset>
                <legend>Editar Resultado</legend>
                <?php
                    echo $this->Form->control('sample_id', ['options' => $samples, 'label' => 'Muestra']);
                    echo $this->Form->control('poder_germinativo', ['type' => 'number', 'step' => '0.01', 'min' => '0', 'max' => '100', 'label' => 'Poder Germinativo (%)']);
                    echo $this->Form->control('pureza', ['type' => 'number', 'step' => '0.01', 'min' => '0', 'max' => '100', 'label' => 'Pureza (%)']);
                    echo $this->Form->control('materiales_inertes', ['type' => 'textarea', 'label' => 'Materiales Inertes (opcional)']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
