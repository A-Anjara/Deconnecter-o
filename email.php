<?php
header('Content-Type: application/json');
require 'emailer/PHPMailer.php';
require 'emailer/SMTP.php';
require 'emailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
?>
<?php
function send_email($to,$body){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'mail.deconnecte.com';               
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'contact@deconnecte.com';         
    $mail->Password   = 'jorabE123aro72ter!';                  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    try {
        $mail->setFrom('contact@deconnecte.com');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = 'Test Email';
        $mail->Body = $body;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$reponse_message = "Un erreur s'est produite! veuillez ressayez plus tard!";
$status = -1;
                           

if(isset($_POST['submit_inscription'])){
    $email = $_POST['adresse_email'];
    $nom_responsable = $_POST['nom_responsable'];
    $telephone = $_POST['telephone'];
    $nom_enfant = $_POST['nom_enfant'];
    $age = $_POST['age'];
    $classe = $_POST['classe'];
    $contenu_client = <<<contenu
<div style="font-family: system-ui, sans-serif, Arial; font-size: 16px; background-color: #fff8f1">
<div style="max-width: 600px; margin: auto; padding: 16px">
<a style="text-decoration: none; outline: none" href="deconnecte.com" target="_blank">
<img
style="height: 72px; vertical-align: middle"
height="72px"
src="https://deconnecte.com/assets/Logo_texted.png"
alt="logo"
/>
</a>
<p>Bonjour,</p>
<p>
Merci pour votre inscription à Deconnecte.com ! Nous sommes ravis de vous compter parmi notre communauté.
</p>    
<p>
Vous recevrez prochainement toutes les informations nécessaires pour profiter pleinement de nos ateliers et ressources. En attendant, vous pouvez déjà télécharger gratuitement notre <a href="https://deconnecte.com/Charte-familiale.pdf" style="text-decoration: none; outline: none; color: #fc0038" download> Charte familiale </a>et explorer nos contenus sur le site.
</p>
<p>
Si vous avez des questions ou besoin d’assistance, n’hésitez pas à nous écrire à
at
<a href="mailto:contact@deconnecte.com" style="text-decoration: none; outline: none; color: #fc0038"
>contact@deconnecte.com</a
></p>
<br />
<small>Cordialement,<br /><small>L’équipe Dé-Connecté</small></small>
</div>
</div>
contenu;
    $contenu_deconnecte = <<<contenu
<div style="font-family: system-ui, sans-serif, Arial; font-size: 16px; background-color: #fff8f1">
<div style="max-width: 600px; margin: auto; padding: 16px">
<a style="text-decoration: none; outline: none" href="deconnecte.com" target="_blank">
<img
style="height: 72px; vertical-align: middle"
height="72px"
src="https://deconnecte.com/assets/Logo_texted.png"
alt="logo"
/>
</a>
<p>Un nouvel utilisateur vient de s’inscrire sur Deconnecte.com.</p>
<p>
Voici les informations principales :
<ul>
<li>Nom du responsable: $nom_responsable</li>
<li>Adresse email : $email</li>
<li>Téléphone : $telephone</li>
<li>Nom enfant : $nom_enfant</li>
<li>Age : $age</li>
<li>Classe : $classe</li>        
</ul>
</p>
</div>
contenu;
    $reponse_message = "Un erreur s'est produite ! Verifiez si l'email est valide !";
    $status = 0;
    if(send_email("deconnectemadagascar@gmail.com",$contenu_deconnecte)){
        if(send_email($email,$contenu_client)){
            $reponse_message = "Inscription envoyé avec succès";
            $status = 1;
        }
    }
}

if(isset($_POST['submit_contact'])){
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $message = str_replace("\n","<br />",$_POST['message']);
    $contenu_client = <<<contenu
<div style="font-family: system-ui, sans-serif, Arial; font-size: 16px; background-color: #fff8f1">
<div style="max-width: 600px; margin: auto; padding: 16px">
<a style="text-decoration: none; outline: none" href="deconnecte.com" target="_blank">
<img
style="height: 72px; vertical-align: middle"
height="72px"
src="https://deconnecte.com/assets/Logo_texted.png"
alt="logo"
/>
</a>
<p>Bonjour,</p>
<p>
Votre message nous a été bien envoyé 
</p>    
<p>
Nous vous repondrons le plus vite possible.
</p>
<br />
<small>Cordialement,<br /><small>L’équipe Dé-Connecté</small></small>
</div>
</div>

contenu;
    $contenu_deconnecte = <<<contenu
<div style="font-family: system-ui, sans-serif, Arial; font-size: 16px; background-color: #fff8f1">
  <div style="max-width: 600px; margin: auto; padding: 16px">
    <a style="text-decoration: none; outline: none" href="deconnecte.com" target="_blank">
      <img
        style="height: 72px; vertical-align: middle"
        height="72px"
        src="https://deconnecte.com/assets/Logo_texted.png"
        alt="logo"
      />
    </a>
    <p>
      <b>$nom $prenom</b> nous a écrit :
    </p>
    <p>
      "<br />
      $message
      <br />"
    </p>
    <p>
      L'email pour repondre à cette personne: <em>
        <br />$email
      </em>
    </p>
    
  </div>
</div>


contenu;
$reponse_message = "Un erreur s'est produite ! Verifiez si l'email est valide !";
$status = 0;
if(send_email("deconnectemadagascar@gmail.com",$contenu_deconnecte)){
    if(send_email($email,$contenu_client)){
        $reponse_message = "Votre message a été bien envoyé";
        $status = 1;
    }
}

}
if($status == -1){
    $valeur_post = print_r($_POST,true);
    $contenu_erreur = <<<contenu
    <h2>
    UNE ERREUR S'EST PRODUITE SUR L'EMAIL CHEZ deconnecte.com
    </h2>
    <br />
    <br />
    $valeur_post
    contenu;
    send_email("nolynextech@gmail.com",$contenu_erreur);
}
$response = [
    "message"=>$reponse_message,
    "status"=>$status
];
echo json_encode($response);
?>