<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller as BaseController;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * @property \Cake\Controller\Component\FlashComponent $Flash
 */
class AppController extends BaseController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }
}
