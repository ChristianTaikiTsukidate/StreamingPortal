<?php
function createDescriptionEpisode($seriesName, $seasonNumber, $episodeName): string
{
    return "Find all the information about $seriesName - Season $seasonNumber, Episode $episodeName: streaming availability, cast, ratings, and more. The best streaming search engine for series and episodes.";
}
function createKeywordsEpisode($seriesName, $seasonNumber, $episodeNumber): string
{
    return "Streaming search engine, $seriesName, Season $seasonNumber, Episode $episodeNumber, watch series online, series stream, streaming, series episodes, cast, ratings, online streaming, find series, video on demand";
}
function createTitleEpisode($seriesName, $seasonNumber, $episodeName): string
{
    return "$seriesName - Season $seasonNumber, Episode $episodeName | Streaming Search Engine";
}