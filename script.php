<?php
/**
 * @package     PKG_JCE_ADVOGADOS
 * @subpackage  Script
 *
 * @copyright   Copyright (C) 2025 Ponto Mega. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Factory;

return new class () implements InstallerScriptInterface {
    private string $minimumJoomla = '4.0';
    private string $minimumPhp = '7.4';
    
    private array $plugins = [
        ['type' => 'plugin', 'group' => 'jce', 'element' => 'links_advogados'],
        ['type' => 'plugin', 'group' => 'search', 'element' => 'advogados']
    ];

    public function install(InstallerAdapter $adapter): bool
    {
        echo '<p>' . Text::_('PKG_JCE_ADVOGADOS_INSTALL_TEXT') . '</p>';
        return true;
    }

    public function update(InstallerAdapter $adapter): bool
    {
        echo '<p>' . Text::_('PKG_JCE_ADVOGADOS_UPDATE_TEXT') . '</p>';
        return true;
    }

    public function uninstall(InstallerAdapter $adapter): bool
    {
        echo '<p>' . Text::_('PKG_JCE_ADVOGADOS_UNINSTALL_TEXT') . '</p>';
        return true;
    }

    public function preflight(string $type, InstallerAdapter $adapter): bool
    {
        if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
            Log::add(
                Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPhp),
                Log::WARNING,
                'jerror'
            );
            return false;
        }

        if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
            Log::add(
                Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomla),
                Log::WARNING,
                'jerror'
            );
            return false;
        }

        return true;
    }

    public function postflight(string $type, InstallerAdapter $adapter): bool
    {
        // Ativar plugins automaticamente na instalação ou atualização
        if ($type === 'install' || $type === 'update') {
            $this->enablePlugins();
        }
        
        return true;
    }
    
    /**
     * Ativa os plugins do pacote
     */
    private function enablePlugins(): void
    {
        $db = Factory::getContainer()->get('DatabaseDriver');
        
        foreach ($this->plugins as $plugin) {
            $query = $db->getQuery(true)
                ->update($db->quoteName('#__extensions'))
                ->set($db->quoteName('enabled') . ' = 1')
                ->where($db->quoteName('type') . ' = ' . $db->quote($plugin['type']))
                ->where($db->quoteName('folder') . ' = ' . $db->quote($plugin['group']))
                ->where($db->quoteName('element') . ' = ' . $db->quote($plugin['element']));
            
            try {
                $db->setQuery($query);
                $db->execute();
            } catch (\Exception $e) {
                Log::add('Erro ao ativar plugin ' . $plugin['group'] . '/' . $plugin['element'] . ': ' . $e->getMessage(), Log::WARNING, 'jerror');
            }
        }
    }
};
