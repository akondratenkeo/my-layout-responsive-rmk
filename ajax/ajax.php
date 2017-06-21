<?php
if ($_POST) {
    
	require_once('./class.php');

	$json = array();
	$json['error'] = "";

	$name = htmlspecialchars($_POST["name"]);
	$phone = htmlspecialchars($_POST["phone"]);
    $country = htmlspecialchars($_POST["country"]);
    
    if (!$name || !$phone) {
        $json['error'] = 'Вы заполнили не все поля!';
        echo json_encode($json);
        die();
    }

    $emailgo = new TEmail;
    $emailgo->from_email = 'noreply@itunion.com.ua';
    $emailgo->from_name = 'Обратный звонок [РМК]';
    $emailgo->to_email = 'Lkprog.pk@gmail.com';
    $emailgo->to_name = '';
    $emailgo->subject = 'Новая заявка на обратный звонок - ' . $country;
    $emailgo->body = 	'<div style="background: #fffce8; border: 1px solid #cecece; padding: 15px">'.
                        '<b>Заявка от:</b><br>' . $name . '<br><br>'.
                        '<b>Телефон:</b><br>' . $phone . '<br><br>'.
                        '</div>';
    $emailgo->send();
	
	echo json_encode($json);

} else {
	echo 'GET LOST!';
}