<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Application\DisplayAwakeMessageCommand;
use App\Application\DisplayAwakeMessageCommandHandler;
use App\Application\DisplaySleepMessageCommand;
use App\Application\DisplaySleepMessageCommandHandler;
use App\Application\DisplayTimeCommand;
use App\Application\DisplayTimeCommandHandler;
use App\Clock;
use App\CommandBus;
use App\CommandHandlerDriver;
use App\SpanishDisplayMessage;

$commandHandlerDriver = new CommandHandlerDriver();
$commandHandlerDriver->registerCommands(
    commandFqn: DisplayTimeCommand::class,
    commandHandler: new DisplayTimeCommandHandler()
);
$commandHandlerDriver->registerCommands(
    commandFqn: DisplayAwakeMessageCommand::class,
    commandHandler: new DisplayAwakeMessageCommandHandler(new SpanishDisplayMessage())
);
$commandHandlerDriver->registerCommands(
    commandFqn: DisplaySleepMessageCommand::class,
    commandHandler: new DisplaySleepMessageCommandHandler(new SpanishDisplayMessage())
);
$commandBus = new CommandBus($commandHandlerDriver);
$clock = new Clock(
    commandBus: $commandBus,
    awakeAt: 6,
    sleepAt: 23
);
($clock)();
