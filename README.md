# 🏠 Prodaja Nekretnina - Real Estate Management System

Profesionalni sistem za upravljanje nekretninama, kupcima, agentima i prodajama izgrađen sa Laravel 12 i Chart.js.

**GitHub Repository**: [prodaja_nekretnina](https://github.com/your-username/prodaja_nekretnina)

---

## 📋 Tabela Sadržaja

1. [Tehnološki Stack](#tehnološki-stack)
2. [Instalacija](#instalacija)
3. [Struktura Projekta](#struktura-projekta)
4. [Modeli i Baza Podataka](#modeli-i-baza-podataka)
5. [Kontroleri i Akcije](#kontroleri-i-akcije)
6. [Use Cases](#use-cases)
7. [Testiranje](#testiranje)
8. [GitHub Actions](#github-actions)

---

## 🛠 Tehnološki Stack

### Framework i Jezici
- **Laravel 12.44.0** - Web framework za PHP
- **PHP 8.4.16** - Server-side jezik
- **MySQL** - Baza podataka
- **Bootstrap 5.3.3** - CSS framework za responsive dizajn

### Biblioteke za Frontend
- **Chart.js 4.4.0** - JavaScript biblioteka za grafikone (doughnut, bar, funnel charts)
- **Font Awesome** - Ikonografija
- **Blade Templates** - Laravel template engine

### Razvojni Alati
- **Pest** - PHP testing framework
- **Pint** - PHP code style fixer
- **Composer** - Dependency manager
- **Git** - Version control

---

## 🚀 Instalacija

### Preduslov
- PHP 8.4+
- MySQL 8.0+
- Composer

### Koraci

```bash
# Kloniranje repozitorijuma
git clone https://github.com/your-username/prodaja_nekretnina.git
cd prodaja_nekretnina

# Instalacija zavisnosti
composer install

# Kopiranje .env datoteke
cp .env.example .env

# Generisanje aplikacionog ključa
php artisan key:generate

# Migracija baze podataka
php artisan migrate

# Seedovanje baze sa test podacima
php artisan db:seed

# Pokretanje razvojnog servera
php artisan serve
```

Pristupite aplikaciji na: `http://localhost:8000`

---

## 📁 Struktura Projekta

```
prodaja_nekretnina/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── KupacController.php        # CRUD za kupce
│   │   │   ├── NekretninaController.php   # CRUD za nekretnine
│   │   │   ├── AgentController.php        # CRUD za agente
│   │   │   ├── ProdajaController.php      # CRUD za prodaje
│   │   │   └── DashboardController.php    # Dashboard sa analitikom
│   │   ├── Requests/
│   │   │   ├── KupacStoreRequest.php      # Validacija (ručno)
│   │   │   ├── NekretninaStoreRequest.php # Validacija (ručno)
│   │   │   ├── ProdajaStoreRequest.php    # Validacija (ručno)
│   │   │   └── AgentStoreRequest.php      # Validacija (ručno)
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php                       # Korisnik (Laravel Breeze)
│   │   ├── Kupac.php                      # Kupac (Buyer) - GENERIRANO
│   │   ├── Nekretnina.php                 # Nekretnina (Property) - GENERIRANO
│   │   ├── Agent.php                      # Agent (Real Estate Agent) - GENERIRANO
│   │   └── Prodaja.php                    # Prodaja (Sale) - GENERIRANO
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Factories/
│       ├── KupacFactory.php               # Generirano
│       ├── NekretninaFactory.php          # Generirano
│       ├── AgentFactory.php               # Generirano
│       └── ProdajaFactory.php             # Generirano
├── database/
│   ├── migrations/
│   │   ├── *_create_kupacs_table.php          # Generirano
│   │   ├── *_create_agents_table.php          # Generirano
│   │   ├── *_create_nekretninas_table.php     # Generirano
│   │   └── *_create_prodajas_table.php        # Generirano
│   ├── seeders/
│   │   └── DatabaseSeeder.php                 # Ručno pisano
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php          # Main layout sa fixed sidebar (RUČNO)
│   │   ├── welcome.blade.php              # Landing page (RUČNO)
│   │   ├── dashboard.blade.php            # Analytics dashboard (RUČNO sa Chart.js)
│   │   ├── kupci/                         # Buyer views
│   │   ├── nekretnine/                    # Property views
│   │   ├── agenti/                        # Agent views
│   │   └── prodaje/                       # Sale views
│   ├── css/app.css
│   └── js/app.js
├── routes/
│   ├── web.php                            # Web routes (RUČNO - resource + dashboard)
│   └── api.php                            # API routes
├── tests/
│   ├── Feature/
│   │   ├── NekretninaFeatureTest.php      # 4 feature testa za nekretnine (RUČNO)
│   │   └── ProdajaFeatureTest.php         # 4 feature testa za prodaje (RUČNO)
│   ├── Unit/
│   │   └── ExampleTest.php
│   ├── TestCase.php                       # Konfiguracija sa RefreshDatabase
│   └── Pest.php
├── .env.testing                           # Test okruženje (RUČNO)
├── .pint.json                             # Pint konfiguracija (RUČNO)
├── .github/
│   └── workflows/
│       └── tests.yml                      # GitHub Actions workflow (RUČNO)
└── composer.json
```

---

## 🗄 Modeli i Baza Podataka

### 1. **Kupac (Buyer)** - Generirano sa `make:model Kupac -m -f`
```
Tabela: kupacs
- id (PK)
- ime (String)
- prezime (String)
- email (String, unique)
- telefon (String)
- created_at, updated_at

Relacija: Ima-mnogo Prodaja
```

### 2. **Nekretnina (Property)** - Generirano sa `make:model Nekretnina -m -f`
```
Tabela: nekretninas
- id (PK)
- oznaka (String, unique) - Identifikator
- povrsina_m2 (Decimal) - Površina u kvadratnim metrima
- cena (Decimal) - Cena nekretnine
- status (String: 'slobodno', 'rezervisano', 'prodato')
- created_at, updated_at

Relacija: Ima-mnogo Prodaja
```

### 3. **Agent (Real Estate Agent)** - Generirano sa `make:model Agent -m -f`
```
Tabela: agents
- id (PK)
- ime (String)
- prezime (String)
- email (String, unique)
- created_at, updated_at

Relacija: Ima-mnogo Prodaja
```

### 4. **Prodaja (Sale)** - Generirano sa `make:model Prodaja -m -f`
```
Tabela: prodajas
- id (PK)
- nekretnina_id (FK → nekretninas.id)
- kupac_id (FK → kupacs.id)
- agent_id (FK → agents.id)
- datum_kreiranja (Date)
- status (String: 'nacrt', 'rezervisana', 'završena', 'otkazana')
- created_at, updated_at

Relacije: 
  - Pripada Nekretnini
  - Pripada Kupcu
  - Pripada Agentu
```

---

## 🎮 Kontroleri i Akcije

Svi kontroleri generirani sa `make:controller {Name} --resource` i onda ručno adaptirani.

### KupacController - `/kupac`
- `index()` - Lista svih kupaca
- `create()` - Forma za novog kupca
- `store()` - Čuvanje novog kupca
- `show()` - Detalji kupca
- `edit()` - Forma za izmenu
- `update()` - Čuvanje izmene
- `destroy()` - Brisanje kupca

### NekretninaController - `/nekretnina`
- `index()` - Lista nekretnina (može se filtrirati po statusu)
- `create()` - Forma za novu nekretninu
- `store()` - Čuvanje nove nekretnine
- `show()` - Detalji nekretnine
- `edit()` - Forma za izmenu
- `update()` - Čuvanje izmene
- `destroy()` - Brisanje nekretnine

### ProdajaController - `/prodaja`
- `index()` - Lista prodaja sa linkovima na kupce, nekretnine, agente
- `create()` - Forma za novu prodaju
- `store()` - Čuvanje nove prodaje
- `show()` - Detalji prodaje
- `edit()` - Forma za izmenu status-a
- `update()` - Čuvanje izmene prodaje
- `destroy()` - Brisanje prodaje
- **Status Workflow**: 'nacrt' → 'rezervisana' → 'završena' (ili 'otkazana')

### AgentController - `/agent`
- `index()` - Lista agenata
- `create()` - Forma za novog agenta
- `store()` - Čuvanje novog agenta
- `show()` - Detalji agenta
- `edit()` - Forma za izmenu
- `update()` - Čuvanje izmene
- `destroy()` - Brisanje agenta

### DashboardController - `/dashboard`
- `index()` - Prikazuje analytics:
  - Ukupno kupaca
  - Nekretnine po status-u (doughnut grafikonski prikaz)
  - Prodaje po status-u (bar grafikonski prikaz)
  - Sales funnel po vrednosti (bar funnel chart)
  - Tabela poslednje 5 prodaja

---

## 💡 Use Cases

### USE CASE 1: Dodavanje Novog Kupca
**Ruta**: `POST /kupac` (forma na `/kupac/create`)
- Ulazni podaci: ime, prezime, email, telefon
- Logika: Validacija (unique email), čuvanje u bazu
- Izlaz: Preusmeravanje na listu kupaca sa porukom "Kupac je uspešno dodat"
- Implementacija: `KupacController::store()` + `KupacStoreRequest`

### USE CASE 2: Dodavanje Nove Nekretnine
**Ruta**: `POST /nekretnina` (forma na `/nekretnina/create`)
- Ulazni podaci: oznaka, povrsina_m2, cena, status
- Logika: Validacija (unique oznaka), čuvanje u bazu
- Izlaz: Preusmeravanje na listu nekretnina
- Implementacija: `NekretninaController::store()` + `NekretninaStoreRequest`
- **Test**: `NekretninaFeatureTest::test_can_create_a_new_nekretnina` ✅

### USE CASE 3: Kreiranje Prodaje (Inicijacija Sale-a)
**Ruta**: `POST /prodaja` (forma na `/prodaja/create`)
- Ulazni podaci: nekretnina_id, kupac_id, agent_id, datum_kreiranja
- Logika: 
  - Validacija (foreign key checks sa `exists:kupacs,id`, `exists:agents,id`, `exists:nekretninas,id`)
  - Nekretnina mora biti u bazi
  - Automatski status = 'nacrt'
- Izlaz: Preusmeravanje na listu prodaja sa porukom
- Implementacija: `ProdajaController::store()` + `ProdajaStoreRequest`
- **Test**: `ProdajaFeatureTest::test_can_create_a_new_prodaja_sale` ✅

### USE CASE 4: Ažuriranje Status-a Prodaje (Edit Sale)
**Ruta**: `PATCH /prodaja/{id}` (forma na `/prodaja/{id}/edit`)
- Workflow statusa: nacrt → rezervisana → završena
- Logika: Validacija novog status-a, ažuriranje prodaje
- Izlaz: Preusmeravanje na listu prodaja
- Implementacija: `ProdajaController::update()` + `ProdajaUpdateRequest`
- **Test**: `ProdajaFeatureTest::test_can_update_prodaja_status_from_draft_to_reserved` ✅

---

## 🧪 Testiranje

### Pest Framework Konfiguracija

**Korišćeni paketi**:
- `pestphp/pest` - Testing framework
- Refershare database između testova

### Pokretanje Testova

```bash
# Svi testovi
php artisan test --env=testing

# Samo Nekretnina testove
php artisan test tests/Feature/NekretninaFeatureTest.php

# Samo Prodaja testove
php artisan test tests/Feature/ProdajaFeatureTest.php

# Sa code coverage
php artisan test --env=testing --coverage
```

### Testovi (10 Testova, 26 Asertcija) - Svi Prolaze ✅

#### NekretninaFeatureTest.php (4 testa)
1. ✅ `test_can_create_a_new_nekretnina` 
   - Testira: POST `/nekretnina` sa validnim podacima
   - Asertcije: `assertDatabaseHas()`, `assertRedirectToRoute()`

2. ✅ `test_can_update_nekretnina_status_from_available_to_reserved`
   - Testira: PATCH `/nekretnina/{id}` - ažuriranje status-a
   - Asertcije: `assertDatabaseHas()`, `assertRedirectToRoute()`

3. ✅ `test_can_list_all_properties_grouped_by_status`
   - Testira: GET `/nekretnina` - prikaz liste
   - Asertcije: `assertStatus(200)`, `assertViewHas('nekretnine')`

4. ✅ `test_can_delete_a_nekretnina`
   - Testira: DELETE `/nekretnina/{id}`
   - Asertcije: `assertDatabaseMissing()`, `assertRedirectToRoute()`

#### ProdajaFeatureTest.php (4 testa)
5. ✅ `test_can_create_a_new_prodaja_sale`
   - Testira: POST `/prodaja` sa foreign key validacijom
   - Asertcije: `assertDatabaseHas()`, `assertRedirectToRoute()`

6. ✅ `test_can_update_prodaja_status_from_draft_to_reserved`
   - Testira: PATCH `/prodaja/{id}` - status workflow
   - Asertcije: `assertDatabaseHas()`, `assertRedirectToRoute()`

7. ✅ `test_can_view_all_prodajas`
   - Testira: GET `/prodaja` - prikaz liste
   - Asertcije: `assertStatus(200)`, `assertViewHas('prodaje')`

8. ✅ `test_can_delete_a_prodaja`
   - Testira: DELETE `/prodaja/{id}`
   - Asertcije: `assertDatabaseMissing()`, `assertRedirectToRoute()`

#### ExampleTest.php (2 testa)
9. ✅ `test_returns_a_successful_response`
   - Testira: GET `/` - home page
   - Asertcije: `assertStatus(200)`

10. ✅ `that_true_is_true`
    - Unit test primer
    - Asertcije: `assertEquals()`

### Baza za Testiranje

Fajl: `.env.testing`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=prodaja_nekretnina_test
DB_USERNAME=root
DB_PASSWORD=
```

- **RefreshDatabase Trait** - Baza se osvežava pre svakog testa
- **Factory Pattern** - Koristi se `Model::factory()->create()` za generisanje test podataka
- **Authenticacija** - Tests koriste `$this->actingAs($user)` za autentifikovane rute

---

## 🔧 GitHub Actions Workflow

**Fajl**: `.github/workflows/tests.yml`

Ovo je YAML fajl koji automatski:
1. Pokreće se na `push` ka `main` i `develop` granama
2. Pokreće se na `pull_request` ka `main` i `develop` granama
3. Setup MySQL servis
4. Instalira zavisnosti
5. Pokreće sve testove
6. Proverava kod sa Pint-om

**Kod**:
```yaml
name: Tests & Code Style

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main, develop ]

jobs:
  test:
    runs-on: ubuntu-latest

    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_DATABASE: prodaja_nekretnina_test
          MYSQL_ROOT_PASSWORD: root
        options: >-
          --health-cmd="mysqladmin ping"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=3
        ports:
          - 3306:3306

    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.4'
          extensions: mysql
          tools: composer:v2

      - name: Install dependencies
        run: composer install --no-progress --prefer-dist --optimize-autoloader

      - name: Create .env.testing file
        run: |
          cp .env.example .env.testing
          sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env.testing
          sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' .env.testing
          sed -i 's/DB_DATABASE=.*/DB_DATABASE=prodaja_nekretnina_test/' .env.testing
          sed -i 's/DB_USERNAME=.*/DB_USERNAME=root/' .env.testing
          sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=root/' .env.testing

      - name: Generate application key
        run: php artisan key:generate --env=testing

      - name: Run migrations
        run: php artisan migrate --env=testing

      - name: Run tests
        run: php artisan test --env=testing

      - name: Check code style with Pint
        run: ./vendor/bin/pint --test
```

---

## 📊 Dashboard Karakteristike

Razvijeno sa Chart.js 4.4.0 za sve grafikone.

### Grafici

1. **Doughnut Chart** - Nekretnine po status-u
   - Slobodno (zeleno)
   - Rezervisano (žuto)
   - Prodato (crveno)
   - Kod: `resources/views/dashboard.blade.php` - `nekretninaChart`

2. **Bar Chart** - Prodaje po status-u
   - Nacrt (plavo)
   - Rezervisana (žuto)
   - Završena (zeleno)
   - Otkazana (crveno)
   - Kod: `resources/views/dashboard.blade.php` - `prodajaChart`

3. **Horizontal Bar (Funnel) Chart** - Sales value progression
   - Prikazuje ukupnu vrednost nekretnina po svakom status-u
   - EUR valuta sa `Intl.NumberFormat`
   - Kod: `resources/views/dashboard.blade.php` - `funnelChart`

### Tabela
- Poslednje 5 prodaja sa linkovima
- Kupac, Nekretnina, Agent, Status
- Ručno pisana sa Bootstrap tabelom

---

## 🎨 UI/UX Karakteristike

### Layout
- **Fixed Sidebar** (240px) - Levo navigacija (ručno CSS)
  - Uvek vidljiva na desktopu
  - Responsive na mobilnim uređajima (media query)
- **Scrollable Main Content** - Desni deo sa `overflow-y: auto`
- **Bootstrap 5.3.3** - Grid sistem, komponente, responsive

### Welcome Stranica
- Blue gradient pozadina (`linear-gradient(135deg, #1e3c72 → #2a5298)`)
- Centralizovani logo (SVG sa zlatnom kućom)
- "Real Estate Home Solutions" branding
- Responsive button grupe (Log In, Register, Dashboard)
- Ručno pisano

### Favicon
- SVG sa zlatnom kućom
- Vidljiv na svim stranicama
- Inline data URI u layout-u

---

## 📝 Blueprint Skript - Komande

Laravel komande koje su korišćene za inicijalizaciju:

```bash
# Inicijalizacija Laravel projekta
laravel new prodaja_nekretnina

# Instalacija Laravel Breeze za autentifikaciju
php artisan breeze:install

# Kreiranje modela sa migracijama i factory-jima
php artisan make:model Kupac -m -f
php artisan make:model Nekretnina -m -f
php artisan make:model Agent -m -f
php artisan make:model Prodaja -m -f

# Kreiranje resource kontrolera
php artisan make:controller KupacController --resource
php artisan make:controller NekretninaController --resource
php artisan make:controller AgentController --resource
php artisan make:controller ProdajaController --resource
php artisan make:controller DashboardController

# Kreiranje Form Request klasa
php artisan make:request KupacStoreRequest
php artisan make:request KupacUpdateRequest
php artisan make:request NekretninaStoreRequest
php artisan make:request NekretninaUpdateRequest
php artisan make:request ProdajaStoreRequest
php artisan make:request ProdajaUpdateRequest
php artisan make:request AgentStoreRequest
php artisan make:request AgentUpdateRequest

# Pokretanje migracija
php artisan migrate

# Seedovanje test podataka
php artisan db:seed
```

---

## 🔐 Sigurnost

Implementirani sledeći security mehanizmi:

- ✅ Form Request Validation (sve `StoreRequest` i `UpdateRequest` klase)
- ✅ CSRF Zaštita (`@csrf` u svim formama)
- ✅ Authentication middleware (`middleware('auth')` na svim rutama)
- ✅ Mass Assignment Protection (protected `$fillable` u svim modelima)
- ✅ Database Foreign Keys sa ON DELETE constraints
- ✅ SQL Injection zaštita (Laravel Eloquent query builder)

---

## 📦 Korišćene Biblioteke i Verzije

| Biblioteka | Verzija | Namena |
|-----------|---------|---------|
| Laravel | 12.44.0 | Web framework |
| PHP | 8.4.16 | Server-side |
| Bootstrap | 5.3.3 | CSS framework |
| Chart.js | 4.4.0 | JavaScript grafici |
| Pest | Latest | Testing framework |
| Pint | Latest | Code style fixer |
| Font Awesome | 6.x | Ikonografija |

---

## 🚀 Commit Istorija

Projekat ima bogatu commit istoriju sa logičnim grupama:

1. Initial commit (Laravel + Breeze)
2. Database models & migrations
3. Controllers & views
4. Dashboard with Charts
5. Fixed sidebar layout
6. Mobile responsive design
7. Feature tests
8. GitHub Actions workflow
9. Code styling with Pint
10. README dokumentacija

---

## 📞 Kontakt i Podrška

Za pitanja ili probleme, otvorite GitHub issue na:
https://github.com/your-username/prodaja_nekretnina/issues

---

## 📄 Licenca

MIT License - Vidite LICENSE fajl za detalje.

---

**Poslednja Ažuriranja**: Januar 13, 2026
**Verzija**: 1.0.0
**Status**: ✅ Production Ready
