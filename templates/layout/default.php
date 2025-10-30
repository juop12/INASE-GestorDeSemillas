<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'app']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('input[name="search"]');
        const muestras = document.querySelectorAll('.muestras-list li');

        if (!searchInput) return;

        searchInput.addEventListener('input', () => {
            const term = searchInput.value.trim().toLowerCase();

            muestras.forEach(li => {
                const text = li.textContent.trim().toLowerCase();

                // If search box is empty, show all again
                if (term === '') {
                    li.classList.remove('hidden');
                } else {
                    li.classList.toggle('hidden', !text.includes(term));
                }
            });
        });
    });
</script>

<body>
    <header class="topbar">
        <h1><a href="<?= $this->Url->build('/') ?>">Gestión de Muestras</a></h1>
    </header>

    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h3>Muestras</h3>

            <form method="get" action="<?= $this->Url->build(['controller' => 'Muestras', 'action' => 'index']) ?>">
                <input type="text" name="search" placeholder="Buscar por ID..." />
            </form>

            <ul class="muestras-list">
                <?php if (!empty($muestrasSidebar)): ?>
                    <?php foreach ($muestrasSidebar as $m): ?>
                        <li>
                            <?= $this->Html->link(
                                h($m->codigo ?? 'Sin código'),
                                ['controller' => 'Muestras', 'action' => 'view', $m->id]
                            ) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><em>No hay muestras</em></li>
                <?php endif; ?>
            </ul>

            <div class="sidebar-buttons">
                <?= $this->Html->link('➕ Nueva', ['controller' => 'Muestras', 'action' => 'add'], ['class' => 'button']) ?>
                <?= $this->Html->link('📄 Reporte', ['controller' => 'Muestras', 'action' => 'reporte'], ['class' => 'button button-outline']) ?>
            </div>
        </aside>

        <!-- Main content -->
        <main class="content">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </main>
    </div>

    <footer>
        <p>&copy; <?= date('Y') ?> Gestión de Muestras</p>
    </footer>
</body>

</html>