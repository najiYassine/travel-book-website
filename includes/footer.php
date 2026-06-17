    <footer class="pied">
        <p>© 2026 Skylane</p>
    </footer>
    <script src="js/main.js"></script>
    <?php if (!empty($extraJs)): ?>
        <?php foreach ($extraJs as $jsFile): ?>
            <script src="<?php echo e($jsFile); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
