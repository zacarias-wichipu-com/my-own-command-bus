<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplayAwakeMessageCommandCommandHandler;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplaySleepMessageCommandCommandHandler;
use App\Application\DisplayTimeCommand;
use App\Application\DisplayTimeCommandCommandHandler;
use App\Clock;
use App\CommandBus;
use App\HandlerDriver;
use App\SpanishDisplayMessage;

$commandHandlerDriver = new HandlerDriver();
$commandHandlerDriver->registerCommands(
    commandFqn: DisplayTimeCommand::class,
    commandHandler: new DisplayTimeCommandCommandHandler()
);
$commandHandlerDriver->registerCommands(
    commandFqn: DisplayAwakeMessageCommand::class,
    commandHandler: new DisplayAwakeMessageCommandCommandHandler(new SpanishDisplayMessage())
);
$commandHandlerDriver->registerCommands(
    commandFqn: DisplaySleepMessageCommand::class,
    commandHandler: new DisplaySleepMessageCommandCommandHandler(new SpanishDisplayMessage())
);
$commandBus = new CommandBus($commandHandlerDriver);
$clock = new Clock(
    commandBus: $commandBus,
    awakeAt: 6,
    sleepAt: 23
);
($clock)();
