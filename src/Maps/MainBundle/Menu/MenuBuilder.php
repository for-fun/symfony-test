<?php

namespace Maps\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Страницы', ['route' => 'page'])->setAttribute('match', 'page');
        $menu->addChild('Группы', ['route' => 'groups'])->setAttribute('match', 'groups');
        $menu->addChild('Заявки', ['route' => 'groupscomments'])->setAttribute('match', 'groups_comments');
        $menu->addChild('История поиска', ['route' => 'search'])->setAttribute('match', 'search');

        return $menu;
    }

    public function siteMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Группы', ['route' => 'site_groups'])->setAttribute('match', 'groups');
        $menu->addChild('Описание', ['route' => 'site_page_show', 'routeParameters' => ['slug' => 'info']]);
        $menu->addChild("Чат", ['uri' => 'http://forum.ednml.ru/chat/'])->setLinkAttributes([
            'onclick' => 'openWindow(this.href);this.blur();return false;',
        ]);
        $menu->addChild("Форум", ['uri' => 'http://forum.ednml.ru/'])->setLinkAttributes(['target' => '_blank']);

        return $menu;
    }

    public function homeMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Главная', ['route' => 'site_home']);
        $menu->addChild('Список инициативных групп', ['route' => 'site_groups']);
        $menu->addChild('Тех поддержка', ['route' => 'site_page_show', 'routeParameters' => ['slug' => 'info']]);
        $menu->addChild('Стоимость рекламы', ['route' => 'site_page_show', 'routeParameters' => ['slug' => 'reklama']]);
        $menu->addChild('Правила', ['route' => 'site_page_show', 'routeParameters' => ['slug' => 'pravila']]);

        return $menu;
    }

    public function homeMenuRight(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('Форум поиска единомышленников', ['uri' => 'http://forum.ednml.ru/'])->setLinkAttributes(['target' => '_blank']);
        $menu->addChild('Чат единомышленников', ['uri' => 'http://forum.ednml.ru/chat/'])->setLinkAttributes([
            'onclick' => 'openWindow(this.href);this.blur();return false;',
        ]);

        return $menu;
    }

    public function homeMenuCenter(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->addChild("", ['uri' => 'http://forum.ednml.ru/'])->setLinkAttributes(['target' => '_blank']);
        $menu->addChild(" ", ['uri' => 'http://forum.ednml.ru/chat/'])->setLinkAttributes([
            'onclick' => 'openWindow(this.href);this.blur();return false;',
        ]);

        return $menu;
    }
}