<?php
/**
 *
 * @filesource   SimpletextTest.php
 * @created      04.03.2016
 * @package      chillerlan\BBCodeTest\normal\Modules\HTML5
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace chillerlan\BBCodeTest\normal\Modules\HTML5;
use chillerlan\bbcode\Modules\Html5\Simpletext;

/**
 * Class SimpletextTest
 */
class SimpletextTest extends HTML5TestBase{
	
	public function simpletextDataProvider($tag){
		$this->setUp();
		return [array_keys($this->parser->getTagmap(), Simpletext::class)];
	}
	
	/**
	 * @dataProvider simpletextDataProvider
	 */
	public function testSimpletextModule($tag){
		$expected = '<'.$tag.' class="foobar">WAT</'.$tag.'>';

		$this->assertEquals($expected, $this->parser->parse('['.$tag.' class=foobar]WAT[/'.$tag.']'));
	}
	
}
