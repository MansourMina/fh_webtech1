<?php
$gewuenschteOrdner = [
    'src/images/services/spa/',
];

foreach ($gewuenschteOrdner as $gewuenschterOrdner) {
// Paths to all PNG and JPG images in the current directory
    $bilder = glob($gewuenschterOrdner . '*.{jpg,jpeg,png}', GLOB_BRACE);

    // Iterate through all found images in the current directory
    foreach ($bilder as $ursprungsDatei) {
        // Construct the target name for the WebP file
        $zielDatei = pathinfo($ursprungsDatei, PATHINFO_DIRNAME) . '/' . pathinfo($ursprungsDatei, PATHINFO_FILENAME) . '.webp';

        // Check if a WebP version already exists
        if (!file_exists($zielDatei)) {
            
            // Load the image into memory
            $bild = imagecreatefromstring(file_get_contents($ursprungsDatei));

            // Save the image in WebP format
            imagewebp($bild, $zielDatei, 80); // Die Zahl 80 repräsentiert die Qualität (0-100)

            // Free up the memory
            imagedestroy($bild);

            // Delete the original file
            unlink($ursprungsDatei);
        }
    }
}
