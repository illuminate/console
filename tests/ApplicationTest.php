<?php

use Mockery as m;

class ApplicationTest extends PHPUnit_Framework_TestCase {

	public function tearDown()
	{
		m::close();
	}


	public function testAddSetsLaravelInstance()
	{
		$app = $this->getMock('Illuminate\Console\Application', array('addToParent'));
		$app->setLaravel('foo');
		$command = m::mock('Illuminate\Console\Command');
		$command->shouldReceive('setLaravel')->once()->with('foo');
		$app->expects($this->once())->method('addToParent')->with($this->equalTo($command))->will($this->returnValue($command));
		$result = $app->add($command);

		$this->assertEquals($command, $result);
	}


	public function testLaravelNotSetOnSymfonyCommands()
	{
		$app = $this->getMock('Illuminate\Console\Application', array('addToParent'));
		$app->setLaravel('foo');
		$command = m::mock('Symfony\Component\Console\Command\Command');
		$command->shouldReceive('setLaravel')->never();
		$app->expects($this->once())->method('addToParent')->with($this->equalTo($command))->will($this->returnValue($command));
		$result = $app->add($command);

		$this->assertEquals($command, $result);
	}

}