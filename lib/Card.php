<?php

class Card
{
    private int|string $value;
    private string $suit;

    public function __construct($value, $suit)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    public function getValue(): int|string
    {
        if (gettype($this->value) === 'string') {
            return $this->calculateFaceCardValue();
        }

        return $this->value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function setValue(int|string $value): void
    {
        $this->value = $value;
    }

    public function setSuit(string $suit): void
    {
        $this->suit = $suit;
    }

    private function calculateFaceCardValue(): int
    {
        if ($this->value === 'Jack' || $this->value === 'Queen' || $this->value === 'King') {
            return 10;
        }

        if ($this->value === 'Ace') {
            return 1;
        }
    }
}