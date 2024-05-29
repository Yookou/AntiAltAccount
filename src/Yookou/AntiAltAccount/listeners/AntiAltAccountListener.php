<?php

namespace Yookou\AntiAltAccount\listeners;

use JsonException;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use Yookou\AntiAltAccount\api\AntiAltAccountAPI;
use Yookou\AntiAltAccount\Main;

class AntiAltAccountListener implements Listener {
	/**
	 * @throws JsonException
	 */
	public function onPlayerLogin(PlayerLoginEvent $event) : void {
		$player = $event->getPlayer();

		if (!$player->hasPlayedBefore()) {
			return;
		}

		$antiAltAccountAPI = AntiAltAccountAPI::getInstance();
		if ($antiAltAccountAPI->alreadyHaveIp($player->getNetworkSession()->getIp()) &&
			$antiAltAccountAPI->alreadyHaveId($player->getPlayerInfo()->getExtraData()["ClientRandomId"])) {
			$event->setKickMessage(Main::getInstance()->getConfig()->get("kick-message"));
		} else {
			$antiAltAccountAPI->insertIp($player->getNetworkSession()->getIp());
			$antiAltAccountAPI->insertId($player->getPlayerInfo()->getExtraData()["ClientRandomId"]);
		}
	}
}
