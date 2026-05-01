# Quiz Sistēma (PHP + MySQL)

Pilns grupas darba projekts atbilstoši uzdevumam.

## Iekļauts
- Login / reģistrācija
- Lomas: admin un user
- 5 temati
- 15 jautājumi katrā tematā
- Jautājumu un atbilžu randomizācija
- Progress bar
- Rezultātu skats
- Vēsture / high-score
- Admin panelis tematu un jautājumu pievienošanai
- Responsīvs dizains

## Uzstādīšana
1. Iekopē projektu savā `htdocs` vai `www` mapē.
2. Izveido MySQL datubāzi ar nosaukumu `quiz_system`.
3. Importē failu `sql/setup.sql`.
4. Pārbaudi `config.php` un saliec savus DB pieejas datus.
5. Atver projektu pārlūkā.

## Demo pieejas
- Admin: `admin` / `admin123`

## Failu struktūra
- `index.php` — login / sign up
- `dashboard.php` — tematu izvēle
- `quiz.php` — jautājumu skats ar progress bar
- `result.php` — rezultāts
- `history.php` — vēsture un high-score
- `admin/` — admin panelis
- `sql/setup.sql` — datubāzes struktūra + demo dati

## Piezīme
Ja gribi, vari papildināt ar:
- taimeri
- attēliem pie jautājumiem
- jautājumu rediģēšanu/dzēšanu
- Bootstrap versiju
