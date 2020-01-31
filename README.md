## Om projektet

Jeg har lavet backend vha. Laravel, da jeg har arbejdet meget i Laravel. ydermere, har jeg valgt Laravel så projektet nemmere kan skaleres.
Jeg har brugt et gratis template fra [creative-tim](https://www.creative-tim.com). Jeg har ikke fokusere på front-end delen af projektet men, derimod back-end delen.

## Opsætning

1. Installer de krævede composer biblioteker
- `composer install`
2. Installer de krævede Node biblioteker
- `npm install`
3. Kør projectet
- `php artisan serve`

Herefter vil konsollen vise hvad for en local url projektet kører på.

## Struktur

| Funktion | Plasering |
| ----------- | ----------- |
| View Controller | app/Http/Controllers/PageController.php |
| Forecast Helper | app/Helpers/Forecast.php |
| Template | resources/views/welcome.blade.php |

## Fremgangsmåde

For at lave dette projekt gør jeg brug af [geonames](http://www.geonames.org), som har en REST API. Det gør at jeg kan få brugbar data ift. tidszoner og geolakation, som altsammen kan bruges til at give den mest præsise data omkring hvornår solen står op og går ned.

Ved at tilgå to forskellige API endpoints, kan jeg få adgang til alt den data, jeg skal bruge. Når dette er gjort, kan der loopes igennem ugens dage, og ved hjælp af en PHP funktion kan sol-dataen udvindes ved hjælp af dato og geolocation.

## Arbejdstid

Jeg har brugt omkring 3 timer, hvor en stor del af denne tid blev brugt til undersøgelse af API muligheder, templates og andre brugbare ressourcer.
