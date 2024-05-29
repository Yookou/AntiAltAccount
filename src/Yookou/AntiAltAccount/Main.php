<?php

namespace Yookou\AntiAltAccount;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use Yookou\AntiAltAccount\listeners\AntiAltAccountListener;
use Yookou\AntiAltAccount\utils\ConfigName;

class Main extends PluginBase {
	use SingletonTrait;

	protected function onLoad() : void {
		self::setInstance($this);
		$this->saveResources();
		$this->saveDefaultConfig();
	}

	protected function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents(new AntiAltAccountListener(), $this);
	}

	protected function onDisable() : void {
		$this->saveResources();
	}

	private function saveResources() : void {
		$this->saveResource(ConfigName::IP_DATA);
		$this->saveResource(ConfigName::ID_DATA);
	}
}
