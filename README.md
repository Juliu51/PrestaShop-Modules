# Name

Demo uzduotis

## About

Prestashop Module for learning purposes. Admin tab with client list.
With active hook(edit,delete,insert) and database.

### Contributing

Prestashop demouzduotis is compatible with all versions of PrestaShop.

#### Installation

1. Copy demouzduotis folder to prestashop/modules directory.
2. On prestashop modules page find demo uzduotis.
3. Install.

#### Use Module

1. On the left side find AdminTest -> open,
2. You can add new client, edit, delete.

3. On main page can configure module.
4. Add "uzduoties pavadinimas" and "uzduoties sunkumas"

###### Tasks in details

1. Sukurti Prestashop modulį:
   1.1. Modulis turi turėti konfigūravimo langą.
   1.2. Tame lange turi būti forma su dviem laukeliais:
   1.2.1. Laisvai įvedamo teksto laukelis su pavadinimu “Užduoties pavadinimas”
   1.2.2. Select tipo laukelis pavadinimu “Užduoties sunkumas”, kuris turėtų tris
   pasirinkimus “Lengva”, “Vidutiniškai sunki”, “Sunki”.
   1.3. Konfigūravimo formoje įvedus užduoties pavadinimą ir pasirinkus sunkumą turi
   būti galimybė išsaugoti pasirinkimus.
   1.4. Pasirinkimai turi būti išsaugoti panaudojus Configuration klasės metodą.
   Išsaugoti pasirinkimai turi būti užkrauti formoje, t. y. perkrovus langą išsaugoti
   pasirinkimai turi išlikti.
   1.5. Modulis turi neturėti klaidų diegiant ir išdiegiant jį iš Prestashop sistemos.
   1.6. Konfigūravimo forma turėtų būti padaryta panaudojant HelperForm klasę.
2. Papildyti pirmąją užduotį, kad diegimo metu būtų sukurta duomenų bazės lentelė
   potencialių klientų informacijai saugoti. Lentelėje turi būti trys laukeliai: automatiškai
   padidėjantis “id” laukelis, kliento vardas, kliento pavardė, kliento el. paštas.
3. Padaryti Admin Controllerį duomenų bazės lentelės duomenims atvaizduoti kaip sąrašą.
   Sąrašui generuoti reikia panaudoti HelperList klasę. Hint: norint pasiekti sukurtą Admin
   controllerį per valdymo zoną būtina užregistruoti sukurtą controllerį per Tab klasę.
4. Papildyti sukurtą Admin Controllerį galimybe pridėti duomenis į duomenų bazę/lentelę
   arba juos redaguoti.
5. Papildyti modulį action hook’u, kuris po prekės sukūrimo sukurtos prekės pavadinimą
   papildytu tekstu “ (Bandomoji užduotis)”;

Papildoma (neprivaloma):

1. Atsinešti HTML turinį į displayFooter ar displayReassurance hooką (fronte) produkto
   puslapyje (tik produkte).
2. Užkrauti papildomą CSS failą (su minimaliu CSS stiliumi).
3. Užkrauti papildomą JS failą.
4. Susikurti Front Controllerį.
5. Minimali html forma su: vardu, pavarde, el.paštu. Paspaudus mygtuką (atsineštame
   blokelyje) įvyksta AJAX post į Jūsų front controllerį. Front controlleris gauną užklausą ->
   validuoja duomenis -> sukuria naują įrašą Admin sukurtame controlleryje.

Papildoma (privaloma):

1. Aiškiai aprašyti kiekvieną funkciją (komentarai) (pavyzdžių galite rasti prie kitų
   Prestashop modulių, Prestashop klasių);
2. Paruošti modulio readme.md failą su bazine informacija: apie, savybės, diegimas,
   trynimas (pavyzdžių galite rasti prie kitų Prestashop modulių);

Link's used:

[1]: https://devdocs.prestashop.com/
[2]: https://www.google.com/search?q=prestashop+module+example&oq=prestashop+modu
[3]: https://www.google.com/search?q=prestashop+module+example&oq=prestashop+modu
[4]: https://francois-steinel.fr/prestashop-module-generator

# Author

https://github.com/Juliu51?tab=repositories
