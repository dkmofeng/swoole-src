--TEST--
swoole_coroutine: main output global
--SKIPIF--
<?php require __DIR__ . '/../../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../../include/bootstrap.php';
ob_start();
echo 'aaa';
go(function () {
    ob_start();
    echo 'bbb';
    co::fgets(fopen(__FILE__, 'r'));
    assert(ob_get_clean() === 'bbb');
});
assert(ob_get_clean() === 'aaa');
?>
--EXPECT--