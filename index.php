<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Főoldal</title>
    
    <!-- Bootstrap Core Css -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <!-- Font Awesome Css -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />

	<!-- Bootstrap Select Css -->
    <link href="css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/app_style.css" rel="stylesheet" />
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
    <div class="all-content-wrapper">
		<!-- Top Bar -->
		<?php require_once('./include/header.php'); ?>
		<!-- #END# Top Bar -->
	
		<section class="container">
			<div class="form-group custom-input-space has-feedback">
				<div class="page-heading">
					<h3 class="post-title">Feleadat bemutatása:</h3>
				</div>
				<div class="panel-body">
                    <p style="font-size:15px">
						Egy full-stack alkalmazás elkészítése, amellyel a mellékelt 
						adatokat tudjuk megjeleníteni, kezelni, valamint szűrni.
						Szükség lesz egy szerveroldali (backend) részre, amely kommunikál 
						az adatbázissal és annak tartalmát összeköti a következő,
						kliensoldali (frontend) résszel, amely az adatok böngészőben 
						történő mejelenítéséért lesz felelős. 
						</br>
						</br>
						Adatbázis diagram: <a href="https://dbdiagram.io/d/5eea6d7f9ea313663b3ab44a"> 
						https://dbdiagram.io/d/5eea6d7f9ea313663b3ab44a</a>
						</br>
						</br>
						1. Készítsd el a mellékelt adatbázis sémát egy általad választott adatbázisban (pl. postgres)!
						</br>
						&emsp; - Készítsd el a megadott táblákat!
						</br>
    					&emsp; - Hozdd létre a táblák közötti kapcsolatokat!
						</br>
    					&emsp; - Importáld be az adatokat a mellékelt fájl segítségével!
						</br>
						</br>
 						2. Készíts egy szerveroldali alkalmazást, amely
						</br>
    					&emsp; - Csatlakozik a létrehozott adatbázishoz,
						</br>
    					&emsp; - Bármely paraméter átadásával képes lekérdezni a négy tábla tartalmát ( mindegyik oszlop legyen megadható keresési feltételnek és a teljes táblában szűrjön ),
						</br>
    					&emsp; - Szigorú paraméterezéssel képes új rekordokat létrehozni mind a négy táblába!
						</br>
						</br>
 						3. Készíts egy felületet, amellyel az adatbázisba korábban feltöltött adatokat megjeleníteni és kezelni tudjuk!
						</br>
    					&emsp; - Az alkalmazás központi része a "vasarlas" tábla lesz. Ezt a táblát kell megjelenítenünk egy minimál felületen.
						</br>
    					&emsp; - A "vasarlas" táblában jelenítsük meg, hogy melyik boltban történt a vásárlás (a "bolt" oszlop a megjelnítésnél a "vasarlas" tábla oszlopai között szerepeljen)
						</br>
    					&emsp; - Legyen lehetőségünk a megjelenített táblában sorrendbe (növekvő, csökkenő) rendezni az adatokat bármely oszlop alapján.
						</br>
    					&emsp; - Bármely sor kiválasztása esetén jelenítsük meg a vásárlás részleteit:
						</br>
        				&emsp; &emsp; - Jelenítsük meg a vásárláshoz tartozó tételeket.
						</br>
        				&emsp; &emsp; - Legyen lehetőségünk megtekinteni az adott tételhez tartozó cikkeket.
						</br>
        				&emsp; &emsp; - Adhassunk hozzá ezen a felületen új tételeket, ahol az adott tételhez a "cikkek" táblában lévő cikkek közül tudunk választani.
						</br>
						</br>
 						4. Lehessen a megjelenített és leszűrt adatokat exportálni excel és/vagy csv formátumba!
					</p>
                </div>
			</div>
		</section>
    </div>	
</body>
</html>