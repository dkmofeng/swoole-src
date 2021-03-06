--TEST--
swoole_coroutine_channel: push timeout 3
--SKIPIF--
<?php require __DIR__ . '/../include/skipif.inc'; ?>
--FILE--
<?php
require __DIR__ . '/../include/bootstrap.php';

$channel = new Swoole\Coroutine\Channel(1);

go(function () use ($channel) {
    assert($channel->push(1, 0.1));
    assert($channel->push(1, 0.1));
});

go(function () use ($channel) {
    assert($channel->pop(0.1) == 1);
});

swoole_event_wait();
echo "DONE\n";
?>
--EXPECT--
DONE
