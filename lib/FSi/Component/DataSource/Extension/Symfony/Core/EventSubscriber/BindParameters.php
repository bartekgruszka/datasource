<?php

/*
 * This file is part of the FSi Component package.
 *
 * (c) Szczepan Cieslik <szczepan@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Component\DataSource\Extension\Symfony\Core\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FSi\Component\DataSource\Event\DataSourceEvents;
use FSi\Component\DataSource\Event\DataSourceEventInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class contains method called at BindParameters events.
 */
class BindParameters implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(DataSourceEvents::PRE_BIND_PARAMETERS => array('preBindParameters', 128));
    }

    /**
     * Method called at PreBindParameters event.
     *
     * @param DataSourceEventInterface $event
     */
    public function preBindParameters(DataSourceEventInterface $event)
    {
        $data = $event->getData();
        if ($data instanceof Request) {
            $event->setData($data->query->all());
        }
    }
}
