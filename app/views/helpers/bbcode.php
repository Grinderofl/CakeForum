<?php

/**
 * 
 * BBCode helper plugin for CakePHP
 * 
 * Contains different formatting functions
 * @author Nero
 *
 */
class BbcodeHelper extends AppHelper {
	
	/**
	 * 
	 * Full list of bbcode regural expressions
	 * @var Array
	 */
	var $bbcode = array(
		"'\[center\](.*?)\[/center\]'is" => "<center>\\1</center>",
		"'\[left\](.*?)\[/left\]'is" => "<div style='text-align: left;'>\\1</div>",
		"'\[right\](.*?)\[/right\]'is" => "<div style='text-align: right;'>\\1</div>",
		"'\[pre\](.*?)\[/pre\]'is" => "<pre>\\1</pre>",
		"'\[b\](.*?)\[/b\]'is" => "<b>\\1</b>",
		//"'\[quote\](.*?)\[/quote\]'is" => "<div class='bbquote'><b>Quote:</b><hr>\\1</div>",
		"'\[i\](.*?)\[/i\]'is" => "<i>\\1</i>",
		"'\[u\](.*?)\[/u\]'is" => "<u>\\1</u>",
		"'\[s\](.*?)\[/s\]'is" => "<del>\\1</del>",
		"'\[move\](.*?)\[/move\]'is" => "<marquee>\\1</marquee>",
		"'\[url\](.*?)\[/url\]'is" => "<a href='\\1' target='_BLANK'>\\1</a>",
		"'\[url=(.*?)\](.*?)\[/url\]'is" => "<a href=\"\\1\" target=\"_BLANK\">\\2</a>",
		"'\[img\](.*?)\[/img\]'is" => "<img border=\"0\" src=\"\\1\">",
		"'\[img=(.*?)\]'" => "<img border=\"0\" src=\"\\1\">",
		"'\[email\](.*?)\[/email\]'is" => "<a href='mailto: \\1'>\\1</a>",
		"'\[size=(.*?)\](.*?)\[/size\]'is" => "<span style='font-size: \\1;'>\\2</span></a>",
		"'\[font=(.*?)\](.*?)\[/font\]'is" => "<span style='font-family: \\1;'>\\2</span></a>",
	);
	
	/**
	 * 
	 * Format a string to bbcode
	 * @param String $str Input string
	 * @return Formatted bbcode string
	 */
	function format ($str) {
		return $this->nl2p(
			$this->bbcodeReplaceQuotes(
			$this->bbcodeReplaceCommon($str)));
	}
	
	/**
	 * 
	 * Converts line breaks to html paragraph entities
	 * @param String $string Input text
	 * @param Boolean $line_breaks Whether to use html breaks instead of paragraphs
	 * @param Boolean $xml Is the input string XML
	 */
	private function nl2p($string, $line_breaks = false, $xml = true)
	{
	    $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);
	    
	    if ($line_breaks == true)
	        return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '<br'.($xml == true ? ' /' : '').'>'), trim($string)).'</p>';
	    else 
	        return '<p>'.preg_replace("/([\n]{1,})/i", "</p>\n<p>", trim($string)).'</p>';
	}
	 
	/**
	 * 
	 * Replace common BBCode characters, doesn't touch specific formatted objects
	 * @param String $str Input text
	 */
	private function bbcodeReplaceCommon ($str) {
		return preg_replace(array_keys($this->bbcode), array_values($this->bbcode), $str);
	}
	
	/**
	 * 
	 * Custom quote replacement function, allows recursive quoting
	 * @param String $str Input text
	 */
	private function bbcodeReplaceQuotes ($str) {
		$open = '<div class="bbquote"><b>Quote: </b><hr />';  
        $close = '</div>';

        preg_match_all ('/\[quote\]/i', $str, $matches);
        $opentags = count($matches['0']);

        preg_match_all ('/\[\/quote\]/i', $str, $matches);
        $closetags = count($matches['0']);

        $unclosed = $opentags - $closetags;
        for ($i = 0; $i < $unclosed; $i++) {
                $str .= '</div>';
        }
        $str = str_replace ('[quote]', $open, $str);
        $str = preg_replace('/\[quote\=(.*?)\]/is','<div class="bbquote dark"><b>Quote: $1</b><hr />', $str);
        $str = str_replace ('[/quote]', $close, $str);
		return $str;
	}
}
