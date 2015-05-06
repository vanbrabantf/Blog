<?php

namespace Vanbrabantf\Blog\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VanbrabantfBlogAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataAdminBundle';
    }
}
