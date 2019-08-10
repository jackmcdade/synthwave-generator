<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $nouns = [
        ['word' => 'Time', 'not' => ['Cop']],
        ['word' => 'Cassette'],
        ['word' => 'VHS'],
        ['word' => 'Rental'],
        ['word' => 'Midnight'],
        ['word' => 'Darkness'],
        ['word' => 'Maverick'],
        ['word' => 'Arcade', 'not' => ['High']],
        ['word' => 'Game'],
        ['word' => 'Joystick'],
        ['word' => 'Night'],
        ['word' => 'Knight'],
        ['word' => 'Dream'],
        ['word' => 'Drive'],
        ['word' => 'Cruise'],
        ['word' => 'Stallone'],
        ['word' => 'Arnold'],
        ['word' => 'Hollywood', 'prefix' => true],
        ['word' => 'High'],
        ['word' => 'Storm'],
        ['word' => 'Laser'],
        ['word' => 'Lazer'],
        ['word' => 'Cobra'],
        ['word' => 'Combo'],
        ['word' => 'Ultra'],
        ['word' => 'Streets of', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'October', 'plural' => false],
        ['word' => 'July', 'plural' => false],
        ['word' => 'August', 'plural' => false],
        ['word' => 'Summer'],
        ['word' => 'Summer of', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Endless', 'prefix' => true],
        ['word' => 'Boys', 'suffix' => true],
        ['word' => 'Boys of', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Tech'],
        ['word' => 'Hacker'],
        ['word' => 'Surfer', 'suffix' => true],
        ['word' => 'FM', 'not' => ['83']],
        ['word' => 'Cop'],
        ['word' => 'Hopper'],
        ['word' => 'Eleven'],
        ['word' => 'Strange'],
        ['word' => 'Stranger', 'suffix' => true],
        ['word' => 'Hawkins'],
        ['word' => 'Hawk'],
        ['word' => 'Falcon'],
        ['word' => 'Volt'],
        ['word' => 'Power'],
        ['word' => 'Lightning'],
        ['word' => 'Glove'],
        ['word' => 'Lazers &', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Hackers &', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Rider', 'prefix' => true],
        ['word' => 'Storm'],
        ['word' => 'Miami'],
        ['word' => 'Ocean'],
        ['word' => 'Fury'],
        ['word' => 'Rage'],
        ['word' => 'Highway'],
        ['word' => 'Superhighway'],
        ['word' => 'Weekend'],
        ['word' => 'Force'],
        ['word' => 'Droid'],
        ['word' => 'Moon'],
        ['word' => 'Analog', 'prefix' => true],
        ['word' => 'Electro', 'prefix' => true],
        ['word' => 'Attack', 'not' => ['FM']],
        ['word' => 'Waves of', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Gamer'],
        ['word' => 'Highscore'],
        ['word' => 'Game Over', 'seperator' => ' '],
        ['word' => 'Story Mode', 'plural' => false, 'seperator' => ' '],
        ['word' => 'Glitch'],
        ['word' => 'Glitch or', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'Skate or', 'prefix' => true, 'seperator' => ' '],
        ['word' => 'or Die', 'suffix' => true, 'seperator' => ' ', 'not' => ['Glitch or', 'Skate or', 'Hackers &', 'Lazers &', 'Waves of', 'Summer of']],
    ];

    public $years = [
        "1983",
        "1984",
        "1985",
        "83",
        "84",
        "85",
        "88",
        "'83",
        "'85",
        "'88",
    ];

    public $first;
    public $second;
    public $year;
    public $name;

    public function index()
    {
        return view('generate', ['name' => $this->buildName()]);
    }

    public function buildName()
    {
        $words = [];

        // Get the first word
        $this->first = $this->getFirstWord();
        $words[] = Arr::get($this->first, 'word');

        // Get the second word
        $this->second = $this->getSecondWord();
        $words[] = Arr::get($this->second, 'word');

        // Join 'em
        $seperator = $this->getSeperator();
        $this->name = implode($words, $seperator);

        // Decide if it should be plural
        if ($this->roll(12) && Arr::get($this->second, 'plural') !== false) {
            $this->name = Str::plural($this->name);
        }

        // Decide if there should be a year at the end
        if ($this->roll(5)) {
            if ($seperator !== '') {
                $this->name .= ' ';
            }
            $this->name .= $this->getYear();
        }

        return $this->name;
    }

    public function getWord()
    {
        return Arr::random($this->nouns);
    }

    public function getFirstWord() {
        $word = $this->getWord();

        if (Arr::get($word, 'suffix')) {
            return $this->getFirstWord();
        }

        return $word;
    }

    public function getSecondWord() {
        $word = $this->getWord();

        if (in_array($this->first['word'], Arr::get($word, 'not', []))) {
            return $this->getSecondWord();
        }

        if ($word == $this->first || $this->first === Arr::has($word, 'not') || Arr::get($word, 'prefix')) {
            return $this->getSecondWord();
        }

        return $word;
    }

    public function getYear() {
        return Arr::random($this->years);
    }

    public function getSeperator() {
        if ($seperator = Arr::get($this->first, 'seperator')) return $seperator;
        if ($seperator = Arr::get($this->second, 'seperator')) return $seperator;

        return Arr::random([' ', ' ', ' ', ' ', '']);
    }

    public function coinFlip() {
        return Arr::random([true, false]);
    }

    public function roll($sides = 20, $weighted = false) {
        return Arr::random(array_pad([true], $sides - 1, $weighted));
    }
}
