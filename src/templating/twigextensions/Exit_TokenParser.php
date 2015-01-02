<?php
/**
 * @link http://buildwithcraft.com/
 * @copyright Copyright (c) 2013 Pixel & Tonic, Inc.
 * @license http://buildwithcraft.com/license
 */

namespace craft\app\templating\twigextensions;

/**
 * Class Exit_TokenParser
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class Exit_TokenParser extends \Twig_TokenParser
{
	// Public Methods
	// =========================================================================

	/**
	 * Parses {% exit %} tags.
	 *
	 * @param \Twig_Token $token
	 *
	 * @return Exit_Node
	 */
	public function parse(\Twig_Token $token)
	{
		$lineno = $token->getLine();
		$stream = $this->parser->getStream();

		if ($stream->test(\Twig_Token::NUMBER_TYPE))
		{
			$status = $this->parser->getExpressionParser()->parseExpression();
		}
		else
		{
			$status = null;
		}

		$stream->expect(\Twig_Token::BLOCK_END_TYPE);

		return new Exit_Node(array('status' => $status), array(), $lineno, $this->getTag());
	}

	/**
	 * Defines the tag name.
	 *
	 * @return string
	 */
	public function getTag()
	{
		return 'exit';
	}
}
