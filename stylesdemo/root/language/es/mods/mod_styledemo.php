<?php
/**
* @package: phpBB 3.0.8 :: Style Demo MOD -> root/language/en/mods :: [es][Spanish]
* @version: $Id: mod_styledemo.php, v 1.0.1 2010/11/25 10:11:25 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @translator: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
**/

/**
* DO NOT CHANGE
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// UMIL Installer
	'INSTALLER_TITLE'				=> 'Demo de Estilos',
	'INSTALLER_TITLE_EXPLAIN'		=> 'Bienvenido a la instalación del <strong>Demo de Estilos</strong>',

// ACP 
	'SD_LINK_TO_MSSTI'		=> 'Style Demo MOD, versión %s por <a href="http://www.mssti.com/phpbb3" onclick="window.open(this.href);return false;">mssti</a>',

	'ACP_SD_TITLE'					=> 'Style Demo',
	'ACP_SD_TITLE_EXPLAIN'			=> 'Desde aquí puede administrar la información de los estilos disponibles. Usted puede alterar la información de los estilos para el “Style Demo MOD”, note que esta información no interfiere con los datos de los estilos para phpBB. El estilo por defecto actual es señalado con un asterisco (*)',
	'ACP_SD_SETTINGS'				=> 'Style Demo Preferencias',
	'ACP_SD_SETTINGS_EXPLAIN'		=> 'Aquí puede ajustar la configuración básica para el “Style Demo MOD”.',
// ACP Preferencias
	'ACP_SD_DISABLE'				=> 'Deshabilitar',
	'ACP_SD_DISABLE_EXPLAIN'		=> 'Esto hará al “Style Demo MOD” inaccesible a los usuarios.',
	'ACP_SD_HIDE_FRAME'				=> 'Ocultar frame',
	'ACP_SD_HIDE_FRAME_EXPLAIN'		=> 'Deshabilitar la barra de “Contraer/Expandir” vista.',
	'ACP_SD_TOPFRAME_HEIGHT'		=> 'Altura del marco',
	'ACP_SD_TOPFRAME_HEIGHT_EXPLAIN'=> 'Por defecto el alto del marco superior.',
	'ACP_SD_STYLE_ACTIVE'			=> 'Estilos disponibles',
	'ACP_SD_STYLE_ACTIVE_EXPLAIN'	=> 'Mostrar todos los estilos ( Activados y Desactivados ) instalados, o solamente los estilos activos.',
	'ACP_SD_LANGUAGE_ACTIVE'		=> 'Idiomas disponibles',
	'ACP_SD_LANGUAGE_ACTIVE_EXPLAIN'=> 'Mostrar un selector con todos los idomas disponibles.<br />Nota: los estilos deben contener instalados los “Paquetes de imágenes” correspondientes a cada idioma',
	'ACP_SD_GUESTS_ACTIVE'			=> 'Invitados',
	'ACP_SD_GUESTS_ACTIVE_EXPLAIN'	=> 'Desabilitar a usuarios no registrados.',
	'ACP_SD_BASIS_OPTIONS'			=> 'Opciones basicas',
	'ACP_SD_SELECTED_STYLE'			=> 'Estilo seleccionado',
	'ACP_SD_SELECT_STYLE'			=> 'Seleccione estilo',
	'ACP_SD_IDENTIFIER'				=> 'Número de identificacion',
	'ACP_SD_STYLE_NAME'				=> 'Nombre del Estilo',
	'ACP_SD_STYLE_VERSION'			=> 'Version del estilo',
	'ACP_SD_STYLE_VERSION_EXPLAIN'	=> 'Número de version de este estilo',
	'ACP_SD_PHPBB_VERSION'			=> 'Version de phpBB',
	'ACP_SD_PHPBB_VERSION_EXPLAIN'	=> 'Número de versión de phpBB para el cual fué creado',
	'ACP_SD_STYLE_AUTHOR'			=> 'Autor del estilo',
	'ACP_SD_STYLE_AUTHOR_EXPLAIN'	=> 'Nombre o usuario del autor',
	'ACP_SD_WEB_AUTHOR'				=> 'URL del autor',
	'ACP_SD_WEB_AUTHOR_EXPLAIN'		=> 'Enlace a la web del autor o a su perfil en phpBB',
	'ACP_SD_SUPPORT'				=> 'URL de soporte',
	'ACP_SD_SUPPORT_EXPLAIN'		=> 'Enlace al sitio de soporte',
	'ACP_SD_DOWNLOAD'				=> 'URL de descarga',
	'ACP_SD_DOWNLOAD_EXPLAIN'		=> 'Enlace para descargar este estilo',
	'ACP_SD_LINK_EXPLAIN'			=> 'URL completa (incluyendo el protocolo, p.ej. <samp>http://</samp>) a la que se redireccionará al usuario.',
	'ACP_SD_STYLE_UPDATED'			=> 'Estilo actualizado correctamente.',
// Comunes
	'SD_COPYRIGHT'			=> 'Copyright',
	'SD_INHERITING_FROM'	=> 'Hereda de',
	'SD_STYLE_TEMPLATE'		=> 'Plantilla',
	'SD_STYLE_THEME'		=> 'Tema',
	'SD_STYLE_IMAGESET'		=> 'Paquete de imágenes',
// Script
	'SD_TITLE'				=> 'Style Demo',
	'SD_SELECT_STYLE'		=> 'Selecione estilo',
	'SD_STYLE_NAME'			=> 'Nombre del estilo',
	'SD_STYLE_VERSION'		=> 'Versión del estilo',
	'SD_PHPBB_VERSION'		=> 'Version de phpBB',
	'SD_STYLE_AUTHOR'		=> 'Autor',
	'SD_SUPPORT'			=> 'Soporte',
	'SD_DOWNLOAD'			=> 'Descargar',
	'SD_COLLAPSE_VIEW'		=> 'Contraer vista',
	'SD_EXPAND_VIEW'		=> 'Expandir vista',
	'SD_PREVIOUS'			=> 'Anterior',
	'SD_NEXT'				=> 'Siguiente',
	'SD_DEFAULT_LANG'		=> 'Seleccione idioma',
	'SD_DELETE_COOKIES'		=> 'Borrar las cookies',
	'SD_LINK_REMOTE'		=> 'Enlace externo',
// Errores
	'WRONG_DATA'		=> 'La dirección del sitio web tiene que ser una URL válida, incluyendo el protocolo, por ejemplo http://www.ejemplo.com/',
	'TOO_LONG'			=> 'El valor que introdujo es demasiado largo.',
	'TOO_SHORT'			=> 'El valor que introdujo es demasiado corto.',
	'SD_NO_STYLE_DATA'	=> 'No se pudo encontrar el estilo',
	'SD_NOFRAMES'		=> 'Disculpe, nu navegador no pospora frames',
	'SD_AJAX_DISABLED'	=> '<strong>Estado:</strong> No se pudo crear el Ojbeto. Su navegador no es compatible con AJAX (XMLHttpRequest) y es incapaz de procesar esta solicitud.',

));

?>