<?php
namespace App\Autolink;

use Illuminate\Support\Str;
use OsiemSiedem\Autolink\Contracts\Element;
use OsiemSiedem\Autolink\Cursor;
use OsiemSiedem\Autolink\Elements\UrlElement;
use App\Autolink\HtmlElement;

class YouTubeParser extends \OsiemSiedem\Autolink\Parsers\UrlParser
{
    /**
     * @var bool
     */
    protected $allowShort = false;

    /**
     * Get the characters.
     *
     * @return array
     */
    public function getCharacters(): array
    {
        return [':'];
    }
	
	public function getDomains(): array
	{
		return ['www.youtube.com', 'youtube.com'];
	}

    /**
     * Parse the text.
     *
     * @param  \OsiemSiedem\Autolink\Cursor  $cursor
     * @return \OsiemSiedem\Autolink\Contracts\Element|null
     */
    public function parse(Cursor $cursor): ?Element
    {
		// preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$post_details['description']);

        $start = $cursor->getPosition();

        if ($cursor->getText($start, 3) !== '://') {
            return null;
        }

        if (! $this->validateDomain($cursor, $start + 3, $this->allowShort)) {
            return null;
        }
		
		if (!in_array($cursor->getText($start + 3, 15), $this->getDomains())) {
			return null;
		}

        while ($cursor->valid()) {
            $character = $cursor->getCharacter();

            if ($this->isWhitespace($character)) {
                break;
            }

            $cursor->next();
        }

        $end = $cursor->getPosition();

        while ($start > 0) {
            if (ctype_alpha($cursor->getCharacter($start - 1))) {
                $start--;

                continue;
            }

            break;
        }

        if (! $this->validateProtocol($cursor, $start)) {
            return null;
        }

        $position = $this->trimMoreDelimeters($cursor, $start, $end);

        $url = $title = $cursor->getText($position['start'], $position['end'] - $position['start']);
		
		$url = '//www.youtube.com/embed/'.$this->getVideoId($url);
		
		return new HtmlElement($position['start'], $position['end'], 'iframe', '', [
			'width' => '420',
			'height' => '315',
			'src' => $url,
			'frameborder' => '0',
			'allowfullscreen' => '',
		]);
		
		// return "<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>";
    }
	
	protected function getVideoId($url) 
	{
		preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $matches);
		return $matches[1];
	}
}
