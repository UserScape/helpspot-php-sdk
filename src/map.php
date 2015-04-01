<?php

return [
    "kb.list" => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\BooksTransformer",
    ],
    "kb.get" => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\BookTransformer",
    ],
];
