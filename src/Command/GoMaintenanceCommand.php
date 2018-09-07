<?php namespace BEA\Composer\GoMaintenance\Command;

use Composer\Command\BaseCommand;
use Composer\Factory;
use Composer\Package\Package;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GoMaintenanceCommand extends BaseCommand {

	protected function configure() {
		$this->setName( 'go-maintenance' )
		     ->setDescription( 'Enable / disable WordPress maintenance mode easily.' )
		     ->addArgument( 'start-stop', InputArgument::REQUIRED, "'start' or 'stop' maintenance mode ?" )
		     ->addArgument( 'wp-rel-dir', InputArgument::OPTIONAL, "Where is installed WordPress (use relative path) ? (default 'wp')" )
		     ->addArgument( 'model-rel-dir', InputArgument::OPTIONAL, "Where is your maintenance.model model (use relative path) ? (default 'tools/')" );
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @author Julien Maury
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {

		$projectRootPath = dirname( Factory::getComposerFile() );

		// Quick access
		$io             = new SymfonyStyle( $input, $output );
		$startStop      = $input->getArgument( 'start-stop' );
		$dir            = ! empty( $input->getArgument( 'wp-rel-dir' ) )
			? $input->getArgument( 'wp-rel-dir' ) : 'wp';
		$model_rel_dir = ! empty( $input->getArgument( 'model-rel-dir' ) )
			? $input->getArgument( 'model-rel-dir' ) : 'tools/maintenance.model';

		if ( ! file_exists( $model_rel_dir ) ) {
			$io->writeln( "There is no model in /tools/ for the .maintenance" );
			exit;
		}

		/**
		 * prevent misuses
		 */
		$dir            = $this->untrailingslashit( $dir );
		$model_rel_dir = $this->untrailingslashit( $model_rel_dir );

		switch ( $startStop ) {

			case 'start':
				// what is the command's purpose
				$io->writeln( "<info>Hello, this command allows you to set your website into maintenance mod.</info>" );

				// everything is ok, launch.
				$io->writeln( "Great ! Let's dot it !" );

				if ( false === $io->confirm( "Do you really want to go maintenance now ?", true ) ) {
					exit;
				}
				$copy = copy( $projectRootPath . '/' . $model_rel_dir . '/maintenance.model', $projectRootPath . '/' . $dir  . '/.maintenance' );
				if ( empty( $copy ) ) {
					$io->error( sprintf( "Copy of %s failed.", $model_rel_dir ) );
					exit;
				}
				$io->success( "Maintenance mod enabled." );
				break;

			case 'stop':
				$maintenance_file_path = $projectRootPath . '/' . $dir . '/.maintenance';
				$unlink                = unlink( $maintenance_file_path );
				if ( empty( $unlink ) ) {
					$io->error( sprintf( "Delete of %s failed.", $model_rel_dir ) );
					exit;
				}
				$io->success( "Maintenance mod disabled." );
				break;
			default:
				$io->error( "You must use 'composer go-maintenance start' or 'composer go-maintenance stop' at least." );
				exit;
		}
	}

	/**
	 * @param $string
	 *
	 * @return string
	 * @author Julien Maury
	 */
	protected function untrailingslashit( $string ) {
		return rtrim( $string, '/\\' );
	}
}
