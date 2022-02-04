<?php 

    function Joueur($nom, $prenom, $age){
        return 'Bonjour <b>' . $prenom . ' ' . $nom . '</b> !' . estMajeur($age);
    }

    function MangeFruits($nom, $prenom, $fruits){
        $message_fruits = '';

        if(!is_array($fruits)){
            return $message_fruits .= 'Problème, il n\'y a pas de fruits !'; 
        }

        if(empty($fruits)){
            $message_fruits .= '<b>' . $prenom . ' ' . $nom . '</b> ne mange pas de fruits !'; 
        }else{
            if(array_key_exists(0, $fruits)){
                $message_fruits .= '<b>' . $prenom . ' ' . $nom . '</b> mange en priorité : ' . $fruits[0]; 
            }
        }

        return $message_fruits;
    }

    $nom_joueur = 'Platini';
    $prenom_joueur = 'Michel';
    $ageMichel = 35;

    //$sortie = Joueur($nom_joueur, $prenom_joueur, $ageMichel);

    echo '<h2>###### Exercice 1 ######</h2>';

    $fruits = array();

    echo $sortie . MangeFruits($nom_joueur, $prenom_joueur, $fruits);

    echo '<br>';

    $fruits = array('bananes', 'pommes', 'poires');

    echo $sortie . MangeFruits($nom_joueur, $prenom_joueur, $fruits);

    echo '<br>';

    $fruits = '';

    echo $sortie . MangeFruits($nom_joueur, $prenom_joueur, $fruits);

    echo '<br>';

    //echo $sortie;

    function estMajeur($age){
        if($age >= 18){
            return "Vous êtes majeur ! ";
        }else{
            return "Vous êtes mineur  !";
        }
    }

    function prixTTC($tva, $ht){
        return 'Le prix TTC du produit est de ' . $ht * (1 + ($tva / 100)) . ' euros.';
    }

    echo '<hr/>';

    echo '<h2>###### Exercice 2 ######</h2>';

    echo prixTTC(20, 50);

    function afficheCP_43(){
        $init = 43000;

        echo '<label for="pet-select">Choisissez un code postal :</label>';

        echo '<select name="CP43" id="CP43-select">';

        echo '<option value="">--Merci de sélectionner une valeur--</option>';

        while($init <= 43999){
            echo '<option value="' .  $init . '">' . $init . '</option>';
            $init++;
        }

        echo '</select>';
    }

    echo '<hr/>';

    echo '<h2>###### Exercice 3 ######</h2>';

    afficheCP_43();

    function listeCapitales($capitales){
        echo '<h2>Liste des capitales</h2>';

        echo '<ul>';

        foreach($capitales as $key => $value){
            echo '<li><b>' . $key . '</b> a pour capitale <b>' . $value . '</b></li>';
        }

        echo '</ul>';
    }

    $capitales = array(
        'France' => 'Paris',
        'Allemagne' => 'Berlin',
        'Italie' => 'Rome'
    );

    echo '<hr/>';

    echo '<h2>###### Exercice 4 ######</h2>';

    listeCapitales($capitales);

    function getAge($personnes, $prenom){
        return $personnes[$prenom];
    }

    echo '<hr/>';

    echo '<h2>###### Exercice 5 ######</h2>';

    $personnes = array(
        'Jean' => 16,
        'Manuel' => 19,
        'André' => 66
    );

    echo array_keys($personnes)[1] . ' a <b>' . getAge($personnes, array_keys($personnes)[1]) . ' ans</b>.';

    echo '<hr/>';

    echo '<h2>###### Exercice 6 ######</h2>';

    function afficheDate(){
        echo "Nous sommes le <b>" . date('d/m/Y') . '</b> et il est <b>' . date('H:i:s') . '</b>';
    }

    afficheDate();

    echo '<hr/>';

    echo '<h2>###### Exercice 7 ######</h2>';

    function afficheTableauNotes($tableauNotes){
        echo '<table>';

        echo '<thead>';
        echo '  <tr>';
        echo '      <th colspan="2">Tableau des notes</th>';
        echo '  <tr>';
        echo '</thead>';

        echo '<tbody>';
        echo '<tr>';
        echo '<th scope="col">Stagiaire</th>';
        echo '<th scope="col">Note</th>';
        echo '</tr>';

        foreach($tableauNotes as $cle => $valeur){
            echo '<tr>';
            echo    '<td>' . $cle .  '</td>';
            echo    '<td>' . $valeur .  '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

        echo '<style>
                table,
                td, th {
                    border: 1px solid #333;
                    padding: 5px;
                }
                
                thead {
                    background-color: #333;
                    color: #fff;
                }
              </style>';
    }

    $notesStagiaires = array(
        'Frédéric' => 12,
        'Silvia' => 15,
        'Jean-Pierre' => 28
    );

    afficheTableauNotes($notesStagiaires);

    function joueurNoteMAX($tableauJoueurs){
        $max = $tableauJoueurs[0];

        foreach($tableauJoueurs as $joueur){
            if($joueur['score'] > $max['score']){
                $max = $joueur;
            }
        }

        return $max;
    }

    echo '<hr/>';

    echo '<h2>###### Exercice 8 ######</h2>';

    $joueurs = [
        ['nom' => 'Platini', 'score' => 150],
        ['nom' => 'Maldini', 'score' => 90],
        ['nom' => 'Zidane', 'score' => 100]
    ];

    $joueurMax = joueurNoteMAX($joueurs);

    echo '<p><u>Meilleur joueur</u> : <b>' . $joueurMax['nom'] . '</b> avec un score de <b>' . $joueurMax['score'] . '</b></p>';

    class MonCompte{
        private $montant;
        private $pourcentage_interets;

        function __construct($montant_init, $interets_init) {
            $this->montant = $montant_init;
            $this->pourcentage_interets = $interets_init;
        }

        function getMontant(){
            return $this->montant;
        }

        function calculInterets(){
            $this->montant *= 1 + $this->pourcentage_interets / 100;
        }
    }

    // Montant initial sur le compte bancaire
    $montantING = 100;
    
    // Pourcentage d'intérêts
    $interetsING = 0.25;

    $ING = new MonCompte($montantING, $interetsING);

    echo "<u>ING Direct - montant initial sur mon compte</u> : <b>" . $ING->getMontant() . ' euros</b><br/>';

    // Simulation du temps qui passe (10 ans)
    for($i = 1; $i <= 10; $i++){
        // Une nouvelle année
        $ING->calculInterets();
    }

    echo "<u>ING Direct - montant après 10 ans sur mon compte</u> : <b>" . $ING->getMontant() . ' euros</b><br/>';
?>