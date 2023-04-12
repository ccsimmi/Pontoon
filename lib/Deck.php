<?php

class Deck
{
    private array $cards;

    const SUITS = ['Hearts', 'Diamonds', 'Spades', 'Clubs'];
    const VALUES = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'Jack', 'Queen', 'King', 'Ace'];

    public function __construct()
    {
        $this->cards = [];

        foreach (self::SUITS as $suit) {
            foreach (self::VALUES as $value) {
                $card = new Card($value, $suit);
                $this->cards[] = $card;
            }
        }
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function drawCard(): Card
    {
        return array_pop($this->cards);
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function reset(): void
    {
        $this->__construct();
    }
}


