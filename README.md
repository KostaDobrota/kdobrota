# KDobrota - Online Prodavnica Maslina

Aplikacija za online prodaju maslina i proizvoda od maslina, izrađena u Laravel framework-u.

## Zahtevi

- PHP >= 8.1
- Composer
- Node.js i NPM
- MySQL ili MariaDB
- XAMPP ili sličan lokalni server

## Instalacija

1. Klonirajte repozitorijum:
```bash
git clone [url-repozitorijuma]
```

2. Uđite u direktorijum projekta:
```bash
cd kdobrota
```

3. Pokrenite start.bat skriptu koja će:
- Instalirati Composer zavisnosti
- Kreirati .env fajl
- Generisati aplikacioni ključ
- Kreirati symbolic link za storage
- Pokrenuti migracije i seedere
- Instalirati NPM zavisnosti
- Izgraditi frontend assets

## Pristup aplikaciji

Nakon instalacije, aplikaciji možete pristupiti na:
```
http://localhost/kdobrota/public
```

## Korisnički nalozi

U aplikaciji postoje tri tipa korisnika:

1. Administrator
   - Email: admin@pwa.rs
   - Password: admin

2. Urednik
   - Email: editor@pwa.rs
   - Password: editor

3. Registrovani korisnik
   - Email: user@pwa.rs
   - Password: user

## Funkcionalnosti

### Javni deo
- Pregled istaknutih proizvoda na početnoj strani
- Katalog proizvoda sa filterima
- Detaljan prikaz pojedinačnog proizvoda
- Kontakt stranica sa mapom

### Korisnički deo
- Registracija i prijava
- Pregled i izmena profila
- Istorija narudžbina
- Kreiranje novih narudžbina

### Administratorski deo
- Upravljanje kategorijama
- Upravljanje proizvodima
- Pregled i obrada narudžbina
- Statistički pregled poslovanja

## Tehnologije

- Laravel 10
- MySQL
- Bootstrap 5
- Vite
- Google Charts (za statistiku)
- DataTables
- TinyMCE (WYSIWYG editor)
