# Beeout – Project Documentation / Documentazione del Progetto

## Versione Italiana

### 1. Panoramica del Progetto
Beeout è un’applicazione web e mobile progettata per aiutare gli utenti a trovare locali che offrono aperitivi.  
Fornisce informazioni in tempo reale sui locali, tra cui orari di apertura, posizione e descrizione dei locali.

**Nota:** al momento il backend è stato sviluppato solo parzialmente e il frontend non è stato implementato dall'autore di questo codice sorgente.

### 2. Stack Tecnologico
- Backend: Laravel 12.x, PHP 8.3
- Frontend: Angular 17 con SSR (non sviluppato)
- Mobile: Ionic + Capacitor (non sviluppato)
- Database: MySQL (dockerizzato)
- Autenticazione: Laravel Sanctum (basata su token per SPA/mobile; login web con cookie non ancora implementato)
- Containerizzazione: Docker & Docker Compose
- UI/Stilizzazione: Tailwind CSS (Bootstrap fallback)

### 4. Backend Features
- CRUD per `Places`
- Autenticazione User con Sanctum (token-based per SPA/mobile; login web con cookie non ancora implementato)
- Rotte API versionate sotto `/api/v1`
- Validazione input tramite classi `FormRequest`

### 5. Frontend Features
**Non sviluppato** – previsto interfaccia basata su mappa con filtri per orari e descrizione locali.

### 6. Applicazione Mobile
**Non sviluppata** – prevista conversione del frontend Angular con Ionic + Capacitor.

---

## English Version

### 1. Project Overview
Beeout is a web and mobile application designed to help users discover venues offering aperitifs.  
It provides real-time information about places, including opening hours, location, and venue descriptions.

**Note:** currently the backend is only partially developed, and the frontend has not been implemented by the author of this source code.

### 2. Tech Stack
- Backend: Laravel 12.x, PHP 8.3
- Frontend: Angular 17 with SSR (not developed)
- Mobile: Ionic + Capacitor (not developed)
- Database: MySQL (dockerized)
- Authentication: Laravel Sanctum (token-based for SPA/mobile; web login via cookie not yet implemented)
- Containerization: Docker & Docker Compose
- UI/Styling: Tailwind CSS (Bootstrap fallback)

### 3. Backend Features
- CRUD for `Places`
- - `User` authentication with Sanctum (token-based for SPA/mobile; web login via cookie not yet implemented)
- API routes versioned under `/api/v1`
- Input validation via `FormRequest` classes

### 4. Frontend Features
**Not developed** – planned map-based interface with filters for time slots and venue descriptions.

### 5. Mobile App
**Not developed** – planned conversion of Angular frontend to mobile app using Ionic + Capacitor.

### 6. Project Structure

```text
beeout/
├── backend/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── api/
│   │   │   │   │   └── v1/
│   │   │   │   │       ├── PlaceController.php
│   │   │   │   │       ├── UserController.php
│   │   │   │   │       └── ...
│   │   │   ├── Requests/
│   │   │   ├── Resources/
│   │   ├── Models/
│   ├── routes/
│   │   ├── api.php
│   │   └── web.php
├── frontend/
│   └── src/
│       └── app/
│           ├── components/
│           ├── pages/
│           └── services/
├── docker-compose.yml
├── Dockerfile
└── README.md
