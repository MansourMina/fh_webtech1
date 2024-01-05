<?php
$gewuenschteOrdner = [
    'src/images/services/spa/',
];

foreach ($gewuenschteOrdner as $gewuenschterOrdner) {
    // Pfade zu allen PNG- und JPG-Bildern im aktuellen Ordner
    $bilder = glob($gewuenschterOrdner . '*.{jpg,jpeg,png}', GLOB_BRACE);

    // Durchlaufe alle gefundenen Bilder im aktuellen Ordner
    foreach ($bilder as $ursprungsDatei) {
        // Konstruieren Sie den Zielnamen für die WebP-Datei
        $zielDatei = pathinfo($ursprungsDatei, PATHINFO_DIRNAME) . '/' . pathinfo($ursprungsDatei, PATHINFO_FILENAME) . '.webp';

        // Überprüfen Sie, ob bereits eine WebP-Version existiert
        if (!file_exists($zielDatei)) {
            // Lade das Bild in den Arbeitsspeicher
            $bild = imagecreatefromstring(file_get_contents($ursprungsDatei));

            // Speichere das Bild im WebP-Format
            imagewebp($bild, $zielDatei, 80); // Die Zahl 80 repräsentiert die Qualität (0-100)

            // Gib den Arbeitsspeicher frei
            imagedestroy($bild);

            // Lösche die ursprüngliche Datei
            unlink($ursprungsDatei);
        }
    }
}
