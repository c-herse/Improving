## Om projektet

Jeg har lavet testen i Laravel da jeg har arbejdet meget i Laravel og derved gerne ville vise hvordan jeg ville implementere denne form for applikation i et Laravel projekt.

Jeg har også valgt Laravel da projektet derved nemmere kan skaleres hvis behovet skulle opstå. Jeg har dog inskærmet mig i forhold til hvor stor en applikation jeg ville lave da mine første tanker omkring projektet var lidt for store i forhold til hvad for en opgave jeg blev sat på.

## Opsætning

1. Installer de krævede composer biblioteker
- `composer install`
2. Installer de krævede Node biblioteker
- `npm install`
3. Kør projectet
- `php artisan serve`

Herefter vil konsollen vise hvad for en local url projektet køre på.

## Struktur

| Funktion | Plasering |
| ----------- | ----------- |
| View Controller | app/Http/Controllers/PageController.php |
| Forecast Helper | app/Helpers/Forecast.php |
| Template | resources/views/welcome.blade.php |
| UnitTests | tests/ |

## Fremgangsmåde

For at lave dette projekt gør jeg brug af [geonames](http://www.geonames.org) som har en REST API der gør jeg kan få brugbar data i forhold til tidszone og geolakation som altsammen kan bruges til at give den mest præsise data omkring hvornår solen står op og går ned.

## Arbejdstid

Jeg har alt i alt brugt omkring 3 timer hvor en stor del af denne tid blev brugt til undersøgelse af API muligheder, templates og andre brugbare resurser

## Design

Jeg har ikke selv lavet designet men har brugt et gratis template fra [creative-tim](https://www.creative-tim.com) jeg har dog prøvet at gøre det så flot som jeg kunne uden at fokusere for meget på dette område
