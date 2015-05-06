<?php

namespace Vanbrabantf\Blog\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VanbrabantfBlogUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
