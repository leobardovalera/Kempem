<?php
////////////////////////////////////////////////////////////////////////////////
// __________ __             ________                   __________              
// \______   \  |__ ______  /  _____/  ____ _____ ______\______   \ _______  ___
//  |     ___/  |  \\____ \/   \  ____/ __ \\__  \\_  __ \    |  _//  _ \  \/  /
//  |    |   |   Y  \  |_> >    \_\  \  ___/ / __ \|  | \/    |   (  <_> >    < 
//  |____|   |___|  /   __/ \______  /\___  >____  /__|  |______  /\____/__/\_ \
//                \/|__|           \/     \/     \/             \/            \/
// -----------------------------------------------------------------------------
//          Designed and Developed by Brad Jones <brad @="bjc.id.au" />         
// -----------------------------------------------------------------------------
////////////////////////////////////////////////////////////////////////////////

class RoboFile extends Robo\Tasks
{
	/**
	 * Method: test
	 * =========================================================================
	 * This will run our unit / acceptance testing. All the *gears* within
	 * the **PhpGearBox** utlise PhpUnit as the basis for our testing with the
	 * addition of the built in PHP Web Server, making the acceptance tests
	 * almost as portable as standard unit tests.
	 *
	 * Just run: ```php ./vendor/bin/robo test```
	 *
	 * Parameters:
	 * -------------------------------------------------------------------------
	 * n/a
	 *
	 * Returns:
	 * -------------------------------------------------------------------------
	 * void
	 */
	public function test()
	{
		exit($this->taskPHPUnit()->arg('./tests')->run()->getExitCode());
	}
}$container['session_factory'] = $container->factory(function()
{
	return new Session($this['session_storage']);
});

// define container parameters / attributes
$container['cookie_name'] = 'SESSION_ID';

// protecting parameters
$container['random_func'] = $container->protect(function()
{
	return rand();
});
```

> For someone that has previously used the Pimple container you should note that
> instead of the container being passed in via a function parameter. It is
> available via the ```$this``` variable. This is because we bind the closure
> to the container.

**Using a Service Provider:**

```php
use Gears\Di\Container;
use Gears\Di\ServiceProviderInterface;

class FooProvider implements ServiceProviderInterface
{
	public function register(Container $c)
	{
		$c['FooService'] = function(){ return new Foo(); };
	}
}

$container = new Container();
$container->register(new FooProvider());
$container['FooService']->bar();
```

**Object Syntax:**

```php
// you can also use the container like this.
$container = new Container();

$container->session_storage = function ()
{
	return new SessionStorage('SESSION_ID');
};

$container->session = function ()
{
	return new Session($this->session_storage);
};

$session = $container->session;
```

**Extending the Container:**

```php
class Mail extends Container
{
	// note how we prefix the word inject.
	// this tells us that the property is injectable
	protected $injectTo;

	// private properties however will always be
	// private and can not be injected directly.
	private $sendMailPath;

	// so if you tried to inject fooBar it will fail
	private $injectFooBar;

	// from a naming standpoint I think it is best if you name the injectable
	// properties such that it tells you the type that should be injected.
	// however this isn't enforced.
	protected $injectMessage;

	protected $injectTransportService;

	// this is where we can define default services for our container.
	protected function setDefaults()
	{
		// notice how we set them without the word inject
		$this->to = 'brad@bjc.id.au';

		// I could have defined this above directly on the property
		// but I would rather keep everything consistent.
		$this->sendMailPath = '/bin/sendmail';

		$this->message = function()
		{
			return new Message('Hello World');
		};

		// take note of the camel case property name vs the definition above.
		$this->transportService = function()
		{
			return new SendMailTransport($this->sendMailPath);
		};

		// you can use factory and protect too
		// note you don't have to explicitly define a class property.
		// but just note that both abc and xyz are public properties.
		$this->abc = $this->factory(function(){ return new Abc(); });
		$this->xyz = $this->protect(function($a,$b){ return $a+$b; });
	}

	public function send()
	{
		$this->message->setTo($this->to);
		return $this->transportService->send($this->message);
	}
}

$mail = new Mail();
$mail->send(); // sends an email to me saying Hello World

$mail = new Mail();
$mail->to = 'foo@example.com';
$mail->ip = '127.0.0.1';
$mail->message = function(){ return new Message('bar'); };
$mail->transportService = function(){ return new SmtpTransport($this->ip); };
$mail->send(); // sends an email to foo@example.com via 127.0.0.1 saying bar

// the above could be re written as
$mail = new Mail
([
	'to' => 'foo@example.com',
	'ip' => '127.0.0.1',
	'message' => function(){ return new Message('bar'); },
	'transportService' => function(){ return new SmtpTransport($this->ip); },
]);
$mail->send();
```

Credits
--------------------------------------------------------------------------------
This is definitely inspired by Fabien's Pimple Di Container.
http://pimple.sensiolabs.org/

--------------------------------------------------------------------------------
Developed by Brad Jones - brad@bjc.id.au