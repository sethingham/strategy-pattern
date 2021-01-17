<?php


namespace AMacsmith\StrategyPattern\Tests;

use AMacSmith\StrategyPattern\Solution\Display\CityDuckDisplayBehavior;
use AMacSmith\StrategyPattern\Solution\DuckFactory;
use AMacSmith\StrategyPattern\Solution\Ducks\CityDuck;
use AMacSmith\StrategyPattern\Solution\Ducks\DecoyDuck;
use AMacSmith\StrategyPattern\Solution\Ducks\JetDuck;
use AMacSmith\StrategyPattern\Solution\Ducks\MallardDuck;
use AMacSmith\StrategyPattern\Solution\Ducks\RubberDuck;
use AMacSmith\StrategyPattern\Solution\Ducks\WildDuck;
use AMacSmith\StrategyPattern\Solution\DuckTypes;
use AMacSmith\StrategyPattern\Solution\Type\CityDuckTypeBehavior;
use AMacSmith\StrategyPattern\Solution\Duck;
use AMacSmith\StrategyPattern\Solution\Eat\WildEatBehavior;
use AMacSmith\StrategyPattern\Solution\Fly\NormalFlyBehavior;
use AMacSmith\StrategyPattern\Solution\Quack\NormalQuackBehavior;
use PHPUnit\Framework\TestCase;

class DuckTest extends TestCase
{
    public function test_can_make_a_duck()
    {
        $duckTypes = DuckTypes::$types;
        $ducks = [];

        foreach($duckTypes as $type) {
            $ducks[] = DuckFactory::make(new $type());
        }

        foreach ($ducks as $duck) {
            $duck->performType();
            $duck->performFly();
            $duck->performDisplay();
            $duck->performQuack();
            $duck->performEat();
            echo PHP_EOL;
            $this->assertInstanceOf(Duck::class, $duck);
        }
    }

    public function test_can_make_a_duck_of_invalid_type()
    {
        $this->expectException(\TypeError::class);

        $ducks = [
            DuckFactory::make(new MallardDuck())
        ];

        foreach ($ducks as $duck) {
            $duck->type();
            $duck->fly();
            $duck->display();
            $duck->quack();
            $duck->eat();
            echo PHP_EOL;
        }
    }
}