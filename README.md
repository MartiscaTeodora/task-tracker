
# tasks_tracker

Aplicație simplă pentru gestionarea proiectelor și task-urilor, construită cu Laravel.

**Scop:** demo/temă pentru gestionare task-uri pe proiecte. Conține modele pentru `Project`, `Task` și autentificare utilizator.

**Conținut rapid:**
- Cod backend: Laravel (PHP)
- Frontend: JS + build cu `npm`

---

## Cerințe (Prerequisites)

- PHP 8.0+ (recomandat 8.1+)
- Composer
- Node.js 16+ și `npm` sau `yarn`
- MySQL / MariaDB (sau altă bază de date suportată de Laravel)
- extensia PHP `pdo_mysql`

---

## Instalare locală (pași rapizi)

1. Clonează repo și intră în folderele proiectului (dacă nu e deja clonat):

```bash
git clone <repo-url>
cd task-tracker-main
```

2. Instalează dependențele PHP:

```bash
composer install
```

3. Creează fișierul de mediu și generează cheia aplicației:

Pe Linux/macOS:
```bash
cp .env.example .env
```
Pe Windows (PowerShell):
```powershell
copy .env.example .env
```

```bash
php artisan key:generate
```

4. Configurează conexiunea la baza de date în fișierul `.env` (variabile `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5. Rulează migrațiile și, opțional, seed-urile:

```bash
php artisan migrate
# sau, pentru migrări + seed
php artisan migrate --seed
```

6. Instalează dependențele frontend și construiește activele:

```bash
npm install
npm run dev   # sau `npm run build` pentru prod
```

7. Pornește serverul de dezvoltare:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Accesează: http://127.0.0.1:8000

---

## Comenzi utile

- Rulează testele PHP:

```bash
./vendor/bin/phpunit
# sau
php artisan test
```

- Link către storage (dacă folosești upload de fișiere):

```bash
php artisan storage:link
```

- Curăță cache config/route/view:

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## Structură importantă

- Codul aplicației se găsește în folderul `tasks_tracker/app`.
- Migrațiile în `database/migrations`.
- Seed-urile în `database/seeders`.

---

## Probleme frecvente

- Eroare de conexiune la DB: verifică `DB_*` în fișierul `.env`.
- Permisiuni director `storage`/`bootstrap/cache`: pe Linux setează `storage` și `bootstrap/cache` writeable.

---

## Licență

Proiectul folosește licența MIT.

---

## Instrucțiuni specifice Windows

- PowerShell: folosește comenzile de mai sus (ex. `copy .env.example .env`). Rulează PowerShell ca Administrator dacă întâmpini probleme cu permisiuni.
- Dacă folosești WSL (Windows Subsystem for Linux), rulează pașii în mediul WSL pentru compatibilitate mai bună cu toolchain Unix.
- Start MySQL pe Windows (ex. dacă ai instalat MySQL ca serviciu):

```powershell
# Pornește serviciul MySQL
Start-Service MySQL
# Sau pentru MariaDB
Start-Service MariaDB
```

---

## Exemplu minim `.env` (fără secrete)

Completează valorile cu datele tale locale:

```
APP_NAME=TaskTracker
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tasks_db
DB_USERNAME=root
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
```

După copiere, rulează `php artisan key:generate` pentru a popula `APP_KEY`.

---

## Seed demo user (opțional)

Dacă seed-urile includ un utilizator demo, poți popula baza astfel:

```bash
php artisan migrate --seed
# sau, doar seed (după migrare)
php artisan db:seed
```

Verifică `database/seeders/DatabaseSeeder.php` pentru datele create (ex. user admin, proiecte demo).

---

## Sugestii `composer` scripts (opțional)

Poți adăuga în `composer.json` sub `scripts` un shortcut pentru setup local:

```json
"scripts": {
	"post-install-cmd": [
		"@php artisan key:generate"
	],
	"setup": [
		"@php artisan migrate --seed",
		"@npm install",
		"@npm run dev"
	]
}
```

Notă: modificarea `composer.json` este opțională; README oferă comenzile manuale dacă nu vrei schimbări în fișiere.

---

## Deploy scurt (prod)

Pași generali pentru producție:

1. Setează `APP_ENV=production` și `APP_DEBUG=false` în `.env`.
2. Instalează dependențe pe server (composer & npm), rulează `npm run build`.
3. Rulează migrațiile: `php artisan migrate --force`.
4. Setează permisiuni corecte pentru `storage` și `bootstrap/cache`.
5. Configurează un server web (Nginx/Apache) pentru a servi `public/` și rulează un process manager (Supervisor) pentru job queue, dacă folosești coadă.

---

## Contact / Ajutor

Dacă ai nevoie, pot:
- adăuga un exemplu de `.env` specific pentru Windows/WSL,
- edita `composer.json` pentru scripturi automate,
- crea un `Makefile` sau script PowerShell pentru setup rapid.

Spune-mi ce vrei să includ mai exact și continui imediat.
