
# Obsah načítaný z databáze (`web2`)


Toto cvičení nevyžaduje žádné předchozí výstupy. Další na něj budou ovšem navazovat.


## Úvod

Pro tuto část budeme používat mírně modifikovanou šablonu webu nazvanou **web2**. Od předchozího se liší ve třech oblastech:

1. **Layout (Bootstrap 4)** -- Místo jednořádkového [12sloupcového gridu](https://www.w3schools.com/bootstrap4/bootstrap_grid_system.asp) se svislou navigací a obsahem v poměru 3:9 bude [navigace vodorovná](https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp) umístěná pod hlavičkou. Na samotnou funkci skriptu to nemá žádný vliv, jen si prostě vyzkoušíme jiný layout. I tento web je samozřejmě responzivní. Po zmenšení se zobrazí "hamburgerová" navigace.
2. **Struktura** -- Druhá změna je v konceptu samotných stránek. Jejich obsah je uložený v databázové tabulce a načítá se dynamicky. Není tedy umístěný v příslušných skriptech (souborech PHP).
3. **Navigace** -- I položky v navigaci se generují z tabulky. Nejsou tedy staticky umístěné přímo ve skriptu.  



## Jak to celé funguje     

Celý web se skládá ze čtyř skriptů:

1. **index.php** - hlavním souborem našich stránek bude i nadále soubor `index.php`. Tentokrát bude obsahovat i hlavičku a patičku. Jednotlivé stránky našeho webu budou mít stále formát `index.php?page=nazev-textu`. 
2. **menu.php** - skript z databázové tabulky `texty` vytáhne název `nazev` a URL `urlnazev` všech stránek (kromě Error 404) a vytvoří z nich položky do navigačního menu. Součástí skriptku je i kontrola, která stránka je právě aktivní, aby šla zvýraznit pomocí CSS. 
3. **pripojeni.php** - standardní skript s údaji pro připojení k databázi, který jsme už používali.
4. **priprav-obsah.php** - skript připraví celou obsahovou část (texty), která se na požadované stránce bude používat – nadpis stránky (ve značce `<title>`), texty pro meta značky pro klíčová slova a meta popis a samotný text. Všechny tyto obsahové části stránky se uloží do příslušných proměnných. V souboru `index.php` pak tyto proměnné pouze dosadíme na odpovídající místa a dynamické načítání obsahu z databáze je hotové. 

Všechna důležitá místa jsou ve skriptech okomentovaná, takže se zde nebudu o jejich funkci rozepisovat.

⚠️ Obsahu adresáře `admin` si zatím nevšímejte. Přijde na něj řada v další lekci.


## Instalace šablony `web2`

Instalace vyžaduje tři kroky:

1. "Instalaci" pomocí klonování na server TuX.

    ```
    $ cd ~/www
    $ git clone https://github.com/edumach/web2
    ```

2. Vyplnění přihlašovacích údajů do skriptu `pripojeni.php` (stejné jako u **web1**)
3. Vytvoření databázové tabulky `texty` 

Třetím krokem je vytvoření tabulky pro ukládání textu a meta textů. K tomu si vytvořme novou tabulku se jménem **texty** a s následujícími sloupci:

- **idtextu**: INT, UNSIGNED, AUTO_INCREMENT,
- **nazev**: VARCHAR(100)
- **urlnazev**: VARCHAR(100), UNIQUE
- **klicovaslova**: VARCHAR(100)
- **metapopis**: VARCHAR(255)
- **text**: TEXT

**Poznámka:** U pole **urlnazev** jsme použili možnost `UNIQUE`, protože **každý text musí mít unikátní název**, který bude používat atribut `page` v URL adrese stránky (`...index.php?page=urlnazev`). V opačném případě by došlo ke kolizi názvů. Do této tabulky teď vložíme následující záznamy:

| idtextu | nazev  | urlnazev | klicovaslova  | metapopis    | text   |
| --- | --- | --- | --- | --- | --- |
| 1       | Úvodní stránka | index    | úvod               | Úvodní stránka našeho webu            | Vítejte na naší úvodní stránce!              |
| 2       | O nás          | o-nas    | testovací aplikace | Podstránka, kde se dočtete něco o nás | Předěláváme statické stránky na dynamické.   |
| 3       | Kontakt        | kontakt  | kontakt            | Kontaktujte nás                       | Můžete nás kontaktovat na této adrese.       |
| 4       | Error 404      | error404 | neexistuje         | Požadovaná stránka neexistuje.        | Litujeme, ale požadovaná stránka neexistuje. |

**Hotová tabulka `texty` pro import**:

```sql
DROP TABLE IF EXISTS `texty`;


CREATE TABLE `texty` (
  `idtextu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazev` varchar(100) NOT NULL,
  `urlnazev` varchar(100) NOT NULL,
  `klicovaslova` varchar(100) NOT NULL,
  `metapopis` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`idtextu`),
  UNIQUE KEY `urlnazev` (`urlnazev`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


INSERT INTO `texty` (`idtextu`, `nazev`, `urlnazev`, `klicovaslova`, `metapopis`, `text`) VALUES
(1, 'Domů', 'index', 'úvod', 'Úvodní stránka našeho webu', 'Vítejte na naší úvodní stránce!'),
(2, 'O nás', 'o-nas', 'testovací aplikace', 'Podstránka, kde se dočtete něco o nás', 'Předěláváme statické stránky na dynamické.'),
(3, 'Kontakt', 'kontakt', 'kontakt', 'Kontaktujte nás', 'Můžete nás kontaktovat na této adrese.'),
(4, 'Error 404', 'error404', 'neexistuje', 'Požadovaná stránka neexistuje.', 'Litujeme, ale požadovaná stránka neexistuje.');
```



## Zkouška

Pokud je vše v pořádku, pak by se po načtení URL

```
https://tux.panska.cz/~10XPrijmeniJ/web2
```
měla zobrazit takováto stránka:

<img src="https://php.edumach.cz/img/image-20210306182628020.png">



## ==Cílový stav==

Cílovým stavem po této hodině budou funkční webové stránky.

