<?php
/**
 * Created by PhpStorm.
 * User: gbine
 * Date: 16/11/18
 * Time: 16:35
 */

namespace App\Menu;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class Filter implements FilterInterface
{

    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
            return false;
        }
    }
}