<?php
/* SVN FILE: $Id: SassMediaNode.php 49 2010-04-04 10:51:24Z chris.l.yates $ */
/**
 * SassMediaNode class file.
 * @author      Richard Lyon
 * @copyright   none
 * @license     http://phamlp.googlecode.com/files/license.txt
 * @package     PHamlP
 * @subpackage  Sass.tree
 */
/**
 * SassMediaNode class.
 * Represents a CSS @media directive
 * @package     PHamlP
 * @subpackage  Sass.tree
 */
class SassMediaNode extends SassNode {
  const IDENTIFIER = '@';
  const MATCH = '/^@(media)\s+(.+?)\s*;?$/';
  const MEDIA = 1;
  public $token;
  /**
   * @var string
   */
  private $media;
  /**
   * @var array parameters for the message;
   * only used by internal warning messages
   */
  private $params;
  /**
   * @var boolean true if this is a warning
   */
  private $warning;
  /**
   * SassMediaNode.
   * @param object source token
   * @param mixed string: an internally generated warning message about the
   * source
   * boolean: the source token is a @Media or @warn directive containing the
   * message; True if this is a @warn directive
   * @param array parameters for the message
   * @return SassMediaNode
   */
  public function __construct($token) {
    parent::__construct($token);
    preg_match(self::MATCH, $token->source, $matches);
    $this->token = $token;
    $this->media = $matches[self::MEDIA];
  }
  /**
   * Parse this node.
   * This raises an error.
   * @return array An empty array
   */
  public function parse($context) {
    $this->token->source = SassDirectiveNode::interpolate_nonstrict($this->token->source, $context);
    $node = new SassRuleNode($this->token, $context);
    $node->root = $this->parent->root;
    $rule = clone $this->parent;
    $rule->root = $node->root;
    $rule->children = $this->children;
    $try = $rule->parse($context);
    if (is_array($try)) {
      $rule->children = $try;
    }
    // Tests were failing with this, but I'm not sure if we cover every case.
    //else if (is_object($try) && method_exists($try, 'render')) {
    //  $rule = $try;
    //}
    $node->children = array(new SassString($rule->render($context)));
    return array($node);
  }
}
