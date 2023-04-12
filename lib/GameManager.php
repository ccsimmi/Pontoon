<?php

class GameManager
{
    private Player $player;

    const PLAY_INSTRUCTIONS = "Type 'draw' to draw a card or 'confirm' if you're happy with your selection: \n";
    const DRAW_DECISION = "drawing a card...\n";
    const CONFIRM_DECISION = "Let's view your hand:\n";
    const INCORRECT_DECISION = "Please enter a correct value.\n";
    const RESULT_BUST = "BUST! Your hand value is ";
    const RESULT_WIN = "WINNER! Your hand value is exactly 21!\n";
    const RESULT_NEUTRAL = "Close, but no cigar. Your hand value is ";
    const RESTART_INSTRUCTIONS = "Enter 'yes' if you'd like another go or 'no' if you're calling it quits.\n";

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function playGame(): void
    {
        while (true) {
            echo self::PLAY_INSTRUCTIONS;
            $decision = $this->getDecision();

            if ($decision === 'draw') {
                echo self::DRAW_DECISION;
                $this->drawAction();
                $this->displayHand();

                if ($this->player->getHandValue() > 21) {
                    break;
                }

                continue;
            }

            if ($decision == 'confirm') {
                $this->confirmAction();
                $this->displayMessageOnConfirmation();
                break;
            }

            if ($decision != 'draw' || $decision != 'confirm') {
                echo self::INCORRECT_DECISION;
                continue;
            }
        }

        if ($this->player->getHandValue() > 21) {
            $this->displayMessageOnConfirmation();
        }

        while (true) {
            echo self::RESTART_INSTRUCTIONS;
            $decision = $this->getDecision();

            if ($decision === 'yes') {
                $this->resetPlayerHandAndDeck();
                $this->playGame();
            }

            if ($decision === 'no') {
                break;
            }
        }
    }

    private function displayMessageOnConfirmation(): void
    {
        if ($this->player->getHandValue() > 21) {
            echo self::RESULT_BUST . $this->player->getHandValue() . ".\n";
        } else if ($this->player->getHandValue() == 21) {
            echo self::RESULT_WIN;
        } else {
            echo self::RESULT_NEUTRAL . $this->player->getHandValue() . ".\n";
        }
    }

    private function getDecision(): string
    {
        $decision = trim(fgets(STDIN) . "\n");

        return $decision;
    }

    private function drawAction(): void
    {
        $deck = $this->player->getDeck();
        $card = $deck->drawCard();
        $this->player->setHand($card);
    }

    private function displayHand(): void
    {
        $displayHand = "Hand:\n";
        $hand = $this->player->getHand();

        if (!empty($hand)) {
            foreach($hand as $card) {
                $displayHand = $displayHand .  $card->getValue() . " of " . $card->getSuit() . "\n";
            }

            echo $displayHand;
        }
    }

    private function confirmAction(): void
    {
        echo self::CONFIRM_DECISION;
        $this->displayHand();
    }

    private function resetPlayerHandAndDeck(): void
    {
        $this->player->resetHand();

        $deck = $this->player->getDeck();
        $deck->reset();
        $deck->shuffle();
    }
}