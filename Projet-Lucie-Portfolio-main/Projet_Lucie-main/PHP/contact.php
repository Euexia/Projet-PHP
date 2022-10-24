<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="traitement.php" method="post">
<p>
<strong>Nom<span style="color: #ff0000;">*</span> :</strong> <label for="nom"> </label> <input id="nom" name="nom" size="28" type="text" /> 
<strong>Prénom :</strong> <label for="prenom"></label> <input id="prenom" name="prenom" size="27" type="text" /> <br /><br /> 
<strong> Société : </strong><br /> <label for="societe"> </label> <input id="societe" name="societe" size="81" type="text" /> <br /><br /> 
<strong> RCS : </strong><br /> <label for="rcs"> </label> <input id="rcs" name="rcs" size="81" type="text" /> <br /><br /> 
<strong>Adresse : </strong><br /> <label for="adresse"></label> <input id="adresse" name="adresse" size="81" type="text" /> <br /><br /> 
<strong>Code Postal  :</strong> <label for="code"></label> <input id="code" name="code" size="13" type="text" /> 
<strong>Ville : </strong> <label for="ville"></label> <input id="ville" name="ville" size="39" type="text" /> <br /><br /> 
<strong>Téléphone<span style="color: #ff0000;">*</span> :<label for="telephone"></label></strong> <input id="telephone" name="telephone" size="27" type="text" /> 
<strong>Fax :</strong> <label for="fax"></label> <input id="fax" name="fax" size="27" type="text" /> <br /> <br /> 
<strong>Mail <span style="color: #ff0000;">*</span> : </strong><br /> <label for="mail"> </label><input id="mail" name="mail" size="81" type="text" /></p>
<p>Pour quelle raison nous contactez-vous ?</p>
<label for="motif"></label> <select id="motif" name="motif"> <option value="reglement">Pour un renseignement</option> 
<option value="enquete_commerciales">Pour une vidéo</option>
<option value="enquete_civile">Pour un article</option> 
<option value="recouvrement">Pour autre chose</option> 
 </select>
<p>Message <span style="color: #ff0000;">*</span> :</p>
<p><label for="message"></label> <textarea id="message" cols="52" rows="7" name="message"></textarea></p>
<input type="reset" value="Effacer" /> <input type="submit" value="Envoyer" />
<p> </p>
</form>




<?php
/* Récupération des informations du formulaire*/
if (get_magic_quotes_gpc())
{
 $nom = stripslashes(trim($_POST['nom']));
 $prenom = stripslashes(trim($_POST['prenom']));
 $dossier = stripslashes(trim($_POST['dossier']));    
 $societe = stripslashes(trim($_POST['societe']));
 $rcs = stripslashes(trim($_POST['rcs']));
 $code = stripslashes(trim($_POST['code']));
 $ville = stripslashes(trim($_POST['ville']));
 $telephone = stripslashes(trim($_POST['telephone']));
 $fax = stripslashes(trim($_POST['fax']));
 $mail = stripslashes(trim($_POST['mail']));
 $motif = stripslashes(trim($_POST['motif']));
 $message = stripslashes(trim($_POST['message']));
}     
else      
{
 $nom = trim($_POST['nom']);
 $prenom = trim($_POST['prenom']);
 $dossier = trim($_POST['dossier']);
 $societe = trim($_POST['societe']);
 $rcs = trim($_POST['rcs']);
 $adresse = trim($_POST['adresse']);
 $code = trim($_POST['code']);
 $ville = trim($_POST['ville']);
 $telephone = trim($_POST['telephone']);
 $fax = trim($_POST['fax']);
 $mail = trim($_POST['mail']);
 $motif = trim($_POST['motif']);
 $message = trim($_POST['message']);
}
/*Vérifie si l'adresse mail est au bon format */
 $regex_mail = '/^[-+.w]{1,64}@[-.w]{1,64}.[-.w]{2,6}$/i'; 
 /*Verifie qu il n y est pas d en tête dans les données*/
$regex_head = '/[nr]/';   
/*Vérifie qu il n y est pas d erreur dans adresse mail*/
 if (!preg_match($regex_mail, $mail))
 {
 $alert = 'L'adresse'.$mail.' n'est pas valide';      
 }
 else
{ 
 $courriel = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $courriel = 0;
}     
/* On vérifie qu'il n'y a aucun header dans les champs */ 
if (preg_match($regex_head, $nom)
 || preg_match($regex_head, $prenom)
 || preg_match($regex_head, $dossier)
 || preg_match($regex_head, $societe)
 || preg_match($regex_head, $rcs)
 || preg_match($regex_head, $adresse)
 || preg_match($regex_head, $code)
 || preg_match($regex_head, $ville)
 || preg_match($regex_head, $telephone)
 || preg_match($regex_head, $fax)
 || preg_match($regex_head, $mail)
 || preg_match($regex_head, $motif)
 || preg_match($regex_head, $message))
{  
 $alert = 'En-têtes interdites dans les champs du formulaire'; 
}
else
{ 
 $header = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $header = 0;
}
if (empty($telephone) 
 || empty($nom) 
 || empty($message))
{  
 $alert = 'Tous les champs doivent être renseignés';
} 
else
{  
 $renseigne = 1;
}   
/* On affiche l'erreur s'il y en a une */ 
if (!empty($alert))
{
 $renseigne = 0;
}
/* Si les variables sont bonne */
if ($renseigne == 1 AND $header == 1 AND $courriel == 1)
{
/*Envoi du mail*/

/*Le destinataire*/
$to="demo@fafa-informatique.com";

/*Le sujet du message qui apparaitra*/
$sujet="Message depuis le site";
$msg = '';
/*Le message en lui même*/
/*$msg = 'Mail envoye depuis le site' "rnrn";*/
$msg .= 'Nom : '.$nom."rnrn";
$msg .= 'Prenom : '.$prenom."rnrn";
$msg .= 'Dossier : '.$dossier."rnrn";
$msg .= 'Societe : '.$societe."rnrn";
$msg .= 'RCS : '.$rcs."rnrn";
$msg .= 'Adresse : '.$adresse."rnrn";
$msg .= 'Code : '.$code."rnrn";
$msg .= 'Ville : '.$ville."rnrn";
$msg .= 'Telephone : '.$telephone."rnrn";
$msg .= 'Fax : '.$fax."rnrn";
$msg .= 'Mail : '.$mail."rnrn";
$msg .= 'Motif : '.$motif."rnrn";
$msg .= 'Message : '.$message."rnrn";
/*Les en-têtes du mail*/
$headers = 'From: MESSAGE DU SITE FAFA<demo@fafa-informatique>'."rn";
$headers .= "rn";
/*L'envoi du mail - Et page de redirection*/
mail($to, $sujet, $msg, $headers);
header('Location:http://www.fafa-informatique.com');
}
else
{
header('Location:http://www.fafa-informatique.com');
}
?>
</body>
</html>

