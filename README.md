# Stupid simple HMVC service for Symfony 2

## Install

In `composer.json`:

```json
"require": {
    "netgusto/hmvc-bundle": "dev-master"
}
```

In `app/AppKernel.php`:

```php
$bundles = array(
    # [...]
    new Netgusto\HMVCBundle\NetgustoHMVCBundle(),
    # [...]
);
```

## Use

```bash

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function someAction(Request $request) {
        
        $newsletterResponse = $this->get('netgusto.hmvc')->delegate('AcmeDemoBundle:SomeOtherController:subscribeNewsletter');

        return $this->render('AcmeDemoBundle:Default:home.html.twig', array(
            'newsletter' => $newsletterResponse->getContent(),
        ));
    }
}
```