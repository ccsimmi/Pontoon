<?php

class Player
{
    private int $player;
    private Deck $deck;
    private string $name;
    private array $hand;

    public function __construct(int $player, Deck $deck, string $name)
    {
        $this->player = $player;
        $this->deck = $deck;
        $this->name = $name;
        $this->hand = [];
    }

    public function getPlayer(): int
    {
        return $this->player;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHand(): array
    {
        return $this->hand;
    }

    public function setHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function resetHand(): void
    {
        $this->hand = [];
    }

    public function getHandValue(): int
    {
        return $this->calculateValue($this->hand);
    }

    private function calculateValue(array $hand): int
    {
        $total = 0;

        foreach ($hand as $card) {
            if ($card->getValue() === 'Jack' || $card->getValue() === 'Queen' || $card->getValue() === 'King') {
                $total = $total + 10;
            } else if ($card->getValue() === 'Ace') {
                $total = $total + 1;
            } else {
                $total = $total + $card->getValue();
            }
        }

        return $total;
    }
}