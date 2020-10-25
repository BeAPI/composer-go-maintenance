<?php namespace BEA\Composer\GoMaintenance;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

class GoMaintenance implements PluginInterface, Capable, CommandProvider {

	/**
	 * @var Composer
	 */
	private $composer;

	/**
	 * @var IOInterface
	 */
	private $io;

	public function activate( Composer $composer, IOInterface $io ) {
		$this->composer = $composer;
		$this->io       = $io;
	}

	public function deactivate(Composer $composer, IOInterface $io)
	{
	}

	public function uninstall(Composer $composer, IOInterface $io)
	{
	}

	public function getCapabilities() {
		return [
			CommandProvider::class => __CLASS__,
		];
	}

	public function getCommands() {
		return [
			new Command\GoMaintenanceCommand,
		];
	}
}