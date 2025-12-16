<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Search.Advogados
 *
 * @copyright   Copyright (C) 2025 Machado Meyer. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Database\ParameterType;

/**
 * Search plugin for Advogados (Lawyers)
 * Enables JCE Link Browser to search and link to lawyer profiles
 */
class PlgSearchAdvogados extends CMSPlugin
{
    protected $autoloadLanguage = true;

    /**
     * Load JCE adapter if JCE is requesting
     */
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);
    }

    /**
     * Content Search Areas
     *
     * @return  array  An array of search areas
     */
    public function onContentSearchAreas()
    {
        // Debug log
        error_log('PlgSearchAdvogados::onContentSearchAreas called');
        
        static $areas = array(
            'advogados' => 'PLG_SEARCH_ADVOGADOS_AREA'
        );
        return $areas;
    }

    /**
     * Search content (advogados)
     *
     * @param   string  $text      Target search string
     * @param   string  $phrase    Matching option (exact|any|all)
     * @param   string  $ordering  Ordering option (newest|oldest|popular|alpha|category)
     * @param   mixed   $areas     An array if the search is to be restricted to areas or null to search all areas
     *
     * @return  array  Search results
     */
    public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
    {
        $db = Factory::getDbo();
        $app = Factory::getApplication();
        $user = $app->getIdentity();
        $groups = $user->getAuthorisedViewLevels();

        if (is_array($areas) && !array_intersect($areas, array_keys($this->onContentSearchAreas()))) {
            return array();
        }

        $limit = $this->params->def('search_limit', 50);
        $text = trim($text);
        
        if ($text == '') {
            return array();
        }

        $section = Text::_('PLG_SEARCH_ADVOGADOS_AREA');

        $rows = array();
        $query = $db->getQuery(true);

        // Search query
        $query->select('a.id, a.codigo, a.nome, a.cargo, a.descricao_perfil, a.alias, a.linguagem, a.created_at')
            ->from($db->quoteName('#__advogados', 'a'))
            ->where($db->quoteName('a.state') . ' = 1');

        // Search in name, position, or profile description
        $searchFields = array(
            'a.nome',
            'a.cargo', 
            'a.descricao_perfil'
        );

        $searchText = $db->quote('%' . str_replace(' ', '%', $db->escape($text, true) . '%'), false);

        switch ($phrase) {
            case 'exact':
                $where = array();
                foreach ($searchFields as $field) {
                    $where[] = $field . ' LIKE ' . $db->quote('%' . $db->escape($text, true) . '%', false);
                }
                $query->where('(' . implode(' OR ', $where) . ')');
                break;

            case 'all':
            case 'any':
            default:
                $words = explode(' ', $text);
                $where = array();
                foreach ($words as $word) {
                    $word = $db->escape($word, true);
                    $wordWhere = array();
                    foreach ($searchFields as $field) {
                        $wordWhere[] = $field . ' LIKE ' . $db->quote('%' . $word . '%', false);
                    }
                    $where[] = '(' . implode(' OR ', $wordWhere) . ')';
                }
                
                if ($phrase == 'all') {
                    $query->where(implode(' AND ', $where));
                } else {
                    $query->where(implode(' OR ', $where));
                }
                break;
        }

        // Ordering
        switch ($ordering) {
            case 'alpha':
                $query->order('a.nome ASC');
                break;

            case 'oldest':
                $query->order('a.created_at ASC');
                break;

            case 'popular':
            case 'newest':
            default:
                $query->order('a.created_at DESC');
                break;
        }

        $db->setQuery($query, 0, $limit);
        $items = $db->loadObjectList();

        foreach ($items as $item) {
            // Format language display
            $lang = $this->getLanguageDisplay($item->linguagem);
            
            $rows[] = (object) array(
                'title'     => $item->nome . ($lang ? ' (' . $lang . ')' : ''),
                'text'      => $item->cargo . ': ' . strip_tags($item->descricao_perfil),
                'section'   => $section,
                'created'   => $item->created_at,
                'href'      => 'index.php?option=com_advogados&view=advogado&id=' . $item->id,
                'browsernav' => 2
            );
        }

        return $rows;
    }

    /**
     * Format language display (pt_BR -> pt-BR, en_GB -> en-GB)
     */
    private function getLanguageDisplay($language)
    {
        if (empty($language) || $language === '*') {
            return '';
        }

        // Normalize pt_BR to pt-BR, en_GB to en-GB
        return str_replace('_', '-', $language);
    }
}
