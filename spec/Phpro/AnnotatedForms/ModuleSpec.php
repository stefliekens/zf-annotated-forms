<?php

namespace spec\Phpro\AnnotatedForms;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModuleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Phpro\AnnotatedForms\Module');
    }

    public function it_should_implement_autoloader_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\AutoloaderProviderInterface');
    }

    public function it_should_implement_config_provider_interface()
    {
        $this->shouldImplement('Zend\ModuleManager\Feature\ConfigProviderInterface');
    }

    public function it_should_load_config()
    {
        $this->getConfig()->shouldBeArray();
    }

    public function it_should_load_autoloader_config()
    {
        $this->getAutoloaderConfig()->shouldBeArray();
    }
}
