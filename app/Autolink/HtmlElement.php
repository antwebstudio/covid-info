<?php

namespace App\Autolink;

use Spatie\Html\Elements\Iframe;
use Spatie\Html\Attributes;

class HtmlElement extends \OsiemSiedem\Autolink\Elements\BaseElement
{
	protected $label;
	
    public function __construct(int $start, int $end, string $tag, string $label, array $attributes = [])
    {
        $this->start = $start;
        $this->end = $end;
        $this->tag = $tag;
        $this->label = $label;
		$this->title = $this->label;
        $this->attributes = $attributes;
    }
	
	public function getHtml()
	{
		return \Spatie\Html\Elements\Element::withTag($this->tag)
			->text($this->label)
			->attributes($this->attributes)
			->toHtml();
	}
}