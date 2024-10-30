<?php
function createDescriptionMedia($mediaName, $type): string
{
    if($type == "movie") {
        return "Entdecke alle Informationen zu $mediaName: Wo du den Film streamen kannst, Schauspieler, Bewertungen und mehr. Die beste Streaming-Suchmaschine für Filme, Serien und Live-Events.";
    } else {
        return "Entdecke alle Informationen zu $mediaName: Wo du die Serie streamen kannst, Schauspieler, Bewertungen und mehr. Die beste Streaming-Suchmaschine für Filme, Serien und Live-Events.";
    }
}
function createKeywordsMedia($mediaName, $genre, $type): string
{
    if($type == "movie") {
        return "Streaming search engine, $mediaName, watch $mediaName online, movie details, movie cast, movie ratings, $genre, video on demand, streaming availability, best movies, watch movies online, movie reviews, film synopsis";
    } else {
        return "Streaming search engine, $mediaName, watch $mediaName online, series details, series cast, series ratings, $genre, video on demand, streaming availability, best series, watch series online, series reviews, series synopsis";
    }
}
function createTitleMedia($mediaName): string
{
    return "$mediaName | Streaming Search Engine";
}