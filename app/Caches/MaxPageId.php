<?php

namespace App\Caches;

use App\Models\Page as PageModel;

class MaxPageId extends Cache
{

    protected $lifetime = 365 * 86400;

    public function getLifetime()
    {
        return $this->lifetime;
    }

    public function getKey($id = null)
    {
        return 'max_id:page';
    }

    public function getContent($id = null)
    {
        $page = PageModel::findFirst(['order' => 'id DESC']);

        return $page->id ?? 0;
    }

}
