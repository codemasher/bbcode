<?php
/**
 * Class Lists
 *
 * @filesource   Lists.php
 * @created      12.10.2015
 * @package      chillerlan\bbcode\Modules\Html5
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2015 Smiley
 * @license      MIT
 */

namespace chillerlan\bbcode\Modules\Html5;

use chillerlan\bbcode\Modules\ModuleInterface;

/**
 * Transforms list tags into HTML5
 */
class Lists extends Html5BaseModule implements ModuleInterface{

	/**
	 * Map of attribute value -> css property
	 *
	 * @var array
	 */
	const TYPES = [
		'0' => 'decimal-leading-zero',
		'1' => 'decimal',
		'a' => 'lower-alpha',
		'A' => 'upper-alpha',
		'i' => 'lower-roman',
		'I' => 'upper-roman',
		'c' => 'circle',
		's' => 'square',
		'd' => 'disc',
	];

	/**
	 * Unordered lists
	 *
	 * @var array
	 */
	const UNORDERED = ['c', 'd', 's'];

	/**
	 * Ordered lists
	 *
	 * @var array
	 */
	const ORDERED = ['0', '1', 'a', 'A', 'i', 'I'];

	/**
	 * An array of tags the module is able to process
	 *
	 * @var array
	 * @see \chillerlan\bbcode\Modules\Tagmap::$tags
	 */
	protected $tags = ['list'];

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

		$start = $this->bbtag();
		$list_tag = (count($this->attributes) === 0 || $this->attributeIn('type', self::UNORDERED) ? 'ul' : 'ol');

		return '<'.$list_tag
			.(is_numeric($start) && $this->attributeIn('type', self::ORDERED) ? ' start="'.ceil($start).'"' : '')
			.($this->getAttribute('reversed') && $this->attributeIn('type', self::ORDERED) ? ' reversed="true"' : '')
			.$this->getTitle()
			.$this->getCssClass(['bb-list', $this->attributeKeyIn('type', self::TYPES, 'disc')]).'>'
			.'<li>'.implode(array_slice(explode('[*]', $this->content), true), '</li><li>').'</li>' // nasty
			.'</'.$list_tag.'>';
	}

}
