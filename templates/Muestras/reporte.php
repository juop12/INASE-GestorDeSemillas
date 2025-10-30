<div class="muestras reporte content">
    <h2>Reporte de Muestras</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Empresa</th>
                <th>Especie</th>
                <th>Poder germinativo</th>
                <th>Pureza</th>
                <th>Materiales inertes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $r): ?>
                <tr>
                    <td><?= h($r->codigo) ?></td>
                    <td><?= h($r->empresa) ?></td>
                    <td><?= h($r->especie) ?></td>
                    <td><?= h($r->resultado->poder_germinativo ?? '-') ?></td>
                    <td><?= h($r->resultado->pureza ?? '-') ?></td>
                    <td><?= h($r->resultado->materiales_inertes ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>