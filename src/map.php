<?php

return [
    "kb.list"       => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\BooksTransformer",
    ],
    "kb.get"        => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\BookTransformer",
    ],
    "kb.getBookTOC" => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\ChaptersTransformer",
    ],
    "kb.getPage" => [
        "method"      => "GET",
        "transformer" => "UserScape\\HelpSpot\\Transformer\\PageTransformer",
    ],
];
