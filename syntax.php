<?php
/**
 * DokuWiki Plugin alainplugin (Syntax Component)
 *
 * simpele plugin plugin om bv. een datum goed te doen uitkomen in een documnet.
 * bv. ::2 mei::
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Alain Benbassat <alain@businessandcode.eu>
 */
class syntax_plugin_alainplugin extends \dokuwiki\Extension\SyntaxPlugin
{
    /** @inheritDoc */
    public function getType()
    {
        return 'formatting';
    }

    /** @inheritDoc */
    public function getPType()
    {
        return 'normal';
    }

    /** @inheritDoc */
    public function getSort()
    {
        return 136;
    }

    /** @inheritDoc */
    public function connectTo($mode)
    {
        $this->Lexer->addEntryPattern('::', $mode, 'plugin_alainplugin');
    }

    /** @inheritDoc */
    public function postConnect()
    {
        $this->Lexer->addExitPattern('::', 'plugin_alainplugin');
    }

    /** @inheritDoc */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        switch ($state) {
          case DOKU_LEXER_ENTER :
                return [$state, []];

          case DOKU_LEXER_UNMATCHED :  return [$state, $match];
          case DOKU_LEXER_EXIT :       return [$state, ''];
        }
        return [];
    }

    /** @inheritDoc */
    public function render($mode, Doku_Renderer $renderer, $data)
    {
        if ($mode !== 'xhtml') {
            return false;
        }
            [$state, $match] = $data;
            switch ($state) {
              case DOKU_LEXER_ENTER :
                $renderer->doc .= "<span style='color:white; background-color:#1E90FF; font-weight:bold; padding-left:4px; padding-right:4px'>";
                break;

              case DOKU_LEXER_UNMATCHED :  $renderer->doc .= $renderer->_xmlEntities($match); break;
              case DOKU_LEXER_EXIT :       $renderer->doc .= "</span>"; break;
            }
            return true;


        return true;
    }
}

