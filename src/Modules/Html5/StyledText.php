<?php
/**
 * Class StyledText
 *
 * @filesource   StyledText.php
 * @created      12.10.2015
 * @package      chillerlan\bbcode\Modules\Html5
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace chillerlan\bbcode\Modules\Html5;

use chillerlan\bbcode\Modules\ModuleInterface;

/**
 * Transforms several styled text tags into HTML5
 */
class StyledText extends Html5BaseModule implements ModuleInterface{

	/**
	 * CSS classes for each tag
	 */
	const CSS_CLASS = [
		'color' => 'color',
		'font'  => 'font',
		'size'  => 'size',
		'tt'    => 'typewriter',
		'i'     => 'italic',
		'b'     => 'bold',
		's'     => 'linethrough',
		'u'     => 'underline',
	];

	/**
	 * An array of tags the module is able to process
	 *
	 * @var array
	 * @see \chillerlan\bbcode\Modules\Tagmap::$tags
	 */
	protected $tags = ['s', 'b', 'u', 'i', 'tt', 'size', 'color', 'font'];

	/**
	 * Transforms the bbcode, called from BaseModuleInterface
	 *
	 * @return string a transformed snippet
	 * @see \chillerlan\bbcode\Modules\BaseModuleInterface::transform()
	 * @internal
	 */
	public function __transform():string{

		if(empty($this->content)){
			return '';
		}

		$style = [];

		if(in_array($this->tag, ['color', 'font', 'size'])){
			$bbtag = $this->bbtag();

			$style = [
				'color' => ['color' => $bbtag],
				'font'  => ['font-family' => $this->bbtagIn($this->allowed_fonts, '')],
				'size'  => ['font-size' => $bbtag],
			][$this->tag];
		}

		return '<span'.$this->getTitle()
			.$this->getCssClass(['bb-text', self::CSS_CLASS[$this->tag]])
			.$this->getStyle($style).'>'.$this->content.'</span>';
	}

}
