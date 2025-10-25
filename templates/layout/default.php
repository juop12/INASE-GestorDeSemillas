<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        INASE - Gestor de Semillas
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['base', 'style']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="container">
            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/') ?>"><span>INASE</span> Gestor de Semillas</a>
            </div>
            <div class="top-nav-links">
                <?= $this->Html->link('Muestras', ['controller' => 'Samples', 'action' => 'index']) ?>
                <?= $this->Html->link('Resultados', ['controller' => 'Results', 'action' => 'index']) ?>
                <?= $this->Html->link('Reportes', ['controller' => 'Reports', 'action' => 'summary']) ?>
            </div>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 INASE - Sistema de Gestión de Muestras de Semillas</p>
        </div>
    </footer>
</body>
</html>
