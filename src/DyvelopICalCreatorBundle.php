<?php

namespace Dyvelop\ICalCreatorBundle;

use Dyvelop\ICalCreatorBundle\DependencyInjection\DyvelopICalCreatorExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DyvelopICalCreatorBundle extends Bundle
{
    /**
     * Get container extension
     *
     * @return ExtensionInterface
     */
    public function getContainerExtension()
    {
        if (!$this->extension instanceof ExtensionInterface) {
            $this->extension = new DyvelopICalCreatorExtension();
        }

        return $this->extension;
    }
}
