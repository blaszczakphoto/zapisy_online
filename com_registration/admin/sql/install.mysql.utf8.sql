DROP TABLE IF EXISTS `#__registration_events`;
DROP TABLE IF EXISTS `#__registration_participants`;


CREATE TABLE `#__registration_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `pttk` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `activation_hash` varchar(100) DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `published` int(11) NOT NULL,
  `params` varchar(100) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `#__registration_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_date_end` date DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `registration_fee` float DEFAULT '0',
  `places` int(100) DEFAULT NULL,
  `extra_info` text,
  `link` varchar(100) DEFAULT NULL,
  `published` int(100) DEFAULT NULL,
  `ordering` int(100) DEFAULT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `params` varchar(1024) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

UPDATE `#__extensions` 
SET `params` = '{\"sender_email\":\"poczta@mazury.pttk.pl\",\"sender_name\":\"Oddzia\\u0142 Warmi\\u0144sko - Mazurski PTTK\",\"bank_details_email\":\"Pieni\\u0105dze prosz\\u0119 przela\\u0107 na konto: Bank Zachodni 19 1500 1562 1215 6004 7189 0000 W tytule prosz\\u0119 wpisa\\u0107 imi\\u0119 i nazwisko oraz nazw\\u0119 wycieczki\",\"bank_details_site\":\"<p>Pieni\\u0105dze prosz\\u0119 przela\\u0107 na konto:<\\/p>\\r\\n<p><strong>Bank Zachodni 19 1500 1562 1215 6004 7189 0000<\\/strong> <br \\/>W tytule prosz\\u0119 wpisa\\u0107:<strong> imi\\u0119 i nazwisko oraz nazw\\u0119 wycieczki<\\/strong><\\/p>\",\"email_footer\":\"Pozdrawiamy,\\r\\nOddzia\\u0142 Warmi\\u0144sko- Mazurski PTTK\\r\\npoczta@mazury.pttk.pl\\r\\n+48 888 777 444\",\"confirmation_email_subject\":\"Potwierd\\u017a swoje uczestnictwo - PTTK -  {EVENT_NAME}\",\"confirmation_email_template\":\"Witaj {PARTICIPANT_NAME}, \\r\\n\\r\\nlink do potwierdzenia zapisu w imprezie turystycznej:\\r\\n{ACTIVATION_URL}\\r\\nSkopiuj link do przegl\\u0105darki lub kliknij go aby aktywowa\\u0107 swoje uczestnictwo w imprezie.\\r\\n\\r\\nSzczeg\\u00f3\\u0142y imprezy:\\r\\nNazwa imprezy: {EVENT_NAME}\\r\\nData imprezy: {EVENT_DATE}\\r\\nWpisowe: {EVENT_REGISTRATION_FEE} PLN\\r\\n\\r\\n{BANK_INFO}\\r\\n\\r\\nDodatkowe informacje:\\r\\n{EVENT_EXTRA_INFO}\\r\\n\\r\\n{MAIL_FOOTER}\",\"cancel_email_title\":\"Pa\\u0144stwa zg\\u0142oszenie zosta\\u0142o skre\\u015blone z listy uczestnik\\u00f3w.\",\"cancel_email_template\":\"Witaj\\r\\n\\r\\nZapisa\\u0142 si\\u0119 i aktywowa\\u0142 nowy uczestnik na imprez\\u0119: {EVENT_NAME}\\r\\n\\r\\nImi\\u0119 i nazwisko: {PARTICIPANT_NAME} {PARTICIPANT_SURNAME}\\r\\nLegitymacja PTTK: {PARTICIPANT_PTTK}\\r\\nE-mail: {PARTICIPANT_PTTK}\\r\\nNumer telefonu: {PARTICIPANT_PHONE}\\r\\nAdres: {PARTICIPANT_ADDRESS}\\r\\n\\r\\n{MAIL_FOOTER}\",\"notify_admin_email_title\":\"Zapisa\\u0142 si\\u0119 nowy uczestnik na imprez\\u0119 - {EVENT_NAME} - {PARTICIPANT_NAME} {PARTICIPANT_SURNAME}\",\"notify_admin_email_template\":\"Witaj\\r\\n\\r\\nZapisa\\u0142 si\\u0119 i aktywowa\\u0142 nowy uczestnik na imprez\\u0119: {EVENT_NAME}\\r\\n\\r\\nImi\\u0119 i nazwisko: {PARTICIPANT_NAME} {PARTICIPANT_SURNAME}\\r\\nLegitymacja PTTK: {PARTICIPANT_PTTK}\\r\\nE-mail: {PARTICIPANT_EMAIL}\\r\\nNumer telefonu: {PARTICIPANT_PHONE}\\r\\nAdres: {PARTICIPANT_ADDRESS}\\r\\n\\r\\n{MAIL_FOOTER}\",\"activation_success_page\":\"<h2>Dzi\\u0119kujemy!<\\/h2>\\r\\n<p>Dzi\\u0119kujemy za potwierdzenie rejestracji. Tw\\u00f3j zapis na imprez\\u0119 turystyczn\\u0105 zosta\\u0142 aktywowany.<\\/p>\\r\\n<p>\\u00a0<\\/p>\\r\\n<p>Poni\\u017cej znajduj\\u0105 si\\u0119\\u00a0szczeg\\u00f3\\u0142owe informacje na temat imprezy.<\\/p>\\r\\n<p>Szczeg\\u00f3\\u0142y imprezy:<br \\/>Nazwa imprezy: {EVENT_NAME}<br \\/>Data imprezy: {EVENT_DATE}<br \\/>Wpisowe: {EVENT_REGISTRATION_FEE} PLN<\\/p>\\r\\n<p>{BANK_INFO}<\\/p>\\r\\n<p>Dodatkowe informacje:<br \\/>{EVENT_EXTRA_INFO}<\\/p>\\r\\n<p><br \\/>Do zobaczenia na imprezie!<\\/p>\",\"registration_form_sent_page\":\"<h2>Dzi\\u0119kujemy za rejestracje na {EVENT_NAME}!<\\/h2>\\r\\n<p><span style=\\\"color: #ff0000;\\\">UWAGA !!! <\\/span><\\/p>\\r\\n<p>Na podany przy zapisie adres e-mail zostanie wys\\u0142any mail, w kt\\u00f3rym nale\\u017cy klikn\\u0105\\u0107 link aktywacyjny w celu potwierdzenia udzia\\u0142u w imprezie turystycznej. Bez tego zapis na imprez\\u0119 b\\u0119dzie niewa\\u017cny !!!<\\/p>\\r\\n<p>\\u00a0<\\/p>\"}'
WHERE `#__extensions`.`element` = 'com_registration';
