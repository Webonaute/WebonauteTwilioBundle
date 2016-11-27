#Symfony Twilio Bundle (for PHP SDK v5)

About
-----

A quick and easy way to use the Twilio SDK (version 5) in a Symfony based application.

Support for PHP 5.6+, including PHP 7 and Symfony 2.8+, including Symfony 3.

For full documentation about how to use the Twilio Client, see the [official SDK](https://github.com/twilio/twilio-php) provided by [Twilio](http://www.twilio.com/).

Thank you for the awesome work of [Fridolin Koch](http://fkse.io) who created the first version of this bundle, with support for version 4 of the SDK.

Installation
------------

Add this to your `composer.json` file:

```json
"require": {
	"blackford/twilio-bundle": "~5.0",
}
```

This will automatically include the `twilio/sdk` dependency into your project.

Add the bundle to `app/AppKernel.php`

```php
$bundles = array(
	// ... other bundles
	new Blackford\TwilioBundle\BlackfordTwilioBundle(),
);
```

Configuration
-------------

Add this to your `config.yml`:

```yaml
blackford_twilio:
    # (Required) Username to authenticate with, typically your Account SID from www.twilio.com/user/account
    username: 'TODO'
    
    # (Required) Password to authenticate with, typically your Auth Token from www.twilio.com/user/account
    password: 'TODO'
    
    # (Optional) Account Sid to authenticate with, defaults to <username> (typically not required)
    # accountSid: 
    
    # (Optional) Region to send requests to, defaults to no region selection (typically not required)
    # region: 
```


Usage
-----

Provided services:

| Service             | Class                         |
|---------------------|-------------------------------|
| `twilio.client`     | `\Twilio\Rest\Client`         |
|---------------------|-------------------------------|

Inside a controller:

```php
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;

class TestController extends Controller
{
    public function smsAction()
    {
        /** @var \Twilio\Rest\Client */
    	$twilio = $this->get('twilio.client');
        
        $date = date('r');
        
        $message = $twilio->messages->create(
            '+12125551234', // Text any number
            array(
                'from' => '+14085551234', // From a Twilio number in your account
                'body' => "Hi there, it's $date and Twilio is working properly."
            )
        );

        return new Response("Sent message [$message->sid] via Twilio.");
    }
}
```

Inside a console command:

```php
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Twilio\Rest\Client;

class TwilioTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('twilio:test:sms')
            ->setDescription('Test the Twilio integration by sending a text message.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //** @var \Twilio\Rest\Client */
        $twilio = $this->get('twilio.client');
         
         $date = date('r');
         
         $message = $twilio->messages->create(
             '+12125551234', // Text any number
             array(
                 'from' => '+14085551234', // From a Twilio number in your account
                 'body' => "Hi there, it's $date and Twilio is working properly."
             )
         );
        
        $output->writeln("Sent message [$message->sid] via Twilio.");
    }
}
```

Copyright / License
-------------------

See [LICENSE](LICENSE)
