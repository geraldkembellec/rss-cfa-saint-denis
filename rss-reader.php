<?php
// URL du flux RSS
$rss_url = "http://geraldkembellec.github.io/rss-cfa-saint-denis/rss-cfa-news.rss";

// Chargement du flux RSS
$rss = simplexml_load_file($rss_url);

if (!$rss) {
    echo "<p>Impossible de charger le flux RSS.</p>";
    exit;
}

// Affichage du titre du canal
echo "<h1>" . htmlspecialchars($rss->channel->title) . "</h1>";
echo "<p>" . htmlspecialchars($rss->channel->description) . "</p>";
echo "<hr>";

// Parcours des items
foreach ($rss->channel->item as $item) {

    // Récupération éventuelle de l'image (<enclosure>)
    $image = "";
    if (isset($item->enclosure)) {
        $image_url = (string)$item->enclosure['url'];
        $image = "<img src=\"$image_url\" alt=\"illustration\" style=\"max-width:300px; display:block; margin-bottom:10px;\">";
    }

    echo "<article style='margin-bottom:30px;'>";
    echo "<h2>" . htmlspecialchars($item->title) . "</h2>";
    echo $image;
    echo "<p>" . $item->description . "</p>";
    echo "<p><a href=\"" . htmlspecialchars($item->link) . "\" target=\"_blank\">Lire la suite</a></p>";
    echo "<small>Publié le : " . htmlspecialchars($item->pubDate) . "</small>";
    echo "</article>";
    echo "<hr>";
}
?>
