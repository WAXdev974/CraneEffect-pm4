<?php

namespace wax\CraneEffect;

use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class event extends Listener{

    /**
     * @var array
     */
    private $CraneEffect;

    private $cooldown = [];

    public function __construct()
    {
        $this->CraneMinage = [
            '369:0' => array( new EffectInstance(
                Effect::getEffect(Effect::HASTE),
                Effect::getEffect(Effect::SPEED),
                200000 * 100000,
                2,
                false
            ), 'Vous utiliser votre Crane de Mineur'
        ]
            $this->CraneFarm = [
                '332:0' => array( new EffectInstance(
                    Effect::getEffect(Effect::HASTE),
                    Effect::getEffect(Effect::SPEED),
                    Effect::getEffect(Effect::NIGHT_VISION),
                    200000 * 100000,
                    3,
                    false
                ), 'Vous Utuliser votre Crane de Farmeur'
            ]
    }

    public function onInteract(PlayerInteractEvent $event){
        $item = $event->getItem();
        $idMeta = $item->getid() . ':' . $item->getDamage();
        if(isset($this->CraneMinage[$idMeta])){
            $player = $event->getPlayer();
            $LastPlayerTime = $this->cooldown[$player->getName()] ?? 0;
            $timeNow = time();
            if($timeNow - $LastPlayerTime >= 5){
                $player->addEffect($this->CraneMinage[$idMeta][0]);
                $player->getInventory()->removeItem($item->setCount(60));
                $this->cooldown[$player->getName()] = $timeNow;
                $this->sendPopup($this->CraneMinage[$idMeta][1]);
}