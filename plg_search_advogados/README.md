# Search Plugin for Advogados (Lawyers)

This Joomla search plugin enables JCE Editor's Link Browser to search and link to lawyer profiles from `com_advogados`.

## Installation

1. Install via Joomla Extensions installer or Discovery
2. Enable the plugin in **Extensions → Plugins**
3. In JCE Editor settings (**Components → JCE Editor → Profiles**), go to the **Link** tab
4. Add "advogados" to the **Link Search Plugins** list (if not already there)

### What Gets Installed

The plugin automatically:
- Installs the search functionality for Joomla's search system
- Copies `joomlalinks.php` to `components/com_jce/editor/extensions/links/joomlalinks/advogados.php`
  - This enables the folder browser navigation in JCE Link dialog
- Removes the JCE file on uninstallation

## Features

- **Search**: Search lawyers by name, position, or profile description
- **Browse**: Navigate through lawyer list in JCE Link Browser folder tree
- **Language Display**: Shows language suffix (pt-BR, en-GB) after lawyer name
- **Configurable**: Adjust search result limit in plugin settings

## Usage

### Via Link Browser (Navigation)
1. Open JCE editor
2. Click the **Link** button
3. In the left panel, expand **Advogados** folder
4. Click on a lawyer name to insert link

### Via Search
1. Open JCE editor
2. Click the **Link** button  
3. In the search field at top, select **Advogados** from dropdown
4. Type lawyer name and click search
5. Click result to insert link

## Configuration

- **Search Limit**: Maximum number of search results (default: 50)

## Technical Details

- **Type**: Search Plugin (Joomla standard)
- **Group**: search
- **Events**: `onContentSearchAreas`, `onContentSearch`
- **Database**: `#__advogados` table
- **JCE Compatible**: Yes (automatically detected)
- **JCE Link Browser**: Requires file in JCE core (auto-installed by script.php)

## Why This Approach?

As confirmed by JCE developer Ryan Demmer ([GitHub Issue #140](https://github.com/widgetfactory/jce/issues/140)):

1. **Search functionality**: JCE natively supports Joomla Search plugins
2. **Link browser navigation**: Requires a file in JCE's joomlalinks folder (no plugin API available)

This plugin uses both methods:
- Search plugin for the search functionality (standard Joomla way)
- Installation script to copy link browser file to JCE core (only way to add folder navigation)

## File Locations

After installation:
- Plugin files: `plugins/search/advogados/`
- JCE adapter (auto-copied): `components/com_jce/editor/extensions/links/joomlalinks/advogados.php`

## Uninstallation

The plugin will automatically:
- Remove itself from `plugins/search/advogados/`
- Delete the JCE adapter file
- Clean up all references

## License

GNU General Public License version 2 or later
