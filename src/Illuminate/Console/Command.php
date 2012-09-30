<?php namespace Illuminate\Console;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends \Symfony\Component\Console\Command\Command {

	/**
	 * The Laravel application instance.
	 *
	 * @var Illuminate\Foundation\Application
	 */
	protected $laravel;

	/**
	 * The input interface implementation.
	 *
	 * @var Symfony\Component\Console\Input\InputInterface
	 */
	protected $input;

	/**
	 * The output interface implementation.
	 *
	 * @var Symfony\Component\Console\Output\OutputInterface
	 */
	protected $output;

	/**
	 * Run the conosle command.
	 *
	 * @param  Symfony\Component\Console\Input\InputInterface  $input
	 * @param  Symfony\Component\Console\Output\OutputInterface  $output
	 * @return mixed
	 */
	public function run(InputInterface $input, OutputInterface $output)
	{
		$this->input = $input;

		$this->output = $output;

		return parent::run($input, $output);
	}

	/**
	 * Call another console command.
	 *
	 * @param  string  $command
	 * @param  array   $arguments
	 * @return mixed
	 */
	public function call($command, array $arguments = array())
	{
		$instance = $this->getApplication()->find($command);

		return $instance->run(new ArrayInput($arguments), $this->output);
	}

	/**
	 * Set the Laravel application instance.
	 *
	 * @return Illuminate\Foundation\Application
	 */
	public function getLaravel()
	{
		return $this->laravel;
	}

	/**
	 * Set the Laravel application instance.
	 *
	 * @param  Illuminate\Foundation\Application  $laravel
	 * @return void
	 */
	public function setLaravel($laravel)
	{
		$this->laravel = $laravel;
	}

}