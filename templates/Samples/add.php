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
            <?= $this->Html->link('Listar Muestras', ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="samples form content">
            <?= $this->Form->create($sample) ?>
            <fieldset>
                <legend>Agregar Muestra</legend>
                <?php
                    echo $this->Form->control('numero_precinto', ['label' => 'Número de Precinto']);
                    echo $this->Form->control('empresa', ['label' => 'Empresa']);
                    echo $this->Form->control('especie', ['label' => 'Especie']);
                    echo $this->Form->control('cantidad_semillas', ['type' => 'number', 'label' => 'Cantidad de Semillas']);
                ?>
                <p class="help-text">El código de muestra se generará automáticamente.</p>
            </fieldset>
            <?= $this->Form->button(__('Guardar'), ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
