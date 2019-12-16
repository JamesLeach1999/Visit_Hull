<footer>
    &copy; <?php echo date('Y') ?> visit hull
</footer>
</body>

</html>
<?php
// just to catch any connections which wernt closed
db_disconnect($db);

?>