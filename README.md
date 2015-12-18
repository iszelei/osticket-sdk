# OsTicketSDK

Read and write sdk for OsTicket 1.9. Read operations requires:
http://www.cyberde.nl/software-en-US/osticket-soap-mod/

### Installition

composer require iszelei/osticket-sdk

### Examples
```
/* FOR WRITE ONLY */
$osTicket = new Iszelei\OsTicketSDK\OsTicketSDK(
	'OSTICKET_API_KEY',
	'OSTICKET_API_URL'
);

$ticket = new Iszelei\OsTicketSDK\Ticket;

$ticket->setName('test SDK')
    ->setEmail('test@email.com')
    ->setSubject('test subject')
    ->setMessage('Test message')
    ->setIp($_SERVER['REMOTE_ADDR'])
    ->setTopicId(16);


$id = $osTicket->createTicket($ticket);

/* FOR READ ONLY */
$staff = new Iszelei\OsTicketSDK\Staff(
	'USERNAME',
	'PASSWORD'
);

$osTicket = new Iszelei\OsTicketSDK\OsTicketSDK(
	null,
	null,
	$staff,
	'WSDL_URL'
);

$departments = $osTicket->listDepartments();

/* FOR READ AND WRITE */
$staff = new Iszelei\OsTicketSDK\Staff(
	'USERNAME',
	'PASSWORD'
);

$osTicket = new Iszelei\OsTicketSDK\OsTicketSDK(
	'OSTICKET_API_KEY',
	'OSTICKET_API_URL',
	$staff,
	'WSDL_URL'
);

$departments = $osTicket->listDepartments();
```