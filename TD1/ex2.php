<?php
    
$prenom = "Florian";
$nom = "Torres";
$ville = "Grenoble";
$age = "20";

echo "<h3>1. Avec des variables</h3>";
echo "<div>Bonjour, je m'appelle $prenom $nom, je viens de $ville et j'ai $age" . ($age>1 ? " ans" : " an") .".</div>";

$personne = array(
    "prenom" => "Tom", 
    "nom" => "Samaille", 
    "ville" => "Grenoble",
    "age" => "1"
);

echo "<h3>2. Avec un tableau associatif</h3>";
if ($personne) {
    echo "<div>Bonjour, je m'appelle {$personne['prenom']} {$personne['nom']}, je viens de {$personne['ville']} et j'ai {$personne['age']}". ($personne["age"]>1 ? " ans" : " an") .".</div>";
}


echo "<h3>3. Jours de la semaine</h3>";
$week = ["Lundi", "Mardi", "Mercredi", "Jeudimac", "Vendredi", "Samedi", "Dimanche"];
?>

<ul>
<?php
foreach($week as $day) {
    echo "<li>$day</li>";
}
?>
</ul>


<?php

echo "<h3>4. Liste de personnes</h3>";
$personnes = [
    array(
        "prenom" => "Florian", 
        "nom" => "Torres", 
        "ville" => "Grenoble",
        "age" => "20"
    ),
    array(
        "prenom" => "Tom", 
        "nom" => "Samaille", 
        "ville" => "Grenoble",
        "age" => "1"
    ),
    array(
        "prenom" => "Noélie", 
        "nom" => "Bravo",
        "ville" => "Le Sud",
        "age" => "150"
    )
]

?>
<ul>
<?php

if (empty($personnes)) {
    echo "Il n'y a personne dans la liste";
} else {
    foreach($personnes as $personne) {
        echo "<li>".$personne["prenom"]." ".$personne["nom"]." : ".$personne["ville"].",  ".$personne["age"]. ($personne["age"]>1 ? " ans" : " an") .".</li>";
    }
}

?>
</ul>