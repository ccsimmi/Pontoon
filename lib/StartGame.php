<?php

class StartGame
{
    const WELCOME_MSG = "Welcome to Pontoon.\n";
    const ENTER_NAME_MSG = "Please enter your name:\n";

    public function startGame()
    {
        echo self::WELCOME_MSG;
        echo self::ENTER_NAME_MSG;

        $name = trim(fgets(STDIN) . "\n");

        $deck = $this->createDeck();

        $player = $this->createPlayer($name, $deck);
        echo "Thanks, lets begin " . $player->getName() . ".\n";

        $game = new GameManager($player);
        $game->playGame();
    }

    private function createDeck(): Deck
    {
        $deck = new Deck();
        $deck->shuffle();
        return $deck;
    }

    private function createPlayer(string $name, Deck $deck): Player
    {
        return new Player(1, $deck, $name);
    }

}