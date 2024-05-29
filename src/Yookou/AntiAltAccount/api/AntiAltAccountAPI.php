<?php

namespace Yookou\AntiAltAccount\api;

use JsonException;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use Yookou\AntiAltAccount\Main;
use Yookou\AntiAltAccount\utils\ConfigName;

class AntiAltAccountAPI {
	use SingletonTrait;

	public function __construct(private Main $plugin) {
	}

	/**
	 * @throws JsonException
	 */
	public function insertIp(string $ip) : void {
		$ip = mb_strtolower($ip);
		$config = new Config($this->plugin->getDataFolder() . ConfigName::IP_DATA, Config::JSON);
		$config->set($ip);
		$config->save();
	}

	public function alreadyHaveIp(string $ip) : bool {
		$ip = mb_strtolower($ip);
		$config = new Config($this->plugin->getDataFolder() . ConfigName::IP_DATA, Config::JSON);

		return $config->exists($ip);
	}

	/**
	 * @throws JsonException
	 */
	public function insertId(string $id) : void {
		$id = mb_strtolower($id);
		$config = new Config($this->plugin->getDataFolder() . ConfigName::ID_DATA, Config::JSON);
		$config->set($id);
		$config->save();
	}

	public function alreadyHaveId(string $id) : bool {
		$id = mb_strtolower($id);
		$config = new Config($this->plugin->getDataFolder() . ConfigName::ID_DATA, Config::JSON);

		return $config->exists($id);
	}
}
