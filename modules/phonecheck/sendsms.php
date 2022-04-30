<?php
require_once './sms.class.php';

$messages = new \Sms\Xml\Messages('login', 'password');
$messages->setUrl('https://sms.targetsms.ru');
$mes = $messages->createNewMessage('SMS4TEST', 'Hello world!', 'sms');

$abonent = $mes->createAbonent('79510000000');
$abonent->setNumberSms(1);
$mes->addAbonent($abonent);

$abonent = $mes->createAbonent("79200000000");
$abonent->setNumberSms(3);
$abonent->setClientIdSms(1);
$abonent->setTimeSend("2015-12-15 15:12");
$abonent->setValidityPeriod("2015-12-16 16:00");
$mes->addAbonent($abonent);

$messages->addMessage($mes);
if (!$messages->send()) {
    echo $messages->getError();
} else {
    print_r($messages->getResponse());
}