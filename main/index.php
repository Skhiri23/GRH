<?php

require_once('connect.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cin = $_POST['cin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];
    $nationality = $_POST['nationality'];
    $civility = $_POST['civility'];
    $children = isset($_POST['nbe']) ? $_POST['nbe'] : '';
    $image = 'aa'; 
    $departement = $_POST['departement'];
    $poste = $_POST['poste'];
    $type_contrat = $_POST['type_contrat'];
    $salaire = $_POST['salaire'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $typeContrat = $_POST['typeContrat'];
    $horaire = $_POST['horaire'];
    $numcarte = $_POST['numcarte'];
    $username = $_POST['username'];
    $password = $_POST['password']; 


   
    $CreateSql = "INSERT INTO employe (cin, nom, prenom, email, gender, age, telephone, nationality, civility, children, image, departement, poste, type_contrat, salaire, dateDebut, dateFin, typeContrat, horaire, numcarte, username, paswrd)
            VALUES ('$cin', '$nom', '$prenom', '$email', '$gender', '$age', '$telephone', '$nationality', '$civility', '$children', '$image', '$departement', '$poste', '$type_contrat', '$salaire', '$dateDebut', '$dateFin', '$typeContrat', '$horaire', '$numcarte', '$username', '$password')";
    $res = mysqli_query($con, $CreateSql) or die(mysqli_error($con));

    if ($res) {
        $message = "Insertion réussie avec succès";
    } else {
        $erreur = "Erreur d'insertion dans la base";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>
	<?php
		include 'navbar.php';
	 ?>

	<div class="container">
		<div class="row pt-4">
			<?php if (isset($message)) { ?>
				<div class="alert alert-success" role="alert">
					<?php echo $message; ?>
				</div> <?php } ?>

				<?php if (isset($erreur)) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $erreur; ?>
				</div> <?php } ?>

			<form action="" method="POST" class="form-horizontal col-md-6 pt-4">
			<fieldset id="personalInfo">
            <h2>Informations personnelles</h2>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Cin</label>
					<div class="col-sm-10">
						<input type="text" name="cin" placeholder="cin" class="form-control" id="input1">
					</div>
				</div>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Nom</label>
					<div class="col-sm-10">
						<input type="text" name="nom" placeholder="Nom" class="form-control" id="input1">
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">prenom</label>
					<div class="col-sm-10">
						<input type="text" name="prenom" placeholder="prenom" class="form-control" id="input1">
					</div>
				</div>
				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" placeholder="e-mail" class="form-control" id="input1">
					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Genre</label>
					<div class="col-sm-10">
						<label>
							<input type="radio" name="gender" id="optionsRadios" value="homme" checked>
							Homme
						</label>
						<label>
							<input type="radio" name="gender" id="optionsRadios" value="femme" checked>
							Femme
						</label>

					</div>
				</div>

				<div class="form-group">
					<label for="input1" class="col-sm-2 control-label">Age</label>
					<div class="col-sm-10">
					<input type="num" name="age" placeholder="age" class="form-control" id="input1">
					</div>
				</div>
				<div class="form-group">
            <label for="inputTelephone" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-10">
                <input type="tel" name="telephone" placeholder="Telephone" class="form-control" id="input1">
            </div>
        </div>
        <div class="form-group">
    <label for="Nationality" class="col-sm-2 control-label">Nationalité</label>
    <div class="col-sm-10">
        <select name="nationality" id="nationality" class="form-control">
        <option value="Afghanistan">Afghanistan</option>
            <option value="Albanie">Albanie</option>
            <option value="Algérie">Algérie</option>
            <option value="Allemagne">Allemagne</option>
            <option value="États-Unis">États-Unis</option>
            <option value="Andorre">Andorre</option>
            <option value="Angola">Angola</option>
            <option value="Antigua-et-Barbuda">Antiguaise-et-Barbudienne (Antigua-et-Barbuda)</option>
            <option value="Argentine">Argentine</option>
            <option value="Arménie">Arménienne (Arménie)</option>
            <option value="Australie">Australienne (Australie)</option>
            <option value="Autriche">Autrichienne (Autriche)</option>
            <option value="Azerbaïdjan">Azerbaïdjanaise (Azerbaïdjan)</option>
            <option value="Bahamas">Bahamienne (Bahamas)</option>
            <option value="Bahreïn">Bahreinienne (Bahreïn)</option>
            <option value="Bangladesh">Bangladaise (Bangladesh)</option>
            <option value="Barbade">Barbadienne (Barbade)</option>
            <option value="Belgique">Belge (Belgique)</option>
            <option value="Belize">Belizienne (Belize)</option>
            <option value="Bénin">Béninoise (Bénin)</option>
            <option value="Bhoutan">Bhoutanaise (Bhoutan)</option>
            <option value="Biélorussie">Biélorusse (Biélorussie)</option>
            <option value="Birmanie">Birmane (Birmanie)</option>
            <option value="Guinée-Bissau">Bissau-Guinéenne (Guinée-Bissau)</option>
            <option value="Bolivie">Bolivienne (Bolivie)</option>
            <option value="Bosnie-Herzégovine">Bosnienne (Bosnie-Herzégovine)</option>
            <option value="Botswana">Botswanaise (Botswana)</option>
            <option value="Brésil">Brésilienne (Brésil)</option>
            <option value="Royaume-Uni">Britannique (Royaume-Uni)</option>
            <option value="Brunéi">Brunéienne (Brunéi)</option>
            <option value="Bulgarie">Bulgare (Bulgarie)</option>
            <option value="Burkina">Burkinabée (Burkina)</option>
            <option value="Burundi">Burundaise (Burundi)</option>
            <option value="Cambodge">Cambodgienne (Cambodge)</option>
            <option value="Cameroun">Camerounaise (Cameroun)</option>
            <option value="Canada">Canadienne (Canada)</option>
            <option value="Cap-Vert">Cap-verdienne (Cap-Vert)</option>
            <option value="Centrafrique">Centrafricaine (Centrafrique)</option>
            <option value="Chili">Chilienne (Chili)</option>
            <option value="Chine">Chinoise (Chine)</option>
            <option value="Chypre">Chypriote (Chypre)</option>
            <option value="Colombie">Colombienne (Colombie)</option>
            <option value="Comores">Comorienne (Comores)</option>
            <option value="Congo-Brazzaville">Congolaise (Congo-Brazzaville)</option>
            <option value="Congo-Kinshasa">Congolaise (Congo-Kinshasa)</option>
            <option value="Îles Cook">Cookienne (Îles Cook)</option>
            <option value="Costa Rica">Costaricaine (Costa Rica)</option>
            <option value="Croatie">Croate (Croatie)</option>
            <option value="Cuba">Cubaine (Cuba)</option>
            <option value="Danemark">Danoise (Danemark)</option>
            <option value="Djibouti">Djiboutienne (Djibouti)</option>
            <option value="République dominicaine">Dominicaine (République dominicaine)</option>
            <option value="Dominique">Dominiquaise (Dominique)</option>
            <option value="Égypte">Égyptienne (Égypte)</option>
            <option value="Émirats arabes unis">Émirienne (Émirats arabes unis)</option>
            <option value="Guinée équatoriale">Équato-guinéenne (Guinée équatoriale)</option>
            <option value="Équateur">Équatorienne (Équateur)</option>
            <option value="Érythrée">Érythréenne (Érythrée)</option>
            <option value="Espagne">Espagnole (Espagne)</option>
            <option value="Timor-Leste">Est-timoraise (Timor-Leste)</option>
            <option value="Estonie">Estonienne (Estonie)</option>
            <option value="Éthiopie">Éthiopienne (Éthiopie)</option>
            <option value="Fidji">Fidjienne (Fidji)</option>
            <option value="Finlande">Finlandaise (Finlande)</option>
            <option value="France">Française (France)</option>
            <option value="Gabon">Gabonaise (Gabon)</option>
            <option value="Gambie">Gambienne (Gambie)</option>
            <option value="Géorgie">Georgienne (Géorgie)</option>
            <option value="Ghana">Ghanéenne (Ghana)</option>
            <option value="Grenade">Grenadienne (Grenade)</option>
            <option value="Guatemala">Guatémaltèque (Guatemala)</option>
            <option value="Guinée">Guinéenne (Guinée)</option>
            <option value="Guyanienne">Guyanienne (Guyana)</option>
            <option value="Haïtienne">Haïtienne (Haïti)</option>
            <option value="Hellénique">Hellénique (Grèce)</option>
            <option value="Hondurienne">Hondurienne (Honduras)</option>
            <option value="Hongroise">Hongroise (Hongrie)</option>
            <option value="Indienne">Indienne (Inde)</option>
            <option value="Indonésienne">Indonésienne (Indonésie)</option>
            <option value="Irakienne">Irakienne (Iraq)</option>
            <option value="Iranienne">Iranienne (Iran)</option>
            <option value="Irlandaise">Irlandaise (Irlande)</option>
            <option value="Islandaise">Islandaise (Islande)</option>
            <option value="Israélienne">Israélienne (Israël)</option>
            <option value="Italienne">Italienne (Italie)</option>
            <option value="Ivoirienne">Ivoirienne (Côte d'Ivoire)</option>
            <option value="Jamaïcaine">Jamaïcaine (Jamaïque)</option>
            <option value="Japonaise">Japonaise (Japon)</option>
            <option value="Jordanienne">Jordanienne (Jordanie)</option>
            <option value="Kazakhstanaise">Kazakhstanaise (Kazakhstan)</option>
            <option value="Kenyane">Kenyane (Kenya)</option>
            <option value="Kirghize">Kirghize (Kirghizistan)</option>
            <option value="Kiribatienne">Kiribatienne (Kiribati)</option>
            <option value="Kittitienne et Névicienne">Kittitienne et Névicienne (Saint-Christophe-et-Niévès)</option>
            <option value="Koweïtienne">Koweïtienne (Koweït)</option>
            <option value="Laotienne">Laotienne (Laos)</option>
            <option value="Lesothane">Lesothane (Lesotho)</option>
            <option value="Lettone">Lettone (Lettonie)</option>
            <option value="Libanaise">Libanaise (Liban)</option>
            <option value="Libérienne">Libérienne (Libéria)</option>
            <option value="Libyenne">Libyenne (Libye)</option>
            <option value="Liechtensteinoise">Liechtensteinoise (Liechtenstein)</option>
            <option value="Lituanienne">Lituanienne (Lituanie)</option>
            <option value="Luxembourgeoise">Luxembourgeoise (Luxembourg)</option>
            <option value="Macédonienne">Macédonienne (Macédoine)</option>
            <option value="Malaisienne">Malaisienne (Malaisie)</option>
            <option value="Malawienne">Malawienne (Malawi)</option>
            <option value="Maldivienne">Maldivienne (Maldives)</option>
            <option value="Malgache">Malgache (Madagascar)</option>
            <option value="Maliennes">Maliennes (Mali)</option>
            <option value="Maltaise">Maltaise (Malte)</option>
            <option value="Marocaine">Marocaine (Maroc)</option>
            <option value="Marshallaise">Marshallaise (Îles Marshall)</option>
            <option value="Mauricienne">Mauricienne (Maurice)</option>
            <option value="Mauritanienne">Mauritanienne (Mauritanie)</option>
            <option value="Mexicaine">Mexicaine (Mexique)</option>
            <option value="Micronésienne">Micronésienne (Micronésie)</option>
            <option value="Moldave">Moldave (Moldovie)</option>
            <option value="Monegasque">Monegasque (Monaco)</option>
            <option value="Mongole">Mongole (Mongolie)</option>
            <option value="Monténégrine">Monténégrine (Monténégro)</option>
            <option value="Mozambicaine">Mozambicaine (Mozambique)</option>
            <option value="Namibienne">Namibienne (Namibie)</option>
            <option value="Nauruane">Nauruane (Nauru)</option>
            <option value="Néerlandaise">Néerlandaise (Pays-Bas)</option>
            <option value="Néo-Zélandaise">Néo-Zélandaise (Nouvelle-Zélande)</option>
            <option value="Népalaise">Népalaise (Népal)</option>
            <option value="Nicaraguayenne">Nicaraguayenne (Nicaragua)</option>
            <option value="Nigériane">Nigériane (Nigéria)</option>
            <option value="Nigérienne">Nigérienne (Niger)</option>
            <option value="Niuéenne">Niuéenne (Niue)</option>
            <option value="Nord-coréenne">Nord-coréenne (Corée du Nord)</option>
            <option value="Norvégienne">Norvégienne (Norvège)</option>
            <option value="Omanaise">Omanaise (Oman)</option>
            <option value="Ougandaise">Ougandaise (Ouganda)</option>
            <option value="Ouzbéke">Ouzbéke (Ouzbékistan)</option>
            <option value="Pakistanaise">Pakistanaise (Pakistan)</option>
            <option value="Palaosienne">Palaosienne (Palaos)</option>
            <option value="Palestinienne">Palestinienne (Palestine)</option>
            <option value="Panaméenne">Panaméenne (Panama)</option>
            <option value="Papouane-Néo-Guinéenne">Papouane-Néo-Guinéenne (Papouasie-Nouvelle-Guinée)</option>
            <option value="Paraguayenne">Paraguayenne (Paraguay)</option>
            <option value="Péruvienne">Péruvienne (Pérou)</option>
            <option value="Philippine">Philippine (Philippines)</option>
            <option value="Polonaise">Polonaise (Pologne)</option>
            <option value="Portugaise">Portugaise (Portugal)</option>
            <option value="Qatarienne">Qatarienne (Qatar)</option>
            <option value="Roumaine">Roumaine (Roumanie)</option>
            <option value="Russe">Russe (Russie)</option>
            <option value="Rwandaise">Rwandaise (Rwanda)</option>
            <option value="Saint-Lucienne">Saint-Lucienne (Sainte-Lucie)</option>
            <option value="Saint-Marinaise">Saint-Marinaise (Saint-Marin)</option>
            <option value="Saint-Vincent-et-les Grenadines">Saint-Vincentaise et Grenadine (Saint-Vincent-et-les Grenadines)</option>
            <option value="Îles Salomon">Salomonaise (Îles Salomon)</option>
            <option value="Salvador">Salvadorienne (Salvador)</option>
            <option value="Samoa">Samoane (Samoa)</option>
            <option value="Sao Tomé-et-Principe">Santoméenne (Sao Tomé-et-Principe)</option>
            <option value="Arabie saoudite">Saoudienne (Arabie saoudite)</option>
            <option value="Sénégal">Sénégalaise (Sénégal)</option>
            <option value="Serbie">Serbe (Serbie)</option>
            <option value="Seychelles">Seychelloise (Seychelles)</option>
            <option value="Sierra Leone">Sierra-Léonaise (Sierra Leone)</option>
            <option value="Singapour">Singapourienne (Singapour)</option>
            <option value="Slovaquie">Slovaque (Slovaquie)</option>
            <option value="Slovénie">Slovène (Slovénie)</option>
            <option value="Somalie">Somalienne (Somalie)</option>
            <option value="Soudan">Soudanaise (Soudan)</option>
            <option value="Sri Lanka">Sri-Lankaise (Sri Lanka)</option>
            <option value="Afrique du Sud">Sud-Africaine (Afrique du Sud)</option>
            <option value="Corée du Sud">Sud-Coréenne (Corée du Sud)</option>
            <option value="Soudan du Sud">Sud-Soudanaise (Soudan du Sud)</option>
            <option value="Suède">Suédoise (Suède)</option>
            <option value="Suisse">Suisse (Suisse)</option>
            <option value="Suriname">Surinamaise (Suriname)</option>
            <option value="Swaziland">Swazie (Swaziland)</option>
            <option value="Syrie">Syrienne (Syrie)</option>
            <option value="Tadjikistan">Tadjike (Tadjikistan)</option>
            <option value="Tanzanie">Tanzanienne (Tanzanie)</option>
            <option value="Tchad">Tchadienne (Tchad)</option>
            <option value="Tchéquie">Tchèque (Tchéquie)</option>
            <option value="Thaïlande">Thaïlandaise (Thaïlande)</option>
            <option value="Togo">Togolaise (Togo)</option>
            <option value="Tonga">Tonguienne (Tonga)</option>
            <option value="Trinité-et-Tobago">Trinidadienne (Trinité-et-Tobago)</option>
            <option value="Tunisie">Tunisienne (Tunisie)</option>
            <option value="Turkménistan">Turkmène (Turkménistan)</option>
            <option value="Turquie">Turque (Turquie)</option>
            <option value="Tuvalu">Tuvaluane (Tuvalu)</option>
            <option value="Ukraine">Ukrainienne (Ukraine)</option>
            <option value="Uruguay">Uruguayenne (Uruguay)</option>
            <option value="Vanuatu">Vanuatuane (Vanuatu)</option>
            <option value="Vatican">Vaticane (Vatican)</option>
            <option value="Venezuela">Vénézuélienne (Venezuela)</option>
            <option value="Viêt Nam">Vietnamienne (Viêt Nam)</option>
            <option value="Yémen">Yéménite (Yémen)</option>
            <option value="Zambie">Zambienne (Zambie)</option>
            <option value="Zimbabwe">Zimbabwéenne (Zimbabwe)</option>
        </select>
    </div>
</div>
				<label for="inputCivility" class="col-sm-2 control-label">Civilité</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="civility" id="inlineRadio1" value="married" onclick="showChildrenInput()">
                    <label class="form-check-label" for="inlineRadio1">Married</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="civility" id="inlineRadio2" value="single" onclick="hideChildrenInput()">
                    <label class="form-check-label" for="inlineRadio2">Single</label>
                </div>
            </div>
			<div class="form-group" id="childrenInput" style="display: none;">
            <label for="inputChildren" class="col-sm-2 control-label">Nb D'enfant</label>
            <div class="col-sm-10">
                <input type="number" name="nbe" placeholder="Nombre D'enfant" class="form-control" id="inputChildren">
            </div>
        </div>
		<div class="form-group">
            <label for="inputImage" class="col-sm-2 control-label">Upload Image</label>
            <div class="col-sm-10">
                <input type="file" name="image" class="form-control-file" id="inputImage">
            </div>
        </div>
		<button type="button" onclick="showContractDetails()" class="btn btn-primary mr-2">Next</button>

		</fieldset>

		<fieldset id="contractDetails" style="display: none;">
            <legend>Contract Details</legend>
            <div class="form-group">
    <label for="inputDepartement" class="col-sm-2 control-label">Département</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputDepartement" name="departement">
            <option value="developpement">Departement</option>
            <option value="developpement">Développement logiciel</option>
            <option value="gestion_projet">Gestion de projet</option>
            <option value="qualite">Qualité logicielle</option>
            <option value="infra_reseaux">Infrastructure et Réseaux</option>
            <option value="conception_ux_ui">Conception UX/UI</option>
            <option value="support_technique">Support Technique</option>
            <option value="recherche_developpement">Recherche et Développement</option>
            <option value="Ressource_Humaine">Ressource Humaine</option>
        </select>
    </div>
</div>

<div class="form-group" id="postesContainer" style="display: none;">
    <label for="inputPoste" class="col-sm-2 control-label">Poste</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputPoste" name="poste">
            
        </select>
    </div>
</div>

    <div class="form-group">
    <label for="type_contrat" class="col-sm-2 control-label">Type de contrat</label>
    <div class="col-sm-10">
        <select name="type_contrat" id="type_contrat" class="form-control">
            <option value="CDI">CDI (Contrat à Durée Indéterminée)</option>
            <option value="CDD">CDD (Contrat à Durée Déterminée)</option>
            <option value="Stage">Stage</option>
            <option value="Apprentissage">Apprentissage</option>
            <option value="Freelance">Freelance</option>
            <option value="Auto-entrepreneur">Auto-entrepreneur</option>
            <option value="Consultant">Consultant</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="inputSalaire" class="col-sm-2 control-label">Salaire brut</label>
    <div class="col-sm-10">
        <input type="text" name="salaire" placeholder="Salaire brut" class="form-control" id="inputSalaire">
    </div>
</div>
<div class="form-group">
    <label for="numcarte" class="col-sm-2 control-label">Numero carte</label>
    <div class="col-sm-10">
        <input type="text" name="numcarte" class="form-control" id="numcarte">
    </div>
</div>
<div class="form-group">
    <label for="dateDebut" class="col-sm-2 control-label">Date de début</label>
    <div class="col-sm-10">
        <input type="date" name="dateDebut" class="form-control" id="dateDebut">
    </div>
</div>

<div class="form-group">
    <label for="dateFin" class="col-sm-2 control-label">Date de fin</label>
    <div class="col-sm-10">
        <input type="date" name="dateFin" class="form-control" id="dateFin">
    </div>
</div>

<div class="form-group">
    <label for="NBjour" class="col-sm-2 control-label">Jour/semaine</label>
    <div class="col-sm-10">
        <select name="typeContrat" id="typeContrat" class="form-control">
            <option value="5 jours par semaine"> 5 jours par semaine</option>
            <option value="4 jours par semaine ">4 jours par semaine  </option>
            <option value="3 jours par semain">3 jours par semaine</option>
            <option value="Télétravail">Télétravail</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="horaire" class="col-sm-2 control-label">Horaire</label>
    <div class="col-sm-10">
        <select name="horaire" id="horaire" class="form-control">
        <option value="8h00 à 16h00 "> 8h00 à 16h00 </option>
            <option value="9h00 à 17h00">9h00 à 17h00 </option>
            <option value="10h00 à 18h00">10h00 à 18h00  </option>
        </select>
    </div>
</div>
			<button type="button" onclick="showPersonalInfo()" class="btn btn-secondary mr-2">Previous</button>
			<button type="button" onclick="showProfile()" class="btn btn-primary mr-2">Next</button>
        </fieldset>
		<fieldset id="profileDetails" style="display: none;">
            <legend>Profile Details</legend>
            <div class="form-group">
                <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" placeholder="Username" class="form-control" id="inputUsername" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" name="password" placeholder="Password" class="form-control" id="inputPassword" readonly>
                </div>
            </div>
          
            <button type="button" onclick="showContractDetails()" class="btn btn-secondary mr-2">Previous</button>
            <input type="submit" value="Submit" class="btn btn-success">
        </fieldset>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script type='text/javascript' id="soledad-pagespeed-header" data-cfasync="false">!function(n,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(n="undefined"!=typeof globalThis?globalThis:n||self).LazyLoad=t()}(this,(function(){"use strict";function n(){return n=Object.assign||function(n){for(var t=1;t<arguments.length;t++){var e=arguments[t];for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(n[i]=e[i])}return n},n.apply(this,arguments)}var t="undefined"!=typeof window,e=t&&!("onscroll"in window)||"undefined"!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),i=t&&"IntersectionObserver"in window,o=t&&"classList"in document.createElement("p"),a=t&&window.devicePixelRatio>1,r={elements_selector:".lazy",container:e||t?document:null,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",data_bg_hidpi:"bg-hidpi",data_bg_multi:"bg-multi",data_bg_multi_hidpi:"bg-multi-hidpi",data_poster:"poster",class_applied:"applied",class_loading:"loading",class_loaded:"loaded",class_error:"error",class_entered:"entered",class_exited:"exited",unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},c=function(t){return n({},r,t)},u=function(n,t){var e,i="LazyLoad::Initialized",o=new n(t);try{e=new CustomEvent(i,{detail:{instance:o}})}catch(n){(e=document.createEvent("CustomEvent")).initCustomEvent(i,!1,!1,{instance:o})}window.dispatchEvent(e)},l="src",s="srcset",f="sizes",d="poster",_="llOriginalAttrs",g="loading",v="loaded",b="applied",p="error",h="native",m="data-",E="ll-status",I=function(n,t){return n.getAttribute(m+t)},y=function(n){return I(n,E)},A=function(n,t){return function(n,t,e){var i="data-ll-status";null!==e?n.setAttribute(i,e):n.removeAttribute(i)}(n,0,t)},k=function(n){return A(n,null)},L=function(n){return null===y(n)},w=function(n){return y(n)===h},x=[g,v,b,p],O=function(n,t,e,i){n&&(void 0===i?void 0===e?n(t):n(t,e):n(t,e,i))},N=function(n,t){o?n.classList.add(t):n.className+=(n.className?" ":"")+t},C=function(n,t){o?n.classList.remove(t):n.className=n.className.replace(new RegExp("(^|\\s+)"+t+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,"")},M=function(n){return n.llTempImage},z=function(n,t){if(t){var e=t._observer;e&&e.unobserve(n)}},R=function(n,t){n&&(n.loadingCount+=t)},T=function(n,t){n&&(n.toLoadCount=t)},G=function(n){for(var t,e=[],i=0;t=n.children[i];i+=1)"SOURCE"===t.tagName&&e.push(t);return e},D=function(n,t){var e=n.parentNode;e&&"PICTURE"===e.tagName&&G(e).forEach(t)},V=function(n,t){G(n).forEach(t)},F=[l],j=[l,d],P=[l,s,f],S=function(n){return!!n[_]},U=function(n){return n[_]},$=function(n){return delete n[_]},q=function(n,t){if(!S(n)){var e={};t.forEach((function(t){e[t]=n.getAttribute(t)})),n[_]=e}},H=function(n,t){if(S(n)){var e=U(n);t.forEach((function(t){!function(n,t,e){e?n.setAttribute(t,e):n.removeAttribute(t)}(n,t,e[t])}))}},B=function(n,t,e){N(n,t.class_loading),A(n,g),e&&(R(e,1),O(t.callback_loading,n,e))},J=function(n,t,e){e&&n.setAttribute(t,e)},K=function(n,t){J(n,f,I(n,t.data_sizes)),J(n,s,I(n,t.data_srcset)),J(n,l,I(n,t.data_src))},Q={IMG:function(n,t){D(n,(function(n){q(n,P),K(n,t)})),q(n,P),K(n,t)},IFRAME:function(n,t){q(n,F),J(n,l,I(n,t.data_src))},VIDEO:function(n,t){V(n,(function(n){q(n,F),J(n,l,I(n,t.data_src))})),q(n,j),J(n,d,I(n,t.data_poster)),J(n,l,I(n,t.data_src)),n.load()}},W=["IMG","IFRAME","VIDEO"],X=function(n,t){!t||function(n){return n.loadingCount>0}(t)||function(n){return n.toLoadCount>0}(t)||O(n.callback_finish,t)},Y=function(n,t,e){n.addEventListener(t,e),n.llEvLisnrs[t]=e},Z=function(n,t,e){n.removeEventListener(t,e)},nn=function(n){return!!n.llEvLisnrs},tn=function(n){if(nn(n)){var t=n.llEvLisnrs;for(var e in t){var i=t[e];Z(n,e,i)}delete n.llEvLisnrs}},en=function(n,t,e){!function(n){delete n.llTempImage}(n),R(e,-1),function(n){n&&(n.toLoadCount-=1)}(e),C(n,t.class_loading),t.unobserve_completed&&z(n,e)},on=function(n,t,e){var i=M(n)||n;nn(i)||function(n,t,e){nn(n)||(n.llEvLisnrs={});var i="VIDEO"===n.tagName?"loadeddata":"load";Y(n,i,t),Y(n,"error",e)}(i,(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_loaded),A(t,v),O(e.callback_loaded,t,i),o||X(e,i)}(0,n,t,e),tn(i)}),(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_error),A(t,p),O(e.callback_error,t,i),o||X(e,i)}(0,n,t,e),tn(i)}))},an=function(n,t,e){!function(n){n.llTempImage=document.createElement("IMG")}(n),on(n,t,e),function(n){S(n)||(n[_]={backgroundImage:n.style.backgroundImage})}(n),function(n,t,e){var i=I(n,t.data_bg),o=I(n,t.data_bg_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage='url("'.concat(r,'")'),M(n).setAttribute(l,r),B(n,t,e))}(n,t,e),function(n,t,e){var i=I(n,t.data_bg_multi),o=I(n,t.data_bg_multi_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage=r,function(n,t,e){N(n,t.class_applied),A(n,b),e&&(t.unobserve_completed&&z(n,t),O(t.callback_applied,n,e))}(n,t,e))}(n,t,e)},rn=function(n,t,e){!function(n){return W.indexOf(n.tagName)>-1}(n)?an(n,t,e):function(n,t,e){on(n,t,e),function(n,t,e){var i=Q[n.tagName];i&&(i(n,t),B(n,t,e))}(n,t,e)}(n,t,e)},cn=function(n){n.removeAttribute(l),n.removeAttribute(s),n.removeAttribute(f)},un=function(n){D(n,(function(n){H(n,P)})),H(n,P)},ln={IMG:un,IFRAME:function(n){H(n,F)},VIDEO:function(n){V(n,(function(n){H(n,F)})),H(n,j),n.load()}},sn=function(n,t){(function(n){var t=ln[n.tagName];t?t(n):function(n){if(S(n)){var t=U(n);n.style.backgroundImage=t.backgroundImage}}(n)})(n),function(n,t){L(n)||w(n)||(C(n,t.class_entered),C(n,t.class_exited),C(n,t.class_applied),C(n,t.class_loading),C(n,t.class_loaded),C(n,t.class_error))}(n,t),k(n),$(n)},fn=["IMG","IFRAME","VIDEO"],dn=function(n){return n.use_native&&"loading"in HTMLImageElement.prototype},_n=function(n,t,e){n.forEach((function(n){return function(n){return n.isIntersecting||n.intersectionRatio>0}(n)?function(n,t,e,i){var o=function(n){return x.indexOf(y(n))>=0}(n);A(n,"entered"),N(n,e.class_entered),C(n,e.class_exited),function(n,t,e){t.unobserve_entered&&z(n,e)}(n,e,i),O(e.callback_enter,n,t,i),o||rn(n,e,i)}(n.target,n,t,e):function(n,t,e,i){L(n)||(N(n,e.class_exited),function(n,t,e,i){e.cancel_on_exit&&function(n){return y(n)===g}(n)&&"IMG"===n.tagName&&(tn(n),function(n){D(n,(function(n){cn(n)})),cn(n)}(n),un(n),C(n,e.class_loading),R(i,-1),k(n),O(e.callback_cancel,n,t,i))}(n,t,e,i),O(e.callback_exit,n,t,i))}(n.target,n,t,e)}))},gn=function(n){return Array.prototype.slice.call(n)},vn=function(n){return n.container.querySelectorAll(n.elements_selector)},bn=function(n){return function(n){return y(n)===p}(n)},pn=function(n,t){return function(n){return gn(n).filter(L)}(n||vn(t))},hn=function(n,e){var o=c(n);this._settings=o,this.loadingCount=0,function(n,t){i&&!dn(n)&&(t._observer=new IntersectionObserver((function(e){_n(e,n,t)}),function(n){return{root:n.container===document?null:n.container,rootMargin:n.thresholds||n.threshold+"px"}}(n)))}(o,this),function(n,e){t&&window.addEventListener("online",(function(){!function(n,t){var e;(e=vn(n),gn(e).filter(bn)).forEach((function(t){C(t,n.class_error),k(t)})),t.update()}(n,e)}))}(o,this),this.update(e)};return hn.prototype={update:function(n){var t,o,a=this._settings,r=pn(n,a);T(this,r.length),!e&&i?dn(a)?function(n,t,e){n.forEach((function(n){-1!==fn.indexOf(n.tagName)&&function(n,t,e){n.setAttribute("loading","lazy"),on(n,t,e),function(n,t){var e=Q[n.tagName];e&&e(n,t)}(n,t),A(n,h)}(n,t,e)})),T(e,0)}(r,a,this):(o=r,function(n){n.disconnect()}(t=this._observer),function(n,t){t.forEach((function(t){n.observe(t)}))}(t,o)):this.loadAll(r)},destroy:function(){this._observer&&this._observer.disconnect(),vn(this._settings).forEach((function(n){$(n)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(n){var t=this,e=this._settings;pn(n,e).forEach((function(n){z(n,t),rn(n,e,t)}))},restoreAll:function(){var n=this._settings;vn(n).forEach((function(t){sn(t,n)}))}},hn.load=function(n,t){var e=c(t);rn(n,e)},hn.resetStatus=function(n){k(n)},t&&function(n,t){if(t)if(t.length)for(var e,i=0;e=t[i];i+=1)u(n,e);else u(n,t)}(hn,window.lazyLoadOptions),hn}));

(function () {

    var PenciLazy = new LazyLoad({
        elements_selector: '.penci-lazy',
        data_bg: 'bgset',
        class_loading: 'lazyloading',
        class_entered: 'lazyloaded',
        class_loaded: 'pcloaded',
        unobserve_entered: true
    });

    MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

    var observer = new MutationObserver(function(mutations, observer) {
        PenciLazy.update();
    });

    observer.observe(document, {
        subtree: true,
        attributes: true
    });
})();
</script>
<script>
   
    const marriedRadio = document.getElementById('inlineRadio1');
    const childrenInput = document.getElementById('childrenInput');
 
    marriedRadio.addEventListener('change', function() {
         if (marriedRadio.checked) {
            childrenInput.style.display = 'block';
        } else {
             childrenInput.style.display = 'none';
        }
    });
	function showContractDetails() {
        document.getElementById('personalInfo').style.display = 'none';
        document.getElementById('contractDetails').style.display = 'block';
        document.getElementById('profileDetails').style.display = 'none';
        document.getElementById('buttonsFieldset').style.display = 'none';
    }

    function showPersonalInfo() {
        document.getElementById('personalInfo').style.display = 'block';
        document.getElementById('contractDetails').style.display = 'none';
        document.getElementById('profileDetails').style.display = 'none';
        document.getElementById('buttonsFieldset').style.display = 'none';
    }

    function showProfile() {
        document.getElementById('personalInfo').style.display = 'none';
        document.getElementById('contractDetails').style.display = 'none';
        document.getElementById('profileDetails').style.display = 'block';
        document.getElementById('buttonsFieldset').style.display = 'block';
    }
	   
        var username = generateRandomString(8);
    var password = generateRandomString(8);
    
     document.getElementById('inputUsername').value = username;
    document.getElementById('inputPassword').value = password;

     function generateRandomString(length) {
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        var result = "";
        for (var i = 0; i < length; i++) {
            result += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        return result;
    }
</script>
<script>
    $(document).ready(function() {
    $('#inputDepartement').change(function() {
        var selectedDepartment = $(this).val();
        var postes = [];

         $('#inputPoste').empty();

         switch (selectedDepartment) {
    case 'developpement':
        postes = ['Développeur', 'Ingénieur QA', 'Architecte logiciel', 'Développeur front-end', 'Développeur back-end'];
        break;
    case 'gestion_projet':
        postes = ['Chef de projet', 'Assistant chef de projet', 'Analyste fonctionnel', 'Chef de projet technique', 'Scrum Master'];
        break;
    case 'qualite':
        postes = ['Analyste qualité', 'Testeur logiciel', 'Responsable qualité', 'Auditeur qualité', 'Analyste de sécurité informatique'];
        break;
    case 'infra_reseaux':
        postes = ['Administrateur système', 'Ingénieur réseau', 'Technicien support', 'Spécialiste en cybersécurité', 'Architecte infrastructure'];
        break;
    case 'conception_ux_ui':
        postes = ['Designer UX/UI', 'Concepteur graphique', 'Intégrateur web', 'UX Researcher', 'Spécialiste en accessibilité web'];
        break;
    case 'support_technique':
        postes = ['Technicien informatique', 'Hotliner', 'Spécialiste en maintenance', 'Technicien réseau', 'Technicien helpdesk'];
        break;
    case 'recherche_developpement':
        postes = ['Chercheur', 'Scientifique des données', 'Ingénieur R&D', 'Analyste en intelligence artificielle', 'Spécialiste en apprentissage automatique', 'Agent RH'];
        break;
    case 'Ressource_Humaine':
        postes = ['Agent RH'];
        break;
    default:
        break;
}


        $.each(postes, function(index, value) {
            $('#inputPoste').append($('<option>').text(value).attr('value', value));
        });

        $('#postesContainer').show();
    });
});
</script>
</body>
</html>